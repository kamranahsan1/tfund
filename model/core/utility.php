<?php
	class ModelCoreUtility extends Model {
		public function addUtility($data) {
			$this->event->trigger('pre.admin.add.utility', $data);
			
			$sql="INSERT INTO " . DB_PREFIX . "utility SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',status = '".$data['status']."' , remarks = '" . $data['remarks'] . "', pname = '" . $data['pname'] . "', psname = '" . $data['psname'] . "', pdetail = '" . $data['pdetail'] . "', region_id = '" . $data['region_id'] . "'";
			
			$this->db->query($sql);
			$utility_id = $this->db->getLastId();
			$this->event->trigger('post.admin.add.utility', $utility_id);
			
			return $utility_id;
		}
		
		public function editUtility($utility_id, $data) {
			$this->event->trigger('pre.admin.edit.utility', $data);
			
			$this->db->query("UPDATE " . DB_PREFIX . "utility SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',status = '".$data['status']."' , remarks = '" . $data['remarks'] . "', pname = '" . $data['pname'] . "', psname = '" . $data['psname'] . "', pdetail = '" . $data['pdetail'] . "', region_id = '" . $data['region_id'] . "' WHERE utility_id = '" . (int)$utility_id . "'");
			
			
			
			$this->cache->delete('utility');
			
			$this->event->trigger('post.admin.edit.utility');
		}
		
		public function deleteUtility($utility_id) {
			$this->event->trigger('pre.admin.delete.utility', $utility_id);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "utility WHERE utility_id = '" . (int)$utility_id . "'");
			$this->cache->delete('utility');
			
			$this->event->trigger('post.admin.delete.utility', $utility_id);
		}
		
		public function getUtility($utility_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "utility WHERE utility_id = '" . (int)$utility_id . "'");
			
			return $query->row;
		}
		
		public function getUtilities($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "utility";
			
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
		

		
		public function getTotalUtilities() {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM utility" . DB_PREFIX . "");
			
			return $query->row['total'];
		}
	}