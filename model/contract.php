<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Contract extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT contracts.id, types_contracts.name as type_contract, no_document, CONCAT(employees.name," ",employees.last_name) as employe, 
            professions.name as profession, type_contract_id, country_id, city_id, seat_id, employe_id, profession_id, date_init, date_end, duration, 
            salary, contracts.status, contracts.created_at, contracts.updated_at 
            FROM contracts INNER JOIN types_contracts ON types_contracts.id = contracts.type_contract_id 
            INNER JOIN employees ON employees.id = contracts.employe_id INNER JOIN professions ON professions.id = contracts.profession_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN cities ON cities.id = headquarters.city_id 
            INNER JOIN countries ON countries.id = cities.country_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxProfession($type_quote) {
			$this->query = 'SELECT employees.id, employees.name, employees.last_name FROM contracts 
            INNER JOIN professions ON professions.id = contracts.profession_id INNER JOIN employees ON employees.id = contracts.employe_id 
            WHERE contracts.status = 1 AND profession_id = '.$type_quote.' GROUP BY employees.id, employees.name, employees.last_name';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxSeat($seat_id) {
			$this->query = 'SELECT employees.id, employees.name, employees.last_name, employees.no_document 
            FROM contracts INNER JOIN employees ON employees.id = contracts.employe_id 
            WHERE seat_id = '.$seat_id.' AND contracts.status = 1';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            if(!empty($this->verificarContract($datos['employe_id']))) return 2;
            $this->query = '
            INSERT INTO contracts 
            (type_contract_id, employe_id, profession_id, date_init, date_end, duration, salary) 
            VALUES('.$datos['type_contract_id'].',"'.$datos['employe_id'].'","'.$datos['profession_id'].'","'.$datos['date_init'].'",
            "'.$datos['date_end'].'","'.utf8_decode($datos['duration']).'",'.$datos['salary'].')';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE contracts SET 
                type_contract_id = '.$put->type_contract_id.',
                employe_id = '.$put->employe_id.',
                profession_id = '.$put->profession_id.',
                date_init = "'.$put->date_init.'",
                date_end = "'.$put->date_end.'",
                duration = "'.utf8_decode($put->duration).'",
                salary = '.$put->salary.',
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE contracts SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE contracts SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        private function verificarContract($employe_id) {
            $this->query = 'SELECT * FROM contracts WHERE employe_id = '.$employe_id.' AND status = 1';
			$this->obtener_resultados_query();
			return $this->rows;
        }

    }