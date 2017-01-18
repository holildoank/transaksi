<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
        modules::run('base/c_login/is_logged_in');

		//session menu
		$data_sess = array(
			base_url().'menu_parent' => 'dashboard',
			base_url().'menu_child' => 'dashboard',
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
    }

    function index()
    {
        $data = array();
        $this->template->load('base/template_dashboard','v_dashboard', $data);
    }

}
