<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/email.php';
    require_once '../model/user.php';

    class Auth extends ModeloAbstractoDB {

        public function login($datos) {
            $this->query = 'SELECT users.id, password, users.status, permits, users.name
            FROM users INNER JOIN roles ON roles.id = users.rol_id WHERE users.status = 1 AND email = "'.$datos['email'].'"';
			$this->obtener_resultados_query();
			$result = $this->rows;
            if(!empty($result) && password_verify($datos['password'], $result[0]['password'])) {
                if($result[0]['status'] == 0) return [];
                $jwt = new JwtToken();
                $jwtToken = $jwt->generar($result[0]['id']);
                return [ 'jwtToken' => $jwtToken, 'permits' => $result[0]['permits'], 'name' =>  $result[0]['name'] ];
            } else {
                return [];
            }
        }

        public function changePass($datos) {
            $put = json_decode($datos);
            $email = new Email();
            $user = new User();
            if(empty($put->key)) return [];
            $return = $email->decodeKey($put->key);
            if($return['error']) return [];
            if(empty($user->consultar($return['id']))) return [];
            $password = password_hash($put->password, PASSWORD_BCRYPT, ['cost' => 12]);
            $this->query = 'UPDATE users SET password = "'.$password.'" WHERE id = '.$return['id'];
            return $this->ejecutar_query_simple();
        }

        public function listar() {}

        public function nuevo($datos) {}

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }