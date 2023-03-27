# PayTR Assessment

- **Programming language:** PHP
- **Framework:** Laravel
- **Authentication:** [Laravel Passport](https://laravel.com/docs/passport)
- **API Documentation:** [kadirermantr.gitbook.io/paytr-api-docs](https://kadirermantr.gitbook.io/paytr-api-docs)
- **API Testing:** Postman
- **Database Diagrams:**
    - [Diagram 1](https://dbdiagram.io/d/6420f4b25758ac5f172447ae)
    - [Diagram 2](https://dbdiagram.io/d/6420f5185758ac5f172447ca)

## Install

```bash
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan passport:install
```
