# Symfony UX LiveComponent - Cycle de vie

## Vue d'ensemble

Les LiveComponents ont un cycle de vie complexe qui diffère selon qu'il s'agit du **premier chargement** (rendu initial) ou d'une **requête Live** (mise à jour AJAX).

## Phases du cycle de vie

### 1. Premier chargement (Initial Render)

```
Constructor → PreMount → Mount → PostMount → instantiateForm → Render
```

1. **`__construct()`** : Injection de dépendances
2. **`#[PreMount] preMount(array &$data)`** : Manipuler les données AVANT qu'elles soient affectées aux props
3. **`mount(...$props)`** : Recevoir et initialiser les props passées depuis le template
4. **`#[PostMount] postMount()`** : Logique d'initialisation APRÈS l'affectation des props
5. **`instantiateForm()`** : Création du formulaire (si `ComponentWithFormTrait`)
6. **Render** : Rendu du template Twig

### 2. Requête Live (AJAX Request)

```
Constructor → Hydration → LiveAction → Dehydration → Render
```

1. **`__construct()`** : ⚠️ **TOUJOURS appelé**, même pour les requêtes Live
2. **Hydration** : Reconstruction des `#[LiveProp]` depuis les données HTML
3. **LiveAction** : Exécution de l'action (ex: `addProduction()`)
4. **Dehydration** : Sérialisation des `#[LiveProp]` pour la réponse
5. **Render** : Rendu partiel ou complet

## Propriétés : LiveProp vs Variables normales

### `#[LiveProp]` - Propriétés persistantes

```php
#[LiveProp]
public ?OrchardDTO $initialFormData = null;

#[LiveProp]
public array $farmBusinessChoices = [];
```

**Comportement** :
- ✅ Persistées entre les requêtes Live (sérialisées en HTML)
- ✅ Reconstruites automatiquement lors des requêtes Live (hydration)
- ⚠️ Doivent être sérialisables (primitifs, arrays, ou custom hydrate/dehydrate)

**Techniques de sérialisation** :
1. **Auto** (défaut) : Types primitifs (string, int, bool, array de primitifs)
2. **`writable: false`** : Propriété en lecture seule, pas de sérialisation
3. **`useSerializerForHydration: true`** : Utilise le Symfony Serializer
4. **Custom** : `dehydrateWith` / `hydrateWith` pour contrôle total

### Variables normales - Non persistantes

```php
private array $farmBusinessChoices = []; // ❌ Sans #[LiveProp]
```

**Comportement** :
- ✅ Initialisées au premier chargement (si passées en paramètre du composant)
- ❌ **Réinitialisées à `null` ou valeur par défaut** après chaque requête Live
- ⚠️ Ne persistent PAS entre les requêtes

**Exemple du problème** :

```php
// Template
<twig:OrchardFormComponent :formData="formData" />

// Composant
public ?OrchardDTO $formData = null; // ❌ Sans #[LiveProp]

// Premier chargement : $formData = OrchardDTO (OK)
// Requête Live (addProduction) : $formData = null (PERDU!)
```

## Méthodes du cycle de vie

### `__construct()`

**Quand** : À chaque reconstruction du composant (premier chargement ET requêtes Live)

**Usage** :
- ✅ Injection de dépendances (repositories, services)
- ❌ PAS pour initialiser des données qui doivent persister

```php
public function __construct(
    private readonly CommandBus $commandBus,
    private readonly FarmBusinessRepository $farmBusinessRepository,
) {}
```

### `#[PreMount] preMount(array &$data)`

**Quand** : Avant l'affectation des props (premier chargement uniquement)

**Usage** :
- Transformer les données entrantes
- Valider ou normaliser les props

```php
#[PreMount]
public function preMount(array &$data): void
{
    // Modifier $data AVANT qu'il soit affecté aux propriétés
    $data['someValue'] = strtolower($data['someValue']);
}
```

### `mount(...$props)`

**Quand** : Recevoir les props du template (premier chargement uniquement)

**Usage** :
- Recevoir les props passées depuis le template
- Initialiser les propriétés depuis les props

```php
public function mount(?OrchardDTO $initialFormData = null): void
{
    // Reçoit :initialFormData="formData" depuis le template
}

// Ou avec des paramètres nommés différents
public function mount(?string $orchardCode = null): void
{
    // Logique d'initialisation
}
```

### `#[PostMount] postMount()`

**Quand** : Après l'affectation des props (premier chargement uniquement)

**Usage** :
- ✅ **Recommandé** pour initialiser des données complexes
- ✅ Charger des données depuis la BDD une seule fois
- ✅ Initialiser des LiveProps qui dépendent d'autres LiveProps

```php
#[PostMount]
public function postMount(): void
{
    // Charger les choix une seule fois
    if (count($this->farmBusinessChoices) === 0) {
        $farmBusinesses = $this->farmBusinessRepository->findAll();
        foreach ($farmBusinesses as $fb) {
            $this->farmBusinessChoices[$fb->__toString()] = $fb->id;
        }
    }
}
```

## Patterns recommandés

### 1. Données initiales pour un formulaire

```php
#[LiveProp(writable: false)]
public ?OrchardDTO $initialFormData = null;

// Template
<twig:OrchardFormComponent :initialFormData="formData" />
```

**Pourquoi `writable: false`** :
- Utilisé uniquement pour initialiser le formulaire
- Les modifications sont gérées par `ComponentWithFormTrait` via `formValues`
- Pas besoin de persister entre les requêtes Live
- Évite les problèmes de sérialisation complexe

### 2. Données de référence (choix, options)

```php
#[LiveProp]
public array $farmBusinessChoices = [];

#[PostMount]
public function postMount(): void
{
    if (count($this->farmBusinessChoices) === 0) {
        // Charger une seule fois
        $this->farmBusinessChoices = /* ... */;
    }
}
```

**Pourquoi LiveProp** :
- Les choix doivent persister entre les requêtes Live
- Utilisés dans `instantiateForm()` qui est appelé à chaque requête

### 3. Objets complexes avec relations

**Option A : Custom hydrate/dehydrate**

```php
#[LiveProp(dehydrateWith: 'dehydrateDTO', hydrateWith: 'hydrateDTO')]
public ?ComplexDTO $data = null;

public function dehydrateDTO(?ComplexDTO $dto): ?array
{
    // Convertir en primitifs
    return $dto ? ['id' => $dto->id, 'name' => $dto->name] : null;
}

public function hydrateDTO(?array $data): ?ComplexDTO
{
    // Reconstruire depuis primitifs
    return $data ? new ComplexDTO($data['id'], $data['name']) : null;
}
```

**Option B : writable: false (si lecture seule)**

```php
#[LiveProp(writable: false)]
public ?ComplexDTO $data = null;
```

## Pièges courants

### ❌ Initialiser des données dans le constructor

```php
public function __construct(
    private readonly FarmBusinessRepository $repo,
) {
    // ❌ Appelé à CHAQUE requête Live !
    $this->choices = $this->repo->findAll();
}
```

**Problème** : Requête SQL à chaque action Live

**Solution** : Utiliser `#[PostMount]`

### ❌ Oublier #[LiveProp] sur une variable qui doit persister

```php
public array $choices = []; // ❌ Réinitialisé à [] après chaque requête Live

#[PostMount]
public function postMount(): void
{
    $this->choices = $this->repo->findAll();
}

// Après addProduction() : $choices = [] (PERDU!)
```

**Solution** : Ajouter `#[LiveProp]`

```php
#[LiveProp]
public array $choices = [];
```

### ❌ Utiliser initialFormData après submitForm()

```php
#[LiveAction]
public function save(): void
{
    $this->submitForm();

    // ❌ $this->initialFormData n'a pas changé !
    $this->commandBus->handle(new CreateCommand($this->initialFormData));
}
```

**Solution** : Récupérer les données du formulaire

```php
#[LiveAction]
public function save(): void
{
    $this->submitForm();

    // ✅ Données hydratées depuis le formulaire
    $formData = $this->getForm()->getData();
    $this->commandBus->handle(new CreateCommand($formData));
}
```

## Diagramme du cycle de vie

```
┌─────────────────────────────────────────────────────────────┐
│                    PREMIER CHARGEMENT                        │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. __construct()           [Injection dépendances]         │
│  2. #[PreMount] preMount()  [Transformer props]             │
│  3. mount()                 [Recevoir props]                │
│  4. #[PostMount] postMount()[Initialiser données]           │
│  5. instantiateForm()       [Créer formulaire]              │
│  6. Render                  [HTML avec LiveProps sérialisé] │
│                                                              │
└─────────────────────────────────────────────────────────────┘

                           ↓ User interaction

┌─────────────────────────────────────────────────────────────┐
│                      REQUÊTE LIVE (AJAX)                     │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  1. __construct()           [⚠️ Appelé à nouveau!]          │
│  2. Hydration               [Reconstruire #[LiveProp]]      │
│  3. #[LiveAction] action()  [Exécuter action]               │
│  4. instantiateForm()       [Recréer formulaire]            │
│  5. Dehydration             [Sérialiser #[LiveProp]]        │
│  6. Render                  [Mise à jour HTML]              │
│                                                              │
└─────────────────────────────────────────────────────────────┘

                           ↓ Repeat
```

## Résumé des bonnes pratiques

| Besoin | Solution |
|--------|----------|
| Injecter services | `__construct()` |
| Transformer props entrantes | `#[PreMount] preMount()` |
| Recevoir props du template | `mount()` |
| Charger données une fois | `#[PostMount] postMount()` + `#[LiveProp]` |
| Données initiales formulaire | `#[LiveProp(writable: false)]` |
| Données de référence (choix) | `#[LiveProp]` + init dans `postMount()` |
| Objets complexes | Custom `dehydrateWith`/`hydrateWith` |
| Variables temporaires | Propriété privée sans `#[LiveProp]` |
| Récupérer données formulaire | `$this->getForm()->getData()` après `submitForm()` |

## Références

- [Documentation Symfony UX LiveComponent](https://symfony.com/bundles/ux-live-component/current/index.html)
- [Component Lifecycle](https://symfony.com/bundles/ux-live-component/current/index.html#component-lifecycle)
- [LiveProps and Hydration](https://symfony.com/bundles/ux-live-component/current/index.html#liveprops)
