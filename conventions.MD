# GitLaravel 11 Code Conventions

## Algemene Conventies

1. **Engels als voertaal**

- Schrijf zoveel mogelijk code, variabelen, functies, en documentatie in het Engels.
- Uitzonderingen mogen alleen in gevallen waar specifieke domeintermen of lokale context vereist zijn.

2. **Voorkom herhaling (DRY)**:
   - Hergebruik code door middel van componenten, helpers, services of traits als hetzelfde patroon meermaals voorkomt.
   - Gebruik Laravel-faciliteiten zoals **Blade Components**, **Custom Validation Rules**, en **Middleware** om herhaling te minimaliseren.

- Hergebruik code door middel van componenten, helpers, services of traits als hetzelfde patroon meermaals voorkomt.
- Gebruik Laravel-faciliteiten zoals **Blade Components**, **Custom Validation Rules**, en **Middleware** om herhaling te minimaliseren.

3. **Duidelijke scheiding**:

- Scheid code logisch in bestanden, klassen en functies.
- Gebruik Laravel-mappenstructuur en voeg submappen toe waar nodig om contexten zoals `Services`, `Repositories`, of `View Models` te beheren.

4. **Github**

- Werken in je eigen branch
- Alleen pushen wanneer het werkt
- als je klaar bent met jou gedeelte van de branch push het naar de main
- communiceer met elkaar waar je aan gaat werken voor zo min mogelijk merge conflicten
- bij de commits zoveel mogeljk nederlands houden en gebruik goede namen dat voor zich zelf spreekt

---

## Folder- en Bestandsstructuur

1. **Controllers**:

- Houd controllers dun en gebruik **services** of **repositories** voor complexe logica.
- Volg de **Single Responsibility Principle**.

2. **Models**:

- Alleen voor database-gerelateerde logica, zoals scopes, relaties, en accessors/mutators.
- Gebruik duidelijke namen die de betekenis van het model reflecteren, zoals `User`, `Product`, of `Invoice`.

3. **Blade Templates**:

   - Maak gebruik van **Blade Components** voor herbruikbare UI-elementen.
   - Organiseer views in mappen die de context van de pagina beschrijven, bijvoorbeeld `resources/views/admin` of `resources/views/user`.
4. **Routes**:

- Scheid routes in meerdere bestanden (bijvoorbeeld `web.php`, `api.php`, `auth.php`) als je applicatie groeit.
- Gebruik routegroepen met namespaces en middlewares voor overzichtelijkheid.

---

## Naming Conventions

1. **Variabelen en Functies**:

- Gebruik **camelCase** voor variabelen en methoden:
  ```php
  $totalAmount = 1000;
  public function calculatePrice() { ... }
  ```

2. **Klassen en Componenten**:

- Gebruik **PascalCase** voor klassen, components en services:
  ```php
  class OrderService { ... }
  ```

3. **Database**:
   - Tabellen in **meervoud**: `users`, `products`.
   - Kolommen in **snake_case**: `created_at`, `user_id`.

**Blade Components**:

4. - Gebruik korte, duidelijke namen zoals `alert`, `form-input`, en plaats ze in `resources/views/components`.

---

## Componenten en Herbruikbaarheid

1. **Maak een component**:

- Bij hergebruik van functionaliteit of een UI-element op **3 of meer plekken**.
- Voorbeelden: Buttons, Modals, en Form Inputs.

2. **Component Design**:

- Houd componenten klein en gespecialiseerd.
- Geef configuratie-opties via parameters:
  ```php
  <x-button type="submit" color="primary">Submit</x-button>
  ```

3. **Shared Logic**:

- Gebruik een **Service** voor gedeelde logica, bijvoorbeeld `NotificationService`.
- Maak gebruik van **Custom Blade Directives** voor veelgebruikte Blade-logica.

---

## Best Practices

1. **Code Formatting**:

- Gebruik een standaard formatter zoals **PHP CS Fixer** of **Laravel Pint**.
- Schrijf duidelijke en beknopte code, en vermijd inline logica in views.

2. **Comments**

- Gebruik Engelstalige commentaarregels waar nodig, maar vermijd over-documentatie:
  ```php
  // Fetch all active users
  $activeUsers = User::where('status', 'active')->get();
  ```

3. **Error Handling**:

   - Gebruik Laravel’s ingebouwde validatie en error-handling waar mogelijk.
   - Gebruik **Custom Exceptions** voor specifieke foutafhandeling.
4. **Environment-Specific Code**:

   - Vermijd harde coderingen. Gebruik `.env`-bestanden voor configuraties zoals API-keys en database-connecties.

---

## Code Voorbeeld

```php
// Controller: UserController
public function index(UserService $userService)
{
    $users = $userService->getAllActiveUsers();
    return view('admin.users.index', compact('users'));
}

// Service: UserService
class UserService
{
    public function getAllActiveUsers()
    {
        return User::where('status', 'active')->get();
    }
}

// Blade Template: resources/views/admin/users/index.blade.php
<x-layout>
    <x-table :items="$users" />
</x-layout>
```

---

1. **Github**
   - Werken in je eigen branch
   - Alleen pushen wanneer het werkt
   - als je klaar bent met jou gedeelte van de branch push het naar de main
   - communiceer met elkaar waar je aan gaat werken voor zo min mogelijk merge conflicten
   - bij de commits zoveel mogeljk nederlands houden en gebruik goede namen dat voor zich zelf spreekt

Met deze conventies wordt je code zowel gestructureerd als gemakkelijk leesbaar. Volg deze richtlijnen voor een consistente en schaalbare Laravel-applicatie.
