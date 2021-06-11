  <?php
  $action = ($record != null) ? "Ubah" : "Tambah";
  $id = (isset($record->id)) ? $record->id : '';
  $nik = (isset($record->nik)) ? $record->nik : '';
  $name = (isset($record->name)) ? $record->name : '';
  $dob = (isset($record->dob)) ? $record->dob : '';
  $address = (isset($record->address)) ? $record->address : '';
  $employee_gender = (isset($record->gender)) ? $record->gender : '';
  $employee_religion = (isset($record->religion)) ? $record->religion : '';
  $phone = (isset($record->phone)) ? $record->phone : '';
  ?>

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
            <h3 class="card-title"><?= $action.' '.$page_name; ?></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="<?= base_url("employee/update") ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIK</label>
                    <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?= $nik; ?>" required>
                    <input type="hidden" name="id" value="<?= $id; ?>">
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama" value="<?= $name; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="dob" value="<?= $dob; ?>" required/>
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="address" rows="3" placeholder="Enter ..." required=""><?= $address; ?></textarea>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="gender" class="form-control select2bs4" style="width: 100%;">
                      <?php 

                      $genders = array('male'=>'Laki - laki', 'female'=>'Perempuan');

                      foreach ($genders as $key => $value) {
                        if ($key == $employee_gender) {
                          $selected = 'selected';
                        } else {
                          $selected = '';
                        }

                        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Agama</label>
                    <select name="religion" class="form-control select2bs4" style="width: 100%;">
                      <?php 

                      $religions = array('islam'=>'Islam', 'protestant'=>'Protestant', 'catholic'=>'Catholic','hindu'=>'Hindu', 'buddha'=>'Buddha', 'kong hu cu'=>'Kong Hu Cu');

                      foreach ($religions as $key => $value) {

                        if ($key == $employee_religion) {
                          $selected = 'selected';
                        } else {
                          $selected = '';
                        }

                        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';

                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No Telp</label>
                    <input type="text" name="phone" class="form-control" data-inputmask='"mask": "9999-9999-9999"' data-mask value="<?= $phone; ?>" required>
                  </div>    
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-outline-primary"><?= $action; ?></button>
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