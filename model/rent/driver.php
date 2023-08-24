<?php
class ModelRentDriver extends Model {
	public function addDriver($data) {
		$this->event->trigger('pre.admin.add.driver', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "driver
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
		$this->event->trigger('post.admin.add.driver', $loan_id);

		return $loan_id;
	}

	public function editDriver($loan_id, $data) {
		$this->event->trigger('pre.admin.edit.driver', $data);
        $sql =  "Update  " . DB_PREFIX . "driver
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "' where  driver_id = '" . (int)$loan_id . "' ";


        $this->db->query($sql);



		$this->cache->delete('driver');

		$this->event->trigger('post.admin.edit.driver');
	}

	public function deleteDriver($id) {
		$this->event->trigger('pre.admin.delete.driver', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "driver WHERE driver_id = '" . (int)$id . "'");
		$this->cache->delete('driver');

		$this->event->trigger('post.admin.delete.driver', $id);
	}

	public function getDriver($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "driver WHERE driver_id = '" . (int)$id . "'");

		return $query->row;
	}
	public function getDrivers($data=array()) {
        $sql="SELECT * FROM " . DB_PREFIX . "driver WHERE 1=1 ";

        if (!empty($data['filter_fname'])) {
            $sql .= " and   fname LIKE '" . $this->db->escape($data['filter_fname']) . "%'";
        }if ( isset($data['filter_lname']) && !empty($data['filter_lname'])) {
            $sql .= " and  lname = '" . $this->db->escape($data['filter_lname']) . "'";
        }if ( isset($data['filter_search']) && !empty($data['filter_search'])) {
            $sql .= " and  fname  like '" . $this->db->escape($data['filter_search']) . "%'";
        }
        $sort_data = array(
            'fname',
            'lname',
            'status',
            'email',
            'address',
            'sort_order'
        );


        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY fname";
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


	public function getTotalDrivers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "driver ");

		return $query->row['total'];
	}
}