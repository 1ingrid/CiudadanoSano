<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class MyFormula extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyFormulas($seat_id) {
            $this->query = 'SELECT consultations.id, CONCAT(clients.name," ",clients.last_name) as client, formula_status, consultations.created_at 
            FROM consultations INNER JOIN clients ON clients.id = consultations.client_id INNER JOIN employees ON employees.id = consultations.employe_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id WHERE formula_date > NOW() AND seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function actualizar($datos) {}

        public function desactivar($id) {}

        public function activar($id) {}

        public function alta($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE consultations SET formula_status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }