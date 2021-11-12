<?php
    require_once '../model/userxemploye.php';
    require_once '../model/userxclient.php';
    require_once '../model/user.php';
    require_once '../model/my_quote.php';
    require_once 'email.php';

    class Tools {

        private $userxEmploye;
        private $userxClient;
        private $user;
        private $myQuote;
        private $email;

        public function __construct() {
            $this->userxEmploye = new UserxEmploye();
            $this->userxClient = new UserxClient();
            $this->user = new User();
            $this->myQuote = new MyQuote();
            $this->email = new Email();
        }

        public function createUser($data) {
            if(!empty($this->user->consultarEmail($data['email']))) return 401;
            $res = $this->user->nuevo($data);
            if($res !== 1) return 400;
            $user = $this->user->consultarEmail($data['email']);
            $res = $this->userxEmploye->nuevo(['user_id' => $user[0]['id'], 'employe_id' => $data['id']]);
            if($res !== 1) return 400;
            if(!$this->email->sendEmailUser($data)['send']) return 400;
            else return 200;
        }

        public function createUserCli($data, $id) {
            if(!empty($this->user->consultarEmail($data['email']))) return 401;
            $res = $this->user->nuevo($data);
            if($res !== 1) return 400;
            $user = $this->user->consultarEmail($data['email']);
            $res = $this->userxClient->nuevo(['user_id' => $user[0]['id'], 'client_id' => $id]);
            if($res !== 1) return 400;
            if(!$this->email->sendEmailUser($data)['send']) return 400;
            else return 200;
        }

        public function createQuote($data, $id) {
            $res = $this->myQuote->nuevaQuote($data, $id);
            if($res !== 1) return 400;
            $quote = $this->myQuote->consultar($data, $id);
            if(!$this->email->sendEmailQuote($quote[0])['send']) return 400;
            else return 200;
        }

    }
