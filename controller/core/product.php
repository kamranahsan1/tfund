<?php
	
	class ControllerCoreProduct extends Controller
	{
		private $error = array();
		
		public function index()
		{
			$this->load->language('core/product');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/product');
			
			$this->getList();
		}
		
		
		public function add()
		{
			$this->load->language('core/product');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/product');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_product->addProduct($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit()
		{
			$this->load->language('core/product');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/product');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_product->editProduct($this->request->get['id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete()
		{
			$this->load->language('core/product');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/product');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $product_id) {
					$this->model_core_product->deleteProduct($product_id);
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
				
				$this->response->redirect($this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
				'href' => $this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['products'] = array();
			
			$filter_data = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$product_total = $this->model_core_product->getTotalProducts();
			
			$results = $this->model_core_product->getProducts($filter_data);
			$data['products'] = array();
			foreach ($results as $result) {
				$data['products'][] = array(
					'product_id' => $result['id'],
					'name' => $result['name'],
					'sname' => $result['sname'],
					'max_principle' => $result['max_principle'],
					'min_interest_rate' => $result['min_interest_rate'],
					'rep_freq' => $result['rep_freq'],
					'duration_name' => $result['duration_name'],
					'charges' => $result['charges'],
					'overpayment' => $result['overpayment'],
					'added_date' => date_format(date_create($result['added_date']),'d-m-Y'),
					'status' => $result['status'],
					'edit' => $this->url->link('core/product/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_name'] = $this->language->get('column_name');
			$data['column_sname'] = $this->language->get('column_sname');
			$data['column_rep_freq'] = $this->language->get('column_rep_freq');
			$data['column_overpayment'] = $this->language->get('column_overpayment');
			$data['column_max_principle'] = $this->language->get('column_max_principle');
			$data['column_min_interest_rate'] = $this->language->get('column_min_interest_rate');
			$data['column_duration_name'] = $this->language->get('column_duration_name');
			$data['column_charges'] = $this->language->get('column_charges');
			$data['column_action'] = $this->language->get('column_action');
			$data['column_status'] = $this->language->get('column_status');
			$data['column_added_date'] = $this->language->get('column_added_date');
			
			
			
			
			
			
			
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
			$data['sort_status'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_name'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_fmonth'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=fmonth' . $url, 'SSL');
			$data['sort_tmonth'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=tmonth' . $url, 'SSL');
			$data['sort_sort_order'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/product_list.tpl', $data));
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
				'href' => $this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['id'])) {
				$data['action'] = $this->url->link('core/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/product/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/product', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$product_info = $this->model_core_product->getProduct($this->request->get['id']);
			}
			
			
			$data['token'] = $this->session->data['token'];
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($product_info)) {
				$data['name'] = $product_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['sname'])) {
				$data['sname'] = $this->request->post['sname'];
			} elseif (!empty($product_info)) {
				$data['sname'] = $product_info['sname'];
			} else {
				$data['sname'] = '';
			}
			
			if (isset($this->request->post['fund_source'])) {
				$data['fund_source'] = $this->request->post['fund_source'];
			} elseif (!empty($product_info)) {
				$data['fund_source'] = $product_info['fund_source'];
			} else {
				$data['fund_source'] = '';
			}
			if (isset($this->request->post['accounting_rule_id'])) {
				$data['accounting_rule_id'] = $this->request->post['accounting_rule_id'];
			} elseif (!empty($product_info)) {
				$data['accounting_rule_id'] = $product_info['accounting_rule_id'];
			} else {
				$data['accounting_rule_id'] = '';
			}
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
			} elseif (!empty($product_info)) {
				$data['status'] = $product_info['status'];
			} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['remarks'])) {
				$data['remarks'] = $this->request->post['remarks'];
			} elseif (!empty($product_info)) {
				$data['remarks'] = $product_info['remarks'];
			} else {
				$data['remarks'] = '';
			}
			
			if (isset($this->request->post['credit_check'])) {
				$data['credit_check'] = $this->request->post['credit_check'];
			} elseif (!empty($product_info)) {
				$data['credit_check'] = $product_info['credit_check'];
			} else {
				$data['credit_check'] = '';
			}if (isset($this->request->post['loan_processing_id'])) {
				$data['loan_processing_id'] = $this->request->post['loan_processing_id'];
			} elseif (!empty($product_info)) {
				$data['loan_processing_id'] = $product_info['loan_processing_id'];
			} else {
				$data['loan_processing_id '] = '';
			}if (isset($this->request->post['amort_method_id'])) {
				$data['amort_method_id'] = $this->request->post['amort_method_id'];
			} elseif (!empty($product_info)) {
				$data['amort_method_id'] = $product_info['amort_method_id'];
			} else {
				$data['amort_method_id'] = '';
			}if (isset($this->request->post['interest_method_id'])) {
				$data['interest_method_id'] = $this->request->post['interest_method_id'];
			} elseif (!empty($product_info)) {
				$data['interest_method_id'] = $product_info['interest_method_id'];
			} else {
				$data['interest_method_id'] = '';
			}if (isset($this->request->post['grace_pamount'])) {
				$data['grace_pamount'] = $this->request->post['grace_pamount'];
			} elseif (!empty($product_info)) {
				$data['grace_pamount'] = $product_info['grace_pamount'];
			} else {
				$data['grace_pamount'] = '';
			}if (isset($this->request->post['duration_type'])) {
				$data['duration_type_id'] = $this->request->post['duration_type'];
			} elseif (!empty($product_info)) {
				$data['duration_type_id'] = $product_info['duration_type'];
			} else {
				$data['duration_type_id'] = '';
			}if (isset($this->request->post['rep_freq'])) {
				$data['rep_freq'] = $this->request->post['rep_freq'];
			} elseif (!empty($product_info)) {
				$data['rep_freq'] = $product_info['rep_freq'];
			} else {
				$data['rep_freq'] = '';
			}if (isset($this->request->post['max_principle'])) {
				$data['max_principle'] = $this->request->post['max_principle'];
			} elseif (!empty($product_info)) {
				$data['max_principle'] = $product_info['max_principle'];
			} else {
				$data['max_principle'] = '';
			}
			if (isset($this->request->post['min_principle'])) {
				$data['min_principle'] = $this->request->post['min_principle'];
			} elseif (!empty($product_info)) {
				$data['min_principle'] = $product_info['min_principle'];
			} else {
				$data['min_principle'] = '';
			}if (isset($this->request->post['def_principal'])) {
				$data['def_principal'] = $this->request->post['def_principal'];
			} elseif (!empty($product_info)) {
				$data['def_principal'] = $product_info['def_principal'];
			} else {
				$data['def_principal'] = '';
			}if (isset($this->request->post['decimal_places'])) {
				$data['decimal_places'] = $this->request->post['decimal_places'];
			} elseif (!empty($product_info)) {
				$data['decimal_places'] = $product_info['decimal_places'];
			} else {
				$data['decimal_places'] = '';
			}if (isset($this->request->post['charges'])) {
				$data['charges'] = $this->request->post['charges'];
			} elseif (!empty($product_info)) {
				$data['charges'] = $product_info['charges'];
			} else {
				$data['charges'] = '';
			}if (isset($this->request->post['loan_portfolio'])) {
				$data['loan_portfolio'] = $this->request->post['loan_portfolio'];
			} elseif (!empty($product_info)) {
				$data['loan_portfolio'] = $product_info['loan_portfolio'];
			} else {
				$data['loan_portfolio'] = '';
			}if (isset($this->request->post['overpayment'])) {
				$data['overpayment'] = $this->request->post['overpayment'];
			} elseif (!empty($product_info)) {
				$data['overpayment'] = $product_info['overpayment'];
			} else {
				$data['overpayment'] = '';
			}if (isset($this->request->post['susp_income'])) {
				$data['susp_income'] = $this->request->post['susp_income'];
			} elseif (!empty($product_info)) {
				$data['susp_income'] = $product_info['susp_income'];
			} else {
				$data['susp_income'] = '';
			}if (isset($this->request->post['income_from_interest'])) {
				$data['income_from_interest'] = $this->request->post['income_from_interest'];
			} elseif (!empty($product_info)) {
				$data['income_from_interest'] = $product_info['income_from_interest'];
			} else {
				$data['income_from_interest'] = '';
			}if (isset($this->request->post['income_from_penalty'])) {
				$data['income_from_penalty'] = $this->request->post['income_from_penalty'];
			} elseif (!empty($product_info)) {
				$data['income_from_penalty'] = $product_info['income_from_penalty'];
			} else {
				$data['income_from_penalty'] = '';
			}if (isset($this->request->post['income_from_fess'])) {
				$data['income_from_fess'] = $this->request->post['income_from_fess'];
			} elseif (!empty($product_info)) {
				$data['income_from_fess'] = $product_info['income_from_fess'];
			} else {
				$data['income_from_fess'] = '';
			}if (isset($this->request->post['income_from_recovery'])) {
				$data['income_from_recovery'] = $this->request->post['income_from_recovery'];
			} elseif (!empty($product_info)) {
				$data['income_from_recovery'] = $product_info['income_from_recovery'];
			} else {
				$data['income_from_recovery'] = '';
			}if (isset($this->request->post['loss_off'])) {
				$data['loss_off'] = $this->request->post['loss_off'];
			} elseif (!empty($product_info)) {
				$data['loss_off'] = $product_info['loss_off'];
			} else {
				$data['loss_off'] = '';
			}if (isset($this->request->post['interest_off'])) {
				$data['interest_off'] = $this->request->post['interest_off'];
			} elseif (!empty($product_info)) {
				$data['interest_off'] = $product_info['interest_off'];
			} else {
				$data['interest_off'] = '';
			}if (isset($this->request->post['auto_disburse'])) {
				$data['auto_disburse'] = $this->request->post['auto_disburse'];
			} elseif (!empty($product_info)) {
				$data['auto_disburse'] = $product_info['auto_disburse'];
			} else {
				$data['auto_disburse'] = '';
			}if (isset($this->request->post['grace_interest_charges'])) {
				$data['grace_interest_charges'] = $this->request->post['grace_interest_charges'];
			} elseif (!empty($product_info)) {
				$data['grace_interest_charges'] = $product_info['grace_interest_charges'];
			} else {
				$data['grace_interest_charges'] = '';
			}if (isset($this->request->post['grace_interest_amount'])) {
				$data['grace_interest_amount'] = $this->request->post['grace_interest_amount'];
			} elseif (!empty($product_info)) {
				$data['grace_interest_amount'] = $product_info['grace_interest_amount'];
			} else {
				$data['grace_interest_amount'] = '';
			}if (isset($this->request->post['max_interest_rate'])) {
				$data['max_interest_rate'] = $this->request->post['max_interest_rate'];
			} elseif (!empty($product_info)) {
				$data['max_interest_rate'] = $product_info['max_interest_rate'];
			} else {
				$data['max_interest_rate'] = '';
			}if (isset($this->request->post['min_interest_rate'])) {
				$data['min_interest_rate'] = $this->request->post['min_interest_rate'];
			} elseif (!empty($product_info)) {
				$data['min_interest_rate'] = $product_info['min_interest_rate'];
			} else {
				$data['min_interest_rate'] = '';
			}if (isset($this->request->post['max_principle'])) {
				$data['max_principle'] = $this->request->post['max_principle'];
			} elseif (!empty($product_info)) {
				$data['max_principle'] = $product_info['max_principle'];
			} else {
				$data['max_principle'] = '';
			}if (isset($this->request->post['fund_amount'])) {
				$data['fund_amount'] = $this->request->post['fund_amount'];
			} elseif (!empty($product_info)) {
				$data['fund_amount'] = $product_info['fund_amount'];
			} else {
				$data['fund_amount'] = '';
			}if (isset($this->request->post['def_interest_rate'])) {
				$data['def_interest_rate'] = $this->request->post['def_interest_rate'];
			} elseif (!empty($product_info)) {
				$data['def_interest_rate'] = $product_info['def_interest_rate'];
			} else {
				$data['def_interest_rate'] = '';
			}if (isset($this->request->post['currency_id'])) {
				$data['currency_id'] = $this->request->post['currency_id'];
			} elseif (!empty($product_info)) {
				$data['currency_id'] = $product_info['currency_id'];
			} else {
				$data['currency_id'] = '';
			}
			
			
			
			
			
			
			$this->load->model('core/region');
			$data['regions'] = $this->model_core_region->getRegions();
			
			$this->load->model('core/product');
			$data['duration_types'] = $this->model_core_product->getDurations();
			$data['amortizations'] = $this->model_core_product->getAmortizations();
			$data['loan_processings'] = $this->model_core_product->getLoan_processing_strategys();
			$data['accounting_rules'] = $this->model_core_product->getAccounting_rules();
			$data['interest_methods'] = $this->model_core_product->getInterest_methods();
			$data['currencies'] = $this->model_core_product->getCurrencys();
		
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/product_form.tpl', $data));
		}
		
		protected function validateForm()
		{
			if (!$this->user->hasPermission('modify', 'core/product')) {
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
			if (!$this->user->hasPermission('modify', 'core/product')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			
			return !$this->error;
		}
		
		public function autocomplete()
		{
			$json = array();
			
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('core/product');
				
				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'filter_sname' => $this->request->get['filter_sname'],
					'start' => 0,
					'limit' => 5
				);
				
				$results = $this->model_core_product->getProducts($filter_data);
				
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