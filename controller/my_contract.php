<?php
    require_once '../model/my_contract.php';
    require_once '../model/type_contract.php';
    require_once '../model/employe.php';
    require_once '../model/profession.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myContract = new MyContract();
    $typeContract = new TypeContract();
    $employe = new Employe();
    $profession = new Profession();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_contracts')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myContract->listarMyContracts($dataUser);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarTypesContracts':
                $listado = $typeContract->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarEmployees':
                $listado = $employe->listarxSeat($dataUser['seat_id']);
                foreach ($listado as $key => $value) if($value['id'] === $dataUser['id']) $position = $key;
                unset($listado[$position]);
                echo json_encode([ 'data' => array_values($listado) ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarProfessions':
                $listado = $profession->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $myContract->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $myContract->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $myContract->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $myContract->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }