<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class UserxEmploye extends ModeloAbstractoDB {

        public function listar() {}

        public function verificarUser($employe_id) {
			$this->query = 'SELECT * FROM usersxemployees WHERE employe_id = '.$employe_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO countries 
                (name) 
                VALUES("'.utf8_decode($datos['name']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }