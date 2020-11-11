<?php

 class AuthRoleMenu extends CI_Model {
    
    public function check(){
       $role = $this->session->userdata('id_role');
       $uri_segment = $this->uri->segment(1);

        
        $check_menu = $this->db->query(
            'SELECT 
                    b.link
            FROM tb_role_menu as a 
            inner join tb_main_menu as b on a.id_menu = b.id_menu 
            inner join tb_grup_role as c on a.id_role = c.id_grup_role 
            WHERE a.id_role = "'.$role.'" and b.link = "'.$uri_segment.'"  '
        )->result();


        if (sizeof($check_menu) == 0) {
            return false;
        } else {
            return true;
        }
        
       
    }
}

?>