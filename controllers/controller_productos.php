<?php

include_once 'connecctions/db.php';

class Productos extends DB{

    
    function getProducts($idempresa){
        $query = $this->connect()->query('SELECT * FROM productos WHERE id_tenant = :idempresa');
        return $query;
    }

    function showOneProduct($idproducto, $idempresa){
        $query = $this->connect()->prepare('SELECT * FROM productos WHERE id_tenant = :idempresa AND id_producto = :idproducto');
        $query->execute(['id_producto' => $idproducto]);
        return $query;
    }

    function addProduct($arrayProducto){
        $query = $this->connect()->prepare('INSERT INTO productos (nombre_producto, descripcion_producto, precio_producto, imagen_producto) VALUES (:nombre, :descripcion, :precio,:imagen)');
        $query->execute(['nombre_producto' => $arrayProducto['nombre'],
                         'descripcion_producto' => $arrayProducto['descripcion'],
                         'precio_producto' => $arrayProducto['precio'], 
                         'id_proveedor' => $arrayProducto['proveedor'],
                         'imagen_producto' => $arrayProducto['imagen']]);
        return $query;
    }

}

?>