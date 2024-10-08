# Pay Track

- **Tech Stack:** [Tech Stack File](https://github.com/kadirermantr/pay-track/blob/master/techstack.md)
- **Programming Language:** PHP
- **Framework:** Laravel
- **Authentication:** [Laravel Passport](https://laravel.com/docs/passport)
- **API Documentation:** [Pay Track - Api Doc](https://kadirermantr.gitbook.io/pay-track-api-doc)
- **API Testing:** Postman
- **Database Diagram:** [Diagram 1](https://dbdiagram.io/d/6420f4b25758ac5f172447ae) | [Diagram 2](https://dbdiagram.io/d/6420f5185758ac5f172447ca)

## Installation

```bash
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail artisan passport:install
```
