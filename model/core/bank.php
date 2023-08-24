<?php
class ModelCoreBank extends Model {
	public function addBank($data) {
		$this->event->trigger('pre.admin.add.bank', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "bank SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "'");
		$bank_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.bank', $bank_id);

		return $bank_id;
	}

	public function editBank($bank_id, $data) {
		$this->event->trigger('pre.admin.edit.bank', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "bank SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "' WHERE bank_id = '" . (int)$bank_id . "'");



		$this->cache->delete('bank');

		$this->event->trigger('post.admin.edit.bank');
	}

	public function deleteBank($bank_id) {
		$this->event->trigger('pre.admin.delete.bank', $bank_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "bank WHERE bank_id = '" . (int)$bank_id . "'");
		$this->cache->delete('bank');

		$this->event->trigger('post.admin.delete.bank', $bank_id);
	}

	public function getBank($bank_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bank WHERE bank_id = '" . (int)$bank_id . "'");

		return $query->row;
	}

	public function getBanks($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "bank";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'name',
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

	public function getBankStores($bank_id) {
		$bank_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bank_to_store WHERE bank_id = '" . (int)$bank_id . "'");

		foreach ($query->rows as $result) {
			$bank_store_data[] = $result['store_id'];
		}

		return $bank_store_data;
	}

	public function getTotalCompanies() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "bank");

		return $query->row['total'];
	}
}