<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class Role extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT * FROM roles WHERE id <> 2 AND id <> 3 AND id <> 4 AND id <> 5 AND id <> 6';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function listarxStatus() {
			$this->query = 'SELECT * FROM roles WHERE id <> 2 AND id <> 3 AND id <> 4 AND id <> 5 AND id <> 6 AND status = 1';
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
            if(!empty($datos['contracts'])) $permits .=  ','.$datos['contracts'];
            if(!empty($datos['clients'])) $permits .=  ','.$datos['clients'];
            if(!empty($datos['professions'])) $permits .=  ','.$datos['professions'];
            if(!empty($datos['employees'])) $permits .=  ','.$datos['employees'];
            if(!empty($datos['providers'])) $permits .=  ','.$datos['providers'];
            if(!empty($datos['mepas'])) $permits .=  ','.$datos['mepas'];
            if(!empty($datos['products'])) $permits .=  ','.$datos['products'];
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
            if(!empty($put->contracts)) $permits .=  ','.$put->contracts;
            if(!empty($put->clients)) $permits .=  ','.$put->clients;
            if(!empty($put->professions)) $permits .=  ','.$put->professions;
            if(!empty($put->employees)) $permits .=  ','.$put->employees;
            if(!empty($put->providers)) $permits .=  ','.$put->providers;
            if(!empty($put->mepas)) $permits .=  ','.$put->mepas;
            if(!empty($put->products)) $permits .=  ','.$put->products;
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