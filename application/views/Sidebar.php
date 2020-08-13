

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header   ">
        <!-- Left navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
          <!-- <?php if($posisi=='2'){ ?>
        <a href="<?=base_url('dashboard')?>" class="brand-link">

            <img src="<?=base_url()?>assets/image/d.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
            <span class="brand-text font-weight-light">
               
                  <?=ucwords ('Dasawisma '.$m->nama_dawis)?>
                  <?php } ?> -->
              </span>
          </a> 

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">

                     <img src="<?=base_url()?>assets/image/d.jpg"
                        class="img-circle elevation-2" alt="User Image">
                   

                </div>
                <div class="info">
                    <a href="<?=base_url('dashboard')?>" class="d-block">

                    Tes

              </a>

          </div>

      </div>


      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

 

  <li class="nav-item">
    <a href="<?php echo base_url('lokasi') ?>" class="nav-link">
        &nbsp; <i class="far fas fa-eye"></i> 
        <p> Data Lokasi</p>
    </a>
</li>


  <li class="nav-item">
    <a href="<?php echo base_url('employee') ?>" class="nav-link">
        &nbsp; <i class="far fas fa-eye"></i> 
        <p> Data Employee</p>
    </a>
</li>





</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->