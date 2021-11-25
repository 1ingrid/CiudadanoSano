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
            $this->email->Host = 'mail.marcsoft.com.co';
            $this->email->Username = 'csrecover@marcsoft.com.co';
            $this->email->Password = 'IpuyW{nKgRLm';
            $this->email->SMTPSecure = 'ssl';
            $this->email->Port = 465;
            // $this->email->Host = 'smtp.gmail.com';
            // $this->email->Username = 'csrecover10@gmail.com';
            // $this->email->Password = 'Csano2021';
            // $this->email->SMTPSecure = 'tls';
            // $this->email->Port = 587;
            $this->email->SMTPAuth = true;
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
                // $url = 'http://localhost/CiudadanoSano/view/auth/change/index.php?key='.$token;
                $url = 'https://ciudadanosano.marcsoft.com.co/view/auth/change/index.php?key='.$token;
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

        function sendEmailUser($data) {
            $this->email->setFrom($data['email'], $data['name'].' '.$data['last_name']);
            $this->email->addAddress($data['email']);
            $this->email->Subject = 'Datos de usuario.';
            $html = file_get_contents('../view/user.php');
            $html = str_replace('$user', $data['email'], $html);
            $html = str_replace('$pass', $data['password'], $html);
            $html = utf8_decode($html);
            $this->email->Body = $html;
            try {
                $this->email->send();
                return [ 'send' => true ];
            } catch (Exception $e) {
                return [ 'send' => false ];
            }
        }

        function sendEmailQuote($data) {
            $this->email->setFrom($data['email'], $data['client']);
            $this->email->addAddress($data['email']);
            $this->email->Subject = 'Datos de la cita programada.';
            $html = file_get_contents('../view/cita.php');
            $html = str_replace('$client', $data['client'], $html);
            $date = new DateTime($data['date']);
            $html = str_replace('$date', $date->format('d M Y h:i A'), $html);
            $html = str_replace('$seat', $data['seat'], $html);
            $html = str_replace('$address', $data['address'], $html);
            $html = str_replace('$cell_phone', $data['cell_phone'], $html);
            $html = str_replace('$employe', $data['employe'], $html);
            if($data['profession'] === 'Medico') $html = str_replace('$type', 'Consulta General', $html);
            $html = utf8_decode($html);
            $this->email->Body = $html;
            try {
                $this->email->send();
                return [ 'send' => true ];
            } catch (Exception $e) {
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