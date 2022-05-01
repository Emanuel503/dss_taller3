<?php
    include_once "combustible.class.php";
    $ventas = new Combustible();
    $datos = $ventas->mostrarVenta($_GET["id"]);
?>


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
        <h1>Modificar venta</h1><br>

        <form method="post">
            <div class="row g-5 align-items-center">
                <div class="col-5">
                    <label for="galones_vendidos" class="col-form-label">Ingresa la cantidad de galones: </label>
                </div>
                <div class="col-6">
                    <input type="number" value="<?php echo $datos["galones_vendidos"]?>" id="galones_vendidos" name="galones_vendidos" class="form-control" min="1" required>
                </div>
            </div>
            <br>
            <div class="row g-5 align-items-center">
                <div class="col-5">
                    <label for="id_combustible" class="col-form-label">Seleccione el tipo de combustible: </label>
                </div>
                <div class="col-6">
                    <select name="id_combustible" id="id_combustible" class="form-select">
                        <option <?php if($datos["id_combustible"]=="1"){echo "selected";}?> value="1">Regular ($3.05 el galón)</option>
                        <option <?php if($datos["id_combustible"]=="2"){echo "selected";}?> value="2">Especial ($3.27 el galón)</option>
                        <option <?php if($datos["id_combustible"]=="3"){echo "selected";}?> value="3">Diesel ($2.96 el galón)</option>
                    </select>
                </div>
            </div>   
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" name="enviar" class="btn btn-primary">Modificar</button>
        </form>
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
        
        $ventas->modificarVenta($id_combustible, $galones_vendidos);
        echo "<script>window.location.href = 'index.php?modificado=si';</>";
    }
?>