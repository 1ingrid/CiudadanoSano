<?php
    require_once '../model/role.php';
    require_once '../middleware/jwtToken.php';

    $role = new Role();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'roles')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $role->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $role->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $role->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $role->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $role->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }