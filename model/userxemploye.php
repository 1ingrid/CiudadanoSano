<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class UserxEmploye extends ModeloAbstractoDB {

        public function listar() {}

        public function verificarUser($employe_id) {
            $this->rows = [];
			$this->query = 'SELECT * FROM usersxemployees WHERE employe_id = '.$employe_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function dataUser($user_id) {
            $this->query = 'SELECT employees.id, seat_id FROM usersxemployees INNER JOIN employees ON employees.id = usersxemployees.employe_id 
            WHERE user_id = '.$user_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO usersxemployees 
                (user_id, employe_id) 
                VALUES('.$datos['user_id'].','.$datos['employe_id'].')';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }