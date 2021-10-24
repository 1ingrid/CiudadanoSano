<?php
    require_once '../model/my_employe.php';
    require_once '../model/userxemploye.php';
    require_once '../model/user.php';
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/email.php';
    require_once '../helpers/tools.php';

    $myEmploye = new MyEmploye();
    $userxEmploye = new UserxEmploye();
    $user = new User();
    $jwt = new JwtToken();
    $email = new Email();
    $tools = new Tools();

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
                $resultado = $tools->createUser($_POST);
                echo json_encode($resultado);
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