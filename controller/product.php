<?php
    require_once '../model/product.php';
    require_once '../model/provider.php';
    require_once '../middleware/jwtToken.php';

    $product = new Product();
    $provider = new Provider();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'products')) {

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $product->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarProviders':
                $listado = $provider->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $product->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $product->actualizar($_POST);
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $product->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $product->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }