<?php 

class Settings extends CI_Controller{ 


    function __construct(){
        parent::__construct();
        $this->load->model('AuthRoleMenu');
      
		if ($this->session->userdata('role') == '' ){
			redirect(base_url().'login');
		}

		$check  = $this->AuthRoleMenu->check();
        if ($check["status"] == false) {
            $data['result'] = array(
                "konten_file" => "Not_akses",
                "title" 	  => "Not Found Page",
            );
            $this->load->view('template/layout', $data );
        }

    }

    
	public function gantiPassword() {
		$id = $this->input->post('id');
		$new_password = $this->input->post('new_password');

		$where = ['id' => $id];
		$data = ["password" => md5($new_password)];

		$exec = $this->db->update('tb_pegawai',$data,$where);
		if($exec) {
            $data = [
                "status" => true,
                "title"  => "Berhasil",
                "pesan" => "Password Berhasil Di Update"
            ];
        } else {
            $data = [
                "status" => false,
                "title"  => "Gagal",
                "pesan" => "Password Berhasil Di Update"
            ];
        }
        
        echo json_encode($data);
	}

    public function index(){

        $id_pegawai = $this->session->userdata('id_pegawai');
        $list_petugas = $this->db->get_where('tb_pegawai', ["id"=> $id_pegawai])->result();

		$data['result'] = array(
			"konten_file" => "setting/setting",
			"title" 	  => "Setting",
			"result"	  => $list_petugas

		);

		$this->load->view('template/layout', $data );
        
    }
}


?>