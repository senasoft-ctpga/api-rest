<?php
    require_once 'extras/http_headers.php';

    include_once 'productos.php';


    $request_producto = new adminProductos();

    if(isset($_GET['idproducto'])){
        $idProducto = $_GET['idproducto'];

        if(is_numeric($idProducto)){
            $request_producto->getProductId($idProducto);
        }else{
            $request_producto->error('El id es incorrecto');
        }
    }else{
        $request_producto->getAllProducts();
    }
?>