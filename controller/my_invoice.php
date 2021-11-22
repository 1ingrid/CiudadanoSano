<?php
    require_once '../model/my_invoice.php';
    require_once '../model/userxemploye.php';
    require_once '../middleware/jwtToken.php';

    $myInvoice = new MyInvoice();
    $userxEmploye = new UserxEmploye();
    $jwt = new JwtToken();

    $token = !empty($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : '';

    if($jwt->verificar($token, 'my_invoices')) {

        $dataUser = $userxEmploye->dataUser($jwt->id)[0];

        switch ($_SERVER['HTTP_ACCION']) {

            case 'listar':
                $listado = $myInvoice->listarMyInvoices($dataUser['seat_id']);
                echo json_encode([ 'data' => $listado ], JSON_UNESCAPED_UNICODE);
            break;
            case 'anular':
                $resultado = $myInvoice->anular(file_get_contents("php://input"));
                echo json_encode($resultado);
            break;
            case 'printInvoice':
                $resultado = $myInvoice->generateInvoice($_GET['invoice_id']);
                echo json_encode([ 'pdf' => base64_encode($resultado) ]);
            break;
            
        }
    } else {
        echo json_encode($jwt->message);
    }