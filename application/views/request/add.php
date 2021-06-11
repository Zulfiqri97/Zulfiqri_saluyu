  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $page_name; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $this->uri->segment(1); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if($error != null or $error != '') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>
        <!-- card -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Request Barang</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="<?= base_url("request/create") ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama</label>
                    <?php if ($this->session->userdata('is_request_write')) { ?> 
                    <select name="employee_id" class="form-control select2bs4" style="width: 100%;" required>
                      <?php 
                      foreach ($employees as $employee) {
                        echo '<option value="'.$employee->id.'">'.$employee->name.'</option>';
                      }
                      ?>
                    </select>
                    <?php } else { ?>
                    <input type="text" class="form-control" value="<?= $this->session->userdata('name') ?>" disabled> 
                    <?php } ?>
                  </div>
                  <div class="form-group">
                    <label>Produk</label>
                    <select name="product_id" class="form-control select2bs4" style="width: 100%;" required>
                      <?php 
                      foreach ($products as $data) {
                        echo '<option value="'.$data->id.'">'.$data->name.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Total</label>
                    <input type="text" name="total" class="form-control" required>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                   
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-outline-primary">Ajukan Request</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->