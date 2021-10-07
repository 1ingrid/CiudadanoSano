<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Seat extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT headquarters.id, cities.name as city, city_id, countries.name as country, country_id, headquarters.name, 
            headquarters.status, headquarters.created_at, headquarters.updated_at 
            FROM headquarters INNER JOIN cities ON cities.id = headquarters.city_id INNER JOIN countries ON countries.id = cities.country_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO headquarters 
                (city_id, name) 
                VALUES('.utf8_decode($datos['city_id']).',"'.utf8_decode($datos['name']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE headquarters SET 
                city_id = "'.utf8_decode($put->city_id).'",
                name = "'.utf8_decode($put->name).'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE headquarters SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE headquarters SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }