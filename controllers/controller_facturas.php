<?php

include_once 'connecctions/db.php';

class Facturas extends DB{

    
    function getInvoices($idEmpresa){
        $query = $this->connect()->query('SELECT * FROM facturas INNER JOIN productos_factura ON facturas.id_factura = productos_factura.id_factura WHERE id_empresa = :idempresa');
        return $query;
    }

    function showOneInvoice($idFactura, $idEmpresa){
        $query = $this->connect()->prepare('SELECT * FROM facturas INNER JOIN productos_factura ON facturas.id_factura = productos_factura.id_factura WHERE id_empresa = :idempresa AND id_factura = :idfactura');
        $query->execute(['id_factura' => $idfactura]);
        return $query;
    }

    function newInvoice($arrayFactura){

        $query_productos_factura = $this->connect()->prepare('SELECT * FROM productos_facturas WHERE id_factura = :idfactura');
        $query->execute(['id_factura' => $idfactura]);
        return $query;

        $query = $this->connect()->prepare('INSERT INTO facturas (id_empresa, id_sucursal, id_cliente, imagen_producto) VALUES (:nombre, :descripcion, :precio,:imagen)');
        $query->execute(['nombre_producto' => $arrayProducto['nombre'],
                         'descripcion_producto' => $arrayProducto['descripcion'],
                         'precio_producto' => $arrayProducto['precio'], 
                         'id_proveedor' => $arrayProducto['proveedor'],
                         'imagen_producto' => $arrayProducto['imagen']]);
        return $query;
    }

}

?>