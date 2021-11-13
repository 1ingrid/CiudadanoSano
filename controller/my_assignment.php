<?php
    require_once '../model/my_assignment.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myAssignment = new MyAssignment();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_assignments')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myAssignment->listarMyAssignments($dataUser['id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'changeStatus':
                $resultado = $myAssignment->change(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }