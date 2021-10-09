<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Role extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT * FROM roles';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function nuevo($datos) {
            $permits = '';
            if(!empty($datos['roles'])) $permits .=  ','.$datos['roles'];
            if(!empty($datos['users'])) $permits .=  ','.$datos['users'];
            if(!empty($datos['countries'])) $permits .=  ','.$datos['countries'];
            if(!empty($datos['cities'])) $permits .=  ','.$datos['cities'];
            if(!empty($datos['headquarters'])) $permits .=  ','.$datos['headquarters'];
            if(!empty($datos['types_contracts'])) $permits .=  ','.$datos['types_contracts'];
            $this->query = '
                INSERT INTO roles 
                (name, description, permits) 
                VALUES("'.utf8_decode($datos['name']).'","'.utf8_decode($datos['description']).'","'.$permits.'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $permits = '';
            if(!empty($put->roles)) $permits .=  ','.$put->roles;
            if(!empty($put->users)) $permits .=  ','.$put->users;
            if(!empty($put->countries)) $permits .=  ','.$put->countries;
            if(!empty($put->cities)) $permits .=  ','.$put->cities;
            if(!empty($put->headquarters)) $permits .=  ','.$put->headquarters;
            if(!empty($put->types_contracts)) $permits .=  ','.$put->types_contracts;
            $this->query = '
                UPDATE roles SET 
                name = "'.utf8_decode($put->name).'",
                description = "'.utf8_decode($put->description).'",
                permits = "'.$permits.'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE roles SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE roles SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }