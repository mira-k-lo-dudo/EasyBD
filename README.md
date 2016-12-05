CLASE PARA ACCESO AL SGBD
=========================

EasyBD es una clase realizada en PHP que permite accesos a MySQL/MariaDB de manera fácil, sencilla y sin necesidad de conocer las sentencias SQL para ello. 

Utiliza PDO, la extensión Objetos de Datos de PHP, y no necesita ningún complemento más para poder ser usada.

## Prerequisitos

* PHP Version 5.1 o superior.
  
## Uso

Se incluye dentro del repositorio un fichero index.php que incluye un ejemplo de uso de esta libreria.

    include "easybd.class.php";
	// $bd= new EasyBD(SERVIDOR,USUARIO,CONTRASEÑA,BASE_DE_DATOS);
    $bd=new EasyBD("localhost","root","","inmobiliaria");
       
Donde:

* SERVIDOR: Direccion del servidor del SGBD.
* USUARIO: Usuario del SGBD.
* CONTRASEÑA: Contraseña del usuario anterior del SGBD.
* BASE_DE_DATOS: Base de datos sobre la que vamos a trabajar.
    


## Licencia

CopyLeft 2016 Juan Ferrer / juanferrer437@hotmail.com / Murcia / España

Puede modificar, cambiar o mejorar lo que desee. 