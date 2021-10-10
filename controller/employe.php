<?php
    require_once '../model/employe.php';
    require_once '../model/seat.php';
    require_once '../middleware/jwtToken.php';

    $employe = new Employe();
    $seat = new Seat();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'employees')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $employe->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarHeadquarters':
                $listado = $seat->listar();
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