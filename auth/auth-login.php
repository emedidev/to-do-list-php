<?php 

require __DIR__.'/../db/conn.php';

if(isset($_POST['User'])){
    
    $user = $_POST['userName'];
    $pass = md5($_POST['userPass']);
    
    if(!isset($_POST['userName'])){
        header('Location: ../index.php');
        exit();
    };

    $result =  validate($conn, $user, $pass);
    $fetch = mysqli_fetch_assoc($result);
    
    if(!isset($fetch)){
        header('Location: ../index.php');
        exit();
        
    };
    
    $Id = $fetch['Id'];
    $Name = $fetch['Nombre'];
    $LastName = $fetch['Apellido'];

    session_start();

    $_SESSION['UserOk'] = array(
        'Id'=> $Id,
        'Name' => $Name,
        'LastName' => $LastName
    );

    header('Location: ../index.php');
};

function validate($con, $user, $pass){
    $query = 'SELECT * FROM users WHERE Email = ? AND Contraseña = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    return $stmt->get_result();
};

?>