  <div class="content-wrapper">

        <br>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data Lokasi</h3>
                                </div>
                                <form action="HomeController/Simpan" method="post" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <div class="form-group <?=form_error('code') ? ' has-error' : null ?>">
                                            <label> Kode Lokasi</label>
                                            <input type="text" class="form-control" name="code"
                                            value=" <?= set_value('code') ?>">
                                            <span class="help-block"> <?=form_error('code') ?></span>
                                        </div>

                                        <div class="form-group <?=form_error('name') ? ' has-error' : null ?>">
                                            <label> Nama Lokasi</label>
                                            <input type="text" class="form-control" name="name"
                                            value=" <?= set_value('name') ?>">
                                            <span class="help-block"> <?=form_error('name') ?></span>
                                        </div>

                                   
                                        <div class="card-footer">
                                            <button type="submit" class="btn bg-gradient-primary"><i
                                                class="far fas fa-save"></i> Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>