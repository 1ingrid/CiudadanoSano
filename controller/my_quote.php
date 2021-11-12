<?php
    require_once '../model/my_quote.php';
    require_once '../model/userxclient.php';
    require_once '../model/seat.php';
    require_once '../model/contract.php';
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/tools.php';

    $myQuote = new MyQuote();
    $userxClient = new UserxClient();
    $seat = new Seat();
    $contract = new Contract();
    $jwt = new JwtToken();
    $tools = new Tools();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_quotes')) {

        $dataUser = $userxClient->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myQuote->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarHeadquarters':
                $listado = $seat->listarxCity($dataUser['city_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarEmployees':
                $listado = $contract->listarxProfession($_GET['type_quote']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verifyAvailability':
                $listado = $myQuote->verifyHour($_GET['date'], $_GET['hour'], $_GET['doctor']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $tools->createQuote($_POST, $dataUser['id']);
                echo json_encode($resultado);
            break;
            case 'cancel':
                $resultado = $myQuote->cancel(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }