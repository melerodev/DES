# User App

### 1. Registrar
![alt text](img/image-1.png)

### 2. Logearse
![alt text](img/image.png)

### 3. Panel de administrador
![alt text](img/image-6.png)

### 4. Editar usuario
![alt text](img/image-4.png)

### 7. Crear usuario
![alt text](img/image-7.png)

### 5. Panel de user
![alt text](img/image-3.png)

## Instalación

1. Clona el repositorio:
    ```sh
    git clone https://github.com/Mariortega83/userManagement
    ```

2. Instala las dependencias:

    ```sh
    composer install
    npm install
    npm run build
    ```

3. Configura el archivo [.env]:
    Tendremos que modificar el archivo `.env` con las configuraciones de la DB y credenciales de correo electrónico.
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. Ejecuta las migraciones:
    ```sh
    php artisan migrate
    ```
