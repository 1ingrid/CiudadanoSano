<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class MyInventory extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyInventories($seat_id) {
            $this->query = 'SELECT inventories.id, CONCAT(products.name," - ",products.presentation," - ",providers.name) as product, product_id, 
            entries, stock, inventories.status, inventories.created_at, inventories.updated_at FROM inventories 
            INNER JOIN products ON products.id = inventories.product_id INNER JOIN providers ON providers.id = products.provider_id 
            WHERE seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function nuevoMyInventory($datos, $seat_id) {
            $this->query = '
            INSERT INTO inventories 
            (product_id, seat_id, entries, stock) 
            VALUES('.$datos['product_id'].','.$seat_id.','.$datos['entries'].','.$datos['entries'].')';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {}

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE inventories SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE inventories SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }