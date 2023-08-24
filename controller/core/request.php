<?php
	
	class ControllerCoreRequest extends Controller
	{
		private $error = array();
		
		public function index()
		{
			$this->load->language('core/request');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/request');
			
			$this->getList();
		}
		
		
		public function add()
		{
			$this->load->language('core/request');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/request');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_request->addRequest($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit()
		{
			$this->load->language('core/request');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/request');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_request->editRequest($this->request->get['id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete()
		{
			$this->load->language('core/request');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/request');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $request_id) {
					$this->model_core_request->deleteRequest($request_id);
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
				
				$this->response->redirect($this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
				'href' => $this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/request/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/request/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['requests'] = array();
			
			$filter_data = array(
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$request_total = $this->model_core_request->getTotalRequests();
			
			$results = $this->model_core_request->getRequests($filter_data);
			
			$data['requests'] = array();
			foreach ($results as $result) {
				$data['requests'][] = array(
					'request_id' => $result['id'],
					'name' => $result['name'],
					'sname' => $result['sname'],
					'date_added' => date_format(date_create($result['date_added']),'d-m-Y'),
					'fdate' => $result['fdate'],
					'tdate' => $result['tdate'],
					'assign_to' => $result['firstname'].' '.$result['lastname'],
					'fund_type_name' => $result['fund_type_name'],
					'remarks' => $result['remarks'],
					'status' => $result['status'],
					'edit' => $this->url->link('core/request/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_name'] = $this->language->get('column_name');
			$data['column_sname'] = $this->language->get('column_sname');
			$data['column_fdate'] = $this->language->get('column_fdate');
			$data['column_tdate'] = $this->language->get('column_tdate');
			$data['column_date_added'] = $this->language->get('column_date_added');
			$data['column_assign_to'] = $this->language->get('column_assign_to');
			$data['column_sort_order'] = $this->language->get('column_sort_order');
			$data['column_action'] = $this->language->get('column_action');
			$data['column_fund_type'] = $this->language->get('column_fund_type');
			$data['column_status'] = $this->language->get('column_status');
			
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
			$data['sort_status'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_name'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_fdate'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=fdate' . $url, 'SSL');
			$data['sort_tdate'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=tdate' . $url, 'SSL');
			$data['sort_sort_order'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $request_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/request', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($request_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($request_total - $this->config->get('config_limit_admin'))) ? $request_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $request_total, ceil($request_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/request_list.tpl', $data));
		}
		
		protected function getForm()
		{
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_tdate'] = $this->language->get('text_tdate');
			$data['text_fdate'] = $this->language->get('text_fdate');
			
			$data['entry_loan_id'] = $this->language->get('entry_loan_id');
			$data['entry_product_id'] = $this->language->get('entry_product_id');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['sentry_name'] = $this->language->get('sentry_name');
			$data['entry_fdate'] = $this->language->get('entry_fdate');
			$data['entry_tdate'] = $this->language->get('entry_tdate');
			$data['entry_country'] = $this->language->get('entry_country');
			$data['entry_region'] = $this->language->get('entry_region');
			$data['entry_area'] = $this->language->get('entry_area');
			$data['entry_email'] = $this->language->get('entry_email');
			$data['entry_phone'] = $this->language->get('entry_phone');
			$data['entry_address'] = $this->language->get('entry_address');
			$data['entry_fund_type'] = $this->language->get('entry_fund_type');
			$data['entry_currency'] = $this->language->get('entry_currency');
			$data['entry_amount'] = $this->language->get('entry_amount');
			$data['entry_doc_status'] = $this->language->get('entry_doc_status');
			$data['entry_assign_to'] = $this->language->get('entry_assign_to');
			$data['entry_status'] = $this->language->get('entry_status');
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
			if (isset($this->error['country_id'])) {
				$data['error_country_id'] = $this->error['country_id'];
			} else {
				$data['error_country_id'] = '';
			}
            if (isset($this->error['region_id'])) {
                $data['error_region_id'] = $this->error['region_id'];
            } else {
                $data['error_region_id'] = '';
            }
            if (isset($this->error['area_id'])) {
                $data['error_area_id'] = $this->error['area_id'];
            } else {
                $data['error_area_id'] = '';
            }
            if (isset($this->error['fdate'])) {
                $data['error_fdate'] = $this->error['fdate'];
            } else {
                $data['error_fdate'] = '';
            }
            if (isset($this->error['tdate'])) {
                $data['error_tdate'] = $this->error['tdate'];
            } else {
                $data['error_tdate'] = '';
            }
            if (isset($this->error['address'])) {
                $data['error_address'] = $this->error['address'];
            } else {
                $data['error_address'] = '';
            }
            if (isset($this->error['phone'])) {
                $data['error_phone'] = $this->error['phone'];
            } else {
                $data['error_phone'] = '';
            }
            if (isset($this->error['email'])) {
                $data['error_email'] = $this->error['email'];
            } else {
                $data['error_email'] = '';
            }
            if (isset($this->error['fund_type_id'])) {
                $data['error_fund_type_id'] = $this->error['fund_type_id'];
            } else {
                $data['error_fund_type_id'] = '';
            }
            if (isset($this->error['currency_id'])) {
                $data['error_currency_id'] = $this->error['currency_id'];
            } else {
                $data['error_currency_id'] = '';
            }
            if (isset($this->error['amount'])) {
                $data['error_amount'] = $this->error['amount'];
            } else {
                $data['error_amount'] = '';
            }
            if (isset($this->error['assign_to'])) {
                $data['error_assign_to'] = $this->error['assign_to'];
            } else {
                $data['error_assign_to'] = '';
            }

            if (isset($this->error['image'])) {
                $data['error_image'] = $this->error['image'];
            } else {
                $data['error_image'] = '';
            }

            if (isset($this->error['doc_status'])) {
                $data['error_doc_status'] = $this->error['doc_status'];
            } else {
                $data['error_doc_status'] = '';
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
				'href' => $this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['id'])) {
				$data['action'] = $this->url->link('core/request/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/request/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/request', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$request_info = $this->model_core_request->getRequest($this->request->get['id']);
			}
			
			
			$data['token'] = $this->session->data['token'];
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($request_info)) {
				$data['name'] = $request_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['sname'])) {
				$data['sname'] = $this->request->post['sname'];
			} elseif (!empty($request_info)) {
				$data['sname'] = $request_info['sname'];
			} else {
				$data['sname'] = '';
			}
			
			if (isset($this->request->post['fdate'])) {
				$data['fdate'] = $this->request->post['fdate'];
			} elseif (!empty($request_info)) {
				$data['fdate'] = $request_info['fdate'];
			} else {
				$data['fdate'] = '';
			}
			if (isset($this->request->post['tdate'])) {
				$data['tdate'] = $this->request->post['tdate'];
			} elseif (!empty($request_info)) {
				$data['tdate'] = $request_info['tdate'];
			} else {
				$data['tdate'] = '';
			}

            if (isset($this->request->post['country_id'])) {
                $data['country_id'] = $this->request->post['country_id'];
            } elseif (!empty($request_info)) {
                $data['country_id'] = $request_info['country_id'];
            } else {
                $data['country_id'] = '';
            }
            if (isset($this->request->post['region_id'])) {
                $data['region_id'] = $this->request->post['region_id'];
            } elseif (!empty($request_info)) {
                $data['region_id'] = $request_info['region_id'];
            } else {
                $data['region_id'] = '';
            }
            if (isset($this->request->post['area_id'])) {
                $data['area_id'] = $this->request->post['area_id'];
            } elseif (!empty($request_info)) {
                $data['area_id'] = $request_info['area_id'];
            } else {
                $data['area_id'] = '';
            }
            if (isset($this->request->post['address'])) {
                $data['address'] = $this->request->post['address'];
            } elseif (!empty($request_info)) {
                $data['address'] = $request_info['address'];
            } else {
                $data['address'] = '';
            }
            if (isset($this->request->post['phone'])) {
                $data['phone'] = $this->request->post['phone'];
            } elseif (!empty($request_info)) {
                $data['phone'] = $request_info['phone'];
            } else {
                $data['phone'] = '';
            }
            if (isset($this->request->post['email'])) {
                $data['email'] = $this->request->post['email'];
            } elseif (!empty($request_info)) {
                $data['email'] = $request_info['email'];
            } else {
                $data['email'] = '';
            }
            if (isset($this->request->post['fund_type_id'])) {
                $data['fund_type_id'] = $this->request->post['fund_type_id'];
            } elseif (!empty($request_info)) {
                $data['fund_type_id'] = $request_info['fund_type_id'];
            } else {
                $data['fund_type_id'] = '';
            }
            if (isset($this->request->post['currency_id'])) {
                $data['currency_id'] = $this->request->post['currency_id'];
            } elseif (!empty($request_info)) {
                $data['currency_id'] = $request_info['currency_id'];
            } else {
                $data['currency_id'] = '';
            }
            if (isset($this->request->post['amount'])) {
                $data['amount'] = $this->request->post['amount'];
            } elseif (!empty($request_info)) {
                $data['amount'] = $request_info['amount'];
            } else {
                $data['amount'] = '';
            }
            if (isset($this->request->post['image'])) {
                $data['image'] = $this->request->post['image'];
            } elseif (!empty($request_info)) {
                $data['image'] = $request_info['image'];
            } else {
                $data['image'] = '';
            }

            if (isset($this->request->post['doc_status'])) {
                $data['doc_status'] = $this->request->post['doc_status'];
            } elseif (!empty($request_info)) {
                $data['doc_status'] = $request_info['doc_status'];
            } else {
                $data['doc_status'] = '';
            }

            if (isset($this->request->post['assign_to'])) {
                $data['assign_to'] = $this->request->post['assign_to'];
            } elseif (!empty($request_info)) {
                $data['assign_to'] = $request_info['assign_to'];
            } else {
                $data['assign_to'] = '';
            }
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
			} elseif (!empty($request_info)) {
				$data['status'] = $request_info['status'];
			} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['remarks'])) {
				$data['remarks'] = $this->request->post['remarks'];
			} elseif (!empty($request_info)) {
				$data['remarks'] = $request_info['remarks'];
			} else {
				$data['remarks'] = '';
			}
			if (isset($this->request->post['loan_id'])) {
				$data['loan_id'] = $this->request->post['loan_id'];
			} elseif (!empty($request_info)) {
				$data['loan_id'] = $request_info['loan_id'];
			} else {
				$data['loan_id'] = '';
			}
			if (isset($this->request->post['product_id'])) {
				$data['product_id'] = $this->request->post['product_id'];
			} elseif (!empty($request_info)) {
				$data['product_id'] = $request_info['product_id'];
			} else {
				$data['product_id'] = '';
			}


            $this->load->model('core/region');
			$this->load->model('core/loan');
			$this->load->model('core/product');
            $data['regions'] = $this->model_core_region->getRegions();
            
			$data['loans'] = $this->model_core_loan->getLoans();
			$data['products'] = $this->model_core_product->getProducts();

            $data['funds'] = $this->model_core_request->getFunds();
            $data['countries'] = $this->model_core_request->getCountries();
            $data['currencies'] = $this->model_core_request->getCurrencies();
            $data['areas'] = $this->model_core_request->getAreas();
            $data['users'] = $this->model_core_request->getUsers();



			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/request_form.tpl', $data));
		}
		
		protected function validateForm()
		{
			if (!$this->user->hasPermission('modify', 'core/request')) {
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
			if (!$this->user->hasPermission('modify', 'core/request')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			
			return !$this->error;
		}
		
		public function autocomplete()
		{
			$json = array();
			
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('core/request');
				
				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'filter_sname' => $this->request->get['filter_sname'],
					'start' => 0,
					'limit' => 5
				);
				
				$results = $this->model_core_request->getRequests($filter_data);
				
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