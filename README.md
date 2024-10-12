# Gestión de Usuarios en BBDD
## Instrucciones de uso
Ejecuta el programa desde un terminal en la carpeta con el comando: `php cli.php`<br />
Por defecto viene con la configuración base para XAMP y MYSQL que es el servidor y BBDD usada en el desarrollo.<br />
Estando el servidor funcionando se conectará y el menú guiará al usuario por el proceso. Las credenciales para el login son Usuario: admin y Contraseña: amin123
### Razonamiento de Diseño
Un archivo con un función simple de login, en un archivo propio, controla el acceso a la aplicación, tras esto se ejecuta un menú que está en el archivo principal que permite al usuario iterar por los menús. Una clase UerManagement aloja los métodos
para la gstión del programa y el archivo config incluye la información para la conexión a una BBDD MYSQL en localhost.

Las secuencias de sql usan secuencias preparadas para prevenir la inyección de SQL y gestionan los errores para que la aplicación no se detenga si obtiene una excepción o un valor inesperado.
### Propuestas de mejora
De contar con más tiempo y necesitar una mayor seguridad lo ideal sería implementar el programa con un framework que permita el uso de ORM para poder gestionar de forma más segura las peticiones a la BBDD y poder modularizar mejor la aplicación. Crearía unas
clases específicas que permitieran gestionar únicamente una función y dividiría el programa en directorios para organizar mejor la estructura interna. También mejoraría la gestión de excepciones y la seguridad del login para evitar que la aplicación rompa por un
error o que se pueda acceder sin permisos a ella.

Otra opción a la hora de asignar los privilegios a los usuarios es dar una lista cerrada de opciones, donde el usuario deba escoger con un número, de esta evitamos que tenga que hacer el input de forma manual y minimizamos los errores de escritura.
