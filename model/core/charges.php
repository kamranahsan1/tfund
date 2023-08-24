<?php
class ModelCoreCharges extends Model {
	public function addCharges($data) {

		$this->event->trigger('pre.admin.add.charges', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "charges
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		charge_type_id = '" . $this->db->escape((int)$data['charge_type_id']) . "',
		charge_amount = '" . $this->db->escape($data['charge_amount']) . "',
		charge_option_id = '" . $this->db->escape((int)$data['charge_option_id']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		penalty = '".$data['penalty']."' ,
		override = '".$data['override']."' ,
		status = '".$data['status']."' ,
		 added_date = now()";

		$this->db->query($sql);
		$loan_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.charges', $loan_id);

		return $loan_id;
	}

	public function editCharges($loan_id, $data) {
		$this->event->trigger('pre.admin.edit.charges', $data);
        $sql =  "Update  " . DB_PREFIX . "charges
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		charge_type_id = '" . $this->db->escape((int)$data['charge_type_id']) . "',
		charge_amount = '" . $this->db->escape($data['charge_amount']) . "',
		charge_option_id = '" . $this->db->escape((int)$data['charge_option_id']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		penalty = '".$data['penalty']."' ,
		override = '".$data['override']."' ,
		status = '".$data['status']."' ,
		 added_date = now() where  id = '" . (int)$loan_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('charges');

		$this->event->trigger('post.admin.edit.charges');
	}

	public function deleteCharges($id) {
		$this->event->trigger('pre.admin.delete.charges', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "charges WHERE id = '" . (int)$id . "'");
		$this->cache->delete('charges');

		$this->event->trigger('post.admin.delete.charges', $id);
	}

	public function getCharge($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "charges WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getCharges($data = array()) {
		$sql="
		SELECT c.*, o.name option_name,t.name type_name
FROM  " . DB_PREFIX . " charges c
INNER JOIN  " . DB_PREFIX . "charges_option o ON c.charge_option_id = o.option_id
INNER JOIN  " . DB_PREFIX . "charges_type t ON c.charge_type_id = t.type_id
WHERE 1=1  ";
		if (!empty($data['filter_name'])) {
			$sql .= " and   f.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
        if ( isset($data['filter_sname']) && !empty($data['filter_sname'])) {
            $sql .= " and  f.sname = '" . $this->db->escape($data['filter_sname']) . "'";
        }
		$sort_data = array(
			'name',
			'sname',
			'status',
			'option_id',
			'charge_type_id'
		);


		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getDurationTypes() {
		$sql = "SELECT * FROM " . DB_PREFIX . "duration_types WHERE status=1 order by name asc ";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getChargesOptions() {
		$sql = "SELECT * FROM " . DB_PREFIX . "charges_option WHERE status=1 order by name asc ";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getChargesTypes() {
		$sql = "SELECT * FROM " . DB_PREFIX . "charges_type WHERE status=1 order by name asc ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}

	public function getTotalCharges() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "charges ");

		return $query->row['total'];
	}
	
	public function getCurrency() {
		$sql = "SELECT * FROM " . DB_PREFIX . "currency WHERE status=1  ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	
	
	
}