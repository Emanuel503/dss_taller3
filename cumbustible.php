<?php
    include_once "conexion.php";
    $combustible = $_GET["tipo"];

    $connection = Database::connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query = $connection->prepare("UPDATE combustibles SET galones=500 WHERE tipo = ?");
    $query->execute(array($combustible));
    header("Location: index.php")
?>