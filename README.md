<div align="center">

# **MODULO 10 ACTIVIDAD 2**

## *Practica con PHP to_do_list*

En este proyecto ponemos a prueba lo aprendido en PHP para realizar una pagina to_do_list basica que permita crear, eliminar, actualizar y cargar registros desde una base de datos. En este proyecto implemente el uso de HTML, CSS, JS y PHP para lograr el resultado final. La pagina permite registrar productos y calcular los precios, eliminar los registros, actualizar los existentes y cargar todo en la interfaz. Tambien implemente algunos controles como alertas para valdiar las acualizaciones, alertas en caso de actualizar sin datos ingresados y el uso de fetch para enviar datos desde el frontend al backend por medio de formato json.

</div>

## Enmanuel Medina

- 01: HTML - Layout.
- 02: CSS - Reset, Root, parametros, estilos y animación.
- 03: JS - Interactividad.
- 04: PHP - BackEnd.
- 05: MySQL - Base de datos.
- 06: Xampp - Servidor local.
- 07: GIT - Repositorio.
- 08: Readme - informativo.

# ** Consulta para crear la base de datos **

drop database to_do_list_php;
create database to_do_list_php;
USE to_do_list_php;

create table productos (
Id int auto_increment primary key,
Producto varchar(100) not null,
Cantidad int not null,
Precio int not null
);


select * from productos;
