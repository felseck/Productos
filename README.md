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

### 10.- Ingresar como administrador  
   #### user: admin@fakemail.com
   #### pwd:  password


## ############ menu url 

### 1.- user login http://127.0.0.1:8000/login
### 2.- user register http://127.0.0.1:8000/register
### 3.- users list http://127.0.0.1:8000/users
### 4.- products list http://127.0.0.1:8000/products
### 5.- purchases list http://127.0.0.1:8000/purchases
### 6.- invoices list http://127.0.0.1:8000/invoices
### 7.- purchase form http://127.0.0.1:8000/purchase-form
### 8.- generate invoices http://127.0.0.1:8000/invoices