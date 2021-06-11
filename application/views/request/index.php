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
          <a href="<?= base_url("request/add") ?>" class="btn btn-app bg-success">
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
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Produk</th>
                    <th>Harga Produk</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Uang Yang Harus Disetorkan</th>
                    <th>Uang Setoran</th>
                    <th>Status</th>
                    <?php if ($this->session->userdata('is_request_write')) { ?>
                      <th>Aksi</th>
                    <?php } ?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($records as $record) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td id="<?= 'employee_id'.$record->id; ?>"><?= $record->employee_id; ?></td>
                        <td id="<?= 'name'.$record->id; ?>"><?= $record->name; ?></td>
                        <td id="<?= 'product_name'.$record->id; ?>"><?= $record->product_name; ?></td>
                        <td id="<?= 'product_price'.$record->id; ?>"><?= $record->product_price; ?></td>
                        <td id="<?= 'total'.$record->id; ?>"><?= $record->total; ?></td>
                        <td id="<?= 'date'.$record->id; ?>"><?= $record->date; ?></td>
                        <td id="<?= 'total_deposit'.$record->id; ?>"><?= $record->product_price * $record->total; ?></td>
                        <td id="<?= 'deposit'.$record->id; ?>"><?= $record->deposit; ?></td>
                        <td>
                          <?php
                          $request_status = $record->request_status;
                          if ($request_status == 'pending') {
                             echo '<span class="badge badge-warning">Menunggu persetujuan</span>';
                          } elseif ($request_status == 'accepted') {
                             echo '<span class="badge badge-success">Disetujui</span>';
                          } elseif ($request_status == 'rejected') {
                             echo '<span class="badge badge-danger">Ditolak</span>';
                          } elseif ($request_status == 'deposited') {
                             echo '<span class="badge badge-primary" >Disetorkan</span>';
                          }
                          ?>  
                        </td>
                        <?php if ($this->session->userdata('is_request_write')) {  ?>
                          <td>
                            <div class="btn-group">
                              <?php if ($request_status == 'pending') { ?>
                              <a href="<?= base_url("request/update?id=".$record->id."&request_status=accepted") ?>" type="button" class="btn btn-outline-success btn-sm">Setujui</a>
                              <a href="<?= base_url("request/update?id=".$record->id."&request_status=rejected") ?>" type="button" class="btn btn-outline-warning btn-sm">Tolak</a>
                              <?php } elseif ($request_status == 'accepted' || ($request_status == 'deposited' && ($record->product_price * $record->total) > $record->deposit)) { ?>
                              <button type="button" class="btn btn-outline-primary btn-sm" id="deposit" value="<?= $record->id; ?>">
                                Setorkan
                              </button>
                              <?php } ?>

                              <?php if ($request_status == 'pending' || $request_status == 'rejected') { ?>
                              <a href="<?= base_url("request/delete?id=".$record->id) ?>" onclick="return confirm('Yakin menghapus data ini?');" type="button" class="btn btn-outline-danger btn-sm">Hapus</a>
                              <?php } ?>
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
      <div class="modal fade" id="modal-deposit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Setor Uang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?= base_url("request/update") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Uang yang harus disetorkan</label>
                      <input type="text" class="form-control" id="m_total_deposit" disabled>
                      <input type="hidden" class="form-control" name="request_status" value="deposited">
                      <input type="hidden" class="form-control" id="m_id" name="id">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Setorkan</label>
                      <input type="number" class="form-control" name="deposit" required>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Setor</button>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $( "#deposit" ).click(function() {
        var id = $(this).val();
        var totaldeposit = $('#total_deposit'+id).text();
        var deposited = $('#deposit'+id).text();
        var insufficient_deposit = totaldeposit - deposited;

        $('#modal-deposit').modal('show');
        $('#m_id').val(id);
        $('#m_total_deposit').val(insufficient_deposit);
      });
    });
  </script>