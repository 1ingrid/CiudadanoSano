<?php
    require_once '../model/auth.php';
    require_once '../helpers/email.php';

    $auth = new Auth();
    $email = new Email();

    switch ($_SERVER['HTTP_ACCION']) {

        case 'login':
            $resultado = $auth->login($_POST);
            echo json_encode($resultado);
        break;
        case 'recover':
            $resultado = $email->sendEmailRecoPass($_POST['email']);
            echo json_encode($resultado);
        break;
        case 'change':
            $resultado = $auth->changePass(file_get_contents("php://input"));
            echo json_encode($resultado);
        break;
        
    }