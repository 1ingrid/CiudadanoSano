<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Provider extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT * FROM providers';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxStatus() {
			$this->query = 'SELECT * FROM providers WHERE status = 1';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function consultarNit($nit) {
            $this->query = 'SELECT * FROM providers WHERE status = 1 AND nit = "'.$nit.'"';
            $this->obtener_resultados_query();
            return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
                INSERT INTO providers 
                (nit, name, email, address, cell_phone) 
                VALUES("'.$datos['nit'].'","'.utf8_decode($datos['name']).'", "'.$datos['email'].'", 
                "'.$datos['address'].'","'.$datos['cell_phone'].'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE providers SET 
                nit = "'.$put->nit.'",
                name = "'.utf8_decode($put->name).'",
                email = "'.$put->email.'",
                address = "'.$put->address.'",
                cell_phone = "'.$put->cell_phone.'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE providers SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE providers SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }