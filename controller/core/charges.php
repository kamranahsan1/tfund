<?php
	
	class ControllerCoreCharges extends Controller
	{
		private $error = array();
		
		public function index()
		{
			$this->load->language('core/charges');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/charges');
			
			$this->getList();
		}
		
		
		public function add()
		{
			$this->load->language('core/charges');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/charges');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_charges->addCharges($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit()
		{
			$this->load->language('core/charges');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/charges');
			
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_charges->editCharges($this->request->get['id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete()
		{
			$this->load->language('core/charges');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/charges');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $charge_id) {
					$this->model_core_charges->deleteCharges($charge_id);
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
				
				$this->response->redirect($this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
				'href' => $this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/charges/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/charges/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['chargess'] = array();
			
			$filter_data = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$charge_total = $this->model_core_charges->getTotalCharges();
			$results = $this->model_core_charges->getCharges($filter_data);

			$data['charges'] = array();
			foreach ($results as $result) {
				$data['charges'][] = array(
					'charges_id' => $result['id'],
					'name' => $result['name'],
					'sname' => $result['sname'],
					'type_name' => $result['type_name'],
					'option_name' => $result['option_name'],
					'charge_amount' => $result['charge_amount'],
					'penalty' => $result['penalty'],
					'remarks' => $result['remarks'],
					'date_added' => date_format(date_create($result['added_date']),'d-m-Y'),
					'status' => $result['status'],
					'edit' => $this->url->link('core/charges/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_name'] = $this->language->get('column_name');
			$data['column_sname'] = $this->language->get('column_sname');
			$data['column_duration'] = $this->language->get('column_duration');
			$data['column_duration_type'] = $this->language->get('column_duration_type');
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
			$data['sort_status'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_name'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_charge_type_id'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=charge_type_id' . $url, 'SSL');
			$data['sort_charge_option_id'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=charge_option_id' . $url, 'SSL');
			$data['sort_charge_amount'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=charge_amount' . $url, 'SSL');
			$data['sort_charge_option_id'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=charge_option_id' . $url, 'SSL');
			$data['sort_penalty'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=penalty' . $url, 'SSL');
			$data['sort_added_date'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . '&sort=added_date' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $charge_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($charge_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($charge_total - $this->config->get('config_limit_admin'))) ? $charge_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $charge_total, ceil($charge_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/charges_list.tpl', $data));
		}
		
		protected function getForm()
		{
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_duration'] = $this->language->get('text_duration');
			$data['text_duration_type'] = $this->language->get('text_duration_type');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['sentry_name'] = $this->language->get('sentry_name');
			$data['entry_duration'] = $this->language->get('entry_duration');
			$data['entry_duration_type'] = $this->language->get('entry_duration_type');
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
			
			if (isset($this->error['name'])) {
				$data['error_name'] = $this->error['name'];
			} else {
				$data['error_name'] = '';
			}
			
			if (isset($this->error['sname'])) {
				$data['error_sname'] = $this->error['sname'];
			} else {
				$data['error_sname'] = '';
			}
			if (isset($this->error['duration'])) {
				$data['error_duration'] = $this->error['duration'];
			} else {
				$data['error_duration'] = '';
			}
			if (isset($this->error['duration_type'])) {
				$data['error_duration_type'] = $this->error['duration_type'];
			} else {
				$data['error_duration_type'] = '';
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
				'href' => $this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['id'])) {
				$data['action'] = $this->url->link('core/charges/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/charges/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/charges', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$charge_info = $this->model_core_charges->getCharge($this->request->get['id']);
			}
			
			
			$data['token'] = $this->session->data['token'];
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($charge_info)) {
				$data['name'] = $charge_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['sname'])) {
				$data['sname'] = $this->request->post['sname'];
			} elseif (!empty($charge_info)) {
				$data['sname'] = $charge_info['sname'];
			} else {
				$data['sname'] = '';
			}
			
			if (isset($this->request->post['charge_type_id'])) {
				$data['charge_type_id'] = $this->request->post['charge_type_id'];
			} elseif (!empty($charge_info)) {
				$data['charge_type_id'] = $charge_info['charge_type_id'];
			} else {
				$data['charge_type_id'] = '';
			}
			if (isset($this->request->post['charge_option_id'])) {
				$data['charge_option_id'] = $this->request->post['charge_option_id'];
			} elseif (!empty($charge_info)) {
				$data['charge_option_id'] = $charge_info['charge_option_id'];
			} else {
				$data['charge_option_id'] = '';
			}
			if (isset($this->request->post['penalty'])) {
				$data['penalty'] = $this->request->post['penalty'];
			} elseif (!empty($charge_info)) {
				$data['penalty'] = $charge_info['penalty'];
			} else {
				$data['penalty'] = '';
			}
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
			} elseif (!empty($charge_info)) {
				$data['status'] = $charge_info['status'];
			} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['remarks'])) {
				$data['remarks'] = $this->request->post['remarks'];
			} elseif (!empty($charge_info)) {
				$data['remarks'] = $charge_info['remarks'];
			} else {
				$data['remarks'] = '';
			}
			
			if (isset($this->request->post['charge_amount'])) {
				$data['charge_amount'] = $this->request->post['charge_amount'];
			} elseif (!empty($charge_info)) {
				$data['charge_amount'] = $charge_info['charge_amount'];
			} else {
				$data['charge_amount'] = '';
			}if (isset($this->request->post['override'])) {
				$data['override'] = $this->request->post['override'];
			} elseif (!empty($charge_info)) {
				$data['override'] = $charge_info['override'];
			} else {
				$data['override'] = '';
			}if (isset($this->request->post['currency_id'])) {
				$data['currency_id'] = $this->request->post['currency_id'];
			} elseif (!empty($charge_info)) {
				$data['currency_id'] = $charge_info['currency_id'];
			} else {
				$data['currency_id'] = '';
			}
			
			$data['duration_types'] = $this->model_core_charges->getDurationTypes();
			$data['charge_options'] = $this->model_core_charges->getChargesOptions();
			$data['charges_types'] = $this->model_core_charges->getChargesTypes();
			$data['currencies'] = $this->model_core_charges->getCurrency();

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/charges_form.tpl', $data));
		}
		
		protected function validateForm()
		{
			if (!$this->user->hasPermission('modify', 'core/charges')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
				$this->error['name'] = $this->language->get('error_name');
			}if ((utf8_strlen($this->request->post['sname']) < 2) || (utf8_strlen($this->request->post['sname']) > 64)) {
				$this->error['sname'] = $this->language->get('error_sname');
			}
			
			return !$this->error;
		}
		
		protected function validateDelete()
		{
			if (!$this->user->hasPermission('modify', 'core/charges')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			
			return !$this->error;
		}
		
		public function autocomplete()
		{
			$json = array();
			
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('core/charges');
				
				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'start' => 0,
					'limit' => 5
				);
				
				$results = $this->model_core_charges->getCharge($filter_data);
				
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