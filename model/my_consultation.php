<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    require_once ("../vendor/autoload.php");

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class MyConsultation extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyConsultations($employe_id) {
            $this->query = 'SELECT consultations.id, CONCAT(clients.name," ",clients.last_name) as client, no_document, client_id, employe_id, reason, 
            detail, formula, consultations.status, consultations.created_at, consultations.updated_at 
            FROM consultations INNER JOIN clients ON clients.id = consultations.client_id WHERE employe_id = '.$employe_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function printFormula($id) {
            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $dompdf = new Dompdf($options);
            $this->query = 'SELECT formula, CONCAT(clients.name," ",clients.last_name) as client, CONCAT(employees.name," ",employees.last_name) as employe, 
            clients.no_document, headquarters.name as seat FROM consultations INNER JOIN clients ON clients.id = consultations.client_id 
            INNER JOIN employees ON employees.id = consultations.employe_id INNER JOIN headquarters ON headquarters.id = employees.seat_id 
            WHERE consultations.id = '.$id;
			$this->obtener_resultados_query();
			$result = $this->rows[0];
            $html = file_get_contents('../view/formula.php');
            $formula = str_replace(array("\r\n", "\n\r", "\r", "\n"), '<br><br>', $result['formula']);
            $html = str_replace('$formula', $formula, $html);
            $html = str_replace('$client', $result['client'], $html);
            $html = str_replace('$no_document', $result['no_document'], $html);
            $html = str_replace('$employe', $result['employe'], $html);
            $html = str_replace('$seat', $result['seat'], $html);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return $dompdf->output();
        }

        public function nuevoMyConsultation($datos, $employe_id) {
            $this->query = '
                INSERT INTO consultations 
                (client_id, employe_id, reason, detail, formula) 
                VALUES('.$datos['client_id'].','.$employe_id.',"'.utf8_decode($datos['reason']).'","'.utf8_decode($datos['detail']).'" 
                ,"'.utf8_decode($datos['formula']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE consultations SET 
                client_id = "'.$put->client_id.'",
                reason = "'.utf8_decode($put->reason).'",
                detail = "'.utf8_decode($put->detail).'",
                formula = "'.utf8_decode($put->formula).'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {}

        public function activar($id) {}

    }