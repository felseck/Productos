## instrucciones de instalacion

### 1.-Clonar el repositorio.

### 2.- Crear una base de datos

### 3.- Modificar el archivo .env las sigueintes lineas, el app url y la base de datos
     
#### APP_URL=http://localhost:8000

#### DB_CONNECTION=mysql
#### DB_HOST=127.0.0.1
#### DB_PORT=3306
#### DB_DATABASE=poder_judi
#### DB_USERNAME=root
#### DB_PASSWORD=

### 4.- Ejecutar: composer install
### 5.- Ejecutar: npm install
### 6.- Ejecutar: php artisan migrate
### 7.- Ejecutar: php artisan db:seed --class=UserSeeder
### 8.- Ejecutar: php artisan db:seed --class=Products
### 9.- Ejecutar: php artisan serve


## ############ menu url 

### 1.- hacer login en http://127.0.0.1:8000/login
### 2.- users en http://127.0.0.1:8000/users
### 3.- products en http://127.0.0.1:8000/products
### 4.- purchases en http://127.0.0.1:8000/purchases
### 5.- invoices en http://127.0.0.1:8000/invoices