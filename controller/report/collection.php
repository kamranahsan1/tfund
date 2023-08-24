<?php
	class ControllerReportCollection extends Controller {
		public function index() {
			$this->load->language('report/collection');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			if (isset($this->request->get['filter_fdate'])) {
				$filter_fdate = $this->request->get['filter_fdate'];
			} else {
				$filter_fdate = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
			}
			
			if (isset($this->request->get['filter_tdate'])) {
				$filter_tdate = $this->request->get['filter_tdate'];
			} else {
				$filter_tdate = date('Y-m-d');
			}
			
			if (isset($this->request->get['filter_area_id'])) {
				$filter_area_id = $this->request->get['filter_area_id'];
			}else{
				$filter_area_id='';
			}
			
			if (isset($this->request->get['filter_region_id'])) {
				$filter_region_id = $this->request->get['filter_region_id'];
			}else{
				$filter_region_id ='';
			}
			
			if (isset($this->request->get['filter_request_id'])) {
				$filter_request_id = $this->request->get['filter_request_id'];
			}else{
				$filter_request_id ='';
			}
		
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			$url = '';
			
			if (isset($this->request->get['filter_fdate'])) {
				$url .= '&filter_fdate=' . $this->request->get['filter_fdate'];
			}
			
			if (isset($this->request->get['filter_tdate'])) {
				$url .= '&filter_tdate=' . $this->request->get['filter_tdate'];
			}
			
			if (isset($this->request->get['filter_area_id'])) {
				$url .= '&filter_area_id=' . $this->request->get['filter_area_id'];
			}
			
			if (isset($this->request->get['filter_region_id'])) {
				$url .= '&filter_region_id=' . $this->request->get['filter_region_id'];
			}
			if (isset($this->request->get['filter_request_id'])) {
				$url .= '&filter_request_id=' . $this->request->get['filter_request_id'];
			}
			
		
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);
			
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('report/collection', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$this->load->model('core/collection');
			
			$data['collections'] = array();
			
			$filter_data = array(
				'filter_fdate'	     => date_format(date_create($filter_fdate), "d-m-Y"),
				'filter_tdate'	     => date_format(date_create($filter_tdate), "d-m-Y"),
				'filter_area_id'           => $filter_area_id,
				'filter_region_id' => $filter_region_id,
				'filter_request_id' => $filter_request_id,
				'start'                  => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit'                  => $this->config->get('config_limit_admin')
			);
			
			$this->load->model('core/region');
			$this->load->model('core/loan');
			$this->load->model('core/request');
			$this->load->model('core/area');
			$data['regions'] = $this->model_core_region->getRegions();
			$data['areas'] = $this->model_core_area->getAreas();
			$data['loans'] = $this->model_core_loan->getLoans();
			$data['requests'] = $this->model_core_request->getRequests();
			
			$project_total = $this->model_core_collection->getTotalCollections($filter_data);
			if(isset($this->request->post['result'])){
				$result = isset($this->request->post['result']);
			}elseif(!empty($filter_data)) {
				$results = $this->model_core_collection->getCollectionsDetail($filter_data);
			}else{
				$results=array();
			}
			
			if(!$results){
				$project_details =array();
			}
	
			foreach ($results as $result) {
				$data['collections'][] = array(
					'collection_id'                  =>   $result['id'],
					'request_name'                =>   $result['request_name'],
					'region_name'              =>   $result['region_name'],
					'city_name'               =>   $result['city_name'],
					'loan_approval_date'             => date_format(date_create($result['loan_approval_date']), "d-m-Y"),
					'pdetail'           =>   $result['pdetail'],
					'loan_amount'                   =>   $result['loan_amount'],
					'collected_amount'                 =>   $result['collected_amount'],
					'status'                 =>   $result['status'],
					'date_added'               =>   date_format(date_create($result['date_added']), "d-m-Y")
				);
				
				
			}
			
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			$data['text_all_status'] = $this->language->get('text_all_status');
			
			$data['column_status'] = 'Status';
			$data['column_added_date'] = 'Date Added';
			$data['column_request_name'] = 'Request';
			$data['column_region_name'] = 'Region';
			$data['column_city_name'] = 'City';
			$data['column_loan_approval_date'] = 'Loan Approval Date';
			$data['column_pdetail'] = 'Project Detail';
			$data['column_loan_amount'] = 'Loan Amount';
			$data['column_collected_amount'] = 'Collected Amount';
			
			$data['entry_fdate'] = 'From Date';
			$data['entry_tdate'] = 'To Date';
			$data['entry_funds'] = 'Funds';
			$data['entry_subfunds'] = 'Sub Funds';
			$data['entry_objects'] = 'Objects';
			$data['entry_projects'] = 'Projects';
			
			$data['button_filter'] = $this->language->get('button_filter');
			
			$data['token'] = $this->session->data['token'];
			
			
			$url = '';
			
			if (isset($this->request->get['filter_fdate'])) {
				$url .= '&filter_fdate=' . $this->request->get['filter_fdate'];
			}
			
			if (isset($this->request->get['filter_tdate'])) {
				$url .= '&filter_tdate=' . $this->request->get['filter_tdate'];
			}
			if (isset($this->request->get['filter_area_id'])) {
				$url .= '&filter_area_id=' . $this->request->get['filter_area_id'];
			}
			if (isset($this->request->get['filter_region_id'])) {
				$url .= '&filter_region_id=' . $this->request->get['filter_region_id'];
			}
			if (isset($this->request->get['filter_request_id'])) {
				$url .= '&filter_request_id=' . $this->request->get['filter_request_id'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $project_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('report/collection', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($project_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($project_total - $this->config->get('config_limit_admin'))) ? $project_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $project_total, ceil($project_total / $this->config->get('config_limit_admin')));
			
			$data['filter_fdate'] = $filter_fdate;
			$data['filter_tdate'] = $filter_tdate;
			$data['filter_area_id'] = $filter_area_id;
			$data['filter_region_id'] = $filter_region_id;
			$data['filter_request_id'] = $filter_request_id;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view('report/collection.tpl', $data));
		}
		
		public function export(){
			require_once(DIR_SYSTEM . 'library/PHPExcel.php');
			$objPHPExcel = new PHPExcel();
			
			if (isset($this->request->get['filter_fdate'])) {
				$filter_fdate = $this->request->get['filter_fdate'];
			} else {
				$filter_fdate = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
			}
			
			if (isset($this->request->get['filter_tdate'])) {
				$filter_tdate = $this->request->get['filter_tdate'];
			} else {
				$filter_tdate = date('Y-m-d');
			}
			
			if (isset($this->request->get['filter_area_id'])) {
				$filter_area_id = $this->request->get['filter_area_id'];
			}else{
				$filter_area_id='';
			}
			
			if (isset($this->request->get['filter_region_id'])) {
				$filter_region_id = $this->request->get['filter_region_id'];
			}else{
				$filter_region_id ='';
			}
			
			if (isset($this->request->get['filter_request_id'])) {
				$filter_request_id = $this->request->get['filter_request_id'];
			}else{
				$filter_request_id ='';
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			$this->load->model('report/sale');
			
			$filter_brands = array(
				'filter_brand' => '',
				'start'       => 0,
				'limit'       => 30
			);
			$data['products'] = array();
			$filter_data = array(
				'filter_fdate'	     => $filter_fdate,
				'filter_tdate'	     => $filter_tdate,
				'filter_area_id' => $filter_area_id,
				'filter_region_id' => $filter_region_id,
				'filter_request_id' => $filter_request_id,
				/*'start'                  => 0,
				'limit'                  => 250*/
			);
			
			$this->load->model('report/sale');
			$rows = $this->model_report_sale->getFundsReport($filter_data);
			$fundSpendingTotal = array();
			$funds = array();
			foreach ($rows as $row) {
				$funds[$row['fund_id']][] = $row;
			}
			$displayArray = array();
			foreach ($funds as  $key=> $fund) {
				
				$fundName = '';
				$fundtotal = 0;
				
				$ftypeTotal = 0;
				$ftypeTaxTotal = 0;
				$ftypeTaxRateTotal = 0;
				
				
				$stypeTaxRateTotal = 0;
				$stypeTaxTotal = 0;
				$stypeTotal = 0;
				
				$child = array();
				
				$sr_no = 1;
				foreach ($fund as $object) {
					
					$fundName = $object['fund_name'];
					$companyName = $object['company_name'];
					$projectName = $object['project_name'];
					$fundtotal +=  $object['stax_amount'] + $object['stype_amount'] + $object['ftype_amount'] + $object['ftax_amount'];
					
					$narration = $object['obj_name'];
					if($object['stype_amount']){
						$narration .= '<br>';
						$narration .= 'We also have Second type Amount '.number_format($object['stax_amount'] + $object['stype_amount']);
						
					}
					if(!$object['stax_amount']){
						$narration .= '<br>';
						$narration .= '(we also don’t have tax)';
						
					}
					$child[] = array(
						'sr_no' => $sr_no,
						'narration' => $narration,
						'total' => number_format($object['stax_amount'] + $object['stype_amount'] + $object['ftype_amount'] + $object['ftax_amount']),
					
					
					);
					
					$sr_no++;
				}
				$displayArray[] = array(
					'company_name' => $companyName ,
					'project_name' => $projectName,
					'upper_parent' => $fundName . ' Spendings Are ' . number_format($fundtotal) .' USD',
					'total' => number_format($fundtotal),
					'children' => $child
				
				);
				
				
				
			}
			$data['display'] = $displayArray;
		
			$col_titles = array('Sr#','Narration','Amount');
			$row_counter = 2;
			$col_counter = 0;
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle('Project');
			// set image col width
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
			// set cols titles from titles array.
			$objPHPExcel->getActiveSheet()->mergeCells('A1:C1','');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:C2','');
			
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A3',$col_titles[0]);
			$objPHPExcel->getActiveSheet()->SetCellValue('B3',$col_titles[1]);
			$objPHPExcel->getActiveSheet()->SetCellValue('C3',$col_titles[2]);
			foreach ($data['display'] as $result) {
				// Id Col
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_counter, $result['upper_parent']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_counter, $result['total']);
				
				foreach ($result['children'] as $child){
					$objPHPExcel->getActiveSheet()->SetCellValue('A4'.$row_counter, $child['sr_no']);
					$objPHPExcel->getActiveSheet()->SetCellValue('B4'.$row_counter, $child['narration']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C4'.$row_counter, $child['total'] .' USD');
				}
				
				$objPHPExcel->getActiveSheet()->mergeCells('A5:C5'.$row_counter, $result['total'] . ' USD' );
				
			
				
				++$row_counter;
			}
			
			
			// image
			
			
			$filename = 'fundsdetail_' . date('Y-m-d _ H:i:s');
			$filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
			// Create new PHPExcel object
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			//Setting the header type
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition: attachment; filename=\"" . $filename . ".xls\"");
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
		}

	}