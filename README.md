<div align="center">

# **MODULO 10 ACTIVIDAD 2.1 y 3.1**

## *Practica con PHP to_do_list*
2.1
En este proyecto ponemos a prueba lo aprendido en PHP para realizar una pagina to_do_list basica que permita crear, eliminar, actualizar y cargar registros desde una base de datos. En este proyecto implemente el uso de HTML, CSS, JS y PHP para lograr el resultado final. La pagina permite registrar productos y calcular los precios, eliminar los registros, actualizar los existentes y cargar todo en la interfaz. Tambien implemente algunos controles como alertas para valdiar las acualizaciones, alertas en caso de actualizar sin datos ingresados y el uso de fetch para enviar datos desde el frontend al backend por medio de formato json.

3.1
Para este proyecto se actualizo la app agregando Loguin y registro, con validación de datos, control de errores, mostrando datos solo los datos del usuario que registro y manejando el flujo de navegación. Se implemento el uso de PDO, lógica de Login y Registro, inicio, creación y destrucción de sesiones, uso de hash para contraseña y navegación entre paginas. Tambien se crea nueva tabla en SQL para los usuarios y columna de relación en productos con el Id de usuario.

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

create table users(
Id int primary key auto_increment,
Nombre varchar(20) not null,
Apellido varchar(20) not null,
Email varchar(50) not null,
Contraseña varchar(35) not null
);

create table productos (
Id int auto_increment primary key,
Producto varchar(100) not null,
Cantidad int not null,
Precio int not null,
IdUser int not null,
foreign key (IdUser) references users(Id)
);



select * from productos;
