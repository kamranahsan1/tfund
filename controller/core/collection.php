<?php
	
	class ControllerCoreCollection extends Controller
	{
		private $error = array();
		
		public function index()
		{
			$this->load->language('core/collection');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/collection');
			
			$this->getList();
		}
		
		
		public function add()
		{
			$this->load->language('core/collection');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/collection');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_collection->addCollection($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit()
		{
			$this->load->language('core/collection');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/collection');
			
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_collection->editCollection($this->request->get['id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete()
		{
			$this->load->language('core/collection');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/collection');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $fund_type_id) {
					$this->model_core_collection->deleteFund($fund_type_id);
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
				
				$this->response->redirect($this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getList();
		}
		
		protected function getList()
		{
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'request_id';
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
				'href' => $this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/collection/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/collection/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['collections'] = array();
			
			$filter_data = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$fund_total = $this->model_core_collection->getTotalCollections();
			$results = $this->model_core_collection->getCollections($filter_data);

			$data['collections'] = array();
			foreach ($results as $result) {
				$data['collections'][] = array(
					'collection_id' => $result['id'],
					'request_id' => $result['request_id'],
					'amount' => $result['amount'],
					'request_name' => $result['request_name'],
					'remarks' => $result['remarks'],
					'ucode' => $result['ucode'],
					'date_added' => date_format(date_create($result['date_added']),'d-m-Y'),
					'ent_date' => date_format(date_create($result['ent_date']),'d-m-Y'),
					'status' => $result['status'],
					'edit' => $this->url->link('core/collection/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_request_id'] = $this->language->get('column_request_id');
			$data['column_amount'] = $this->language->get('column_amount');
			$data['column_ucode'] = $this->language->get('column_ucode');
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
			$data['sort_status'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_request_id'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . '&sort=request_id' . $url, 'SSL');
			$data['sort_amount'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . '&sort=amount' . $url, 'SSL');
			$data['sort_duration'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . '&sort=duration' . $url, 'SSL');
			$data['sort_duration_type'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . '&sort=duration_type' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $fund_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($fund_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($fund_total - $this->config->get('config_limit_admin'))) ? $fund_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $fund_total, ceil($fund_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/collection_list.tpl', $data));
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
			
			$data['entry_request_id'] = $this->language->get('entry_request_id');
			$data['entry_amount'] = $this->language->get('entry_amount');
			$data['entry_ent_date'] = $this->language->get('entry_ent_date');
			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_keyword'] = $this->language->get('entry_keyword');
			$data['entry_image'] = $this->language->get('entry_image');
			$data['entry_ucode'] = $this->language->get('entry_ucode');
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
			
			if (isset($this->error['request_id'])) {
				$data['error_request_id'] = $this->error['request_id'];
			} else {
				$data['error_request_id'] = '';
			}
			
			if (isset($this->error['amount'])) {
				$data['error_amount'] = $this->error['amount'];
			} else {
				$data['error_amount'] = '';
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
				'href' => $this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['id'])) {
				$data['action'] = $this->url->link('core/collection/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/collection/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/collection', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$fund_info = $this->model_core_collection->getCollection($this->request->get['id']);
			}
			
			
			$data['token'] = $this->session->data['token'];
			
			
			$this->load->model('core/request');
			$data['requests'] = $this->model_core_request->getRequests();
			if (isset($this->request->post['request_id'])) {
				$data['request_id'] = $this->request->post['request_id'];
			} elseif (!empty($fund_info)) {
				$data['request_id'] = $fund_info['request_id'];
			} else {
				$data['request_id'] = '';
			}
			if (isset($this->request->post['amount'])) {
				$data['amount'] = $this->request->post['amount'];
			} elseif (!empty($fund_info)) {
				$data['amount'] = $fund_info['amount'];
			} else {
				$data['amount'] = '';
			}
			
			
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
			} elseif (!empty($fund_info)) {
				$data['status'] = $fund_info['status'];
			} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['remarks'])) {
				$data['remarks'] = $this->request->post['remarks'];
			} elseif (!empty($fund_info)) {
				$data['remarks'] = $fund_info['remarks'];
			} else {
				$data['remarks'] = '';
			}
			
			if (isset($this->request->post['ucode'])) {
				$data['ucode'] = $this->request->post['ucode'];
			} elseif (!empty($fund_info)) {
				$data['ucode'] = $fund_info['ucode'];
			} else {
				$data['ucode'] = '';
			}
			
			if (isset($this->request->post['ent_date'])) {
				$data['ent_date'] = $this->request->post['ent_date'];
			} elseif (!empty($fund_info)) {
				$data['ent_date'] = $fund_info['ent_date'];
			} else {
				$data['ent_date'] = '';
			}
			
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/collection_form.tpl', $data));
		}
		
		protected function validateForm()
		{
			/*if (!$this->user->hasPermission('modify', 'core/collection')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if ((utf8_strlen($this->request->post['request_id']) < 2) || (utf8_strlen($this->request->post['request_id']) > 64)) {
				$this->error['request_id'] = $this->language->get('error_request_id');
			}if ((utf8_strlen($this->request->post['amount']) < 2) || (utf8_strlen($this->request->post['amount']) > 64)) {
				$this->error['amount'] = $this->language->get('error_amount');
			}
			*/
			return !$this->error;
		}
		
		protected function validateDelete()
		{
			if (!$this->user->hasPermission('modify', 'core/collection')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			
			return !$this->error;
		}
		
		public function autocomplete()
		{
			$json = array();
			
			if (isset($this->request->get['filter_request_id'])) {
				$this->load->model('core/collection');
				
				$filter_data = array(
					'filter_request_id' => $this->request->get['filter_request_id'],
					'start' => 0,
					'limit' => 5
				);
				
				$results = $this->model_core_collection->getCollections($filter_data);
				
				foreach ($results as $result) {
					$json[] = array(
						'id' => $result['id'],
						'request_id' => strip_tags(html_entity_decode($result['request_id'], ENT_QUOTES, 'UTF-8'))
					);
				}
			}
			
			$sort_order = array();
			
			foreach ($json as $key => $value) {
				$sort_order[$key] = $value['request_id'];
			}
			
			array_multisort($sort_order, SORT_ASC, $json);
			
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		
		
		
	}