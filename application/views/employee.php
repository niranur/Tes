<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                 <?php 
                 $data = $this->session->flashdata('sukses');
                 if ($data!="") {?>
                    <div class="alert alert-success alert-dismissible "> <i class="icon fa fa-check">
                    </i>
                    <?php echo $data; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                </div>
            <?php }
            ?>

            <?php 
            $dataa = $this->session->flashdata('eror');
            if ($dataa!="") {?>
                <div class="alert alert-danger alert-dismissible "> <i class="icon fa fa-trash"> &nbsp
                </strong></i>
                <?php echo $dataa; ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
            </div>
        <?php }
        ?>
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title" style="text-align: center;">Data Employe</h3>
        </div>
        <div class="row">
          <div class="col-sm-3">
             <a href="<?php echo base_url('tambah-lokasi'); ?>">
            <button type="button"  class="btn  btn-outline-primary btn-sm">Tambah Data </button></a>
          </div>
          
        </div>
         
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10x">No.</th>
                        <th>Lokasi Kode</th>
                        <th>Birt_date</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
<!-- 
                    <?php $i = 1; ?>
                    <?php
                    foreach($lokasi as $row){ 

                      ?>
                      <tr>
                        <td><?=$i ?>.</td>
                        <td><?=$row->code?></td>
                         <td><?=$row->name?></td>

                        <td align="center">
                                   <a href="<?php echo base_url('HomeController/update_data/'.$row->id); ?>">
                                <button type="button" title="edit" class="btn bg-gradient-warning btn-sm"><i class="far fas fa-edit"></i> Edit </button>
                            </a>
                           <a href="<?php echo base_url('HomeController/hapus/'.$row->id); ?>">
                            <button type="button" title="hapus"
                            onclick="return confirm('yakin akan menghapus data ini?');"
                            class="btn bg-gradient-danger btn-sm"><i class="far fas fa-trash"></i> Hapus</button>
                        </a>


                    </td>
                </tr>


                <?php $i++; ?>
            <?php } ?> -->

        </tbody>

    </table>
</div>
<!-- /.card-body -->
</div>
</div>
</div>
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
