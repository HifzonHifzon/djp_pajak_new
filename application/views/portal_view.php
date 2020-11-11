<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tracking - DJP Pajak</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url().'asset/datatables/media/css/dataTables.bootstrap.css'; ?>" >
  <link rel="stylesheet" href="<?php echo base_url().'asset/datatables/media/css/jquery.dataTables.css'; ?>" >

 


</head>
<style>

li, a {
    color:white;
}

h3 {
    font-weight:bold;
}
input, button{
    margin-top:10px;
}

.back_table1 {
    width:100%;
    height:30px;
    background-color:#337ab7;
}
</style>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:white">DJP Pajak Online</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" style="color:white"><span class="glyphicon glyphicon-user" ></span> Tracking</a></li>
      <li><a href="<?php echo base_url().'login' ?>" style="color:white" ><span class="glyphicon glyphicon-log-in"></span> Login Dashboard </a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
    <h3> <center>Tracking Surat DJP Wajib Pajak</center> <h3> 
    <hr>
    <div class="row">
       <input type="text" placeholder="Masukan Nama" class="form-control" id="nama_wajib_pajak">
       <button class="btn btn-primary" style="width:100%" onclick="getDataPortal()"> Search </button>
    </div>
</div>

<hr>
<div class="container-fluid">
<div class="back_table1">
</div>
    <table id="table11" class="table table-bordered table-striped text-center">
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
            <th>Status</th>                     
        </tr>
        </thead>
        <tbody>
           
        </tbody>
        </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- src js datatables -->
<script type="text/javascript" src="<?php echo base_url().'asset/datatables/media/js/dataTables.bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/datatables/media/js/jquery.dataTables.js' ?>"></script>

</body>
</html>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
    getDataPortal();
});


function getDataPortal(){


    var nama_wajib_pajak = $('#nama_wajib_pajak').val();

    if (nama_wajib_pajak == '') {
        var wajib_pajak = '';
    } else {
        var wajib_pajak = nama_wajib_pajak;
    }

        //datatables
        table = $('#table11').DataTable({ 
            "searching": false,
            "lengthChange": false,
            "destroy": true,
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('portal/get_data_user')?>",
                "type": "POST",
                "data" : {
                  wajib_pajak : wajib_pajak
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
                    // {data: 'Status'},
                    {
                              data: "STATUS",
                              "render": function ( data, type, row ) {
          
                                               if (row.Disposisi  == 0) {
                                                  var action =  "<a href='' class='btn btn-warning btn-xs'> <i class='fa fa-pen'></i> Surat Sedang di Sekretariat </a>";
                                                      return action;
                                               } 

                                               if (row.Disposisi  == 1) {
                                                  var action =  "<a href='' class='btn btn-warning btn-xs'> <i class='fa fa-pen'></i> Surat Sedang di Proses Pelayanan </a>";
                                                      return action;
                                               } 

                                               if (row.Disposisi  == 2 ) {
                                                    if (row.Disposisi  == 2 && row.Status == 1) {
                                                      var action =  "<a href='' class='btn btn-success btn-xs'> <i class='fa fa-pen'></i> Surat Telah selesai </a>";
                                                          return action;
                                                    } 
                                                    
                                                    var action =  "<a href='' class='btn btn-warning btn-xs'> <i class='fa fa-pen'></i> Surat sedang di Proses Petugas</a>";
                                                      return action;
                                               } 

                                             


              

                              }

                          },
                ],
 
        });

        // $('#table').DataTable.destroy();

}
</script>
