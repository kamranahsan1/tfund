<?php
class ModelCoreRequest extends Model {
	public function addRequest($data) {

		$this->event->trigger('pre.admin.add.request', $data);
$sql =  "INSERT INTO " . DB_PREFIX . "request
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		fdate = '" . $this->db->escape($data['fdate']) . "',
		tdate = '" . $this->db->escape($data['tdate']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		country_id = '" . $this->db->escape((int)$data['country_id']) . "',
		region_id = '" . $this->db->escape((int)$data['region_id']) . "',
		area_id = '" . $this->db->escape((int)$data['area_id']) . "',
		fund_type_id = '" . $this->db->escape((int)$data['fund_type_id']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		address = '".$data['address']."' ,
		phone = '".$data['phone']."' ,
		email = '".$data['email']."' ,
		amount = '".$this->db->escape((int)$data['amount'])."' ,
		image = '".$this->db->escape($data['image'])."' ,
		doc_status = '".$data['doc_status']."' ,
		assign_to = '".(int)$data['assign_to']."' ,
		loan_id = '".(int)$data['loan_id']."',
		product_id = '".(int)$data['product_id']."',
		status = '".(int)$data['status']."',
		date_added = now()
		 ";

		$this->db->query($sql);
		$request_id = $this->db->getLastId();
		$this->event->trigger('post.admin.add.request', $request_id);

		return $request_id;
	}

	public function editRequest($request_id, $data) {
		$this->event->trigger('pre.admin.edit.request', $data);
		$sql =  "UPDATE " . DB_PREFIX . "request
		SET name = '" . $this->db->escape($data['name']) . "',
		sname = '" . $this->db->escape($data['sname']) . "',
		fdate = '" . $this->db->escape($data['fdate']) . "',
		tdate = '" . $this->db->escape($data['tdate']) . "',
		remarks = '" . $this->db->escape($data['remarks']) . "',
		country_id = '" . $this->db->escape((int)$data['country_id']) . "',
		region_id = '" . $this->db->escape((int)$data['region_id']) . "',
		area_id = '" . $this->db->escape((int)$data['area_id']) . "',
		fund_type_id = '" . $this->db->escape((int)$data['fund_type_id']) . "',
		currency_id = '" . $this->db->escape((int)$data['currency_id']) . "',
		address = '".$data['address']."' ,
		phone = '".$data['phone']."' ,
		email = '".$data['email']."' ,
		amount = '".$this->db->escape((int)$data['amount'])."' ,
		image = '".$this->db->escape($data['image'])."' ,
		doc_status = '".$data['doc_status']."' ,
		assign_to = '".(int)$data['assign_to']."' ,
		loan_id = '".(int)$data['loan_id']."',
		product_id = '".(int)$data['product_id']."',
		status = '".(int)$data['status']."'
		 where  id = '" . (int)$request_id . "' ";

        $this->db->query($sql);



		$this->cache->delete('request');

		$this->event->trigger('post.admin.edit.request');
	}

	public function deleteRequest($id) {
		$this->event->trigger('pre.admin.delete.request', $id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "request WHERE id = '" . (int)$id . "'");
		$this->cache->delete('request');

		$this->event->trigger('post.admin.delete.request', $id);
	}

	public function getRequest($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "request WHERE id = '" . (int)$id . "'");

		return $query->row;
	}

	public function getRequests($data = array()) {
		$sql = "SELECT r.* ,u.firstname,u.lastname, t.name fund_type_name FROM  " . DB_PREFIX . "request r inner join user u on r.assign_to=u.user_id inner join fund_types t on r.fund_type_id=t.id WHERE 1= 1  ";

		if (!empty($data['filter_name'])) {
			$sql .= " and   r.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
        if ( isset($data['filter_sname']) && !empty($data['filter_sname'])) {
            $sql .= " and  r.sname = '" . $this->db->escape($data['filter_sname']) . "'";
        }
		$sort_data = array(
			'name',
			'sname',
			'status',
			'fdate',
			'tdate',
			'date_added',
			'assign_to'
		);


		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.name";
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

	public function getTotalRequests() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "request ");

		return $query->row['total'];
	}

    public function getFunds() {
	    $sql="SELECT id,name,sname FROM  fund_types WHERE STATUS = 1 order by sort_order";
        $query = $this->db->query($sql);

        return $query->rows;
    }
    public function getCountries() {
        $sql="SELECT country_id id,name,sname FROM  country WHERE STATUS = 1 order by sort_order";
        $query = $this->db->query($sql);

        return $query->rows;
    }
    public function getCurrencies() {
        $sql="SELECT currency_id id,title name,code sname FROM  currency WHERE STATUS = 1 order by title";
        $query = $this->db->query($sql);

        return $query->rows;
    }



    public function getAreas() {
        $sql="SELECT area_id id, name, sname FROM  area WHERE STATUS = 1 order by sort_order";
        $query = $this->db->query($sql);

        return $query->rows;
    }
	
	public function getUsers() {
		$sql="SELECT firstname , lastname , user_id FROM user WHERE STATUS = 1 order by firstname asc, lastname asc ";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
}