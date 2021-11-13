<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    require_once ("../vendor/autoload.php");

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class MyAssignment extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyAssignments($employe_id) {
            $this->query = 'SELECT quotes.id, CONCAT(clients.name," ",clients.last_name) as client, professions.name as profession, 
            date, quotes.status, quotes.created_at, quotes.updated_at FROM quotes INNER JOIN clients ON clients.id = quotes.client_id 
            INNER JOIN employees ON employees.id = quotes.employe_id INNER JOIN contracts ON employees.id = contracts.employe_id 
            INNER JOIN professions ON professions.id = contracts.profession_id WHERE date > NOW() AND quotes.employe_id = '.$employe_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {}

        public function actualizar($datos) {}

        public function change($datos) {
            $put = json_decode($datos);
            $this->query = 'UPDATE quotes SET status = "'.$put->status.'" WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {}

        public function activar($id) {}

    }