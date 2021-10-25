<?php
    require_once ("../helpers/modeloAbstractoDB.php");
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