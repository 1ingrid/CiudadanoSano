<?php
    require_once '../vendor/autoload.php';
    require_once '../model/user.php';

    use Firebase\JWT\JWT;

    class JwtToken {

        private $secret_key = 'CS230921KEY';
        private $encrypt = ['HS256'];
        public $id;
        public $message = '';

        function generar($id) {
            $token = [
                'iat' => time(),
                'data' => [
                    'id' => $id
                ]
            ];
            return JWT::encode($token, $this->secret_key);
        }

        function verificar($token, $module) {
            if(empty($token)) {
                $this->message = "Token no incluido";
                return false;
            }
            $token = explode(' ', $token)[1];
            if(empty($token)) {
                $this->message = "Token no incluido";
                return false;
            }
            try {
                $payload = JWT::decode(
                    $token,
                    $this->secret_key,
                    $this->encrypt
                );
                $user = new User();
                $dataUser = $user->consultar($payload->data->id);
                if(empty($dataUser)) {
                    $this->message = "Token no valido";
                    return false;
                } else {
                    if($module !== 'profile') {
                        $permits = explode(',', $dataUser[0]['permits']);
                        unset($permits[0]);
                        array_values($permits);
                        if(!array_search($module, $permits)) {
                            $this->message = "Token no valido";
                            return false;
                        }
                    }
                    $this->id = $dataUser[0]['id'];
                    return true;
                }
            } catch (Exception $e) {
                $this->message = 'Token no valido';
                return false;
            }
        }

        function decode($token) {
            try {
                $id = JWT::decode(
                    $token,
                    $this->secret_key,
                    $this->encrypt
                )->data->id;
                return [ 'error' => false, 'id' => $id ];
            } catch (\Exception $e) {
                return [ 'error' => true ];
            }
        }

    }

