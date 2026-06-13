# FridgeChef

FridgeChef es una aplicación web diseñada para ayudar a los usuarios a encontrar recetas de cocina utilizando únicamente los ingredientes que tienen disponibles en su nevera o despensa. La plataforma permite buscar recetas por nombre, categoría o ingredientes específicos, mostrando resultados relevantes de forma rápida y sencilla. Además, los usuarios pueden crear sus propias recetas, editarlas, eliminarlas y comentar las recetas de otros. El objetivo principal es fomentar una cocina más consciente, reducir el desperdicio de alimentos y aprovechar al máximo los recursos disponibles en el hogar.

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
- Importar el archivo `fridgechef.sql`

8. **Iniciar el servidor**  
   `php artisan serve`

## Gestor de base de datos utilizado

phpMyAdmin (incluido en XAMPP)
