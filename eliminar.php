<?php

    include_once "conexion.php";
    $id = $_GET["id"];

    $connection = Database::connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query = $connection->prepare("DELETE FROM ventas WHERE id=?");
    $query->execute(array($id));
    Database::disconnect();
    header("Location: index.php?eliminado")
?>