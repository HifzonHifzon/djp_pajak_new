<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>
              </div>
              <!-- /.card-header -->
            <div class="card">
              <div class="card-header">
                <div class=" btn btn-primary btn-ml"><i class="fa fa-plus"> Tambah User </i></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No.KTP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp/HP</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>3172016606970001</td>
                    <td>Indah</td>
                    <td>Swadaya</td>
                    <td>0821</td>
                    <td>indah@gmail.com</td>
                    <td>indah22</td> 
                    <td class="text-center" width="160px">
                      <a href="" class="btn btn-primary btn-xs">
                        <i class="fa fa-pen"></i> Update
                      </a>
                       <a href="" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> Delete
                      </a>
                    </td>                  
                  </tr>
                  </tbody>
                </table>

              <form role="form">
                <div class="card-body col-6 col-6">
                  <div class="form-group">
                    <label for="exampleInputNama">Nama</label>
                    <input type="nama" class="form-control" id="exampleInputNama" placeholder="Masukkan Nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputNp_KTP">No.KTP</label>
                    <input type="" class="form-control" id="exampleInputNo_KTP" placeholder="Masukkan No.KTP">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAlamat">Alamat</label>
                    <input type="" class="form-control" id="exampleInputAlamat" placeholder="Masukkan Alamat">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputNo_Telp_HP">No.Telp/Hp</label>
                    <input type="" class="form-control" id="exampleInputNo_Telp_HP" placeholder="Masukkan No.Telp/Hp">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="email" class="form-control" id="exampleInputemail" placeholder="Masukkan Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername">Username</label>
                    <input type="" class="form-control" id="exampleInputAlamatUsername" placeholder="Masukkan Username">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->