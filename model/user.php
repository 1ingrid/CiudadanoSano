<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class User extends ModeloAbstractoDB {

        public function listar() {
			$this->query = 'SELECT users.id, roles.name as rol, rol_id, users.name, last_name, email, users.status, users.created_at, users.updated_at 
            FROM users INNER JOIN roles ON roles.id = users.rol_id';
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function consultarEmail($email) {
            $this->query = 'SELECT * FROM users WHERE email = "'.$email.'"';
            $this->obtener_resultados_query();
            return $this->rows;
        }

        public function consultar($id) {
            $this->query = 'SELECT users.id, permits, users.name, last_name, email FROM users INNER JOIN roles ON roles.id = users.rol_id WHERE users.id = "'.$id.'"';
            $this->obtener_resultados_query();
            return $this->rows;
        }

        public function nuevo($datos) {
            $password = password_hash($datos['password'], PASSWORD_BCRYPT, ['cost' => 12]);
            $this->query = '
            INSERT INTO users 
            (rol_id, name, last_name, email, password) 
            VALUES('.$datos['rol_id'].',"'.utf8_decode($datos['name']).'","'.utf8_decode($datos['last_name']).'","'.$datos['email'].'","'.$password.'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            if(!empty($put->password)) $password = password_hash($put->password, PASSWORD_BCRYPT, ['cost' => 12]);
            else $password = $this->consultarEmail($put->email)[0]['password'];
            $this->query = '
                UPDATE users SET 
                rol_id = '.$put->rol_id.',
                name = "'.utf8_decode($put->name).'",
                last_name = "'.utf8_decode($put->last_name).'",
                email = "'.$put->email.'",
                password = "'.$password.'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function profile($datos) {
            $put = json_decode($datos);
            if(!empty($put->password)) $password = password_hash($put->password, PASSWORD_BCRYPT, ['cost' => 12]);
            else $password = $this->consultarEmail($put->email)[0]['password'];
            $this->query = '
                UPDATE users SET 
                name = "'.utf8_decode($put->name).'",
                last_name = "'.utf8_decode($put->last_name).'",
                email = "'.$put->email.'",
                password = "'.$password.'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE users SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE users SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }