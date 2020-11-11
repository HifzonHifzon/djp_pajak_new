<?php

 class AuthRoleMenu extends CI_Model {
    
    public function check(){
       $role = $this->session->userdata('id_role');
       $uri_segment = $this->uri->segment(1);
       
        // search menu
        $this->db->select('id_menu');
        $this->db->from('tb_main_menu'); 
        $this->db->where(["link" => $uri_segment]);
        $menu_id = $this->db->get()->result();
        $menu_id = $menu_id[0]->id_menu;

        $check_role = $this->db->query("select * from tb_role_menu WHERE id_role = $role and id_menu = $menu_id ")->result();
    
        if (sizeof($check_role) == 0) {
            $data = ["status" => false];
            return $data;
        }
        
        $data = ["status" => true];
        return $data;
    }
}

?>