# FridgeChef

FrdigeChef es una aplicación web que ayuda a los usuarios a encontrar recetas de cocina utilizando los ingredientes que tienen disponibles en su nevera o despensa, con el objetivo de reducir el desperdicio de alimentos.

## Integrantes del grupo

- Yoselin Andrea Linares Hernández (SMSS027124) 
- Katerinne Alejandra Mendez Garcia (SMSS001824)
- Mario Antonio Salamanca Romero (SMSS085424)


## Indicaciones de instalación

1. **Clonar el repositorio**  
   - Abrir VS Code  
   - En la pantalla de inicio, hacer clic en "Clone Git Repository..."  
   - Pegar la URL: `https://github.com/mariooromeroo/Lab2doAvance.git`  
   - Elegir una carpeta destino  
   - Abrir el proyecto clonado  
   *O desde la terminal:* `git clone https://github.com/mariooromeroo/Lab2doAvance.git`

2. **Entrar a la carpeta del proyecto**  
   `cd Lab2doAvance/FridgeChef`

3. **Instalar dependencias de PHP** (obligatorio la primera vez)  
   `composer install`

4. **Copiar archivo de entorno**  
   `cp .env.example .env`

5. **Generar clave de la aplicación**  
   `php artisan key:generate`

6. **Configurar la base de datos** en el archivo `.env`  
   `DB_DATABASE=fridgechef`  
   `DB_USERNAME=root`  
   `DB_PASSWORD=`

7. **Importar la base de datos**  
   - Abrir phpMyAdmin  
   - Crear la base de datos `fridgechef`  
   - Importar el archivo `database/fridgechef.sql`

8. **Iniciar el servidor**  
   `php artisan serve`

## Gestor de base de datos utilizado

phpMyAdmin (incluido en XAMPP)
