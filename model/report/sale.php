<?php
class ModelReportSale extends Model {
	public function getTotalProjects($data=array()) {
		 $sql="SELECT COUNT(*) AS total FROM project_d WHERE 1=1";
		if (!empty($data['filter_fund_id'])) {
			$sql .= " AND fund_id = '" . (int)$data['filter_fund_id'] . "'";
		}
		
		if (!empty($data['filter_subfund_id'])) {
			$sql .= " AND subfund_id = '" . $this->db->escape($data['filter_subfund_id']) . "'";
		}
		
		if (!empty($data['filter_obj_id'])) {
			$sql .= " AND obj_id = '" . $this->db->escape($data['filter_obj_id']) . "'";
		}

        if (!empty($data['filter_project_id'])) {
            $sql .= " AND project_id = '" . $this->db->escape($data['filter_project_id']) . "'";
        }
		
		if (!empty($data['filter_fdate']) && !empty($data['filter_tdate'])) {
			$sql .= " AND added_date BETWEEN '" . $this->db->escape($data['filter_fdate']) . "'
			AND '" . $this->db->escape($data['filter_tdate']) . "'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getProjectDetail($data = array()) {
		$sql = "SELECT
     f.fund_id
	,f.name fund_name
	,f.amount fund_amount
	,sf.subfund_id
	,sf.name subfund_name
	,sf.amount subfund_amount
	,o.obj_id
	,o.name obj_name
	,m.name project_name
	,d.fund_amount fund_released_amount
	,d.ftype_amount
	,d.ftype_tax_rate
	,d.ftax_amount
	,d.ftype_total
	,d.stype_amount
	,d.stype_tax_rate
	,d.stax_amount
	,d.stype_total
	,d.total
	,d.added_date
FROM `project` m
INNER JOIN `project_d` d ON m.project_id = d.project_id
INNER JOIN `objects` o ON d.obj_id = o.obj_id
INNER JOIN `funds` f ON d.fund_id = f.fund_id
INNER JOIN `subfunds` sf ON d.subfund_id = sf.subfund_id";

		if (!empty($data['filter_fund_id'])) {
			$sql .= " WHERE f.fund_id = '" . (int)$data['filter_fund_id'] . "'";
		}

		if (!empty($data['filter_subfund_id'])) {
			$sql .= " AND sf.subfund_id = '" . $this->db->escape($data['filter_subfund_id']) . "'";
		}

		if (!empty($data['filter_obj_id'])) {
			$sql .= " AND o.obj_id = '" . $this->db->escape($data['filter_obj_id']) . "'";
		}
		
		if (!empty($data['filter_project_id'])) {
			$sql .= " AND m.project_id = '" . $this->db->escape($data['filter_project_id']) . "'";
		}
		
		if (!empty($data['filter_fdate']) && !empty($data['filter_tdate'])) {
			$sql .= " AND d.added_date BETWEEN '" . $this->db->escape($data['filter_fdate']) . "'
			AND '" . $this->db->escape($data['filter_tdate']) . "'";
		}

		$sql .= " ORDER BY d.added_date DESC";

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
	
	public function getFundsReport($data=array()){
		
		
		$sql = "SELECT
  c.name company_name
 ,p.name project_name
 ,p.status
 ,d.fund_id
 ,d.obj_id
 ,f.name fund_name
 ,o.name obj_name
 ,d.fund_amount
 ,d.ftype_total
 ,d.ftype_amount
 ,d.ftype_tax_rate
 ,d.ftax_amount
 ,d.stype_total
 ,d.stype_amount
 ,d.stype_tax_rate
 ,d.stax_amount
 ,d.total
 ,d.added_date
FROM
  project p
  LEFT JOIN company c ON p.project_id = c.company_id
  LEFT JOIN project_d d ON p.project_id = d.project_id
  LEFT JOIN funds f ON f.fund_id = d.fund_id
  LEFT JOIN objects o  ON d.obj_id = o.obj_id
  LEFT join subfunds s on d.fund_id = s.fund_id
  where 1=1
  ";
		if (!empty($data['filter_fund_id'])) {
			$sql .= " AND f.fund_id = '" . (int)$data['filter_fund_id'] . "'";
		}
		
		if (!empty($data['filter_subfund_id'])) {
			$sql .= " AND d.subfund_id = '" . $this->db->escape($data['filter_subfund_id']) . "'";
		}
		
		if (!empty($data['filter_obj_id'])) {
			$sql .= " AND o.obj_id = '" . $this->db->escape($data['filter_obj_id']) . "'";
		}
		
		if (!empty($data['filter_project_id'])) {
			$sql .= " AND p.project_id = '" . $this->db->escape($data['filter_project_id']) . "'";
		}
		
		/*if (!empty($data['filter_fdate']) && !empty($data['filter_tdate'])) {
			$sql .= " AND d.added_date BETWEEN '" . $this->db->escape($data['filter_fdate']) . "'
			AND '" . $this->db->escape($data['filter_tdate']) . "'";
		}*/
		$sql .= " ORDER BY d.added_date DESC";
	
		return $rows = $this->db->query($sql)->rows;
	}
	
}

