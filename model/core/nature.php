<?php
class ModelCoreNature extends Model {
	public function addNature($data) {
		$this->event->trigger('pre.admin.add.nature', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "nature SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "'");
		$nature_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.nature', $nature_id);

		return $nature_id;
	}

	public function editNature($nature_id, $data) {
		$this->event->trigger('pre.admin.edit.nature', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "nature SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "' WHERE nature_id = '" . (int)$nature_id . "'");



		$this->cache->delete('nature');

		$this->event->trigger('post.admin.edit.nature');
	}

	public function deleteNature($nature_id) {
		$this->event->trigger('pre.admin.delete.nature', $nature_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "nature WHERE nature_id = '" . (int)$nature_id . "'");
		$this->cache->delete('nature');

		$this->event->trigger('post.admin.delete.nature', $nature_id);
	}

	public function getNature($nature_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nature WHERE nature_id = '" . (int)$nature_id . "'");

		return $query->row;
	}

	public function getNatures($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "nature";

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

	public function getNatureStores($nature_id) {
		$nature_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "nature_to_store WHERE nature_id = '" . (int)$nature_id . "'");

		foreach ($query->rows as $result) {
			$nature_store_data[] = $result['store_id'];
		}

		return $nature_store_data;
	}

	public function getTotalCompanies() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "nature");

		return $query->row['total'];
	}
}