<?php
    require_once '../model/billing.php';
    require_once '../model/userxemploye.php';
    require_once '../model/client.php';
    require_once '../model/inventory.php';
    require_once '../middleware/jwtToken.php';

    $billing = new Billing();
    $userxEmploye = new UserxEmploye();
    $client = new Client();
    $inventory = new Inventory();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'billing')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'getClient':
                $result = $client->consultarDocument($_GET['no_document']);
                echo json_encode(!empty($result) ? $result[0] : []);
            break;
            case 'getProduct':
                $result = $inventory->consultarProduct($_GET['product_id']);
                echo json_encode(!empty($result) ? $result[0] : []);
            break;
            case 'registro':
                $resultado = $billing->nuevoInvoice($_POST, $dataUser['id'], $dataUser['seat_id']);
                echo json_encode($resultado);
            break;

        }
    } else {
        echo json_encode($jwt->message);
    }