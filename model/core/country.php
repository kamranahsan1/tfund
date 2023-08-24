<?php
	class ModelCoreCountry extends Model {
		public function addCountry($data) {
			$this->event->trigger('pre.admin.add.country', $data);
			
			$sql="INSERT INTO " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "'";
			
			$this->db->query($sql);
			$country_id = $this->db->getLastId();
			$this->event->trigger('post.admin.add.country', $country_id);
			
			return $country_id;
		}
		
		public function editCountry($country_id, $data) {
			$this->event->trigger('pre.admin.edit.country', $data);
			
			$this->db->query("UPDATE " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "' WHERE country_id = '" . (int)$country_id . "'");
			
			
			
			$this->cache->delete('country');
			
			$this->event->trigger('post.admin.edit.country');
		}
		
		public function deleteCountry($country_id) {
			$this->event->trigger('pre.admin.delete.country', $country_id);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");
			$this->cache->delete('country');
			
			$this->event->trigger('post.admin.delete.country', $country_id);
		}
		
		public function getCountry($country_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");
			
			return $query->row;
		}
		
		public function getCountries($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "country";
			
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
		

		
		public function getTotalCountries() {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM country" . DB_PREFIX . "");
			
			return $query->row['total'];
		}
	}