<?php
    require_once ("../helpers/modeloAbstractoDB.php");

    require_once ("../vendor/autoload.php");

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class MyInvoice extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyInvoices($seat_id) {
            $this->query = 'SELECT invoices.id, CONCAT(clients.name," ",clients.last_name) as client, iva, total, neto, 
            CONCAT(employees.name," ",employees.last_name) as employe, invoices.status, invoices.created_at, invoices.updated_at 
            FROM invoices INNER JOIN clients ON clients.id = invoices.client_id INNER JOIN employees ON employees.id = invoices.employe_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id WHERE seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function generateInvoice($invoice_id) {
            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $dompdf = new Dompdf($options);
            $this->query = 'SELECT invoices.id, headquarters.name as seat, headquarters.cell_phone, headquarters.address, invoices.created_at, 
            CONCAT(employees.name," ",employees.last_name) as employe, clients.no_document, CONCAT(clients.name," ",clients.last_name) as client, 
            total, iva, neto FROM invoices INNER JOIN employees ON employees.id = invoices.employe_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN clients ON clients.id = invoices.client_id 
            WHERE invoices.id = '.$invoice_id;
			$this->obtener_resultados_query();
			$invoice = (object) $this->rows[0];
            $this->rows = [];
            $this->query = 'SELECT count, CONCAT(products.name," - ",products.presentation," - ",providers.name) as name, mov_invoices.price, 
            total FROM mov_invoices INNER JOIN products ON products.id = mov_invoices.product_id 
            INNER JOIN providers ON providers.id = products.provider_id WHERE invoice_id = '.$invoice_id;
            $this->obtener_resultados_query();
            $mov = $this->rows;
            ob_start();
		        include('../view/invoice.php');
		    $html = ob_get_clean();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return $dompdf->output();
        }

        public function nuevo($datos) {}

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

        public function anular($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE invoices SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }