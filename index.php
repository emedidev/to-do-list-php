
<?php include("./includes/header.php") ?>
<?php include('./db/crud.php') ?>
<?php include('./db/conn.php') ?>

    <main>
        <fieldset>
            <legend>Lista de compras</legend>
            <form action="./db/crud.php" class="form" method="post">
                <div class="containerImpForm">
                    <div class="boxContainer">
                        <label for="prodName">Producto</label>
                        <input required placeholder="Ingrese el producto" type="text" name="prodName" id="prodName" class="inpData">
                    </div>
                    <div class="boxContainer">
                        <label for="prodCuant">Cantidad</label>
                        <input required placeholder="Ingrese la cantidad" type="number" name="prodCuant" id="prodCuant" class="inpData" min="1" step="1">
                    </div>
                    <div class="boxContainer">
                        <label for="prodPrice">Precio</label>
                        <input required placeholder="Ingrese el precio" type="number" name="prodPrice" id="prodPrice" class="inpData" min="1" step="1">
                    </div>
                </div>
                <div class="containerButton">
                    <input type="submit" class="btn btnSuccess" name="save-task">
                </div>
            </form>
        </fieldset>
        <table>
            <caption>Lista de productos</caption>
            <thead>
                <tr>
                    <th>Id.</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Estatus</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody id="contentList">
                <?php 
                    $datos = loadTask($conn);
                    foreach($datos as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['Id']; ?></td>
                            <td><input type="text" disabled class="tableResult" value="<?php echo $data['Producto']; ?>" ondblclick="activeField()"></td>
                            <td><input type="text" disabled class="tableResult" value="<?php echo $data['Cantidad']; ?>"></td>
                            <td><input type="text" disabled class="tableResult" value="<?php echo $data['Precio']; ?>"></td>
                            <td><?php echo $data['Cantidad'] * $data['Precio']; ?></td>
                            <td><?php echo 'Pendiente' ?></td>
                            <td>
                                <fieldset>
                                    <form method="post" action="./db/crud.php">
                                        <input hidden  name="edit-task" name='<?php echo $data['Id']; ?>'>
                                        <input type="submit" value='Editar' class="btnAct btnEdit">
                                    </form>
                                    <form method="post" action="./db/crud.php">
                                        <input hidden  name="delete-task" value='<?php echo $data['Id']; ?>'>
                                        <input type="submit" value='Eliminar' class="btnAct btnDelete">
                                    </form>
                                </fieldset>
                            </td>

                        </tr>
                        <?php
                    };
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td id="totalCantidad">
                        <?php 
                            $sumaCant = 0;
                            foreach($datos as $dato){
                                $sumaCant += $dato['Cantidad'];
                            }
                            echo $sumaCant;
                        ?>
                    </td>
                    <td id="totalPrecio">
                        <?php 
                            $sumaPrice = 0;
                            foreach($datos as $dato){
                                $sumaPrice += $dato['Precio'];
                            }
                            echo $sumaPrice;
                        ?>
                    </td>
                    <td id="totalGeneral" colspan="1" class="totales">
                        <?php 
                            $sumaTotal = 0;
                            foreach($datos as $dato){
                                $calculo = $dato['Cantidad'] * $dato['Precio'];
                                $sumaTotal += $calculo;
                            }
                            echo $sumaTotal;
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </main>

<?php include("./includes/footer.php") ?>