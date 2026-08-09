
<!-- LLAMADA AL HEADER -->
<?php require_once "./includes/header.php" ?>

<main>
    
    <?php
        session_start();
        
        if(!isset($_SESSION['UserOk'])){
                header('Location: ./pages/login.php');
            };

        if(isset($_SESSION['UserOk'])){
            require_once './pages/main.php';
        };
    ?>
        
</main>

    <!-- LLAMADA AL FOOTER -->
<?php include_once "./includes/footer.php" ?>