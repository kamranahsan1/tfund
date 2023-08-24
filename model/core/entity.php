<?php
class ModelCoreEntity extends Model {
	public function addEntity($data) {
		$this->event->trigger('pre.admin.add.entity', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "entity SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "'");
		$entity_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.entity', $entity_id);

		return $entity_id;
	}

	public function editEntity($entity_id, $data) {
		$this->event->trigger('pre.admin.edit.entity', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "entity SET name = '" . $this->db->escape($data['name']) . "',remarks = '".$data['remarks']."',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "' WHERE entity_id = '" . (int)$entity_id . "'");



		$this->cache->delete('entity');

		$this->event->trigger('post.admin.edit.entity');
	}

	public function deleteEntity($entity_id) {
		$this->event->trigger('pre.admin.delete.entity', $entity_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "entity WHERE entity_id = '" . (int)$entity_id . "'");
		$this->cache->delete('entity');

		$this->event->trigger('post.admin.delete.entity', $entity_id);
	}

	public function getEntity($entity_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "entity WHERE entity_id = '" . (int)$entity_id . "'");

		return $query->row;
	}

	public function getEntities($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "entity";

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

	public function getEntityStores($entity_id) {
		$entity_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "entity_to_store WHERE entity_id = '" . (int)$entity_id . "'");

		foreach ($query->rows as $result) {
			$entity_store_data[] = $result['store_id'];
		}

		return $entity_store_data;
	}

	public function getTotalCompanies() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "entity");

		return $query->row['total'];
	}
}