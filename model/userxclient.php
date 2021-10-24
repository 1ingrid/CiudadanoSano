<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class UserxClient extends ModeloAbstractoDB {

        public function listar() {}

        public function verificarUser($client_id) {
            $this->rows = [];
			$this->query = 'SELECT * FROM usersxclients WHERE client_id = '.$client_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function dataUser($user_id) {
            $this->query = 'SELECT clients.id FROM usersxclients INNER JOIN clients ON clients.id = usersxclients.client_id 
            WHERE user_id = '.$user_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO usersxclients 
                (user_id, client_id) 
                VALUES('.$datos['user_id'].','.$datos['client_id'].')';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }