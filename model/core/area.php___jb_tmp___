<?php
	class ModelCoreArea extends Model {
		public function addArea($data) {
			$this->event->trigger('pre.admin.add.area', $data);
			
			$sql="INSERT INTO " . DB_PREFIX . "area SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "'";
			
			$this->db->query($sql);
			$area_id = $this->db->getLastId();
			$this->event->trigger('post.admin.add.area', $area_id);
			
			return $area_id;
		}
		
		public function editArea($area_id, $data) {
			$this->event->trigger('pre.admin.edit.area', $data);
			
			$this->db->query("UPDATE " . DB_PREFIX . "area SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',status = '".$data['status']."' , sort_order = '" . (int)$data['sort_order'] . "' WHERE area_id = '" . (int)$area_id . "'");
			
			
			
			$this->cache->delete('area');
			
			$this->event->trigger('post.admin.edit.area');
		}
		
		public function deleteArea($area_id) {
			$this->event->trigger('pre.admin.delete.area', $area_id);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "area WHERE area_id = '" . (int)$area_id . "'");
			$this->cache->delete('area');
			
			$this->event->trigger('post.admin.delete.area', $area_id);
		}
		
		public function getArea($area_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "area WHERE area_id = '" . (int)$area_id . "'");
			
			return $query->row;
		}
		
		public function getAreas($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "area";
			
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
		

		
		public function getTotalAreas() {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM area" . DB_PREFIX . "");
			
			return $query->row['total'];
		}
	}