<?php
    require_once '../model/employe.php';
    require_once '../model/country.php';
    require_once '../model/city.php';
    require_once '../model/seat.php';
    require_once '../model/userxemploye.php';
    require_once '../model/user.php';
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/email.php';

    $employe = new Employe();
    $country = new Country();
    $city = new City();
    $seat = new Seat();
    $userxEmploye = new UserxEmploye();
    $user = new User();
    $jwt = new JwtToken();
    $email = new Email();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'employees')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $employe->listar();
                foreach ($listado as $key => $value) {
                   $listado[$key]['user'] = !empty($userxEmploye->verificarUser($value['id'])) ? true : false;
                }
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCountries':
                $listado = $country->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCities':
                $listado = $city->listarxCountry($_GET['country_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarHeadquarters':
                $listado = $seat->listarxCity($_GET['city_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarDocument':
                $result = $employe->consultarDocument($_GET['no_document']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'registro':
                $resultado = $employe->nuevo($_POST);
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
                $resultado = $employe->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $employe->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $employe->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }