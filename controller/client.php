<?php
    require_once '../model/client.php';
    require_once '../model/country.php';
    require_once '../model/city.php';
    require_once '../middleware/jwtToken.php';
    require_once '../helpers/tools.php';

    $client = new Client();
    $country = new Country();
    $city = new City();
    $jwt = new JwtToken();
    $tools = new Tools();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'countries')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $client->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCountries':
                $listado = $country->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCities':
                $listado = $city->listarxCountry($_GET['country_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'verificarDocument':
                $result = $client->consultarDocument($_GET['no_document']);
                echo json_encode([ 'exists' => !empty($result) ? true : false ]);
            break;
            case 'registro':
                $resultado = $client->nuevo($_POST);
                if($resultado == 1) {
                    $result = $client->consultarDocument($_POST['no_document']);
                    $form = [
                        'rol_id' => 2,
                        'name' => $_POST['name'],
                        'last_name' => $_POST['last_name'],
                        'email' => $_POST['email'],
                        'password' => substr(md5(uniqid(rand())),0,6)
                    ];
                    $resultado = $tools->createUserCli($form, $result[0]['id']);
                }
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $client->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $client->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $client->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }