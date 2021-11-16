<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class MyProduct extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyProduct($seat_id) {
            $this->query = 'SELECT products.id, seat_id, provider_id, providers.name as provider, products.name, presentation, img, products.status, 
            products.created_at, products.updated_at FROM products INNER JOIN providers ON providers.id = products.provider_id WHERE seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function nuevoMyProduct($datos, $seat_id) {
            $prefijo = substr(md5(uniqid(rand())), 0,6);
            $info_archivo = explode(".",$_FILES['img']['name']);
            $nombre_archivo = $info_archivo[0].'_'.$prefijo.'.'.$info_archivo[1];
            if(copy($_FILES['img']['tmp_name'], '../uploads/products/'.$nombre_archivo)) {
                $this->query = '
                INSERT INTO products 
                (seat_id, provider_id, name, presentation, img) 
                VALUES('.$seat_id.','.$datos['provider_id'].',"'.utf8_decode($datos['name']).'","'.utf8_decode($datos['presentation']).'",
                "'.$nombre_archivo.'")';
                return $this->ejecutar_query_simple();
            } else {
                return 0;
            }   
        }

        public function actualizar($datos) {
            if(!empty($_FILES['img']['tmp_name'])) {
                $this->query = 'SELECT * FROM products WHERE id = '.$datos['id'];
                $this->obtener_resultados_query();
                unlink('../uploads/products/'.$this->rows[0]['img']);
			    $prefijo = substr(md5(uniqid(rand())), 0,6);
                $info_archivo = explode(".",$_FILES['img']['name']);
                $nombre_archivo = $info_archivo[0].'_'.$prefijo.'.'.$info_archivo[1];
                if(copy($_FILES['img']['tmp_name'], '../uploads/products/'.$nombre_archivo)) {
                    $this->query = '
                    UPDATE products SET 
                    provider_id = "'.$datos['provider_id'].'",
                    name = "'.utf8_decode($datos['name']).'",
                    presentation = "'.utf8_decode($datos['presentation']).'",
                    img = "'.$nombre_archivo.'",
                    updated_at = NOW() WHERE id = '.$datos['id'];
                }
            } else {
                $this->query = '
                UPDATE products SET 
                provider_id = "'.$datos['provider_id'].'",
                name = "'.utf8_decode($datos['name']).'",
                presentation = "'.utf8_decode($datos['presentation']).'",
                updated_at = NOW() WHERE id = '.$datos['id'];
            }
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE products SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE products SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }