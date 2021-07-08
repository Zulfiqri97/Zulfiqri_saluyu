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
        <div class="row">
          <a href="<?= base_url("employee/edit") ?>" class="btn btn-app bg-success">
            <i class="fas fa-plus"></i> Tambah
          </a>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data <?= $page_name; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <!-- menambahkan pungsi prin tambahkan (id example) -->
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Telp</th>
                    <?php if ($this->session->userdata('is_employee_write')) { ?>
                      <th>Aksi</th>
                    <?php } ?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($records as $record) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $record->nik; ?></td>
                        <td><?= $record->name; ?></td>
                        <td><?= $record->dob; ?></td>
                        <td><?= $record->address; ?></td>
                        <td><?= $record->gender; ?></td>
                        <td><?= $record->religion; ?></td>
                        <td><?= $record->phone; ?></td>
                        <?php if ($this->session->userdata('is_employee_write')) { ?>
                          <td>
                            <div class="btn-group">
                              <a href="<?= base_url("employee/edit?id=".$record->id) ?>" type="button" class="btn btn-outline-primary btn-sm">Ubah</a>
                              <a href="<?= base_url("employee/delete?id=".$record->id) ?>" onclick="return confirm('Yakin menghapus data ini?');" type="button" class="btn btn-outline-danger btn-sm">Hapus</a>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                      <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
