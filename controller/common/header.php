<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_order'] = $this->language->get('text_order');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');






        $data['customer'] =false;
        $data['driver'] =false;
        $data['user'] =false;
        $data['setting'] =false;
        $data['user_group'] =false;
        if ($this->user->hasPermission('access', 'rent/customer')) {
            $data['menu_customer'] = $this->url->link('rent/customer', 'token=' . $this->session->data['token'], 'SSL');
        }
        if ($this->user->hasPermission('access', 'rent/driver')) {
            $data['menu_driver'] = $this->url->link('rent/driver', 'token=' . $this->session->data['token'], 'SSL');
        }
        if ($this->user->hasPermission('access', 'user/user')) {
            $data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
        }
        if ($this->user->hasPermission('access', 'rent/company')) {
            $data['company'] = $this->url->link('rent/company', 'token=' . $this->session->data['token'], 'SSL');
        }
        if ($this->user->hasPermission('access', 'user/user')) {
            $data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
        }
        if ($this->user->hasPermission('access', 'user/user_permission')) {
            $data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
        }
		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
            $data['logged'] = true;

            $data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
            $data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');

        }

		return $this->load->view('common/header.tpl', $data);
	}
}