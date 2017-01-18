<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_panel extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_panel');
        $this->load->model('base/m_base');
    }

    public function reload_notif_eventtodo()
    {
        $data = [];

        $data_event = $this->m_panel->get_event();
        $data_todo = $this->m_panel->get_todo();
        $data['jml_eventtodo'] = $data_event->num_rows() + $data_todo->num_rows();
        $data['data_event'] = $data_event;
        $data['data_todo'] = $data_todo;
        $this->load->view('v_notif_eventtodo', $data);
    }

    public function make_event_read()
    {
        $data = array(
            'event_read' => 1
        );
        $filter = array('event_id' => $this->input->post('id'));
        $update_event = $this->m_base->update_data('t_event', $data, $filter);

        $data_event = $this->m_base->get_data('t_event', $filter)->row();
        if($data_event->module_id==100){
            $result['next'] = site_url().'/lead/read/'.$data_event->event_foreignkey;
        }elseif ($data_event->module_id==200) {
            $result['next'] = site_url().'/corp/read/'.$data_event->event_foreignkey;
        }elseif ($data_event->module_id==300) {
            $result['next'] = site_url().'/contact/read/'.$data_event->event_foreignkey;
        }elseif ($data_event->module_id==400) {
            $result['next'] = site_url().'/opportunity/read/'.$data_event->event_foreignkey;
        }
        $result['stat'] = true;

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function make_todo_read()
    {
        $data = array(
            'todo_read' => 1
        );
        $filter = array('todo_id' => $this->input->post('id'));
        $update_event = $this->m_base->update_data('t_todo', $data, $filter);
        $this->output->set_content_type('application/json')->set_output(json_encode($update_event));
    }

}
