<?php

include_once 'controllers/controller_productos.php';

class adminProductos{

    private $error;
    private $imagen;


    function getAllProducts(){
        $producto = new Productos();
        $productos = array();
        $productos["json_productos"] = array();

        $res = $producto->getProducts();

        if(!empty($res)){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "idproducto" => $row['id_producto'],
                    "nombre" => $row['nombre_producto'],
                    "descripcion" => $row['descripcion_producto'],
                    "precio" => $row['precio_producto'],
                    "imagen" => $row['imagen_producto'],
                );
                array_push($productos["json_productos"], $item);
            }
        
            $this->printJSON($productos);
        }else{
            $this->error('No se han agregado productos');
        }
    }

    function getProductId($idproducto){
        $producto = new Productos();
        $productos = array();
        $productos["json_productos"] = array();

        $res = $producto->showOneProduct($idproducto);

        if($res->rowCount() == 1){
            $row = $res->fetch();
        
            $item=array(
                "idproducto" => $row['id_producto'],
                "nombre" => $row['nombre_producto'],
                "descripcion" => $row['descripcion_producto'],
                "precio" => $row['precio_producto'],
                "imagen" => $row['imagen_producto'],
            );
            array_push($productos["json_productos"], $item);
            $this->printJSON($producto);
        }else{
            $this->error('Rl producto buscado no se encuentra');
        }
    }

    function add($item){
        $producto = new Producto();

        $res = $producto->addProduct($item);
        $this->exito('Se registró el producto de forma exitosa');
    }


    function error($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function exito($mensaje){
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>'; 
    }

    function printJSON($array){
        echo '<code>'.json_encode($array).'</code>';
    }

    function subirImagen($file){
        $directorio = "imagenes/";

        $this->imagen = basename($file["name"]);
        $archivo = $directorio . basename($file["name"]);

        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // valida que es imagen
        $checarSiImagen = getimagesize($file["tmp_name"]);

        if($checarSiImagen != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{

                //validar tipo de imagen
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    function getImagen(){
        return $this->imagen;
    }

    function getError(){
        return $this->error;
    }
}

?>