<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <title>Taller 2</title>
</head>
<body>
    <nav class="nav navbar justify-content-center bg-dark">
        <li class="nav-item">
            <a class="nav-link text-white">Sistema de venta de combustible</a>
        </li>
    </nav>
    <br>
    <div class="container">
        <h3>Cantidad de galones diponible en los tanques</h3><br>

        <div class="row">
            <?php
                include_once "combustible.class.php";
                $ventas = new Combustible();
                $cantidad = $ventas->mostrarGalones("Regular");
            ?>
            <div class="col-10">
                <label>Tanque de Regular</label><br>
                <span>Maximo de galones: 500</span><br>
                <span>Galones disponibles: <?php echo $cantidad["galones"];?></span>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo ($cantidad["galones"]/500)*100 ?>%;" aria-valuemin="0" aria-valuemax="100"><?php echo $cantidad["galones"];?> galones</div>
                </div>
            </div>
            <div class="col-2">
                <br><a href="cumbustible.php?tipo=Regular" class="btn btn-secondary" href="">Rellenar tanque</a>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
                include_once "combustible.class.php";
                $ventas = new Combustible();
                $cantidad = $ventas->mostrarGalones("Especial");
            ?>
            <div class="col-10">
                <label>Tanque de Especial</label><br>
                <span>Maximo de galones: 500</span><br>
                <span>Galones disponibles: <?php echo $cantidad["galones"];?></span>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ($cantidad["galones"]/500)*100 ?>%;" aria-valuemin="0" aria-valuemax="100"><?php echo $cantidad["galones"];?> galones</div>
                </div>
            </div>
            <div class="col-2">
                <br><a href="cumbustible.php?tipo=Especial" class="btn btn-secondary" href="">Rellenar tanque</a>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
                include_once "combustible.class.php";
                $ventas = new Combustible();
                $cantidad = $ventas->mostrarGalones("Diesel");
            ?>
            <div class="col-10">
                <label>Tanque de Diesel</label><br>
                <span>Maximo de galones: 500</span><br>
                <span>Galones disponibles: <?php echo $cantidad["galones"];?></span>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo ($cantidad["galones"]/500)*100 ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $cantidad["galones"];?> galones</div>
                </div>
            </div>
            <div class="col-2">
                <br><a href="cumbustible.php?tipo=Diesel" class="btn btn-secondary" href="">Rellenar tanque</a>
            </div>
        </div>
        <br><br>
        <h3>Registro de ventas</h3><br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Registrar nueva venta</button><br><br>
        <table class="table table-dark table-bordered table-striped table-hover table-responsive">
            <thead>
                <th>#</th>
                <th>Tipo de gasolina</th>
                <th>Fecha de venta</th>
                <th>Cantidad de galones</th>
                <th>Total</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php
                    
                    $datos = $ventas->mostrarVentas();
                    $contador=0;

                    foreach($datos as $venta){
                        $contador++;
                        echo "<tr>";
                            echo "<td>".$contador."</td>";
                            echo "<td>".$venta["tipo"]."</td>";
                            echo "<td>".$venta["fecha"]."</td>";
                            echo "<td>".$venta["galones_vendidos"]."</td>";
                            echo "<td>$".$venta["total"]."</td>";
                            echo "<td>";
                                echo "<a href='modificarVenta.php?id=".$venta[0]."' class='btn btn-success'>Modificar</a>";
                                echo "<button onclick='eliminar(".$venta[0].")' class='btn btn-danger'>Eliminar</button>";
                            echo "</td>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nueva venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row g-5 align-items-center">
                        <div class="col-5">
                            <label for="galones_vendidos" class="col-form-label">Ingresa la cantidad de galones: </label>
                        </div>
                        <div class="col-6">
                            <input type="number" id="galones_vendidos" name="galones_vendidos" class="form-control" min="1" required>
                        </div>
                    </div>
                    <br>
                    <div class="row g-5 align-items-center">
                        <div class="col-5">
                            <label for="id_combustible" class="col-form-label">Seleccione el tipo de combustible: </label>
                        </div>
                        <div class="col-6">
                            <select name="id_combustible" id="id_combustible" class="form-select">
                                <option value="1">Regular ($3.05 el galón)</option>
                                <option value="2">Especial ($3.27 el galón)</option>
                                <option value="3">Diesel ($2.96 el galón)</option>
                            </select>
                        </div>
                    </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js" ></script>
    <script src="js/funciones.js"></script>
</body>
</html>

<?php
    if(isset($_POST["enviar"])){
        $id_combustible = $_POST["id_combustible"]; 
        $galones_vendidos = $_POST["galones_vendidos"];
        
        $mensaje = $ventas->agregrarVenta($id_combustible, $galones_vendidos);

        if($mensaje == 1){
            echo '
            <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <b>Venta guardada correctamente</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }

        if($mensaje == 2){
            echo '
            <div class="alert alert-danger alert-dismissible fade show fixed-top text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <b>Cantidad de combustible no disponible en los tanques</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }

    if(isset($_GET["eliminado"])){
        echo '
        <div class="alert alert-danger alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Venta eliminada correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    if(isset($_GET["modificado"])){
        echo '
        <div class="alert alert-success alert-dismissible fade show fixed-top text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <b>Venta modificada correctamente</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
?>