<?php
    require_once '../model/my_product.php';
    require_once '../model/provider.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myProduct = new MyProduct();
    $provider = new Provider();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_products')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myProduct->listarMyProduct($dataUser['seat_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarProviders':
                $listado = $provider->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $myProduct->nuevoMyProduct($_POST, $dataUser['seat_id']);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $myProduct->actualizar($_POST);
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $myProduct->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $myProduct->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }