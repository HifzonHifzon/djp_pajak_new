<?php 
  $role = $this->session->userdata('role');
  $status = 2;
?>


<div class="card card-dark">
  <div class="card-header">
   <h3 class="card-title">Data Petugas</h3>
     <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
     </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="table" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Terima</th>
        <th>Nama Wajib Pajak</th>
        <th>NPWP</th>
        <th>Perihal</th>
        <th>Nomor Surat</th>
        <th>Tanggal Surat</th>
        <th>Keterangan</th>
        <th>Action</th>    
        <th>Status</th>                     
      </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>





<!-- Disposisi ke Petugas dari Sekretaris Pelayanan -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"></button>
        <h4 class="modal-title">Disposisi Ke Pelayanan</h4>
      </div>
      <div class="modal-body">
        <p>Petugas</p>
        <form id="data_">
        <select name="pegawai" class="form-control" id="pegawai">  
          <option> Pilih Petugas </option>
          <?php foreach ($result['pegawai'] as $key) {?>
              <option value="<?php echo $key->id ?>"><?php echo $key->Nama_Petugas; ?></option>
          <?php } ?>
        </select>
          
        <input type="hidden" value="" class="form-control" id="id_surat">
        </form>
        <button class="btn btn-primary btn-sm" style="margin:10px" onClick="return submitdisposisiToPetugas(); "> Disposisi </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">


function submitdisposisiToPetugas() {
    var id_pegawai = $('#pegawai').val();
    var id_surat = $('#id_surat').val();

    $.ajax({
      url : "<?php echo base_url().'SuratMasuk/disposisiKePetugas' ?>",
      data : {
        id_pegawai : id_pegawai,
        id_surat : id_surat
      },
      type : "POST",
      success:function (res) {
        var data = JSON.parse(res);
        if (data.status ==  true ){
                  swal({title: data.title , text: data.pesan, type: 
                      "success"}).then(function(){ 
                        location.reload();
                        }
                      );
                    }
      },
      error:function() {
        alert('err')

      }
    })
}
  function getSMPOS(){

      var tanggal = $('#tanggal').val();

      if (tanggal === '' ){
        var date_txt = '';

      } else {
         var date_txt = tanggal;
      }


              //datatables
              table = $('#table').DataTable({ 
                  "destroy": true,
                  "processing": true, 
                  "serverSide": true, 
                  "order": [], 
                   
                  "ajax": {
                      "url": "<?php echo site_url('SuratMasuk/get_data_user')?>",
                      "type": "POST",
                      "data" : {
                        tanggal : date_txt
                      }
                  },


                    columns: [
                          {data: 'NO'},
                          {data: 'Tanggal_Terima'},
                          {data: 'Nama_Wajib_Pajak'},
                          {data: 'NPWP'},
                          {data: 'nama_perihal'},
                          {data: 'Nomor_Surat'},
                          {data: 'Tanggal_Surat'},
                          {data: 'Keterangan'},

                           {
                              data: "NPWP",
                              "render": function ( data, type, row ) {
                                    <?php if ($role == 'sekretariat') { ?>
                                               if (row.Disposisi  == 0) {
                                                  var action =  "<a href='' class='btn btn-warning btn-xs'> <i class='fa fa-pen'></i> Edit</a>";
                                                      action  +="<a onclick ='return deleteData("+row.id+")' class='btn btn-danger btn-xs' style='color:white'> <i class='fa fa-trash'></i> Hapus </a> "
                                                      action  +="<a onclick ='return disposisi("+row.id+")' class='btn btn-success btn-xs' style='color:white'> <i class='fa fa-trash'></i> Disposisi </a> "
                                                      return action;
                                               } else {
                                                    return  "-";
                                               }
                                    <?php } ?>

                                    <?php if ($role == 'sekretariat_pelayanan') { ?>
                                               if (row.Disposisi  == 1) {
                                  
                                                     var action  ="<a onclick ='return disposisiKePetugas("+row.id+")' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal' style='color:white'> Disposisi Petugas </a> "
                                                      return action;
                                               } else {
                                                    return  "<h5 style='color:blue; font-size:12px;'> Sudah didisposisi Ke Petugas</h5> ";

                                               }
                                    <?php } ?>

                                    <?php if ($role == 'petugas') { ?>
                                               if (row.Disposisi == 2 && row.Status == 0) {
                                                  var action =  "<button class='btn btn-warning btn-xs' onClick='konfirmasiSelesai("+row.id+")'> Konfirmasi Telah Selesai </button>";
                                                      return action;
                                               } else {
                                                    return  "<h5 style='color:blue; font-size:12px;'> Selesai </h5> ";

                                               }

                                    <?php } ?>
                              }

                          },
                          {
                              data: "NPWP",
                              "render": function ( data, type, row ) {
                                  <?php if ($role == 'sekretariat_pelayanan') { ?>
                                               if (row.Disposisi  == 1 || row.Disposisi == 0) {
                                                  var action =  "<a href='' class='btn btn-warning btn-xs'> Belum Disposisi ke Petugas</a>";
                                                      return action;
                                               } else {
                                                var action =  "<button class='btn btn-success btn-xs'> Sudah Disposisi </button>";
                                                return action;

                                               }

                                               if (row.Disposisi  == 2 ) {
                                                      var action =  " <button class='btn btn-success btn-xs'> Sudah Disposisi ke Petugas</button>";
                                                      return action;
                                               } else {
                                                var action =  " <button class='btn btn-success btn-xs'> Sudah Disposisi ke Petugas</button>";
                                                      return action;
                                               }

                                             
                                  <?php } ?>

                                  <?php if ($role == 'sekretariat') { ?>
                                               if (row.Disposisi  == 0) {
                                                  var action =  "<button class='btn btn-warning btn-xs'> Belum Disposisi </button>";
                                                      return action;
                                               } else {
                                                    return  "<h5 style='color:blue; font-size:12px;'> Sudah didisposisi</h5> ";

                                               }

                                               if (row.Disposisi  == 2) {
                                                  return '<button class="btn btn-warning btn-sm"> Sudah Diposisi</button>';
                                               } else{
                                                  return '<button class="btn btn-success btn-sm"> Sudah Diterima</button>';
                                               }
                                    <?php } ?>

                                    <?php if ($role == 'petugas') { ?>
                                               if (row.Disposisi  == 2 && row.Status == 0) {
                                                      var action =  "<a href='' class='btn btn-warning btn-xs'> Masih Proses Petugas </a>";
                                                      return action;
                                               } 


                                               if (row.Disposisi  == 2 && row.Status == 1) {
                                                      var action =  "<a href='' class='btn btn-warning btn-xs'> Selesai </a>";
                                                      return action;
                                               } 

                                              
                                              
                                              
                                    <?php } ?>
                              }

                          },
                      ],
       
              });

              // $('#table').DataTable.destroy();

  }



// disposisi from sekretaris ke sekretaris pelayanan
 function disposisi(id_surat) {
  swal({
        text: "Apakah Anda yakin akan mendisposisi surat ini ke Sekretaris Pelayanan ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url : "<?php echo base_url().'SuratMasuk/disposisiToPelayanan' ?>",
              data : {
                id : id_surat
              },
              type : "POST",
            success:function(res){
              var data = JSON.parse(res);
              
                if (data.status ==  true ){
                  swal({title: data.title , text: data.pesan, type: 
                      "success"}).then(function(){ 
                        location.reload();
                        }
                      );
                    }
                  

                },

              });
          
        } else {
          swal("Data masih tersimpan");
        }
      });
 } 

 function konfirmasiSelesai(id_surat){
  swal({
        text: "Apakah Anda yakin akan surat ini telah selesai?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url : "<?php echo base_url().'SuratMasuk/SuratSelesai' ?>",
              data : {
                id_surat : id_surat
              },
              type : "POST",
            success:function(res){
                    swal({ 
                    text:"Surat Telah selesai!",
                    type:"success",
                    showConfirmButton: true
                    }).then(function(){
                    window.location.reload();
                    })

                },

              });
          
        } else {
          swal("Data masih tersimpan");
        }
      });
 }

 function deleteData(id_surat){
    swal({
        text: "Apakah Anda yakin akan menghapus data ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url : "<?php echo base_url().'SuratMasuk/prosesDelete' ?>",
              data : {
                id : id_surat
              },
              type : "POST",
            success:function(res){
                    swal({ 
                    text:"Data telah dihapus!",
                    type:"success",
                    showConfirmButton: true
                    }).then(function(){
                    window.location.reload();
                    })

                },

              });
          
        } else {
          swal("Data masih tersimpan");
        }
      });

  }

  function approve(id) {
        swal({
        text: "Apakah Anda yakin akan menerima berkas ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
      data : {
        id : id,
      },
      type : "POST",
      url : "<?php   echo base_url().'Penerimaan_SM/approvalSuratMasuk' ?>",
      success:function(res){
                    swal({ 
                    text:"Berkas telah diterima!",
                    type:"success",
                    showConfirmButton: true
                    }).then(function(){
                    window.location.reload();
                    })
                },

              });
          
        } else {
          swal("Berkas Batal Diterima");
        }
      });
    
  }

  function disposisiKePetugas(id) {
      $('#id_surat').val(id);
  }

  function disposisi_pelayanan(){
       swal({
        text: "Apakah Anda yakin akan mendisposisi berkas ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
      data : {
        id : id,
      },
      type : "POST",
      url : "",
      success:function(res){
                    swal({ 
                    text:"Berkas telah di disposisi !",
                    type:"success",
                    showConfirmButton: true
                    }).then(function(){
                    window.location.reload();
                    })
                },

              });
          
        } else {
          swal("Berkas Batal Diterima");
        }
      });
  }



  function konfirmasi_sekretariat_pelayanan(){
       swal({
        text: "Apakah Anda yakin akan mendisposisi berkas ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
      data : {
        id : id,
      },
      type : "POST",
      url : "",
      success:function(res){
                    swal({ 
                    text:"Berkas telah di disposisi !",
                    type:"success",
                    showConfirmButton: true
                    }).then(function(){
                    window.location.reload();
                    })
                },

              });
          
        } else {
          swal("Berkas Batal Diterima");
        }
      });
  }

</script>
              

