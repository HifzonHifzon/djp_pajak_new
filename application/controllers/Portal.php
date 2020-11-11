<?php 


class Portal extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Portal_model');
    }

    public function index(){
        $pegawai = $this->db->query("SELECT * FROM tb_pegawai where id_role = 3")->result();
		$data['result'] = array(
			"konten_file" => "sm_pos/sm_pos_view",
			"title" 	  => "Surat Masuk POS",
			"pegawai"	  => $pegawai
 		);
        $this->load->view('portal_view');
    }

	function get_data_user()
	{
		$wajib_pajak = $this->input->post('wajib_pajak');
		
		$list = $this->Portal_model->get_datatables($wajib_pajak);
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
			"recordsTotal" => $this->Portal_model->count_all(),
			"recordsFiltered" => $this->Portal_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

}
