<?php 
class Penerimaan_SM extends CI_Controller {

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
	
	public function insertSM(){
		$tanggal_terima 		= $this->input->post('tanggal_terima');
		$nama_wajib_pajak 		= $this->input->post('nama_wajib_pajak');
		$npwp 					= $this->input->post('npwp');
		$perihal 				= $this->input->post('perihal');
		$nomor_surat 			= $this->input->post('nomor_surat');
		$tanggal_surat 			= $this->input->post('tanggal_surat');
		$keterangan 			= $this->input->post('keterangan');


		$data = array(
			"Tanggal_Terima"	 => $tanggal_terima,
			"Nama_Wajib_Pajak" 	 => $nama_wajib_pajak,
			"NPWP" 				 => $npwp,
			"Perihal" 			 => $perihal,
			"Nomor_Surat" 		 => $nomor_surat,
			"Tanggal_Surat" 	 => $tanggal_surat,
			"Keterangan" 		 => $keterangan,			
		);

		$insert = $this->db->insert('tb_penerimaan_sm',$data);

		redirect(base_url().'list-terima-sm');
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