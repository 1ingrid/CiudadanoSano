<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Mepas extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT * FROM mepas';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO mepas 
                (name) 
                VALUES("'.utf8_decode($datos['name']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE mepas SET 
                name = "'.utf8_decode($put->name).'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE mepas SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE mepas SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }