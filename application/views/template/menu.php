<?php   
      $roles = $this->session->userdata('role');
      $this->db->select('a.*, b.*, c.*');
      $this->db->from('tb_role_menu as a');
      $this->db->join('tb_grup_role as b', 'a.id_role = b.id_grup_role' );
      $this->db->join('tb_main_menu as c', 'a.id_menu = c.id_menu');
      $this->db->where(['b.name_grup' => $roles, 'c.status' => 1]);
      $list_menu = $this->db->get()->result();
?>
 
 
 
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url().'asset/dist/img/pajak.jpg' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIDJP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url().'asset/image/user.png'; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

      <?php foreach($list_menu as $key) { ?>
          <li class="nav-item">
            <a href="<?php echo base_url().$key->link; ?>" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                  <?php echo $key->name_menu; ?>
              </p>
            </a>
          </li>
      <?php } ?>

      <li class="nav-item">
            <a  href="#" onclick="getExit()" class="nav-link" >
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                 Exit
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>


