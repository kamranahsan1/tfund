<?php
class ModelCoreProduct extends Model {
	public function addProduct($data) {
	
		$this->event->trigger('pre.admin.add.product', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "product
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		fund_amount = '" . $this->db->escape((double)$data['fund_amount']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		decimal_places = '" . $this->db->escape((int)$data['decimal_places']) . "',
		def_principal = '" . $this->db->escape((double)$data['def_principal']) . "',
		min_principle = '" . $this->db->escape((double)$data['min_principle']) . "',
		max_principle = '" . $this->db->escape((double)$data['max_principle']) . "',
		rep_freq = '" . $this->db->escape((int)$data['rep_freq']) . "',
		def_interest_rate = '" . $this->db->escape((double)$data['def_interest_rate']) . "',
		min_interest_rate = '" . $this->db->escape((double)$data['min_interest_rate']) . "',
		max_interest_rate = '" . $this->db->escape((double)$data['max_interest_rate']) . "',
		duration_type = '" . $this->db->escape((int)$data['duration_type']) . "',
		grace_pamount = '" . $this->db->escape((double)$data['grace_pamount']) . "',
		grace_interest_amount = '" . $this->db->escape((double)$data['grace_interest_amount']) . "',
		grace_interest_charges = '" . $this->db->escape((double)$data['grace_interest_charges']) . "',
		interest_method_id = '" . $this->db->escape((int)$data['interest_method_id']) . "',
		amort_method_id = '" . $this->db->escape((int)$data['amort_method_id']) . "',
		loan_processing_id = '" . $this->db->escape((int)$data['loan_processing_id']) . "',
		charges = '" . $this->db->escape((double)$data['charges']) . "',
		credit_check = '" . $this->db->escape((int)$data['credit_check']) . "',
		accounting_rule_id = '" . $this->db->escape((int)$data['accounting_rule_id']) . "',
		fund_source = '" . $this->db->escape((double)$data['fund_source']) . "',
		loan_portfolio = '" . $this->db->escape((double)$data['loan_portfolio']) . "',
		overpayment = '" . $this->db->escape((double)$data['overpayment']) . "',
		susp_income = '" . $this->db->escape((double)$data['susp_income']) . "',
		income_from_interest = '" . $this->db->escape((double)$data['income_from_interest']) . "',
		income_from_penalty = '" . $this->db->escape((double)$data['income_from_penalty']) . "',
		income_from_fess = '" . $this->db->escape((double)$data['income_from_fess']) . "',
		income_from_recovery = '" . $this->db->escape((double)$data['income_from_recovery']) . "',
		loss_off = '" . $this->db->escape((double)$data['loss_off']) . "',
		interest_off = '" . $this->db->escape((double)$data['interest_off']) . "',
		auto_disburse = '" . $this->db->escape((double)$data['auto_disburse']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 added_date = now()";

		$this->db->query($sql);
		$product_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.product', $product_id);

		return $product_id;
	}

	public function editProduct($product_id, $data) {
		$this->event->trigger('pre.admin.edit.product', $data);
        $sql =  "Update  " . DB_PREFIX . "product
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		fund_amount = '" . $this->db->escape((double)$data['fund_amount']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		decimal_places = '" . $this->db->escape((int)$data['decimal_places']) . "',
		def_principal = '" . $this->db->escape((double)$data['def_principal']) . "',
		min_principle = '" . $this->db->escape((double)$data['min_principle']) . "',
		max_principle = '" . $this->db->escape((double)$data['max_principle']) . "',
		rep_freq = '" . $this->db->escape((int)$data['rep_freq']) . "',
		def_interest_rate = '" . $this->db->escape((double)$data['def_interest_rate']) . "',
		min_interest_rate = '" . $this->db->escape((double)$data['min_interest_rate']) . "',
		max_interest_rate = '" . $this->db->escape((double)$data['max_interest_rate']) . "',
		duration_type = '" . $this->db->escape((int)$data['duration_type']) . "',
		grace_pamount = '" . $this->db->escape((double)$data['grace_pamount']) . "',
		grace_interest_amount = '" . $this->db->escape((double)$data['grace_interest_amount']) . "',
		grace_interest_charges = '" . $this->db->escape((double)$data['grace_interest_charges']) . "',
		interest_method_id = '" . $this->db->escape((int)$data['interest_method_id']) . "',
		amort_method_id = '" . $this->db->escape((int)$data['amort_method_id']) . "',
		loan_processing_id = '" . $this->db->escape((int)$data['loan_processing_id']) . "',
		charges = '" . $this->db->escape((double)$data['charges']) . "',
		credit_check = '" . $this->db->escape((int)$data['credit_check']) . "',
		accounting_rule_id = '" . $this->db->escape((int)$data['accounting_rule_id']) . "',
		fund_source = '" . $this->db->escape((double)$data['fund_source']) . "',
		loan_portfolio = '" . $this->db->escape((double)$data['loan_portfolio']) . "',
		overpayment = '" . $this->db->escape((double)$data['overpayment']) . "',
		susp_income = '" . $this->db->escape((double)$data['susp_income']) . "',
		income_from_interest = '" . $this->db->escape((double)$data['income_from_interest']) . "',
		income_from_penalty = '" . $this->db->escape((double)$data['income_from_penalty']) . "',
		income_from_fess = '" . $this->db->escape((double)$data['income_from_fess']) . "',
		income_from_recovery = '" . $this->db->escape((double)$data['income_from_recovery']) . "',
		loss_off = '" . $this->db->escape((double)$data['loss_off']) . "',
		interest_off = '" . $this->db->escape((double)$data['interest_off']) . "',
		auto_disburse = '" . $this->db->escape((double)$data['auto_disburse']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		status = '".$data['status']."' ,
		 added_date = now()
		  where  id = '" . (int)$product_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('product');

		$this->event->trigger('post.admin.edit.product');
	}

	public function deleteProduct($id) {
		$this->event->trigger('pre.admin.delete.product', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE id = '" . (int)$id . "'");
		$this->cache->delete('product');

		$this->event->trigger('post.admin.delete.product', $id);
	}

	public function getProduct($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getProducts($data = array()) {
		$sql = "SELECT p.*,d.name duration_name FROM " . DB_PREFIX . "product p INNER JOIN duration_types d ON p.duration_type=d.id WHERE 1= 1  ";

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

	public function getTotalProducts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product ");

		return $query->row['total'];
	}
	public function getDurations() {
		$sql="SELECT * FROM duration_types where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	
	
	
	
	public function getAmortizations() {
		$sql="SELECT * FROM amortization_method where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	public function getLoan_processing_strategys() {
		$sql="SELECT * FROM loan_processing_strategy where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	public function getAccounting_rules() {
		$sql="SELECT * FROM accounting_rule where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	public function getInterest_methods() {
		$sql="SELECT * FROM interest_method where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	public function getCurrencys() {
		$sql="SELECT * FROM currency where status=1 ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	
	
}