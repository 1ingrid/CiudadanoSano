<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    require_once ("../vendor/autoload.php");

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class Billing extends ModeloAbstractoDB {

        public function listar() {}

        public function nuevo($datos) {}

        public function nuevoInvoice($datos, $employe_id, $seat_id) {
            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $dompdf = new Dompdf($options);
            $this->query = '
                INSERT INTO invoices 
                (client_id, employe_id, iva, total, neto) 
                VALUES('.$datos['client_id'].','.$employe_id.','.$datos['iva'].','.$datos['total'].','.$datos['neto'].')';
            $invoice = $this->ejecutar_query_simple();
            if($invoice !== 1) return [ 'code' => 400 ];
            $this->query = 'SELECT MAX(invoices.id) as id, headquarters.name as seat, headquarters.cell_phone, headquarters.address, invoices.created_at, 
            CONCAT(employees.name," ",employees.last_name) as employe, clients.no_document, CONCAT(clients.name," ",clients.last_name) as client, 
            total, iva, neto FROM invoices INNER JOIN employees ON employees.id = invoices.employe_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN clients ON clients.id = invoices.client_id 
            WHERE client_id = '.$datos['client_id'].' AND employe_id = '.$employe_id;
			$this->obtener_resultados_query();
			$invoice = (object) $this->rows[0];
            foreach ($datos['mov'] as $key => $value) {
                $this->query = '
                INSERT INTO mov_invoices 
                (invoice_id, product_id, count, price, total) 
                VALUES('.$invoice->id.','.$value['id'].','.$value['count'].','.$value['price'].','.$value['total'].')';
                $this->ejecutar_query_simple();
                $this->rows = [];
                $this->query = 'SELECT * FROM inventories WHERE stock > 0 AND status = 1 AND product_id = '.$value['id'].' AND seat_id = '.$seat_id;
			    $this->obtener_resultados_query();
                $inventories = $this->rows;
                $count = (int) $value['count'];
                foreach ($inventories as $key => $val) {
                    if($count > 0) {
                        $count -= $val['stock'];
                        if($count >= 0) $stock = 0;
                        else $stock = $count * -1;
                        $this->query = '
                            UPDATE inventories SET 
                            stock = '.$stock.',
                            updated_at = NOW() WHERE id = '.$val['id'];
                        $this->ejecutar_query_simple();
                    }
                }
            }
            $mov = $datos['mov'];
            ob_start();
		        include('../view/invoice.php');
		    $html = ob_get_clean();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return [ 'code' => 200, 'pdf' => base64_encode($dompdf->output()) ];
        }

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

    }