<?php
    require_once '../model/my_inventory.php';
    require_once '../model/product.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myInventory = new MyInventory();
    $product = new Product();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_inventories')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myInventory->listarMyInventories($dataUser['seat_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarProducts':
                $listado = $product->listarxStatus();
                echo json_encode([ 'data' => array_values($listado) ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $myInventory->nuevoMyInventory($_POST, $dataUser['seat_id']);
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $myInventory->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $myInventory->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }