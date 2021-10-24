<?php
    require_once '../model/mepas.php';
    require_once '../middleware/jwtToken.php';

    $mepas = new Mepas();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'mepas')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $mepas->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $mepas->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $mepas->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $mepas->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $mepas->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }