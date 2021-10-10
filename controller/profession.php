<?php
    require_once '../model/profession.php';
    require_once '../middleware/jwtToken.php';

    $profession = new Profession();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'professions')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $profession->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $profession->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $profession->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $profession->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $profession->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }