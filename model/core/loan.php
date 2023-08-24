<?php
class ModelCoreLoan extends Model {
	public function addLoan($data) {
		$this->event->trigger('pre.admin.add.loan', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "loan
		SET
		fmonth = '" . $this->db->escape($data['fmonth']) . "',
		tmonth = '" . $this->db->escape($data['tmonth']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 region_id = '" . (int)$data['region_id'] . "',
		 area_id = '" . (int)$data['area_id'] . "',
		 source_id = '" . (int)$data['source_id'] . "',
		 loan_type_id = '" . (int)$data['loan_type_id'] . "',
		 pamount = '" . (double)$data['pamount'] . "',
		 interest_percent = '" . (double)$data['interest_percent'] . "',
		 duration = '" . (double)$data['duration'] . "',
		 repayment_freq = '" . (int)$data['repayment_freq'] . "',
		 duration_type_id = '" . (int)$data['duration_type'] . "',
		 user_id = '" . (int)$data['user_id'] . "',
		 loan_purpose = '" . $data['loan_purpose'] . "',
		 exp_date = '" . $data['exp_date'] . "',
		 charges = '" . (double)$data['charges'] . "',
		 date_added = now()";

		$this->db->query($sql);
		$loan_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.loan', $loan_id);

		return $loan_id;
	}

	public function editLoan($loan_id, $data) {
		$this->event->trigger('pre.admin.edit.loan', $data);
        $sql =  "Update  " . DB_PREFIX . "loan
		SET
		fmonth = '" . $this->db->escape($data['fmonth']) . "',
		tmonth = '" . $this->db->escape($data['tmonth']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 region_id = '" . (int)$data['region_id'] . "',
		 area_id = '" . (int)$data['area_id'] . "',
		 source_id = '" . (int)$data['source_id'] . "',
		 loan_type_id = '" . (int)$data['loan_type_id'] . "',
		 pamount = '" . (double)$data['pamount'] . "',
		 interest_percent = '" . (double)$data['interest_percent'] . "',
		 duration = '" . (double)$data['duration'] . "',
		 repayment_freq = '" . (int)$data['repayment_freq'] . "',
		 duration_type_id = '" . (int)$data['duration_type'] . "',
		 user_id = '" . (int)$data['user_id'] . "',
		 loan_purpose = '" . $data['loan_purpose'] . "',
		 exp_date = '" . $data['exp_date'] . "',
		 charges = '" . (double)$data['charges'] . "'
		  where  id = '" . (int)$loan_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('loan');

		$this->event->trigger('post.admin.edit.loan');
	}

	public function deleteLoan($id) {
		$this->event->trigger('pre.admin.delete.loan', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "loan WHERE id = '" . (int)$id . "'");
		$this->cache->delete('loan');

		$this->event->trigger('post.admin.delete.loan', $id);
	}

	public function getLoan($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "loan WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getLoans($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "loan WHERE 1= 1  ";

		if (!empty($data['filter_name'])) {
			$sql .= " and   name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
        if ( isset($data['filter_sname']) && !empty($data['filter_sname'])) {
            $sql .= " and  sname = '" . $this->db->escape($data['filter_sname']) . "'";
        }
		$sort_data = array(
			'name',
			'sname',
			'status',
			'fmonth',
			'tmonth',
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
	public function getLoansDetail($data = array()) {
		
		$sql = "SELECT l.*
	,r.name region_name
	,s.name source_name
	,f.name fund_type_name
	,t.name duration_type_name
FROM " . DB_PREFIX . "loan l
LEFT JOIN " . DB_PREFIX . "region r ON l.region_id = r.region_id
LEFT JOIN " . DB_PREFIX . "sources s ON l.source_id = s.id
LEFT JOIN " . DB_PREFIX . "fund_types f ON l.loan_type_id = f.id
LEFT JOIN " . DB_PREFIX . "duration_types t ON l.duration_type_id = t.id ";

		if (!empty($data['filter_fdate']) && !empty($data['filter_tdate'])) {
			$sql .= " and   l.date_added between '" . $this->db->escape($data['filter_fdate']) . "' AND  '" . $this->db->escape($data['filter_tdate']) . "'";
		}
        if ( isset($data['filter_source_id']) && !empty($data['filter_source_id'])) {
            $sql .= " and  l.source_id = '" . $this->db->escape($data['filter_source_id']) . "'";
        }
		if ( isset($data['filter_region_id']) && !empty($data['filter_region_id'])) {
			$sql .= " and  l.region_id = '" . $this->db->escape($data['filter_region_id']) . "'";
		}
		if ( isset($data['filter_type_id']) && !empty($data['filter_type_id'])) {
			$sql .= " and  l.loan_type_id = '" . $this->db->escape($data['filter_type_id']) . "'";
		}
		$sort_data = array(
			'name',
			'sname',
			'status',
			'fmonth',
			'tmonth',
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

	public function getTotalLoans() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "loan ");

		return $query->row['total'];
	}
	public function getDurations() {
		$sql="SELECT * FROM duration_types where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
}