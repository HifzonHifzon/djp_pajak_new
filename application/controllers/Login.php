<?php 

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login_view');
	}

	public function doLogin() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = [
			"Username"	=> $username, 
			"password"	=> md5($password)
		];

		$check = $this->db->get_where('tb_pegawai', $where);
		
		if ($check->num_rows() > 0) {

			$this->db->select('a.*, b.*');
			$this->db->from('tb_pegawai as a');
			$this->db->join('tb_grup_role as b', 'a.id_role = b.id_grup_role');
			$this->db->where(['a.Username'=> $username]);
			$data= $this->db->get()->result();
			
			$role_id = $data[0]->id_role;
			$create_session = [
				"username" => $data[0]->Username,
				"nama_petugas"=> $data[0]->Nama_Petugas,
				"role"	=> $data[0]->name_grup,
				"id_role"	=> $role_id,
				"id_pegawai"	=> $data[0]->id,
				
			];

			$this->session->set_userdata($create_session);
			
			$first_menu = $this->db->query("
					SELECT 
						b.link
					FROM tb_role_menu as a 
						inner join tb_main_menu as b on a.id_menu = b.id_menu
						inner join tb_grup_role as c on a.id_role  = c.id_grup_role
					WHERE a.id_role  = $role_id limit 1"
			)->result();

			redirect(base_url().$first_menu[0]->link);
		} else {
			redirect(base_url().'login');
		}
	}


	public function doLogout() {
		$this->session->sess_destroy();
	}
	
}

 ?>