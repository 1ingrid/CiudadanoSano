<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Employe extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT employees.id, headquarters.name as seat, cities.name as city, countries.name as country, seat_id, city_id, country_id, 
            no_document, employees.name, last_name, email, employees.address, cell_phone, employees.status, employees.created_at, employees.updated_at 
            FROM employees INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN cities ON cities.id = headquarters.city_id 
            INNER JOIN countries ON countries.id = cities.country_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxSeat($seat_id) {
			$this->query = 'SELECT employees.id, headquarters.name as seat, cities.name as city, countries.name as country, seat_id, city_id, country_id, 
            no_document, employees.name, last_name, email, employees.address, cell_phone, employees.status, employees.created_at, employees.updated_at 
            FROM employees INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN cities ON cities.id = headquarters.city_id 
            INNER JOIN countries ON countries.id = cities.country_id WHERE seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function consultarDocument($no_document) {
            $this->query = 'SELECT * FROM employees WHERE no_document = "'.$no_document.'"';
            $this->obtener_resultados_query();
            return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
            INSERT INTO employees 
            (seat_id, no_document, name, last_name, email, address, cell_phone) 
            VALUES('.$datos['seat_id'].',"'.$datos['no_document'].'","'.utf8_decode($datos['name']).'","'.utf8_decode($datos['last_name']).'", 
            "'.$datos['email'].'","'.$datos['address'].'","'.$datos['cell_phone'].'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE employees SET 
                seat_id = '.$put->seat_id.',
                no_document = '.$put->no_document.',
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
            $this->query = 'UPDATE employees SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE employees SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }