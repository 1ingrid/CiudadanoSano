<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class City extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT cities.id, countries.name as country, country_id, cities.name, cities.status, cities.created_at, cities.updated_at 
            FROM cities INNER JOIN countries ON countries.id = cities.country_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxCountry($country_id) {
			$this->query = 'SELECT cities.id, countries.name as country, country_id, cities.name, cities.status, cities.created_at, cities.updated_at 
            FROM cities INNER JOIN countries ON countries.id = cities.country_id WHERE cities.status = 1 AND country_id = '.$country_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO cities 
                (country_id, name) 
                VALUES('.utf8_decode($datos['country_id']).',"'.utf8_decode($datos['name']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE cities SET 
                country_id = "'.utf8_decode($put->country_id).'",
                name = "'.utf8_decode($put->name).'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE cities SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE cities SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }