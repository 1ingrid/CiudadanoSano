<?php
    require_once '../model/my_employe.php';
    require_once '../model/userxemploye.php';
    require_once '../model/user.php';
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/email.php';

    $myEmploye = new MyEmploye();
    $userxEmploye = new UserxEmploye();
    $user = new User();
    $jwt = new JwtToken();
    $email = new Email();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_employees')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myEmploye->listarMyEmployees($dataUser);
                foreach ($listado as $key => $value) {
                   $listado[$key]['user'] = !empty($userxEmploye->verificarUser($value['id'])) ? true : false;
                }
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarDocument':
                $result = $myEmploye->consultarDocument($_GET['no_document']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'registro':
                $resultado = $myEmploye->nuevoMyEmploye($_POST, $dataUser['seat_id']);
                echo json_encode($resultado);
            break;
            case 'registroUser':
                if(!empty($user->consultarEmail($_POST['email']))) echo json_encode(401);
                $res = $user->nuevo($_POST);
                if($res !== 1) echo json_encode(400);
                $user = $user->consultarEmail($_POST['email']);
                $res = $userxEmploye->nuevo(['user_id' => $user[0]['id'], 'employe_id' => $_POST['id']]);
                if($res !== 1) echo json_encode(400);
                if(!$email->sendEmailUser($_POST)['send']) echo json_encode(400);
                else echo json_encode(200);
            break;
            case 'modificar':
                $resultado = $myEmploye->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $myEmploye->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $myEmploye->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }