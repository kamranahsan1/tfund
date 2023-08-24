<?php
	class ModelCoreRegion extends Model {
		public function addRegion($data) {
			$this->event->trigger('pre.admin.add.region', $data);
			
			$sql="INSERT INTO " . DB_PREFIX . "region SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',status = '".$data['status']."' , remarks = '" . $data['remarks'] . "'";
			
			$this->db->query($sql);
			$region_id = $this->db->getLastId();
			$this->event->trigger('post.admin.add.region', $region_id);
			
			return $region_id;
		}
		
		public function editRegion($region_id, $data) {
			$this->event->trigger('pre.admin.edit.region', $data);
			
			$this->db->query("UPDATE " . DB_PREFIX . "region SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',status = '".$data['status']."' , remarks = '" . $data['remarks'] . "' WHERE region_id = '" . (int)$region_id . "'");
			
			
			
			$this->cache->delete('region');
			
			$this->event->trigger('post.admin.edit.region');
		}
		
		public function deleteRegion($region_id) {
			$this->event->trigger('pre.admin.delete.region', $region_id);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "region WHERE region_id = '" . (int)$region_id . "'");
			$this->cache->delete('region');
			
			$this->event->trigger('post.admin.delete.region', $region_id);
		}
		
		public function getRegion($region_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "region WHERE region_id = '" . (int)$region_id . "'");
			
			return $query->row;
		}
		
		public function getRegions($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "region ";
			
			if (!empty($data['filter_name'])) {
				$sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			$sort_data = array(
				'name'
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
		

		
		public function getTotalRegions() {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM region" . DB_PREFIX . "");
			
			return $query->row['total'];
		}
	}