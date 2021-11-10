<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Client extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT clients.id, no_document, clients.name, last_name, email, address, cell_phone, clients.status, clients.created_at, 
            clients.updated_at, city_id, country_id, cities.name as city, countries.name as country 
            FROM clients INNER JOIN cities ON cities.id = clients.city_id INNER JOIN countries ON countries.id = cities.country_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function consultarDocument($no_document) {
            $this->query = 'SELECT * FROM clients WHERE no_document = "'.$no_document.'"';
            $this->obtener_resultados_query();
            return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO clients 
                (city_id, no_document, name, last_name, email, address, cell_phone) 
                VALUES('.$datos['city_id'].',"'.$datos['no_document'].'","'.utf8_decode($datos['name']).'","'.utf8_decode($datos['last_name']).'", 
                "'.$datos['email'].'","'.$datos['address'].'","'.$datos['cell_phone'].'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE clients SET 
                city_id = '.$put->city_id.',
                no_document = "'.$put->no_document.'",
                name = "'.utf8_decode($put->name).'",
                last_name = "'.utf8_decode($put->last_name).'",
                email = "'.$put->email.'",
                address = "'.$put->address.'",
                cell_phone = "'.$put->cell_phone.'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE clients SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE clients SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }