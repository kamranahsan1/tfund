<?php
	class ModelCoreInvestor extends Model {
		public function addInvestor($data) {
			$this->event->trigger('pre.admin.add.investor', $data);
			
			$sql="INSERT INTO " . DB_PREFIX . "investor SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',country_id = '" . $this->db->escape($data['country_id']) . "',region_id = '" . $this->db->escape($data['region_id']) . "',entity_id = '" . $this->db->escape($data['entity_id']) . "',nature_id = '" . $this->db->escape($data['nature_id']) . "',bank_id = '" . $this->db->escape($data['bank_id']) . "',bank_account = '" . $this->db->escape($data['bank_account']) . "',bank_address = '" . $this->db->escape($data['bank_address']) . "',capital_amount = '" . $this->db->escape($data['capital_amount']) . "',added_date=NOW(), status = '".$data['status']."' , remarks = '" . $data['remarks'] . "'";

			$this->db->query($sql);
			$investor_id = $this->db->getLastId();
			$this->event->trigger('post.admin.add.investor', $investor_id);
			
			return $investor_id;
		}
		
		public function editInvestor($investor_id, $data) {
			$this->event->trigger('pre.admin.edit.investor', $data);
			
			$this->db->query("UPDATE  " . DB_PREFIX . "investor SET name = '" . $this->db->escape($data['name']) . "',sname = '" . $this->db->escape($data['sname']) . "',address = '" . $this->db->escape($data['address']) . "',email = '" . $this->db->escape($data['email']) . "',phone = '" . $this->db->escape($data['phone']) . "',country_id = '" . $this->db->escape($data['country_id']) . "',region_id = '" . $this->db->escape($data['region_id']) . "',entity_id = '" . $this->db->escape($data['entity_id']) . "',nature_id = '" . $this->db->escape($data['nature_id']) . "',bank_id = '" . $this->db->escape($data['bank_id']) . "',bank_account = '" . $this->db->escape($data['bank_account']) . "',bank_address = '" . $this->db->escape($data['bank_address']) . "',capital_amount = '" . $this->db->escape($data['capital_amount']) . "', status = '".$data['status']."' , remarks = '" . $data['remarks'] . "' WHERE investor_id = '" . (int)$investor_id . "'");

			$this->cache->delete('investor');
			
			$this->event->trigger('post.admin.edit.investor');
		}
		
		public function deleteInvestor($investor_id) {
			$this->event->trigger('pre.admin.delete.investor', $investor_id);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "investor WHERE investor_id = '" . (int)$investor_id . "'");
			$this->cache->delete('investor');
			
			$this->event->trigger('post.admin.delete.investor', $investor_id);
		}
		
		public function getInvestor($investor_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "investor WHERE investor_id = '" . (int)$investor_id . "'");
			
			return $query->row;
		}
		
		public function getInvestors($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "investor ";
			
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
		

		
		public function getTotalInvestors() {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM investor" . DB_PREFIX . "");
			
			return $query->row['total'];
		}
	}