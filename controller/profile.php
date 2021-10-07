<?php
    require_once '../model/user.php';
    require_once '../middleware/jwtToken.php';

    $user = new User();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'profile')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'consultar':
                $listado = $user->consultar($jwt->id);
                echo json_encode($listado[0], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarEmail':
                $result = $user->consultarEmail($_GET['email']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'modificar':
                $resultado = $user->profile(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }