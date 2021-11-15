<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class MyPayroll extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyPayroll($seat_id) {
            $this->query = 'SELECT payroll.id, employe_id, name, last_name, bank_account, no_account, date, payroll.status, payroll.created_at, 
            payroll.updated_at FROM payroll INNER JOIN employees ON employees.id = payroll.employe_id WHERE seat_id = '.$seat_id;
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function nuevo($datos) {
            $this->query = '
            INSERT INTO payroll 
            (employe_id, bank_account, no_account, date) 
            VALUES('.$datos['employe_id'].',"'.utf8_decode($datos['bank_account']).'","'.utf8_decode($datos['no_account']).'",
            "'.utf8_decode($datos['date']).'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {
            $put = json_decode($datos);
            $this->query = '
                UPDATE payroll SET 
                employe_id = "'.$put->employe_id.'",
                bank_account = "'.utf8_decode($put->bank_account).'",
                no_account = "'.utf8_decode($put->no_account).'",
                date = "'.utf8_decode($put->date).'",
                updated_at = NOW() WHERE id = '.$put->id;
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE payroll SET status = "0" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function activar($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE payroll SET status = "1" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

    }