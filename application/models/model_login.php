<?php 

class model_login extends CI_Model {
	public function getData() {
		$data = $this->db->get('tb_login')->result();
		
		echo "<pre>";
		var_dump($data);
	} 
}

 ?>