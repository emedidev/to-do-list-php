<!-- LLAMAMOS LA CONEXION LAS FUNCIONES CRUD PARA MOSTRAR LOS DATOS EN EL DOM -->
<?php require './db/crud.php' ?>

<!-- LLAMADA A LA CONEXION A LA BASE DE DATOS -->
<?php require './db/conn.php' ?>

<!-- LLAMADA AL HEADER -->
<?php require "./includes/header.php" ?>

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

        
        <dialog id="editModal" class="editModal">
            <form class="formModal" action="/db/crud.php" method="post">
                <h3>Editar datos</h3>
                <section class="modalContentInput">
                    <div>
                        <label for="">Producto</label>
                        <input id="prodName" type="text" require value="">
                    </div>
                    <div>
                        <label for="">Cantidad</label>
                        <input id="prodName" type="number" require value="">
                    </div>
                    <div>
                        <label for="">Precio</label>
                        <input id="prodName" type="number" require value="">
                    </div>
                </section>
                <section class="modalContentButton">
                    <button type="submit" class="btnAct btnEdit">Guardar</button>
                    <button id="cerrarBtn" class="btnAct btnDelete">Cancelar</button>
                </section>
            </form>
        </dialog>
        

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
                <!-- SE LLAMA LA FUNCION loadTask PARA MOSTRAR LOS REGISTROS EN LA TABLA DEL DOM -->
                <?php 
                    $datos = loadTask($conn);
                    foreach($datos as $data){
                        // GUARDAMOS LOS DATOS EN VARIABLES PARA CADA ITERACION //
                        $id = $data["Id"];
                        $prod = $data["Producto"];
                        $cant = $data["Cantidad"];
                        $pric = $data["Precio"];

                        // SE CREAN ID PARA CADA REGISTRO, PARA IDENTIFICAR AL MOMENTO DE EDITAR LOS DATOS //
                        $idPrd = $id . 1 . $prod;
                        $idCnt = $id . 2 . $cant;
                        $idPrc = $id . 3 . $pric;
                        ?>
                        <tr id='<?php echo $id;?>'>
                            <td><?php echo $data['Id']; ?></td>
                            <td><input type="text" class="tableResult" value="<?php echo $prod; ?>" id="<?php echo $idPrd; ?>" readonly ondblclick="handleClick('<?php echo $idPrd ?>')" require></td>
                            <td><input type="text" class="tableResult" value="<?php echo $cant; ?>" id="<?php echo $idCnt; ?>" readonly ondblclick="handleClick('<?php echo $idCnt; ?>')" require></td>
                            <td><input type="text" class="tableResult" value="<?php echo $pric; ?>" id="<?php echo $idPrc; ?>" readonly ondblclick="handleClick('<?php echo $idPrc; ?>')" require></td>
                            <td><?php echo $data['Cantidad'] * $data['Precio']; ?></td>
                            <td><?php echo 'Pendiente' ?></td>
                            <td>
                                <fieldset>
                                    <div> <!-- CREAMOS EL BOTON PARA EDITAR Y ASIGNAMOS UN EVENTO ONCLIK PARA ENVIAR LOS DATOS POR JS AL BACKEND -->
                                        <input type="button" value='Editar' class="btnAct btnEdit" onclick="sendChange(<?php echo $id;?>, '<?php echo $idPrd;?>', <?php echo $idCnt;?>, <?php echo $idPrc;?>)">
                                    </div>
                                    <form method="post" action="./db/crud.php"> <!-- CREAMOS EL BOTON PARA ELIMINAR REGISTROS -->
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
                <tr> <!-- SE ASIGNAN BUCLES PARA ITERAR VALORES Y CALCULAR TOTALES -->
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
<!-- LLAMADA AL FOOTER -->
<?php include "./includes/footer.php" ?>