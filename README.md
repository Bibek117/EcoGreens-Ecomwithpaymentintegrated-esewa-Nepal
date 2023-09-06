# EcoGreens (Ecommerce application with esewa integration)
## build with laravel 9 and react
### Note: not for commerical use 

## Screenshots

![preview img](/previewecom.png)

## Run Locally

Clone the project

```bash
  git clone https://github.com/Bibek117/EcoGreens-Ecomwithpaymentintegrated-esewa-Nepal.git project-name
```

Go to the project directory

```bash
  cd project-name
```

-   Copy .env.example file to .env and edit database credentials there

```bash
    composer install
```

```bash
    php artisan key:generate
```

```bash
    php artisan artisan migrate:fresh --seed
```

```bash
    php artisan storage:link
```
```bash
     npm install
```
```bash
     npm run watch
```
#### Login

-   email = admin@example.com
-   password = 123

### Esewa 

-  id =  9806800001
-  password = Nepal@123
-  token = 123456