
# Illustration Website
A website designed to show off SquaredLabs Scientific Illustrations, as well as requesting new illustrations.
## Setup
```bash
cp .env.example .env
#Add database configuration in .env
```
**Then,**
### Developing
```bash
composer install
php artisan migrate --seed
php artisan serve
```
### Docker
Edit `.env`, make sure `DB_HOST=db`
```bash
docker-compose up -d
docker-compose exec app composer install &&  
  php artisan key:generate && 
  php artisan migrate
```
