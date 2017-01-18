<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_blank extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();

        $data_view['content_layout'] = $this->load->view('v_blank', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

}
