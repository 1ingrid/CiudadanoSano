<?php
    require_once ("../helpers/modeloAbstractoDB.php");
    class MyQuote extends ModeloAbstractoDB {

        public function listar() {}

        public function listarMyQuotes($client_id) {
			$this->query = 'SELECT quotes.id, CONCAT(employees.name," ",employees.last_name) as employe, professions.name as profession, 
            date, quotes.status, quotes.created_at, quotes.updated_at FROM quotes INNER JOIN employees ON employees.id = quotes.employe_id 
            INNER JOIN contracts ON employees.id = contracts.employe_id INNER JOIN professions ON professions.id = contracts.profession_id 
            WHERE date > NOW() AND client_id = '.$client_id;
			$this->obtener_resultados_query();
			return $this->rows;
		}

        public function consultar($datos, $client_id) {
            $date = new DateTime($datos['date'].' '.$datos['hour']);
            $this->query = 'SELECT quotes.id, CONCAT(employees.name," ",employees.last_name) as employe, professions.name as profession, 
            date, CONCAT(clients.name," ",clients.last_name) as client, clients.email, headquarters.name as seat, headquarters.address, 
            headquarters.cell_phone FROM quotes INNER JOIN employees ON employees.id = quotes.employe_id 
            INNER JOIN contracts ON employees.id = contracts.employe_id INNER JOIN professions ON professions.id = contracts.profession_id 
            INNER JOIN headquarters ON headquarters.id = employees.seat_id INNER JOIN clients ON clients.id = quotes.client_id 
            WHERE client_id = '.$client_id.' AND quotes.employe_id = '.$datos['employe_id'].' AND date = "'.$date->format('Y-m-d H:i:s').'"';
			$this->obtener_resultados_query();
			return $this->rows;
        }

        public function verifyHour($date, $hour, $doctor) {
            $dateTime = new DateTime($date.' '.$hour.':00');
            $this->query = 'SELECT * FROM quotes WHERE date = "'.$dateTime->format('Y-m-d H:i:s').'" AND employe_id = '.$doctor;
			$this->obtener_resultados_query();
            if(empty($this->rows)) return [ 'available' => 0 ];
            $hourM = 8;
            $hourN = 8;
            $min = 0;
            $hoursAvailables = [];
            for ($i = 0; $i < 25; $i++) {
                $this->rows = [];
                $dateTime = new DateTime($date.' '.($hourM >= 10 ? $hourM : '0'.$hourM).':'.($min == 0 ? '00' : $min));
                $this->query = 'SELECT * FROM quotes WHERE date = "'.$dateTime->format('Y-m-d H:i:s').'" AND employe_id = '.$doctor;
                $this->obtener_resultados_query();
                if(empty($this->rows) || (!empty($this->rows) && $this->rows[0]['status'] == 2)) {
                    $value = $hourM.':'.($min == 0 ? '00' : $min);
                    if($hourN >= 8 && $hourN < 12) $index = ($hourN < 10 ? '0'.$hourN : $hourN).':'.($min == 0 ? '00' : $min).' a.m.';
                    else $index = ($hourN < 10 ? '0'.$hourN : $hourN).':'.($min == 0 ? '00' : $min).' p.m.';
                    array_push($hoursAvailables, [ 'value' => $value, 'index' => $index ]);
                }
                if($min == 40) {
                    $min = 0;
                    if($hourM == 11) {
                        $hourM = 14;
                        $hourN = 2;
                    } else {
                        ++$hourM;
                        ++$hourN;
                    }
                } else {
                    $min += 20;
                }
            }
            return !empty($hoursAvailables) ? [ 'available' => 1, 'hours' => $hoursAvailables ] : [ 'available' => 2];
        }

        public function nuevo($datos) {}

        public function nuevaQuote($datos, $client_id) {
            $date = new DateTime($datos['date'].' '.$datos['hour']);
            $this->query = '
                INSERT INTO quotes 
                (client_id, employe_id, date) 
                VALUES('.$client_id.','.$datos['employe_id'].',"'.$date->format('Y-m-d H:i:s').'")';
            return $this->ejecutar_query_simple();
        }

        public function actualizar($datos) {}

        public function cancel($id) {
            $delete = explode('=', $id);
            $this->query = 'UPDATE quotes SET status = "2" WHERE id = '.$delete[1];
            return $this->ejecutar_query_simple();
        }

        public function desactivar($id) {}

        public function activar($id) {}
    }