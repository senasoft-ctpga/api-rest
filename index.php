<?php
    require_once 'extras/http_headers.php';
    include_once 'apipeliculas.php';
    include_once 'productos.php';


    $request_pelicula = new ApiPeliculas();

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        if(is_numeric($id)){
            $request_pelicula->getById($id);
        }else{
            $request_pelicula->error('El id es incorrecto');
        }
    }else{
        $request_pelicula ->getAll();
    }
    
    $request_producto = new adminProductos();

    if(isset($_GET['producto'])){
        $idProducto = $_GET['producto'];

        if(is_numeric($idProducto)){
            $request_producto->getProductId($idProducto);
        }else{
            $request_producto->error('El id es incorrecto');
        }
    }else{
        $request_producto->getAllProducts();
    }
?>