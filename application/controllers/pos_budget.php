<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos_budget extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'table', 'session'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('pos_budget_model');
    }

    public function index()
    {
        $data_tpl = array();
        $list = $this->pos_budget_model->get_list();
        
        $this->table->add_row(
            anchor(site_url('pos_budget/add'), 'Add new').'&nbsp;'
        );
        $data_tpl['nav'] = $this->table->generate();
        
        $this->table->set_heading('ID', 'Alokasi', 'Tahun', 'Bulan', 'Amount', 'Action');

        foreach($list->result() as $row)
        {
            $action = anchor(site_url('pos_budget/edit/'.$row->id), 'Edit').'&nbsp;';
            $action .= anchor(site_url('pos_budget/delete/'.$row->id), 'Delete');
            $this->table->add_row($row->id, $row->alokasi, $row->tahun, $row->bulan, $row->amount, $action );
        }
        
        $data_tpl['list'] = $this->table->generate();

        $data_tpl['content'] = 'hoho';
        $this->load->view('pos_budget_list', $data_tpl);
    }

    public function edit()
    {
        $data_tpl = array();
        
        $asc_arr = $this->uri->uri_to_assoc(2);
        $id = (isset($asc_arr['edit'])) ? $asc_arr['edit'] : '';
            
        $row = $this->pos_budget_model->get_list($id);

        $this->form_validation->set_rules('alokasi', 'Alokasi', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|exact_length[4]');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('amount', 'Amount', '');
        
        if ($this->form_validation->run())
        {
            $data = array(
                'alokasi'=>$this->input->post('alokasi'),
                'tahun'=>$this->input->post('tahun'),
                'bulan'=>$this->input->post('bulan'),
                'amount'=>$this->input->post('amount'),
            );
            
            $result = $this->pos_budget_model->edit($id, $data);
            
            if ($result) redirect(site_url('pos_budget'), 'refresh');
        }
        
        $data_tpl['row'] = $row->row();
        
        $this->load->view('pos_budget_form', $data_tpl);
    }

    public function add()
    {
        $data_tpl = array();

         $this->form_validation->set_rules('alokasi', 'Alokasi', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|exact_length[4]');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('amount', 'Amount', '');
        
        if ($this->form_validation->run())
        {
            $data = array(
                'alokasi'=>$this->input->post('alokasi'),
                'tahun'=>$this->input->post('tahun'),
                'bulan'=>$this->input->post('bulan'),
                'amount'=>$this->input->post('amount'),
            );
            
            $result = $this->pos_budget_model->add($data);

            if ($result) redirect(site_url('pos_budget'), 'refresh');
        }
        
        $this->load->view('pos_budget_form', $data_tpl);
    }

    public function delete()
    {
        $asc_arr = $this->uri->uri_to_assoc(2);
        $id = (isset($asc_arr['delete'])) ? $asc_arr['delete'] : '';
        $result = $this->pos_budget_model->delete($id);

        redirect(site_url('pos_budget'), 'refresh');
    }
}