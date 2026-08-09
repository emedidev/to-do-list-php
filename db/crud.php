<?php
    
    
    // LLAMADA A LA FUNCION DE CONEXION A LA BASE DE DATOS //

    include __DIR__ . '/../db/conn.php';


    

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // EVALIAMOS LA SOLICITUD DEL METODO PARA DEFINIR EL PROCESO A CORRER, EN ESTE CASO GUARDAR DATOS //
    if(isset($_POST['save-task'])){
        session_start();
        $idUser = $_SESSION['UserOk']['Id'];
        // CREAMOS LAS VARIABLES PARA ALMACENAR LOS DATOS RECIBIDOS DEL FORMULARIO //
        $prodName = $_POST['prodName'];
        $prodCuant = $_POST['prodCuant'];
        $prodPrice = $_POST['prodPrice'];

        // LLAMAMOS A LA FUNCION saveTask QUE EJECUTARA EL PROCESO DE ALMACENAMIENTO DE REGISTROS //
        saveTask($conn, $prodName, $prodCuant, $prodPrice, $idUser);

        // ENVIAMOS AL USUARIO A LA PAGINA PRINCIPAL //
        header("location: ../index.php");
    };

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // EVALUAMOS EL METODO PARA VALIDAR SI LA SOLICITUD ES ELIMINAR REGISTROS //
    if(isset($_POST['delete-task'])){
        
        // GUARDAMOS EL ID EN UNA VARIABLE //
        $id = $_POST['delete-task'];
        
        // EJECUTAMOS LA FUNCION deleteTask PARA ELIMINAR REGISTROS //
        deleteTask($conn, $id);

        // ENVIAMOS AL USUARIO A LA PAGINA PRINCIPAL //
        header("location: ../index.php");

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // EVALUAMOS EL METODO PARA VALIDAR SI LA SOLICITUD ES EDITAR REGISTROS //
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    
    if(isset($data['action']) && $data['action'] == 'edit-task'){
        
        $prodId = $data['id'] ?? null;
        $prodName = $data['producto'] ?? null;
        $prodCant = $data['cantidad'] ?? null;
        $prodPrice = $data['precio'] ?? null;

        editTask($conn,$prodId, $prodName, $prodCant, $prodPrice);
        
        echo json_encode(['estatus' => 'ok', 'mensaje' => 'Tarea editada']);
        exit;

        }
        
        
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // FUNCION PARA GUARDAR LOS REGISTROS EN LA BASE DE DATOS //
    function saveTask($conn, $name, $cuant, $price, $idUser){
        $query = 'INSERT INTO productos(Producto, Cantidad, Precio, IdUser) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siii", $name, $cuant, $price, $idUser);
        $stmt->execute();

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // ESTA FUNCION REALIZA UNA CONSULTA DE LOS DATOS ALMACENADOS //
    function loadTask($conn, $idUser){
        $query = 'SELECT * FROM productos WHERE IdUser = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // ESTA FUNCION ELIMINA LOS REGISTROS DE LA BASE DE DATOS //
    function deleteTask($conn, $id){
        
        $query = 'DELETE FROM productos WHERE Id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // FUNCION PARA ACTUALIZAR LOS REGISTROS //
    function editTask($conn, $id, $prod, $cant, $price){
        $query = 'UPDATE productos SET Producto = ?, Cantidad = ?, Precio = ? WHERE ID = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('siii', $prod, $cant, $price, $id);
        return $stmt->execute();
    }
?>