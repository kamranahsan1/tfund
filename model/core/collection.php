<?php
class ModelCoreCollection extends Model {
	public function addCollection($data) {
	
		$this->event->trigger('pre.admin.add.collection', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "loan_collection
		SET request_id = '" . $this->db->escape((int)$data['request_id']) . "',
		amount = '" . $this->db->escape($data['amount']) . "',
		ucode = '" . $this->db->escape($data['ucode']) . "',
		ent_date = '" . $this->db->escape($data['ent_date']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 date_added = now()";

		$this->db->query($sql);
		$collection_id_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.collection', $collection_id_id);

		return $collection_id_id;
	}

	public function editCollection($collection_id_id, $data) {
		$this->event->trigger('pre.admin.edit.loan_collection', $data);
        $sql =  "Update  " . DB_PREFIX . "loan_collection
		SET request_id = '" . $this->db->escape((int)$data['request_id']) . "',
		amount = '" . $this->db->escape($data['amount']) . "',
		ucode = '" . $this->db->escape($data['ucode']) . "',
		ent_date = '" . $this->db->escape($data['ent_date']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 date_added = now()
		  where  id = '" . (int)$collection_id_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('collection');

		$this->event->trigger('post.admin.edit.loan_collection');
	}

	public function deleteCollection($id) {
		$this->event->trigger('pre.admin.delete.loan_collection', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "collection WHERE id = '" . (int)$id . "'");
		$this->cache->delete('collection');

		$this->event->trigger('post.admin.delete.loan_collection', $id);
	}

	public function getCollection($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "loan_collection WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getCollections($data = array()) {
		$sql = "SELECT f.*,d.name request_name FROM " . DB_PREFIX . "loan_collection f INNER JOIN  request d on f.request_id=d.id WHERE 1= 1  ";

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
			'request_id',
			'request_name',
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
	public function getCollectionsDetail($data = array()) {
		$sql = "
SELECT f.*
	,d.name request_name
	,r.name region_name
	,a.name city_name
	,l.date_added loan_approval_date
	,l.pdetail
	,l.fund_amount loan_amount
	,f.amount collected_amount
FROM " . DB_PREFIX . "loan_collection f
INNER JOIN " . DB_PREFIX . "request d ON f.request_id = d.id
INNER JOIN " . DB_PREFIX . "region r ON d.region_id = r.region_id
INNER JOIN " . DB_PREFIX . "area a ON d.area_id = a.area_id
INNER JOIN " . DB_PREFIX . "loan l ON d.loan_id = l.id
  WHERE 1= 1  ";
		
		/*if (!empty($data['filter_fdate']) && !empty($data['filter_tdate'])) {
			$sql .= " and   l.date_added between '" . $this->db->escape($data['filter_fdate']) . "' AND  '" . $this->db->escape($data['filter_tdate']) . "'";
		}*/
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
			'd.name',
			'sname',
			'status',
			'request_id',
			'request_name',
			'sort_order'
		);


		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY d.name";
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

	public function getTotalCollections() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "loan_collection ");

		return $query->row['total'];
	}
}