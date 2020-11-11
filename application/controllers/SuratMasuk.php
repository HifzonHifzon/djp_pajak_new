<?php 

class SuratMasuk extends CI_Controller {
  	
  	public function __construct() {
  		parent::__construct();

		$this->load->model('Model_sm_pos');
	
		if ($this->session->userdata('role') == '' ){
			redirect(base_url().'login');
		}

		$check  = $this->AuthRoleMenu->check();
        // if ($check == false) {
        //     $data['result'] = array(
        //         "konten_file" => "Not_akses",
        //         "title" 	  => "Not Found Page",
        //     );
        //     $this->load->view('template/layout', $data );
        // }

  	}

	function index(){
		$pegawai = $this->db->query("SELECT * FROM tb_pegawai where id_role = 3")->result();
		$data['result'] = array(
			"konten_file" => "sm_pos/sm_pos_view",
			"title" 	  => "Surat Masuk POS",
			"pegawai"	  => $pegawai
 		);
		$this->load->view('template/layout', $data );
	}

	function get_data_user()
	{
		$tanggal = $this->input->post('tanggal');
		
		$list = $this->Model_sm_pos->get_datatables($tanggal);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row['id'] = $field->id;
			$row['NO'] = $no;
			$row['Nama_Wajib_Pajak'] = $field->Nama_Wajib_Pajak;
			$row['NPWP'] = $field->NPWP;
			$row['nama_perihal'] = $field->nama_perihal;
			$row['Nomor_Surat'] = $field->Nomor_Surat;
			$row['Tanggal_Surat'] = $field->Tanggal_Surat;
			$row['Keterangan'] = $field->Keterangan;
			$row['Disposisi'] = $field->Disposisi;
			$row['Status'] = $field->Status;
			$row['Tanggal_Terima'] = $field->Tanggal_Terima;;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Model_sm_pos->count_all(),
			"recordsFiltered" => $this->Model_sm_pos->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
    }
    
    public function viewPenerimanSuratMasuk(){

		$list_layanan 		= $this->db->get('tb_layanan')->result();
		$list_penerimaan_sm = $this->db->get('tb_penerimaan_sm')->result();

		$data['result']   = array(
			"konten_file" => "penerimaan_sm/penerimaan_sm_view",
			"title" 	  => "Penerimaan Surat Masuk POS",
			"result"	  => $list_penerimaan_sm,
			"layanan" 	  => $list_layanan
		);

		$this->load->view('template/layout', $data );
	}

	public function getDetailPerihal(){
		$id_layanan = $this->input->post('id_layanan_text');
		$this->db->where('id_layanan', $id_layanan);
			$exec = $this->db->get('tb_perihal')->result();
			echo json_encode($exec);		
	}

	function SuratSelesai() {
		$id_surat = $this->input->post('id_surat');
		$update = ['Status' => 1];
		$exec = $this->db->update('tb_penerimaan_sm', $update, ['id' => $id_surat]);

		if($exec) {
            $data = [
                "status" => true,
                "title"  => "Berhasil",
                "pesan" => "Surat Telah Selesai Dikerjakan"
            ];
        }
        
        echo json_encode($data);
	}

	public function disposisiKePetugas () {
		$id_pegawai = $this->input->post('id_pegawai');
		$id_surat = $this->input->post('id_surat');
		
		$update = ["Disposisi" => 2, "To_Disposisi" => $id_pegawai, "Status" => 0,];
		$exec = $this->db->update('tb_penerimaan_sm', $update, ['id' => $id_surat]);

		
        if($exec) {
            $data = [
                "status" => true,
                "title"  => "Berhasil",
                "pesan" => "Disposisi ke petugas berhasil"
            ];
        } else {
            $data = [
                "status" => false,
                "title"  => "Gagal",
                "pesan" => "Disposisi ke petugas gagal"
            ];
        }
        
        echo json_encode($data);
	}
	
	public function insertSM(){
		$tanggal_terima 		= $this->input->post('tanggal_terima');
		$nama_wajib_pajak 		= $this->input->post('nama_wajib_pajak');
		$npwp 					= $this->input->post('npwp');
		$perihal 				= $this->input->post('perihal');
		$nomor_surat 			= $this->input->post('nomor_surat');
		$tanggal_surat 			= $this->input->post('tanggal_surat');
		$keterangan 			= $this->input->post('keterangan');


		$data = array(
			"Tanggal_Terima"	 => date('Y-m-d', strtotime($tanggal_terima)),
			"Nama_Wajib_Pajak" 	 => $nama_wajib_pajak,
			"NPWP" 				 => $npwp,
			"Perihal" 			 => $perihal,
			"Nomor_Surat" 		 => $nomor_surat,
			"Tanggal_Surat" 	 => $tanggal_surat,
			"Keterangan" 		 => $keterangan,			
		);

		$insert = $this->db->insert('tb_penerimaan_sm',$data);

        if($insert) {
            $data = [
                "status" => true,
                "title"  => "Berhasil",
                "pesan" => "Surat Masuk Berhasil Di Input"
            ];
        } else {
            $data = [
                "status" => false,
                "title"  => "Gagal",
                "pesan" => "Surat Masuk Gagal Di Input"
            ];
        }
        
        echo json_encode($data);
    }
	
	public function disposisiToPelayanan(){ 
		$id = $this->input->post();
		$exec = $this->Model_sm_pos->execDisposisiToPelayanan($id);
		if ($exec) {
			$data = [
				"status" => true, 
				"title"	=> "Berhasil",
				"pesan"	=> "Data berhasil di Disposisi Ke Sekretaris Pelayanan"
			];
		} else {
			$data = [
				"status" => false, 
				"title"	=> "Berhasil",
				"pesan"	=> "Data gagal di Disposisi Ke Sekretaris Pelayanan"
			];
		}

		echo json_encode($data);
	}
	public function prosesDelete(){
		$id = $this->input->post('id');

		$this->db->where('id',$id);
		$delete = $this->db->delete('tb_penerimaan_sm');
	}

	public function approvalSuratMasuk(){
		$id = $this->input->post('id');

		$where = ["id" => $id];
		$data  = ["status" =>1];

		$this->db->where($where);
		$exec  = $this->db->update('tb_penerimaan_sm', $data);
	}

}	
 ?>