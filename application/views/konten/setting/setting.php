
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
    <table id="myTable" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Petugas</th>
        <th>NIP</th>
        <th>Telpon</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Username</th>
        <th>Action</th>                    
      </tr>
      </thead>
      <tbody>

  <?php $no=1; foreach ($result['result'] as $key) { ?>
 
      <tr>
        <td><?php echo $no++; ?></td>  
        <td><?php echo $key->Nama_Petugas ?></td>
        <td><?php echo $key->NIP ?></td>
        <td><?php echo $key->No_Telpon ?></td>
        <td><?php echo $key->Email ?></td>
        <td><?php echo $key->Alamat ?></td>
        <td><?php echo $key->Username ?></td>   
        <td class="text-center" width="160px">
          <button class="btn btn-primary btn-xs" data-toggle="modal" onClick="getPetugas(<?php echo $key->id; ?>)" data-target="#edit_petugas">
            <i class="fa fa-pen"></i> Edit
          </button>
           <a onClick="getPetugas(<?php echo $key->id; ?>)" data-toggle="modal"  data-target="#setting_password" class="btn btn-warning btn-xs" style="color:white">
            <i class="fa fa-pen"></i> Ganti Password
          </a>
        </td>                  
      </tr>
    <?php } ?>
        
      </tbody>
    </table>
  </div>
</div>


<!-- Setting Password  -->

<!-- Modal -->
<div id="setting_password" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control id_petugas" id="id_petugas">
        <label> Password Baru </label>
        <input type="text" class="form-control" placeholder="Masukan Password Baru" id="password_baru"> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="updatePassword()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Pop Up edit -->
<div id="edit_petugas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"></button>
        <h4 class="modal-title">Edit Petugas </h4>
      </div>
      <div class="modal-body">
        
      <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nama Petugas</label>
                  </div>
                  <div class="col-md-9">
                    <input type="hidden" class="form-control id_petugas" id="id_petugas">
                    <input type="text" name="nama_petugas_txt" class="form-control" id="nama_petugas_txt" placeholder="Nama Petugas Pelayanan">
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>NIP</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nip" class="form-control" id="nip_txt" placeholder="Nomor Induk Pegawai (NIP)">
                  </div>
              </div> 

               <div class="form-group row">
                  <div class="col-md-3">
                    <label>Telpon</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="no_telp" class="form-control" id="no_telp_txt" placeholder="Nomor Telpon Petugas">
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>Email</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="email" class="form-control" id="email_txt" placeholder="Email Petugas">
                  </div>
            </div>

            <div class="form-group row">
                  <div class="col-md-3">
                    <label>Alamat</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="alamat" class="form-control" id="alamat_txt" placeholder="Alamat Petugas">
                  </div>
            </div> 

            <div class="form-group row">
                  <div class="col-md-3">
                    <label>Username</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="username" class="form-control" id="username_txt" placeholder="Username Petugas">
                  </div>
            </div> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="editPetugas()">Edit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--  -->


<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  }); 

  function updatePassword(){
    var id = $('.id_petugas').val();
    var new_password =  $('#password_baru').val();

    $.ajax({
      url : "<?php echo base_url().'Settings/gantiPassword' ?>",
      data : {
        id : id, 
        new_password : new_password
      },
      type :"POST",
      success:function(res) {
        var data = JSON.parse(res);
        swal({title: data.title , text:data.pesan, type: 
          "success"}).then(function(){ 
              window.location.href = 'list-terima-sm';
            }
          );

      }
    })
  }

  function editPetugas() {
        var nama_petugas = $('#nama_petugas_txt').val();
        var nip = $('#nip_txt').val();
        var no_telp =  $('#no_telp_txt').val();
        var email =  $('#email_txt').val();
        var alamat =  $('#alamat_txt').val();
        var username =  $('#username_txt').val();
        var id = $('.id_petugas').val();

        $.ajax({
            url : "<?php echo base_url().'Petugas/EditPetugas'; ?>",
            type : "POST",
            data : {
              nama_petugas_txt : nama_petugas,
              nip_txt : nip,
              no_telp_txt : no_telp,
              email_txt : email,
              alamat_txt : alamat,
              username_txt : username, 
              id_txt : id  
            },
            success:function(res) {
              var data = JSON.parse(res);
              
              if (data.status ==  true ){
                swal({title: data.title , text: data.pesan, type: 
                    "success"}).then(function(){ 
                      location.reload();
                      }
                    );
                  }
            }
        });
          
  }

 

  function getPetugas(id_petugas) {
    $.ajax({
        url : "Petugas/getPetugasById",
        data : {
          id_petugas_txt : id_petugas 
        }, 
        type : "POST",
        success:function(result) {
          var data  = JSON.parse(result);
    
            $('#nama_petugas_txt').val(data[0].Nama_Petugas);
            $('#nip_txt').val(data[0].NIP);
            $('#no_telp_txt').val(data[0].No_Telpon);
            $('#email_txt').val(data[0].Email);
            $('#alamat_txt').val(data[0].Alamat);
            $('#username_txt').val(data[0].Username);
            $('.id_petugas').val(data[0].id);

            
        }
    });
  }

  function submit_petugas() {
    var nama_petugas      = $('#nama_petugas').val();
    var nip               = $('#nip').val();
    var no_telp           = $('#no_telp').val();
    var email             = $('#email').val();
    var alamat            = $('#alamat').val();
    var username          = $('#username').val();


    
    $.ajax({
        url : "<?php echo base_url().'Petugas/insertPetugas' ?>",
        data    : {
          nama_petugas     : nama_petugas, 
          nip              : nip,
          no_telp          : no_telp,
          email            : email,
          alamat           : alamat,
          username         : username
          
        }, 
        type    : "POST",

      success:function(){
      swal({title:"Berhasil!",
                        text:"Terimakasih, Data sudah tersimpan!",
                        type:"success",timer:4000,showConfirmButton: true
                        }).then(function(){
                          window.location.reload();
                        })
                      
    },
    });


}

  function deleteData(id_user){

    swal({
        text: "Apakah Anda yakin akan menghapus data ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
      data : {
        id : id_user,
      },
      type : "POST",
      url : "<?php   echo base_url().'Petugas/prosesDelete' ?>",
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

</script>
              