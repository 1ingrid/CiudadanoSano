<?php
    require_once '../model/type_contract.php';
    require_once '../middleware/jwtToken.php';

    $typeContract = new TypeContract();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'types_contracts')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $typeContract->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $typeContract->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $typeContract->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $typeContract->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $typeContract->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }