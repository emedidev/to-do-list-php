<?php 

    $host = 'localhost';
    $db = 'to_do_list_php';
    $user = 'root';
    $pass = '';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if(!$conn){
        echo "conexion fallida";
    };

?>