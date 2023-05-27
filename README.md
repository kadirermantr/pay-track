# PayTR Assessment

- **Programming Language:** PHP
- **Framework:** Laravel
- **Authentication:** [Laravel Passport](https://laravel.com/docs/passport)
- **API Documentation:** [kadirermantr.gitbook.io/paytr-api-docs](https://kadirermantr.gitbook.io/paytr-api-docs)
- **API Testing:** Postman
- **Database Diagram:** [Diagram 1](https://dbdiagram.io/d/6420f4b25758ac5f172447ae) | [Diagram 2](https://dbdiagram.io/d/6420f5185758ac5f172447ca)

## Installation

1. `cp .env.example .env`
2. `composer install`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail artisan migrate`
5. `./vendor/bin/sail artisan passport:install`
