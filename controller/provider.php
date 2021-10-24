<?php
    require_once '../model/provider.php';
    require_once '../middleware/jwtToken.php';

    $provider = new Provider();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'providers')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $provider->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarNit':
                $result = $provider->consultarNit($_GET['nit']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'registro':
                $resultado = $provider->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $provider->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $provider->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $provider->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }