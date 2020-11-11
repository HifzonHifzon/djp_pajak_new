 <div class="card card-dark">
  <div class="card-header">
   <h3 class="card-title">Data Wajib Pajak</h3>
     <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
     </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Wajib Pajak</th>
        <th>Nomor KTP</th>
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
        <td><?php echo $key->Nama_Wajib_Pajak ?></td>
        <td><?php echo $key->Nomor_KTP ?></td>
        <td><?php echo $key->No_Telpon ?></td>
        <td><?php echo $key->Email ?></td>
        <td><?php echo $key->Alamat ?></td>
        <td><?php echo $key->Username ?></td>   
        <td class="text-center" width="160px">
          <a href="" class="btn btn-primary btn-xs">
            <i class="fa fa-pen"></i> Update
          </a>
           <a onclick ="return deleteData(<?php  echo $key->id ?>)" class="btn btn-danger btn-xs">
            <i class="fa fa-trash"></i> Delete
          </a>
        </td>                  
      </tr>
    <?php } ?>
        
      </tbody>
    </table>
  </div>
</div>



<script type="text/javascript">

  function getDetailPerihalSurat() {
    var id_kategori = $('#kategori_surat').val();

    $.ajax({
      url : "<?php echo base_url().'Penerimaan_SM/getDetailPerihalSurat' ?>",
      data  : {
        id_kategori_text  : id_kategori
      },
      type : "POST",
      dataType :  "JSON",
      success:function(res) {
        var select_perihal = "<option value=''> Pilih Perihal Surat </option>";
       
        for(var x=0; x<res.length; x++) {
        select_perihal += "<option value ="+res[x].id_perihal+"  > "+res[x].nama_perihal+"</option>"
        }

        $('#perihal_show').html(select_perihal);
      }, 
      error:function() {
        alert('errror')
      }
    })
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
      swal({title:"Good job!", 
                        text:"Thanks For your Quotation, we will get back to you soon!",
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
              