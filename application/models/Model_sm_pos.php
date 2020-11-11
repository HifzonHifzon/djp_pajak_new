<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_sm_pos extends CI_Model {
 
    var $table = 'tb_penerimaan_sm';
    var $column_order = array(null, 'Nama_Wajib_Pajak','NPWP','Tanggal_Terima','Perihal','Nomor_Surat','Tanggal_Surat','Keterangan','Status','Disposisi','Nama_Perihal','Nama_Perihal'); //set column field database for datatable orderable
    var $column_search = array('Nama_Wajib_Pajak','NPWP','Tanggal_Terima','Perihal','Nomor_Surat','Tanggal_Surat','Keterangan','Status','Disposisi','Nama_Perihal','Nama_Perihal'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         

        // Query Data
        $this->db->select('
                        a.id as id, 
                        a.Tanggal_Terima as Tanggal_Terima, 
                        a.Nama_Wajib_Pajak as Nama_Wajib_Pajak, 
                        a.NPWP as NPWP, 
                        b.nama_perihal as nama_perihal, 
                        a.Nomor_Surat as Nomor_Surat, 
                        a.Tanggal_Surat as Tanggal_Surat, 
                        a.Keterangan as Keterangan, 
                        a.Status as Status, 
                        a.Disposisi as Disposisi, 
                        a.To_Disposisi as To_Disposisi, 
                        b.nama_perihal as Nama_Perihal');
        $this->db->from('tb_penerimaan_sm as a');
        $this->db->join('tb_perihal as b','a.Perihal = b.id_perihal');
        // tutup query data



        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($tanggal)
    {       
        
        $role = $this->session->userdata('role');
        $id_pegawai = $this->session->userdata('id_pegawai');

        $this->_get_datatables_query();     
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);


        if ($role == 'petugas') {
            $this->db->or_where('a.To_Disposisi', $id_pegawai);
        }


        /*jika tanggal tidak ksoong artinya dia ada tanggalnya se*/
        if ($tanggal != null) {
                $this->db->where('a.Tanggal_Surat', $tanggal );
        }
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        $role = $this->session->userdata('role');

        // hitung count / jumlah query data 
        $this->db->select('
                        a.Tanggal_Terima as Tanggal_Terima, 
                        a.Nama_Wajib_Pajak as Nama_Wajib_Pajak, 
                        a.NPWP as NPWP, 
                        a.Perihal as Perihal, 
                        a.Nomor_Surat as Nomor_Surat, 
                        a.Tanggal_Surat as Tanggal_Surat, 
                        a.Keterangan as Keterangan, 
                        a.Status as Status, 
                        a.Disposisi as Disposisi, 
                        b.nama_perihal as Nama_Perihal');
        $this->db->from('tb_penerimaan_sm as a');
        $this->db->join('tb_perihal as b','a.Perihal = b.id_perihal');
        if ($role == 'petugas') {
            $this->db->or_where('a.To_Disposisi', $id_pegawai);
        }
        
        return $this->db->count_all_results();
    }

    public function execDisposisiToPelayanan($id) {
        $data = ['Disposisi' => 1 ];
        $exec = $this->db->update('tb_penerimaan_sm',$data, $id);
        return $exec;
    }
 
}