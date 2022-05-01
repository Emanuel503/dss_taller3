<?php

    class Combustible{
        private $id;
        private $id_combustible;
        private $galones_vendidos;
        private $total;
        private $fecha;

        public function __construct(){
            $this->id=0;
            $this->id_combustible=0;
            $this->galones_vendidos=0;
            $this->total=0;
            $this->fecha="";
        }

        public function mostrarGalones($tipo){
            include_once 'conexion.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM combustibles WHERE tipo=?");
            $query->execute(array($tipo));
            $combustibles = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            return $combustibles;
        }

        public function mostrarVentas(){
            include_once 'conexion.php';	
            $connection = Database::connect();
            $query ="SELECT * FROM ventas v JOIN combustibles c ON v.id_combustible = c.id";
            $ventas = $connection->query($query);
            Database::disconnect();
            return $ventas;
        }

        public function mostrarVenta($id){
            include_once 'conexion.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM ventas v JOIN combustibles c ON v.id_combustible = c.id WHERE v.id = ?");
            $query->execute(array($id));
            $ventas = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            return $ventas;
        }

        public function agregrarVenta($id_combustible, $galones_vendidos){
            include_once 'conexion.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM combustibles WHERE id = ?");
            $query->execute(array($id_combustible));
            $combustibles = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();

            if($combustibles["galones"] < $galones_vendidos){
                return 2;
            }else{
                $connection = Database::connect();
                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query = $connection->prepare("UPDATE combustibles SET galones=? WHERE id = ?");
                $nuevaCantidad = $combustibles["galones"] - $galones_vendidos;
                $query->execute(array($nuevaCantidad,$id_combustible));

                date_default_timezone_set('America/El_Salvador');
                $this->id_combustible = $id_combustible;
                $this->galones_vendidos = $galones_vendidos;
                $this->total = $combustibles["precio_galon"] * $galones_vendidos;
                $this->fecha = date('Y-m-d H:i:s');

                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query = $connection->prepare("INSERT INTO ventas(id_combustible, galones_vendidos, total, fecha) VALUES (?,?,?,?)");
                $query->execute(array($this->id_combustible, $this->galones_vendidos, $this->total, $this->fecha));
                Database::disconnect();
                return 1;
            }
        }

        public function modificarVenta($id_combustible, $galones_vendidos){
            include_once 'conexion.php';	
            $connection = Database::connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $connection->prepare("SELECT * FROM combustibles WHERE id = ?");
            $query->execute(array($id_combustible));
            $combustibles = $query->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();

            if($combustibles["galones"] < $galones_vendidos){
                return 2;
            }else{
                $connection = Database::connect();
                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query = $connection->prepare("UPDATE combustibles SET galones=? WHERE id = ?");
                $nuevaCantidad = $combustibles["galones"] - $galones_vendidos;
                $query->execute(array($nuevaCantidad,$id_combustible));

                date_default_timezone_set('America/El_Salvador');
                $this->id_combustible = $id_combustible;
                $this->galones_vendidos = $galones_vendidos;
                $this->total = $combustibles["precio_galon"] * $galones_vendidos;
                $this->fecha = date('Y-m-d H:i:s');

                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query = $connection->prepare("INSERT INTO ventas(id_combustible, galones_vendidos, total, fecha) VALUES (?,?,?,?)");
                $query->execute(array($this->id_combustible, $this->galones_vendidos, $this->total, $this->fecha));
                Database::disconnect();
                return 1;
            }
        }
    }
?>