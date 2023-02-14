# Aplikacja galeria
## Sposób uruchomienia:
- pobierz kod
- composer install
- Utwórz bazę MySql lokalnie: 127.0.0.1:3306 (użytkownik: root; brak hasła)
- Utwórz bazę o nazwie gallery
- Skopiuj plik .env.example i nazwij go .env
- Wykonaj komendę ``` php artisan key:generate ```
- Wykonaj komendę ``` php artisan migrate ```
- Wykonaj komendę ``` php artisan serve ```
- Aplikacja jest dostępna pod adresem http://localhost:8000

## O aplikacji
Aplikacja napisana w Laravelu, udostępnia możliwość dodawania zdjęć oraz przeglądu wszystkich dostępnych zdjęć. Aby uzyskać dostęp do tej drugiej funkcji, należy się zalogować. Do systemu można się zalogować lub można się w nim zarejestrować.
