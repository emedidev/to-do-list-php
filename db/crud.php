<?php

    include __DIR__ . '/../db/conn.php';

    if(isset($_POST['save-task'])){
        
            $prodName = $_POST['prodName'];
            $prodCuant = $_POST['prodCuant'];
            $prodPrice = $_POST['prodPrice'];

            saveTask($conn, $prodName, $prodCuant, $prodPrice);
            header("location: ../index.php");
        }

    if(isset($_POST['delete-task'])){
        
        $id = $_POST['delete-task'];
        
        deleteTask($conn, $id);
        header("location: ../index.php");

    };

    if(isset($_POST['edit-task'])){

        echo "A editar";
    };


        function saveTask($conn, $name, $cuant, $price){

            $query = 'INSERT INTO productos(Producto, Cantidad, Precio) VALUES (?, ?, ?)';
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sii", $name, $cuant, $price);
            $stmt->execute();

        };

        
        function loadTask($conn){

            $query = 'SELECT * FROM productos';
            $result = $conn->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);

        };

        function deleteTask($conn, $id){
            
            $query = 'DELETE FROM productos WHERE Id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();

        };

        function editTask(){
        


        };
?>