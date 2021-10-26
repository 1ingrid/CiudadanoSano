<?php
    require_once '../model/my_consultation.php';
    require_once '../model/client.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myConsultation = new MyConsultation();
    $client = new Client();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_consultations')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myConsultation->listarMyConsultations($dataUser['id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarClients':
                $listado = $client->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'printFormula':
                $resultado = $myConsultation->printFormula($_GET['id']);
                echo json_encode([ 'pdf' => base64_encode($resultado) ]);
            break;
            case 'registro':
                $resultado = $myConsultation->nuevoMyConsultation($_POST, $dataUser['id']);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $myConsultation->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }