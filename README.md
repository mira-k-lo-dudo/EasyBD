CLASE PARA ACCESO AL SGBD
=========================

EasyBD es una clase realizada en PHP que permite accesos a MySQL/MariaDB de manera fácil, sencilla y sin necesidad de conocer las sentencias SQL para ello. 

Utiliza PDO, la extensión Objetos de Datos de PHP, y no necesita ningún complemento más para poder ser usada.

## Prerequisitos

* PHP Version 5.1 o superior.
  
## Base de datos y Tabla de prueba

Vamos a partir de una base de datos llamada PRUEBA. Las pruebas las voy a realizar con una tabla MARCA con dos campos: el primero un ID_MARCA de tipo entero y clave primaria y el segundo NOMBRE_MARCA de tipo varchar.

## Creación de una variable y Conexion al servidor

Para crear una variable de este tipo, y además realizar la conexion con el SGBD debemos hacer new EasyBD con los parametros siguientes:

* SERVIDOR: Direccion del servidor del SGBD.
* USUARIO: Usuario del SGBD.
* CONTRASEÑA: Contraseña del usuario anterior del SGBD.
* BASE_DE_DATOS: Base de datos sobre la que vamos a trabajar.

Ejemplo:
	<?php
    include "easybd.class.php";
    $bd=new EasyBD("localhost","root","","PRUEBA");
    ?>
    
## insertar(TABLA,ARRAY_DE_ELEMENTOS)
insertar recibe el nombre de una tabla y un array de elementos que seran insertados en dicha tabla ordenados en el mismo orden que estan la tabla. 

Devuelve true si se ha podido realizar la inserccion y false si no ha sido posible.

Ejemplo:

<?php
    if ($bd->insertar('MARCA',[1,'SEAT'])) 
    	echo "Se ha realizado la inserccion";
    else 
    	echo "NO se ha podido insertar";
    ?>


## Licencia

CopyLeft 2016 Juan Ferrer / juanferrer437@hotmail.com / Murcia / España

Puede modificar, cambiar o mejorar lo que desee. 