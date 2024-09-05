composer update 
cp .env.example .env 
php artisan key:generate 
php artisan migrate --seed 
npm install vite --save-dev 
npm run build 