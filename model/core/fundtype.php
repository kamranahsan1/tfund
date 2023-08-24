<?php
class ModelCoreFundtype extends Model {
	public function addFundtype($data) {
		$this->event->trigger('pre.admin.add.fund_types', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "fund_types
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		duration = '" . $this->db->escape((int)$data['duration']) . "',
		duration_type = '" . $this->db->escape((int)$data['duration_type']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "',
		 date_added = now()";

		$this->db->query($sql);
		$loan_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.fund_types', $loan_id);

		return $loan_id;
	}

	public function editFundtype($loan_id, $data) {
		$this->event->trigger('pre.admin.edit.fund_types', $data);
        $sql =  "Update  " . DB_PREFIX . "fund_types
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		duration = '" . $this->db->escape($data['duration']) . "',
		duration_type = '" . $this->db->escape($data['duration_type']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "' where  id = '" . (int)$loan_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('fund_types');

		$this->event->trigger('post.admin.edit.fund_types');
	}

	public function deleteFundtype($id) {
		$this->event->trigger('pre.admin.delete.fund_types', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "fund_types WHERE id = '" . (int)$id . "'");
		$this->cache->delete('fund_types');

		$this->event->trigger('post.admin.delete.fund_types', $id);
	}

	public function getFundtype($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fund_types WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getFundtypes($data = array()) {
		$sql = "SELECT f.*,d.name duration_type_name FROM " . DB_PREFIX . "fund_types f INNER JOIN  duration_types d on f.duration_type=d.id WHERE 1= 1  ";

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
			'duration',
			'duration_type',
			'sort_order'
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

	public function getTotalFundtypes() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fund_types ");

		return $query->row['total'];
	}
}