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
          <a href="<?= base_url("supply/edit") ?>" class="btn btn-app bg-success">
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga Produk</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>In/Out</th>
                    <th>Sumber</th>
                    <?php if ($this->session->userdata('is_supply_write')) { ?>
                      <th>Aksi</th>
                    <?php } ?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($records as $record) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $record->product_name; ?></td>
                        <td><?= $record->product_price; ?></td>
                        <td><?= $record->total; ?></td>
                        <td><?= $record->date; ?></td>
                        <td><?= $record->type; ?></td>
                        <td><?= $record->source; ?></td>
                        <?php if ($this->session->userdata('is_supply_write')) {  ?>
                          <td>
                            <div class="btn-group">
                              <a href="<?= base_url("supply/delete?id=".$record->id) ?>" onclick="return confirm('Yakin menghapus data ini?');" type="button" class="btn btn-outline-danger btn-sm">Hapus</a>
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