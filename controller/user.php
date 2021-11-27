<?php
    require_once '../model/user.php';
    require_once '../model/role.php';
    require_once '../middleware/jwtToken.php';

    $user = new User();
    $role = new Role();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'users')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $user->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarRoles':
                $listado = $role->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarEmail':
                $result = $user->consultarEmail($_GET['email']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'registro':
                $resultado = $user->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $user->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $user->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $user->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }