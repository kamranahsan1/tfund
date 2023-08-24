<?php
	
	class ControllerCoreLoan extends Controller
	{
		private $error = array();
		
		public function index()
		{
			$this->load->language('core/loan');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/loan');
			
			$this->getList();
		}
		
		
		public function add()
		{
			$this->load->language('core/loan');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/loan');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_loan->addLoan($this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit()
		{
			$this->load->language('core/loan');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/loan');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_loan->editLoan($this->request->get['id'], $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete()
		{
			$this->load->language('core/loan');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/loan');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $loan_id) {
					$this->model_core_loan->deleteLoan($loan_id);
				}
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getList();
		}
		
		protected function getList()
		{
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'name';
			}
			
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
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
				'href' => $this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/loan/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/loan/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['loans'] = array();
			
			$filter_data = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$loan_total = $this->model_core_loan->getTotalLoans();
			
			$results = $this->model_core_loan->getLoans($filter_data);
			
			$data['loans'] = array();
			foreach ($results as $result) {
			
				$data['loans'][] = array(
					'loan_id' => $result['id'],
					'name' => $result['name'],
					'sname' => $result['sname'],
					'fmonth' => $result['fmonth'],
					'tmonth' => $result['tmonth'],
					'remarks' => $result['remarks'],
					'date_added' => date_format(date_create($result['date_added']),'d-m-Y'),
					'status' => $result['status'],
					'sort_order' => $result['sort_order'],
					'edit' => $this->url->link('core/loan/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_name'] = $this->language->get('column_name');
			$data['column_sname'] = $this->language->get('column_sname');
			$data['column_fmonth'] = $this->language->get('column_fmonth');
			$data['column_tmonth'] = $this->language->get('column_tmonth');
			$data['column_sort_order'] = $this->language->get('column_sort_order');
			$data['column_action'] = $this->language->get('column_action');
			$data['column_status'] = $this->language->get('column_status');
			$data['column_date_added'] = $this->language->get('column_date_added');
			
			$data['button_insert'] = $this->language->get('button_insert');
			$data['button_edit'] = $this->language->get('button_edit');
			$data['button_delete'] = $this->language->get('button_delete');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
			} else {
				$data['error_warning'] = '';
			}
			
			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				
				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}
			
			if (isset($this->request->post['selected'])) {
				$data['selected'] = (array)$this->request->post['selected'];
			} else {
				$data['selected'] = array();
			}
			
			$url = '';
			
			if ($order == 'ASC') {
				$url .= '&order=DESC';
			} else {
				$url .= '&order=ASC';
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$data['sort_status'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_name'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_fmonth'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=fmonth' . $url, 'SSL');
			$data['sort_tmonth'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=tmonth' . $url, 'SSL');
			$data['sort_sort_order'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $loan_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($loan_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($loan_total - $this->config->get('config_limit_admin'))) ? $loan_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $loan_total, ceil($loan_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/loan_list.tpl', $data));
		}
		
		protected function getForm()
		{
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_tmonth'] = $this->language->get('text_tmonth');
			$data['text_fmonth'] = $this->language->get('text_fmonth');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['sentry_name'] = $this->language->get('sentry_name');
			$data['entry_fmonth'] = $this->language->get('entry_fmonth');
			$data['entry_tmonth'] = $this->language->get('entry_tmonth');
			$data['entry_pdetail'] = $this->language->get('entry_pdetail');
			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_keyword'] = $this->language->get('entry_keyword');
			$data['entry_image'] = $this->language->get('entry_image');
			$data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$data['entry_customer_group'] = $this->language->get('entry_customer_group');
			$data['entry_remarks'] = 'Remarks';
			
			$data['help_keyword'] = $this->language->get('help_keyword');
			
			$data['button_save'] = $this->language->get('button_save');
			$data['button_cancel'] = $this->language->get('button_cancel');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
			} else {
				$data['error_warning'] = '';
			}
			
			/*if (isset($this->error['name'])) {
				$data['error_name'] = $this->error['name'];
			} else {
				$data['error_name'] = '';
			}*/
			
			/*if (isset($this->error['sname'])) {
				$data['error_sname'] = $this->error['sname'];
			} else {
				$data['error_sname'] = '';
			}*/
			if (isset($this->error['project'])) {
				$data['error_project'] = $this->error['project'];
			} else {
				$data['error_project'] = '';
			}
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
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
				'href' => $this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['id'])) {
				$data['action'] = $this->url->link('core/loan/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/loan/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/loan', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$loan_info = $this->model_core_loan->getLoan($this->request->get['id']);
			}
			
			
			$data['token'] = $this->session->data['token'];
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($loan_info)) {
				$data['name'] = $loan_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['sname'])) {
				$data['sname'] = $this->request->post['sname'];
			} elseif (!empty($loan_info)) {
				$data['sname'] = $loan_info['sname'];
			} else {
				$data['sname'] = '';
			}
			
			if (isset($this->request->post['fmonth'])) {
				$data['fmonth'] = $this->request->post['fmonth'];
			} elseif (!empty($loan_info)) {
				$data['fmonth'] = $loan_info['fmonth'];
			} else {
				$data['fmonth'] = '';
			}
			if (isset($this->request->post['tmonth'])) {
				$data['tmonth'] = $this->request->post['tmonth'];
			} elseif (!empty($loan_info)) {
				$data['tmonth'] = $loan_info['tmonth'];
			} else {
				$data['tmonth'] = '';
			}
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
			} elseif (!empty($loan_info)) {
				$data['status'] = $loan_info['status'];
			} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['remarks'])) {
				$data['remarks'] = $this->request->post['remarks'];
			} elseif (!empty($loan_info)) {
				$data['remarks'] = $loan_info['remarks'];
			} else {
				$data['remarks'] = '';
			}
			
			if (isset($this->request->post['pdetail'])) {
				$data['pdetail'] = $this->request->post['pdetail'];
			} elseif (!empty($loan_info)) {
				$data['pdetail'] = $loan_info['pdetail'];
			} else {
				$data['pdetail'] = '';
			}if (isset($this->request->post['pamount'])) {
				$data['pamount'] = $this->request->post['pamount'];
			} elseif (!empty($loan_info)) {
				$data['pamount'] = $loan_info['pamount'];
			} else {
				$data['pamount'] = '';
			}if (isset($this->request->post['source_id'])) {
				$data['source_id'] = $this->request->post['source_id'];
			} elseif (!empty($loan_info)) {
				$data['source_id'] = $loan_info['source_id'];
			} else {
				$data['source_id'] = '';
			}if (isset($this->request->post['repayment_freq'])) {
				$data['repayment_freq'] = $this->request->post['repayment_freq'];
			} elseif (!empty($loan_info)) {
				$data['repayment_freq'] = $loan_info['repayment_freq'];
			} else {
				$data['repayment_freq'] = '';
			}if (isset($this->request->post['duration'])) {
				$data['duration'] = $this->request->post['duration'];
			} elseif (!empty($loan_info)) {
				$data['duration'] = $loan_info['duration'];
			} else {
				$data['duration'] = '';
			}if (isset($this->request->post['duration_type_id'])) {
				$data['duration_type_id'] = $this->request->post['duration_type_id'];
			} elseif (!empty($loan_info)) {
				$data['duration_type_id'] = $loan_info['duration_type_id'];
			} else {
				$data['duration_type_id'] = '';
			}if (isset($this->request->post['region_id'])) {
				$data['region_id'] = $this->request->post['region_id'];
			} elseif (!empty($loan_info)) {
				$data['region_id'] = $loan_info['region_id'];
			} else {
				$data['region_id'] = '';
			}if (isset($this->request->post['area_id'])) {
				$data['area_id'] = $this->request->post['area_id'];
			} elseif (!empty($loan_info)) {
				$data['area_id'] = $loan_info['area_id'];
			} else {
				$data['area_id'] = '';
			}
			if (isset($this->request->post['user_id'])) {
				$data['user_id'] = $this->request->post['user_id'];
			} elseif (!empty($loan_info)) {
				$data['user_id'] = $loan_info['user_id'];
			} else {
				$data['user_id'] = '';
			}if (isset($this->request->post['loan_purpose'])) {
				$data['loan_purpose'] = $this->request->post['loan_purpose'];
			} elseif (!empty($loan_info)) {
				$data['loan_purpose'] = $loan_info['loan_purpose'];
			} else {
				$data['loan_purpose'] = '';
			}if (isset($this->request->post['exp_date'])) {
				$data['exp_date'] = $this->request->post['exp_date'];
			} elseif (!empty($loan_info)) {
				$data['exp_date'] = $loan_info['exp_date'];
			} else {
				$data['exp_date'] = '';
			}if (isset($this->request->post['charges'])) {
				$data['charges'] = $this->request->post['charges'];
			} elseif (!empty($loan_info)) {
				$data['charges'] = $loan_info['charges'];
			} else {
				$data['charges'] = '';
			}if (isset($this->request->post['loan_type_id'])) {
				$data['loan_type_id'] = $this->request->post['loan_type_id'];
			} elseif (!empty($loan_info)) {
				$data['loan_type_id'] = $loan_info['loan_type_id'];
			} else {
				$data['loan_type_id'] = '';
			}if (isset($this->request->post['interest_percent'])) {
				$data['interest_percent'] = $this->request->post['interest_percent'];
			} elseif (!empty($loan_info)) {
				$data['interest_percent'] = $loan_info['interest_percent'];
			} else {
				$data['interest_percent'] = '';
			}
			
			$this->load->model('core/region');
			$this->load->model('core/fundtype');
			$this->load->model('core/sources');
			$data['regions'] = $this->model_core_region->getRegions();
			$data['loan_types'] = $this->model_core_fundtype->getFundtypes();
			$data['sources'] = $this->model_core_sources->getSourcess();
			
			$this->load->model('core/area');
			$data['areas'] = $this->model_core_area->getAreas();
			
			$this->load->model('core/loan');
			$data['duration_types'] = $this->model_core_loan->getDurations();
			
			$this->load->model('user/user');
			$data['users'] = $this->model_user_user->getUsers();
		
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/loan_form.tpl', $data));
		}
		
		protected function validateForm()
		{
			/*if (!$this->user->hasPermission('modify', 'core/loan')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
				$this->error['name'] = $this->language->get('error_name');
			}if ((utf8_strlen($this->request->post['sname']) < 2) || (utf8_strlen($this->request->post['sname']) > 64)) {
				$this->error['sname'] = $this->language->get('error_sname');
			}*/
			
			return !$this->error;
		}
		
		protected function validateDelete()
		{
			if (!$this->user->hasPermission('modify', 'core/loan')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			
			return !$this->error;
		}
		
		public function autocomplete()
		{
			$json = array();
			
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('core/loan');
				
				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'filter_sname' => $this->request->get['filter_sname'],
					'start' => 0,
					'limit' => 5
				);
				
				$results = $this->model_core_loan->getLoans($filter_data);
				
				foreach ($results as $result) {
					$json[] = array(
						'id' => $result['id'],
						'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
					);
				}
			}
			
			$sort_order = array();
			
			foreach ($json as $key => $value) {
				$sort_order[$key] = $value['name'];
			}
			
			array_multisort($sort_order, SORT_ASC, $json);
			
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		
		
		
	}