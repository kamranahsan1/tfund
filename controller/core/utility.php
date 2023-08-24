<?php
	class ControllerCoreUtility extends Controller {
		private $error = array();
		
		public function index() {
			$this->load->language('core/utility');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/utility');
			
			$this->getList();
		}
		
		public function add() {
			$this->load->language('core/utility');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/utility');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_utility->addUtility($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function edit() {
			$this->load->language('core/utility');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/utility');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_core_utility->editUtility($this->request->get['utility_id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getForm();
		}
		
		public function delete() {
			$this->load->language('core/utility');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('core/utility');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				foreach ($this->request->post['selected'] as $utility_id) {
					$this->model_core_utility->deleteUtility($utility_id);
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
				
				$this->response->redirect($this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
			$this->getList();
		}
		
		protected function getList() {
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
				'href' => $this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			$data['insert'] = $this->url->link('core/utility/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('core/utility/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['utilities'] = array();
			
			$filter_data = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$utility_total = $this->model_core_utility->getTotalUtilities();
			
			$results = $this->model_core_utility->getUtilities($filter_data);
			
			foreach ($results as $result) {
				$data['utilities'][] = array(
					'utility_id' => $result['utility_id'],
					'name'            => $result['name'],
					'sname'            => $result['sname'],
                    'address'            => $result['address'],
                    'email'            => $result['email'],
                    'phone'            => $result['phone'],
                    'status'            => $result['status'],
                    'added_date'            => date_format(date_create($result['added_date']), 'd-m-Y'),
					'edit'            => $this->url->link('core/utility/edit', 'token=' . $this->session->data['token'] . '&utility_id=' . $result['utility_id'] . $url, 'SSL')
				);
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_confirm'] = $this->language->get('text_confirm');
			
			$data['column_name'] = $this->language->get('column_name');
			$data['column_sname'] = $this->language->get('column_sname');
            $data['column_address'] = $this->language->get('column_address');
            $data['column_email'] = $this->language->get('column_email');
            $data['column_phone'] = $this->language->get('column_phone');
            $data['column_added_date'] = $this->language->get('column_added_date');
            $data['column_status'] = $this->language->get('column_status');
			$data['column_action'] = $this->language->get('column_action');
			
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
			
			$data['sort_name'] = $this->url->link('core/utility', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('core/utility', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_sort_order'] = $this->url->link('core/utility', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$pagination = new Pagination();
			$pagination->total = $utility_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
			$data['pagination'] = $pagination->render();
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($utility_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($utility_total - $this->config->get('config_limit_admin'))) ? $utility_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $utility_total, ceil($utility_total / $this->config->get('config_limit_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/utility_list.tpl', $data));
		}
		
		protected function getForm() {
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_form'] = !isset($this->request->get['utility_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_percent'] = $this->language->get('text_percent');
			$data['text_amount'] = $this->language->get('text_amount');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_sname'] = $this->language->get('entry_sname');
            $data['entry_address'] = $this->language->get('entry_address');
            $data['entry_email'] = $this->language->get('entry_email');
            $data['entry_phone'] = $this->language->get('entry_phone');
            $data['entry_remarks'] = $this->language->get('entry_remarks');
            $data['entry_status'] = $this->language->get('entry_status');
            $data['entry_psname'] = $this->language->get('entry_psname');
            $data['entry_pname'] = $this->language->get('entry_pname');
            $data['entry_pdetail'] = $this->language->get('entry_pdetail');
            $data['entry_region'] = $this->language->get('entry_region');
			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_keyword'] = $this->language->get('entry_keyword');
			$data['entry_image'] = $this->language->get('entry_image');
			$data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$data['entry_customer_group'] = $this->language->get('entry_customer_group');
			
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
			}if (isset($this->error['address'])) {
                $data['error_address'] = $this->error['address'];
            } else {
                $data['error_address'] = '';
            }
            if (isset($this->error['email'])) {
                $data['error_email'] = $this->error['email'];
            } else {
                $data['error_email'] = '';
            }
            if (isset($this->error['phone'])) {
                $data['error_phone'] = $this->error['phone'];
            } else {
                $data['error_phone'] = '';
            }if (isset($this->error['remarks'])) {
                $data['error_remarks'] = $this->error['remarks'];
            } else {
                $data['error_remarks'] = '';
            }
            if (isset($this->error['pname'])) {
                $data['error_pname'] = $this->error['pname'];
            } else {
                $data['error_pname'] = '';
            }
            if (isset($this->error['psname'])) {
                $data['error_psname'] = $this->error['psname'];
            } else {
                $data['error_psname'] = '';
            }
            if (isset($this->error['pdetail'])) {
                $data['error_pdetail'] = $this->error['pdetail'];
            } else {
                $data['error_pdetail'] = '';
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
				'href' => $this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
			
			if (!isset($this->request->get['utility_id'])) {
				$data['action'] = $this->url->link('core/utility/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('core/utility/edit', 'token=' . $this->session->data['token'] . '&utility_id=' . $this->request->get['utility_id'] . $url, 'SSL');
			}
			
			$data['cancel'] = $this->url->link('core/utility', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			if (isset($this->request->get['utility_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$utility_info = $this->model_core_utility->getUtility($this->request->get['utility_id']);
			}
			
			$data['token'] = $this->session->data['token'];
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($utility_info)) {
				$data['name'] = $utility_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['sname'])) {
				$data['sname'] = $this->request->post['sname'];
			} elseif (!empty($utility_info)) {
				$data['sname'] = $utility_info['sname'];
			} else {
				$data['sname'] = '';
			}if (isset($this->request->post['address'])) {
                $data['address'] = $this->request->post['address'];
            } elseif (!empty($utility_info)) {
                $data['address'] = $utility_info['address'];
            } else {
                $data['address'] = '';
            }if (isset($this->request->post['email'])) {
                $data['email'] = $this->request->post['email'];
            } elseif (!empty($utility_info)) {
                $data['email'] = $utility_info['email'];
            } else {
                $data['email'] = '';
            }if (isset($this->request->post['phone'])) {
                $data['phone'] = $this->request->post['phone'];
            } elseif (!empty($utility_info)) {
                $data['phone'] = $utility_info['phone'];
            } else {
                $data['phone'] = '';
            }
            if (isset($this->request->post['status'])) {
                $data['status'] = $this->request->post['status'];
            } elseif (!empty($utility_info)) {
                $data['status'] = $utility_info['status'];
            } else {
                $data['status'] = '';
            }if (isset($this->request->post['remarks'])) {
                $data['remarks'] = $this->request->post['remarks'];
            } elseif (!empty($utility_info)) {
                $data['remarks'] = $utility_info['remarks'];
            } else {
                $data['remarks'] = '';
            }if (isset($this->request->post['pname'])) {
                $data['pname'] = $this->request->post['pname'];
            } elseif (!empty($utility_info)) {
                $data['pname'] = $utility_info['pname'];
            } else {
                $data['pname'] = '';
            }if (isset($this->request->post['psname'])) {
                $data['psname'] = $this->request->post['psname'];
            } elseif (!empty($utility_info)) {
                $data['psname'] = $utility_info['psname'];
            } else {
                $data['psname'] = '';
            }if (isset($this->request->post['pdetail'])) {
                $data['pdetail'] = $this->request->post['pdetail'];
            } elseif (!empty($utility_info)) {
                $data['pdetail'] = $utility_info['pdetail'];
            } else {
                $data['pdetail'] = '';
            }if (isset($this->request->post['region_id'])) {
                $data['region_id'] = $this->request->post['region_id'];
            } elseif (!empty($utility_info)) {
                $data['region_id'] = $utility_info['region_id'];
            } else {
                $data['region_id'] = '';
            }

            $this->load->model('core/region');
            $data['regions'] = $this->model_core_region->getRegions();

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('core/utility_form.tpl', $data));
		}
		
		protected function validateForm() {
			if (!$this->user->hasPermission('modify', 'core/utility')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
				$this->error['name'] = $this->language->get('error_name');
			}
			if ((utf8_strlen($this->request->post['sname']) < 1) || (utf8_strlen($this->request->post['name']) > 64)) {
				$this->error['sname'] = $this->language->get('error_sname');
			}
            if ((utf8_strlen($this->request->post['psname']) < 1) || (utf8_strlen($this->request->post['psname']) > 64)) {
                $this->error['psname'] = $this->language->get('error_psname');
            }
            if ((utf8_strlen($this->request->post['pname']) < 1) || (utf8_strlen($this->request->post['pname']) > 64)) {
                $this->error['pname'] = $this->language->get('error_pname');
            }
			return !$this->error;
		}
		
		protected function validateDelete() {
			if (!$this->user->hasPermission('modify', 'core/utility')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
		
			return !$this->error;
		}
		
		public function autocomplete() {
			$json = array();
			
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('core/utility');
				
				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'start'       => 0,
					'limit'       => 5
				);
				
				$results = $this->model_core_utility->getUtilities($filter_data);
				
				foreach ($results as $result) {
					$json[] = array(
						'utility_id' => $result['utility_id'],
						'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
						'sname'            => strip_tags(html_entity_decode($result['sname'], ENT_QUOTES, 'UTF-8'))
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