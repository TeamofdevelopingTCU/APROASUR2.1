<?php 
error_reporting(1);
include_once 'Data.php';
include '../Domain/Product.php';

class ProductData extends Data {
    /* metodo obtiene todos los productos de la BD */

    public function getAllProducts() {

        $conn = new mysqli($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        $query = "call sp_getAllProducts()";
        $result = mysqli_query($conn, $query);
        mysqli_close($conn);

        $array = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentProduct = new Product($row['id_product'], $row['name'], $row['description'], $row['path_image'], $row['id_organization']);
            array_push($array, $currentProduct);
        }
        return $array;
    }

}
