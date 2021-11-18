<?php
    require_once '../model/billing.php';
    require_once '../model/client.php';
    require_once '../model/inventory.php';
    require_once '../middleware/jwtToken.php';

    $billing = new Billing();
    $client = new Client();
    $inventory = new Inventory();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'billing')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $billing->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'getClient':
                $result = $client->consultarDocument($_GET['no_document']);
                echo json_encode(!empty($result) ? $result[0] : []);
            break;
            case 'getProduct':
                $result = $inventory->consultarProduct($_GET['product_id']);
                echo json_encode(!empty($result) ? $result[0] : []);
            break;
            case 'registro':
                $resultado = $billing->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $billing->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $billing->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $billing->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }