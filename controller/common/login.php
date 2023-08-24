<?php
class ControllerCommonLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('common/login');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->session->data['token'] = md5(mt_rand());

			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0 || strpos($this->request->post['redirect'], HTTPS_SERVER) === 0 )) {
				$this->response->redirect($this->request->post['redirect'] . '&token=' . $this->session->data['token']);
			} else {
				$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_login'] = $this->language->get('text_login');
		$data['text_forgotten'] = $this->language->get('text_forgotten');

		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_login'] = $this->language->get('button_login');

		if ((isset($this->session->data['token']) && !isset($this->request->get['token'])) || ((isset($this->request->get['token']) && (isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token']))))) {
			$this->error['warning'] = $this->language->get('error_token');
		}

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

		$data['action'] = $this->url->link('common/login', '', 'SSL');

		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->get['route'])) {
			$route = $this->request->get['route'];

			unset($this->request->get['route']);
			unset($this->request->get['token']);

			$url = '';

			if ($this->request->get) {
				$url .= http_build_query($this->request->get);
			}

			$data['redirect'] = $this->url->link($route, $url, 'SSL');
		} else {
			$data['redirect'] = '';
		}

		if ($this->config->get('config_password')) {
			$data['forgotten'] = $this->url->link('common/forgotten', '', 'SSL');
		} else {
			$data['forgotten'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/login.tpl', $data));
	}

	protected function validate() {
		if (!isset($this->request->post['username']) || !isset($this->request->post['password']) || !$this->user->login($this->request->post['username'], $this->request->post['password'])) {
			$this->error['warning'] = $this->language->get('error_login');
		}

		return !$this->error;
	}

	public function check() {
		$route = '';

		if (isset($this->request->get['route'])) {
			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
		}

		$ignore = array(
			'common/login',
			'common/forgotten',
			'common/reset'
		);

		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return new Action('common/login');
		}

		if (isset($this->request->get['route'])) {
			$ignore = array(
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'
			);

			$config_ignore = array();

			if ($this->config->get('config_token_ignore')) {
				$config_ignore = unserialize($this->config->get('config_token_ignore'));
			}

			$ignore = array_merge($ignore, $config_ignore);

			if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
				return new Action('common/login');
			}
		} else {
			if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
				return new Action('common/login');
			}
		}
	}

    public function apiLogin(){
        $keys = array(
            'username',
            'password',
        );
        $this->load->model('rent/customer');
        $this->load->model('rent/driver');
        $json = array();
        foreach ($keys as $key) {
            if (!isset($this->request->post[$key])) {
                $this->request->post[$key] = '';
            }
        }
        if ($this->request->post['username'] == '') {
            $json['message']['username'] = "Enter Username";
        }
        if ($this->request->post['password'] == '') {
            $json['message']['password'] = "Enter Password";
        }

        if (!$json) {
            $data = $this->request->post;

            $user_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($data['username']) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($data['password']) . "'))))) OR password = '" . $this->db->escape(md5($data['password'])) . "') AND status = '1'")->row;


            if($user_info) {
                $json['username'] = $user_info['username'];
                $json['firstname'] = $user_info['firstname'];
                $json['lastname'] = $user_info['lastname'];
                $json['email'] = $user_info['email'];
                $json['status'] = "1";
                $json['message'] = "You Have Successfully Logged In";
            }else{
                $json['message'] = 'Invalid Username and Password';
                $json['status'] = '0';
            }
            
            $filter_data = array();
            $results = $this->model_rent_customer->getCustomers($filter_data);
            $json['customers'] = array();
            foreach ($results as $result) {
                $json['customers'][] = array(
                    'customer_id' => $result['customer_id'],
                    'fname' => $result['fname'],
                    'lname' => $result['lname'],
                    'email' => $result['email'],
                    'contact' => $result['contact'],
                    'address' => $result['address'],
                    'date_added' => date_format(date_create($result['date_added']),'d-m-Y'),
                    'status' => $result['status'],
                    'sort_order' => $result['sort_order']
                );
            }
            $results = $this->model_rent_driver->getDrivers($filter_data);
            $json['drivers'] = array();
            foreach ($results as $result) {
                $json['drivers'][] = array(
                    'driver_id' => $result['driver_id'],
                    'fname' => $result['fname'],
                    'lname' => $result['lname'],
                    'email' => $result['email'],
                    'contact' => $result['contact'],
                    'address' => $result['address'],
                    'date_added' => date_format(date_create($result['date_added']),'d-m-Y'),
                    'status' => $result['status'],
                    'sort_order' => $result['sort_order']
                );
            }

        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function addCustomer(){
        $customer_id='';
        if(isset($this->request->post['customer_id'])) {
            $customer_id = $this->request->post['customer_id'];
        }
        if (true) {
            $this->request->server['REQUEST_METHOD'] = 'POST';
            if ($this->request->server['REQUEST_METHOD'] == 'POST') {
                if (isset($customer_id) && $customer_id == '') {
                    $customer_id = $this->addCustomers($this->request->post);

                    $json['status'] = "1";
                    $json['customer_id'] = $customer_id;
                } else {
                    $this->editCustomers($this->request->post, $customer_id);
                    $json['customer_id'] = $customer_id;
                    $json['status'] = "1";
                }

            }

        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function addDriver(){
        $driver_id='';
        if(isset($this->request->post['driver_id'])) {
            $driver_id = $this->request->post['driver_id'];
        }
        if (true) {
            $this->request->server['REQUEST_METHOD'] = 'POST';
            if ($this->request->server['REQUEST_METHOD'] == 'POST') {
                if (isset($driver_id) && $driver_id == '') {
                    $driver_id = $this->addDrivers($this->request->post);

                    $json['status'] = "1";
                    $json['driver_id'] = $driver_id;
                } else {
                    $this->editDrivers($this->request->post, $driver_id);
                    $json['driver_id'] = $driver_id;
                    $json['status'] = "1";
                }

            }

        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function addCustomers($data) {
        if(!isset($data['sort_order'])){
            $data['sort_order']=0;
        }
        $this->event->trigger('pre.admin.add.customer', $data);
        $sql =  "INSERT INTO " . DB_PREFIX . "customer
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "',
		 date_added = now()";
        $this->db->query($sql);
        $loan_id = $this->db->getLastId();
        $this->event->trigger('post.admin.add.customer', $loan_id);
        return $loan_id;
    }
    public function editCustomers($customer_id, $data) {
        if(!isset($data['sort_order'])){
            $data['sort_order']=0;
        }
        $this->event->trigger('pre.admin.edit.customer', $data);
        $sql =  "Update  " . DB_PREFIX . "customer
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "' where  customer_id = '" . (int)$customer_id . "' ";

        $this->db->query($sql);
        $this->cache->delete('customer');
        $this->event->trigger('post.admin.edit.customer');
    }

    public function addDrivers($data) {
        if(!isset($data['sort_order'])){
            $data['sort_order']=0;
        }
        $this->event->trigger('pre.admin.add.driver', $data);
        $sql =  "INSERT INTO " . DB_PREFIX . "driver
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "',
		 date_added = now()";
        $this->db->query($sql);
        $loan_id = $this->db->getLastId();
        $this->event->trigger('post.admin.add.driver', $loan_id);


        return $loan_id;
    }
    public function editDrivers($driver_id, $data) {
        if(!isset($data['sort_order'])){
            $data['sort_order']=0;
        }
        $this->event->trigger('pre.admin.edit.driver', $data);
        $sql =  "Update  " . DB_PREFIX . "driver
		SET fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		contact = '" . $this->db->escape($data['contact']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		status = '".$data['status']."' ,
		 sort_order = '" . (int)$data['sort_order'] . "' where  driver_id = '" . (int)$driver_id . "' ";

        $this->db->query($sql);
        $this->cache->delete('driver');
        $this->event->trigger('post.admin.edit.driver');
    }
}