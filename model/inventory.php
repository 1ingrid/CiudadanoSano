<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Inventory extends ModeloAbstractoDB {

        public function listar() {}

        public function consultarProduct($product_id) {
            $this->query = 'SELECT products.id, CONCAT(products.name," - ",products.presentation," - ",providers.name) as name, products.price, 
            SUM(stock) as stock FROM inventories INNER JOIN products ON products.id = inventories.product_id 
            INNER JOIN providers ON providers.id = products.provider_id WHERE product_id = "'.$product_id.'" AND stock > 0 AND inventories.status = 1 
            GROUP BY products.id, products.name, products.price';
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }