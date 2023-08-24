<?php
class ModelRentCompany extends Model {
	public function addCompany($data) {
		$this->event->trigger('pre.admin.add.company', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "company
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "',
		 date_added = now()";
		$this->db->query($sql);
		$loan_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.company', $loan_id);

		return $loan_id;
	}

	public function editCompany($loan_id, $data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
		$this->event->trigger('pre.admin.edit.company', $data);
        $sql =  "Update  " . DB_PREFIX . "company
		SET 
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		rent_per = '".$data['rent_per']."' where  company_id = 1 ";

echo $sql; exit;
        $this->db->query($sql);



		$this->cache->delete('company');

		$this->event->trigger('post.admin.edit.company');
	}

	public function deleteCompany($id) {
		$this->event->trigger('pre.admin.delete.company', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "company WHERE company_id = '" . (int)$id . "'");
		$this->cache->delete('company');

		$this->event->trigger('post.admin.delete.company', $id);
	}

	public function getCompany($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE company_id = '" . (int)$id . "'");

		return $query->row;
	}
	public function getCompanys($data=array()) {
        $sql="SELECT * FROM " . DB_PREFIX . "company  ";
        $query = $this->db->query($sql);

        return $query->row;
	}


	public function getTotalCompanys() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company ");

		return $query->row['total'];
	}
}