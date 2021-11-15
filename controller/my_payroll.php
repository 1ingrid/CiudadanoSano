<?php
    require_once '../model/my_payroll.php';
    require_once '../model/contract.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myPayroll = new MyPayroll();
    $contract = new Contract();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_payroll')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myPayroll->listarMyPayroll($dataUser['seat_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarEmployees':
                $listado = $contract->listarxSeat($dataUser['seat_id']);
                foreach ($listado as $key => $value) if($value['id'] === $dataUser['id']) $position = $key;
                unset($listado[$position]);
                echo json_encode([ 'data' => array_values($listado) ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $myPayroll->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $myPayroll->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $myPayroll->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $myPayroll->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }