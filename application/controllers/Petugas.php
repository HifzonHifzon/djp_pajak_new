<?php 
class Petugas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$check  = $this->AuthRoleMenu->check();
        if ($check["status"] == false) {
            $data['result'] = array(
                "konten_file" => "Not_akses",
                "title" 	  => "Not Found Page",
            );
            $this->load->view('template/layout', $data );
        }
	}

	public function index(){

		$list_petugas = $this->db->get('tb_pegawai')->result();

		$data['result'] = array(
			"konten_file" => "petugas/petugas_view",
			"title" 	  => "Petugas",
			"result"	  => $list_petugas

		);

		$this->load->view('template/layout', $data );
	}

	public function insertPetugas(){
		$nama_petugas = $this->input->post('nama_petugas');
		$nip = $this->input->post('nip');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$username = $this->input->post('username');

		$data = array(
			"Nama_Petugas" 	=> $nama_petugas,
			"NIP" 			=> $nip,
			"No_Telpon" 	=> $no_telp,
			"Email" 		=> $email,
			"Alamat" 		=> $alamat,
			"Username" 		=> $username,		
		);

		$insert = $this->db->insert('tb_pegawai',$data);
		redirect(base_url().'petugas');
	}

	public function getPetugasById() {
		$id = $this->input->post('id_petugas_txt');
		$getPetugas = $this->db->get_where('tb_pegawai',["id" => $id])->result();
		echo json_encode($getPetugas);
	}

	public function EditPetugas(){
		$nama_petugas_txt = $this->input->post('nama_petugas_txt');
		$nip_txt = $this->input->post('nip_txt');
		$no_telp_txt = $this->input->post('no_telp_txt');
		$email_txt = $this->input->post('email_txt');
		$alamat_txt = $this->input->post('alamat_txt');
		$username_txt = $this->input->post('username_txt');
		$id_txt = $this->input->post('id_txt');

		$data = [
			"Nama_Petugas" => $nama_petugas_txt,
			"NIP" => $nip_txt,
			"No_Telpon" => $no_telp_txt,
			"Email" => $email_txt,
			"Alamat" => $alamat_txt,
			"Username" => $username_txt,
		];

		$where = [
			"id" => $id_txt
		];

		$eksekusi = $this->db->update('tb_pegawai', $data, $where);

		if ($eksekusi) {
			$data = [
				"status" => true, 
				"title"  => "Berhasil",	
				"pesan"  => "Data Petugas berhasil di Update"
			];
		} else {
			$data = [
				"status" => false, 
				"title"  => "Gagal",	
				"pesan"  => "Data Petugas gagal di Update"
			];
		}

		echo json_encode($data);

	}

	public function prosesDelete(){
		$id = $this->input->post('id');

		$this->db->where('id',$id);
		$delete = $this->db->delete('tb_pegawai');
	}


}

?>