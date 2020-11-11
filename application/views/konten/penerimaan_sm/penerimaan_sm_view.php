<!-- /.card-header -->
<div class="card card-dark">
  <div class="card-header">
    <h3 class="card-title">Detail Surat Masuk</h3>
     <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
     </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
       <div class="row">
          <div class="col-md-6"> 
          <div class="form-group row">
                  <div class="col-md-3">
                    <label>Tanggal Surat</label>
                  </div>
                  <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend"></div>
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" id="tanggal_terima" readonly>
                  </div>
                  </div>
              </div> 
  

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nama Wajib Pajak</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nama_wajib_pajak" class="form-control" id="nama_wajib_pajak" placeholder="Nama Wajib Pajak">
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>NPWP</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nama" class="form-control" id="npwp" placeholder="Nomor Pokok Wajib Pajak (NPWP)">
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>Layanan</label>
                  </div>
                  <div class="col-md-9">
              <select name="layanan" class="form-control" id="layanan" onchange="return getDetailPerihal()">
                  <option>Pilih Layanan</option>
                    <?php foreach($result['layanan'] as $key)  { ?>
                      <option value="<?php echo $key->id_layanan ?>"><?php echo $key->nama_layanan ?></option>
                    <?php } ?>
              </select>
                  </div>
              </div> 

            </div>


            <div class="col-md-6"> 
            <div class="form-group row">
                  <div class="col-md-3">
                    <label>Perihal</label>
                  </div>
                  <div class="col-md-9">
                  <select name="perihal" class="form-control" id="perihal_show">
                  </select>
                  </div>
              </div>

             <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nomor Surat</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="nama" class="form-control" id="nomor_surat" placeholder="Nomor Surat">
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>Tanggal Surat</label>
                  </div>
                  <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend"></div>
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    <input type="date" class="form-control" name="tanggal_surat" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" id="tanggal_surat">
                  </div>
                  </div>
              </div> 

              <div class="form-group row">
                  <div class="col-md-3">
                    <label>Keterangan</label>
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" row="1" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                  </div>
              </div> 
            </div>


          <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary" onclick="submit_sm()">Submit</button>
            </div>
  </div>
</div>
</div>


<script type="text/javascript">

  $('#reservation').daterangepicker()
  function getDetailPerihal() {
    var id_layanan = $('#layanan').val();

    $.ajax({
      url : "<?php echo base_url().'SuratMasuk/getDetailPerihal' ?>",
      data  : {
        id_layanan_text  : id_layanan
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
        alert('error')
      }
    })
  }

  function submit_sm() {
    var tanggal_terima      = $('#tanggal_terima').val();
    var nama_wajib_pajak    = $('#nama_wajib_pajak').val();
    var npwp                = $('#npwp').val();
    var layanan             = $('#layanan').val();
    var perihal             = $('#perihal_show').val();
    var nomor_surat         = $('#nomor_surat').val();
    var tanggal_surat       = $('#tanggal_surat').val();
    var keterangan          = $('#keterangan').val();

    if (nama_wajib_pajak ==''){
      swal('Harap Mengisi Nama Wajib Pajak');
      return ;
    }

    $.ajax({
        url : "<?php echo base_url().'SuratMasuk/insertSM' ?>",
        data    : {
          tanggal_terima    : tanggal_terima, 
          nama_wajib_pajak  : nama_wajib_pajak,
          npwp              : npwp,
          layanan           : layanan,
          perihal           : perihal,
          nomor_surat       : nomor_surat,
          tanggal_surat     : tanggal_surat,
          keterangan        : keterangan
        }, 
        type    : "POST",

      success:function(res){
        var data = JSON.parse(res);
        if (data.status  == true ) {
          swal({title: data.title , text:data.pesan, type: 
              "success"}).then(function(){ 
                  window.location.href = 'list-terima-sm';
                }
              );
          } 
                      
    },
    });


}


</script>
              