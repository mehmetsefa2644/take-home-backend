# take-home-backend

### install dependencies
- composer install

### create .env file
don't forget to create an .env file which includes your mysql credentials

### migrate db
- php artisan migrate

### seed database
- php artisan db:seed --class=ProductsTableSeeder
- php artisan db:seed --class=AccountsTableSeeder
- php artisan db:seed --class=OrdersTableSeeder
- php artisan db:seed --class=PaymentStatusesTableSeeder

### serve backend
- php artisan serve
