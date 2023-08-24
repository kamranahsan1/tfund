<?php

	class ControllerRentCompany extends Controller
	{
		private $error = array();

		public function index()
		{
			$this->load->language('rent/company');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->load->model('rent/company');

			$this->getList();
		}


		public function add()
		{
			$this->load->language('rent/company');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->load->model('rent/company');

			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_rent_company->addCompany($this->request->post);

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

				$this->response->redirect($this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}

			$this->getForm();
		}

		public function edit()
		{
			$this->load->language('rent/company');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->load->model('rent/company');


			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_rent_company->editCompany($this->request->get['company_id'], $this->request->post);

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

				$this->response->redirect($this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}

			$this->getForm();
		}
		public function updateCompany()
		{

            $sql =  "Update  " . DB_PREFIX . "company
		SET 
		contact = '" . $this->db->escape($this->request->get['contact']) . "',
		address = '" . $this->db->escape($this->request->get['address']) . "',
		rent_per = '".$this->request->get['rent_per']."' where  company_id = 1 ";
            $this->db->query($sql);
		}

		public function delete()
		{
			$this->load->language('rent/company');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->load->model('rent/company');

			if (true) {
                $this->model_rent_company->deleteCompany($this->request->get['company_id']);

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

				$this->response->redirect($this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}

			$this->getList();
		}

		protected function getList()
		{


            $this->load->model('user/user');
            $this->load->model('tool/image');
            $user_info = $this->model_user_user->getUser($this->user->getId());
            if ($user_info) {
                $data['firstname'] = $user_info['firstname'];
                $data['lastname'] = $user_info['lastname'];
                $data['username'] = $user_info['username'];
                $data['user_group'] = $user_info['user_group'] ;
                if (is_file(DIR_IMAGE . $user_info['image'])) {
                    $data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
                } else {
                    $data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
                }
            } else {
                $data['username'] = '';
                $data['image'] = '';
            }



            if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'name';
			}
            if (isset($this->request->get['filter_search'])) {
				$filter_search = $this->request->get['filter_search'];
			} else {
                $filter_search = '';
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
				'href' => $this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);

			$data['insert'] = $this->url->link('rent/company/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['delete'] = $this->url->link('rent/company/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
            if (!isset($this->request->get['company_id'])) {
                $data['action'] = $this->url->link('rent/company/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
            } else {
                $data['action'] = $this->url->link('rent/company/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['company_id'] . $url, 'SSL');
            }
			$data['companys'] = array();

			$filter_data = array(
				'filter_search' => $filter_search,
				'sort' => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);

			$fund_total = $this->model_rent_company->getTotalCompanys();
			$result = $this->model_rent_company->getCompanys();

            $data['company_id']=$result['company_id'];
            $data['name']=$result['name'];
            $data['rent_per']=$result['rent_per'];
            $data['address']=$result['address'];
            $data['contact']=$result['contact'];
            $data['edit']=$this->url->link('rent/company/edit', 'token=' . $this->session->data['token'] . '&company_id=' . $result['company_id'] . $url, 'SSL');


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
			$data['sort_status'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
			$data['sort_name'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
			$data['sort_sname'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=sname' . $url, 'SSL');
			$data['sort_duration'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=duration' . $url, 'SSL');
			$data['sort_duration_type'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=duration_type' . $url, 'SSL');
			$data['sort_sort_order'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
			$pagination->url = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($fund_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($fund_total - $this->config->get('config_limit_admin'))) ? $fund_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $fund_total, ceil($fund_total / $this->config->get('config_limit_admin')));
            $data['cancel'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['token'] = $this->session->data['token'];

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('rent/company_list.tpl', $data));
		}

		protected function getForm()
		{
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_form'] = !isset($this->request->get['company_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_duration'] = $this->language->get('text_duration');
			$data['text_duration_type'] = $this->language->get('text_duration_type');

			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_keyword'] = $this->language->get('entry_keyword');
			$data['entry_image'] = $this->language->get('entry_image');
			$data['entry_sort_order'] = $this->language->get('entry_sort_order');
			$data['entry_company_group'] = $this->language->get('entry_company_group');
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

			if (isset($this->error['name'])) {
				$data['error_name'] = $this->error['name'];
			} else {
				$data['error_name'] = '';
			}
			if (isset($this->error['rent_per'])) {
				$data['error_rent_per'] = $this->error['rent_per'];
			} else {
				$data['error_rent_per'] = '';
			}
			if (isset($this->error['contact'])) {
				$data['error_contact'] = $this->error['contact'];
			} else {
				$data['error_contact'] = '';
			}
			if (isset($this->error['address'])) {
				$data['error_address'] = $this->error['address'];
			} else {
				$data['error_address'] = '';
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
				'href' => $this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);

			if (!isset($this->request->get['company_id'])) {
				$data['action'] = $this->url->link('rent/company/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			} else {
				$data['action'] = $this->url->link('rent/company/edit', 'token=' . $this->session->data['token'] . '&company_id=' . $this->request->get['company_id'] . $url, 'SSL');
			}

			$data['cancel'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'] . $url, 'SSL');

			if (isset($this->request->get['company_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$fund_info = $this->model_rent_company->getCompany($this->request->get['company_id']);
			}

            $data['tcompanys'] = $this->model_rent_company->getTotalCompanys();


			$data['token'] = $this->session->data['token'];

			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
			} elseif (!empty($fund_info)) {
				$data['name'] = $fund_info['name'];
			} else {
				$data['name'] = '';
			}
			if (isset($this->request->post['rent_per'])) {
				$data['rent_per'] = $this->request->post['rent_per'];
			} elseif (!empty($fund_info)) {
				$data['rent_per'] = $fund_info['rent_per'];
			} else {
				$data['rent_per'] = '';
			}
			if (isset($this->request->post['contact'])) {
				$data['contact'] = $this->request->post['contact'];
			} elseif (!empty($fund_info)) {
				$data['contact'] = $fund_info['contact'];
			} else {
				$data['contact'] = '';
			}

			if (isset($this->request->post['address'])) {
				$data['address'] = $this->request->post['address'];
			} elseif (!empty($fund_info)) {
				$data['address'] = $fund_info['address'];
			} else {
				$data['address'] = '';
			}


            $this->load->model('user/user');
            $this->load->model('tool/image');
            $user_info = $this->model_user_user->getUser($this->user->getId());
            if ($user_info) {
                $data['firstname'] = $user_info['firstname'];
                $data['lastname'] = $user_info['lastname'];
                $data['username'] = $user_info['username'];
                $data['user_group'] = $user_info['user_group'] ;
                if (is_file(DIR_IMAGE . $user_info['image'])) {
                    $data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
                } else {
                    $data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
                }
            } else {
                $data['username'] = '';
                $data['image'] = '';
            }


            $data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');


			$this->response->setOutput($this->load->view('rent/company_list.tpl', $data));
		}

		protected function validateForm()
		{
			if (!$this->user->hasPermission('modify', 'rent/company')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}

			if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
				$this->error['name'] = $this->language->get('error_name');
			}

			return !$this->error;
		}

		protected function validateDelete()
		{
			if (!$this->user->hasPermission('modify', 'rent/company')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}


			return !$this->error;
		}

		public function autocomplete()
		{
			$json = array();

			if (isset($this->request->get['filter_name'])) {
				$this->load->model('rent/company');

				$filter_data = array(
					'filter_name' => $this->request->get['filter_name'],
					'start' => 0,
					'limit' => 5
				);

				$results = $this->model_rent_company->getCompanys($filter_data);

				foreach ($results as $result) {
					$json[] = array(
						'company_id' => $result['company_id'],
						'name' => strip_tags(html_entity_decode($result['fname'], ENT_QUOTES, 'UTF-8'))
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