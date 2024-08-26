# Examen_Final_Goyes_Job
Enlace video funcionamiento del CRUD implementado (7:31 min): https://drive.google.com/file/d/1aIRhLInfTkpqd8iYZhxjfKtIz62a6icA/view?usp=drive_link

## Instrucciones para ejecutar la aplicación

### Paso 1: Descargar en instalar un servidor local

Primeramente se debe tener en cuenta que se necesita de un servidor local a elección, en este caso se utilizó XAMPP de Apache.

Enlace página oficial XAMPP: https://www.apachefriends.org/es/index.html

En el enlace anterior es posible descargar e instalar este servidor local.

### Paso 2: Inicializar el servidor local y descargar el proyecto

Una vez se tenga instalado XAMPP, se lo debe ejecutar e inicializar las dos primeras opciones que son Apache y MySQL, basta con darle click en "Start".

Una vez listo el servidor local, se procede a descargar el proyecto respectivo, en este caso de nombre **Examen_Final_Goyes_Job**, en formato .zip, una vez descargado darle click derecho y buscar la opción extraer aqui, aparecerá una carpeta del mismo nombre, esa carpeta debe ser copiada y pegada dentro de la carpeta htdocs que se encuentra en la dirección donde se haya instalado el servidor local, por lo general suele ser en C:\xampp\htdocs.

**Muy importante: En caso de descargarlo desde el repositorio de GitHub (suele extenderse el nombre, por ejemplo Examen_Final_Goyes_Job-main), cambiar el nombre de la carpeta que se va a copiar a Examen_Final_Goyes_Job, para evitar cualquier tipo de inconveniente**

### Paso 3: Ingreso al proyecto desde Visual Studio Code

Una vez ubicada la carpeta del proyecto en el directorio correspondiente, se debe proceder a abrir Visual Studio Code.

En caso de que se requiera descargar e instalar el mismo, se especifica el siguiente enlace: https://code.visualstudio.com/ el cual direcciona a la página oficial de visual studio.

Dentro de Visual Studio Code, dirigirse hacia la parte superior izquierda sección "File", luego buscar la opción "Open Folder" y buscar la carpeta anteriormente ubicada en htdocs de nombre **Examen_Final_Goyes_Job**, apenas se abra la carpeta se mostrarán todas las implementaciones.

### Paso 4: Creación de la base de datos en XAMPP phpMyAdmin

Una vez completados todos los pasos anteriores, se procede a crear una base de datos en MySQL phpMyAdmin presente en XAMPP, para ello es de dirigirse al servidor local, buscar MySQL y darle click en la opción "Admin", automáticamente abrirá el navegador, mostrando phpMyAdmin.

**Base de datos:** Una vez dentro de phpMyAdmin, se debe crear una base de datos de nombre examen_final_goyes_job (El nombre debe ser tal cual como se menciona, sin embargo es posible cambiarlo en la parte de los modelos DB.php dentro de Visual Studio Code).

**Entidad/tabla seleccionada Aulas:** Una vez creada la base de datos se procede a crear la tabla aulas con el siguiente código:

```
  CREATE TABLE aulas (
    aula_id INT AUTO_INCREMENT PRIMARY KEY,
    aula_nombre VARCHAR(255) NOT NULL,
    aula_numero_estudiantes INT NOT NULL,
    aula_capacidad_maxima INT NOT NULL,
    aula_tipo VARCHAR(100) NOT NULL
);
```
De este modo se puede apreciar que la entidad respectiva posee **cinco atributos** correspondientes.
Luego de haber digitado el código, se debe proceder a ejecutarlo, para ello se dará click en la opción continuar presente en la parte inferior izquierda.


### Paso 5: Aplicación web en el navegador utilizando XAMPP

Por último, se procede a abrir la aplicación web en el navegador utilizando el servidor local.

Para entrar en la página de inicio de la aplicación, se digitará lo siguiente (mientras se tiene abierto XAMPP en segundo plano): localhost/Examen_Final_Goyes_Job/inicio

Una vez digitada la ruta anterior, se presionará la tecla "enter" y automáticamente aparecerá la página de inicio de la aplicación respectiva, asi también en la misma página es posible navegar hacia la gestión de aulas correspondientemente.
