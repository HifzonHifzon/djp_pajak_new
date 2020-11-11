<?php 

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();

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
  
	public function index() {
		$data['result'] = array(
			"konten_file" => "dashboard_view",
			"title" 	  => "Dashboard",
		);
		$this->load->view('template/layout', $data );
	}

	public function setting() {

		$data['result'] = array(
			"konten_file" => "setting_view"
		);
		$this->load->view('template/layout', $data );
	}

	public function logout() {

		$data['result'] = array(
			"konten_file" => "logout_view"
		);
		$this->load->view('template/layout', $data );
	}
}	
 ?>