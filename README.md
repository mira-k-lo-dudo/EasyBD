EASYBD CLASE PARA FACILITAR EL ACCESO AL SGBD
=============================================

EasyBD es una clase realizada en PHP que permite accesos a MySQL/MariaDB de manera fácil, sencilla y sin necesidad de conocer las sentencias SQL para ello. 

Utiliza PDO, la extensión Objetos de Datos de PHP, y no necesita ningún complemento más para poder ser usada.

# Prerequisitos

* PHP Version 5.1 o superior.
  
# Base de datos y Tabla de prueba

Vamos a partir de una base de datos llamada PRUEBA. Las pruebas las voy a realizar con una tabla MARCA con dos campos: el primero un ID_MARCA de tipo entero y clave primaria y el segundo NOMBRE_MARCA de tipo varchar.

## Creación de una variable y Conexion al servidor

Para crear una variable de este tipo, y además realizar la conexion con el SGBD debemos hacer new EasyBD con los parametros siguientes:

* SERVIDOR: Direccion del servidor del SGBD.
* USUARIO: Usuario del SGBD.
* CONTRASEÑA: Contraseña del usuario anterior del SGBD.
* BASE_DE_DATOS: Base de datos sobre la que vamos a trabajar.

Ejemplo:
```php
	include "easybd.class.php";
    $bd=new EasyBD("localhost","root","","PRUEBA");
```   
## insertarTodos(TABLA,ARRAY_DE_ELEMENTOS)
insertar recibe el nombre de una tabla y un array de elementos que seran insertados en dicha tabla ordenados en el mismo orden que estan la tabla. 

Devuelve true si se ha podido realizar la inserccion y false si no ha sido posible.

Ejemplo:

```php
    if ($bd->insertarTodos('MARCA',[1,'SEAT']))
        echo "Se ha realizado la inserccion";
    else 
    	echo "NO se ha podido insertar";
```

## insertarParcial(TABLA,ARRAY_DE_CAMPOS,ARRAY_DE_ELEMENTOS)
insertarParcial recibe el nombre de una tabla, los campos que seran insertados (pueden ir desordenados) y un array de elementos que seran insertados en dicha tabla (siguiendo el orden del array anterior), hay que tener cuidado pues hay ciertos campos que por definición son NOT NULL  y por tanto obligatoriamente deberán ser insertados ya que si no esta insercción fallará.

Devuelve true si se ha podido realizar la inserccion y false si no ha sido posible

Ejemplo:

```php
    if ($bd->insertarParcial('MARCA',['ID_MARCA','NOMBRE_MARCA'],[2,'AUDI'])) 
    	echo "Se ha realizado la inserccion";
    else 
    	echo "NO se ha podido insertar";
 ```
## consultarTodos(ARRAY_DE_TABLA,ARRAY_DE_CONDICIONES,ARRAY_DE_PARAMETROS)
Para usar consultarTodos es obligatorio indicar al menos una tabla donde hacer la consulta (soporta array de tablas permitiendo hacer joins entre ellas), mientras que puedo omitir las condiciones y los parametros, en caso de utilizar condiciones y parametros debes pasarselas mediante un array, como he indicado anteriormente soporta joins.

Devuelve un array bidimensional con los datos obtenidos o un array vacio en caso de no poder realizar la consulta.

Ejemplos:
```php
$resultado=$bd->consultarTodos(['MARCA']);
print_r($resultado);
```

## borrar(TABLA,ARRAY_DE_CONDICIONES)
Para usar borrar es obligatorio indicar la tabla mientras que puedo omitir las condiciones, en caso de utilizar condiciones debes pasarselas mediante un array.

Devuelve true si se ha podido realizar el borrado y false si no ha sido posible

Ejemplo:
```php
 if ($bd->borrar('MARCA',['ID_MARCA=1'])) 
        echo "Se ha borrado correctamente";
    else 
        echo "NO se ha podido borrar";
```

## contar(TABLA, ARRAY_DE_CONDICIONES)

Para usar contar es obligatorio indicar la tabla mientras que puedo omitir las condiciones. En caso de utilizar condiciones debes pasarselas mediante un array.

El resultado devuelto por esta funcion será un numero, resultado de contar las ocurrencias de los campos establecidos en el array de condiciones o de todos los campos si se omite dicho valor

Ejemplo: 
```php
$num_registros=$bd->contar('MARCA'); 
echo "En la tabla MARCA hay ".$num_registros." registros";
```

## consultaRegistro(TABLA,ARRAY_DE_CONDICIONES)

Para usar consultarRegistro es obligatorio indicar la tabla mientras que puedo omitir las condiciones, en caso de utilizar condiciones debes pasarselas mediante un array, el resultado devuelto por esta funcion será un array unidimensional, en caso de que el resultado obtenido tuviese varios registros, solo será devuelto el primero.

En caso de error o de no producir resultado la consulta, devolverá un array vacio.

Ejemplo: 
```php
$resultado=$bd->consultaRegistro("MARCA",['ID_MARCA=3']);
echo $resultado['ID_MARCA'];
echo $resultado['NOMBRE_MARCA'];
```

## consultaUno(TABLA, ARRAY_DE_CONDICIONES, VALOR_DEVUELTO)

Para usar consultarUno es obligatorio indicar la tabla mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array, el resultado devuelto por esta funcion será un unico valor, en caso de que el resultado obtenido tuviese varios valores/registros, solo será devuelto el primer valor obtenido.

Ejemplo: 
```php
$resultado=$bd->consultaUno("MARCA",[],"COUNT(*)");
echo $resultado;
```

## Licencia


CopyLeft 2016 Juan Ferrer / juanferrer437@hotmail.com / Murcia / España

Puede modificar, cambiar o mejorar lo que desee. 