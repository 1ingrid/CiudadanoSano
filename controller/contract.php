<?php
    require_once '../model/contract.php';
    require_once '../model/type_contract.php';
    require_once '../model/country.php';
    require_once '../model/city.php';
    require_once '../model/seat.php';
    require_once '../model/employe.php';
    require_once '../model/profession.php';
    require_once '../middleware/jwtToken.php';

    $contract = new Contract();
    $typeContract = new TypeContract();
    $country = new Country();
    $city = new City();
    $seat = new Seat();
    $employe = new Employe();
    $profession = new Profession();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'contracts')) {
        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $contract->listar();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarTypesContracts':
                $listado = $typeContract->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCountries':
                $listado = $country->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarCities':
                $listado = $city->listarxCountry($_GET['country_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarHeadquarters':
                $listado = $seat->listarxCity($_GET['city_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarEmployees':
                $listado = $employe->listarxSeat($_GET['seat_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'listarProfessions':
                $listado = $profession->listarxStatus();
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'registro':
                $resultado = $contract->nuevo($_POST);
                echo json_encode($resultado);
            break;
            case 'modificar':
                $resultado = $contract->actualizar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'desactivar':
                $resultado = $contract->desactivar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'activar':
                $resultado = $contract->activar(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }