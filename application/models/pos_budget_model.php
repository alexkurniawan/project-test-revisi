<?php
class Pos_budget_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }

    public function get_list($id='')
    {
        if ($id)
            $this->db->where('id', $id); 
        
        $query = $this->db->get('pos_budget');

        return $query;
    }
    
    public function edit($id, $data)
    {
        $this->db->where('id', $id);
        
        $result = $this->db->update('pos_budget', $data); 

        return $result;
    }
    
    public function add($data)
    {       
        $result = $this->db->insert('pos_budget', $data); 

        return $result;
    }
    
    public function delete($id)
    {       
        $this->db->where('id', $id);
        $result = $this->db->delete('pos_budget'); 

        return $result;
    } 
}