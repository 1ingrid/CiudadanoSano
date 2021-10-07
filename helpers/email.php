<?php
    require_once '../vendor/autoload.php';
    require_once '../model/user.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use Firebase\JWT\JWT;

    class Email {
        
        private $email;
        private $secret_key = 'CS270921KEY';
        private $encrypt = ['HS256'];

        function __construct() {
            $this->email = new PHPMailer(true);
            $this->email->isSMTP();
            $this->email->Host = 'smtp.gmail.com';
            $this->email->Port = 587;
            $this->email->SMTPSecure = 'tls';
            $this->email->SMTPAuth = true;
            $this->email->Username = 'csrecover10@gmail.com';
            $this->email->Password = 'Csano2021';
            $this->email->isHTML(true);
        }

        function sendEmailRecoPass($email) {
            $user = new User();
            $return = $user->consultarEmail($email);
            if(!empty($return)) {
                $this->email->setFrom($return[0]['email'], $return[0]['name'].' '.$return[0]['last_name']);
                $this->email->addAddress($return[0]['email']);
                $this->email->Subject = 'Recuperar Password.';
                $token = $this->generarToken($return[0]['id']);
                $url = 'http://localhost/CiudadanoSano/view/auth/change/index.php?key='.$token;
                $html = file_get_contents('../view/recover.php');
                $html = str_replace('$url_pass', $url, $html);
                $html = utf8_decode($html);
                $this->email->Body = $html;
                try {
                    $this->email->send();
                    return [ 'send' => true ];
                } catch (Exception $e) {
                    return [ 'send' => false ];
                } 
            } else {
                return [ 'send' => false ];
            }
        }

        function decodeKey($key) {
            try {
                $id = JWT::decode(
                    $key,
                    $this->secret_key,
                    $this->encrypt
                )->data->id;
                return [ 'error' => false, 'id' => $id ];
            } catch (\Exception $e) {
                return [ 'error' => true ];
            }
        }

        private function generarToken($id) {
            $token = [
                'exp' => time() + (60 * 60),
                'data' => [
                    'id' => $id
                ]
            ];
            return JWT::encode($token, $this->secret_key);
        }

    }