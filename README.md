INSTALACION INICIAL

1. Copie el contenido de la carpeta "Código Fuente" en su servidor.
2. Ejecute el script de Base de datos contenido en la carpeta "Base de Datos" en su servidor mysql. Recuerde las credenciales de acceso.


CONFIGURACIONES

1. Base de datos "app/Config/database.php" 
2. Email "app/Config/email.php" 

La base de datos se encuentra seteada con un usuario "admin" para realizar las configuraciones iniciales de la plataforma.

User: admin
pass: 123456


La aplicación, por usar el método rewrite no debe ser invocada por medio de la página .php.  Por ejemplo:

Error: 
www.midominio.cl/index.php

Correcto:
www.midominio.cl

Además, su servidor debe tener el mod_rewrite habilitado.
