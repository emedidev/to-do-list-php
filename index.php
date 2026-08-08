
<!-- LLAMADA AL HEADER -->
<?php require "./includes/header.php" ?>

<main>
    
    <?php
        session_start();
        
        if(!isset($_SESSION['UserOk'])){
             require "./pages/login.php";
             require './pages/register.php';
             exit();
            };

        if(isset($_SESSION['UserOk'])){
            require './pages/main.php';
        };


        ?>
            
    </main>

    <!-- LLAMADA AL FOOTER -->
<?php include "./includes/footer.php" ?>