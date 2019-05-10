
# Illustration Website
A website designed to show off SquaredLabs Scientific Illustrations, as well as requesting new illustrations.
## Setup
```bash
cp .env.example .env
#Add database configuration in .env
composer install
```
**Then,**
### Developing
```bash
php artisan migrate
php artisan serve
```
### Docker
Edit `.env`, make sure `DB_HOST=db`
```bash
docker-compose up -d
docker-compose exec app php artisan migrate
```
