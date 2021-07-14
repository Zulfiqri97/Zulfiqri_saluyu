  <!-- Content Wrapper. Contains page content -->
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
          <a class="btn btn-app bg-success" data-toggle="modal" data-target="#modal-give">
            <i class="fas fa-arrow-up"></i> Taruh Barang
          </a>
          <a class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-take">
            <i class="fas fa-arrow-down"></i> Ambil Barang
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
              <!-- mpdf -->
              <!-- <a href="<?php echo base_url('transaction/mpdf'); ?>" target="blank"><button class="btn btn-primary btn-sm" style="margin-bottom: 10px;">       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
              <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg> Export</button></a> -->

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Toko</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Kuantitas</th>
                    <th>Taruh/Ambil Barang</th>
                    <th>Tanggal</th>
                    <th>Sub Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>

                    <?php foreach ($records as $record) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $record->name; ?></td>
                        <td><?= $record->store_name; ?></td>
                        <td><?= $record->product_name; ?></td>
                        <td><?= $record->product_price; ?></td>
                        <td><?= $record->total_product; ?></td>
                        <td><?= ($record->type == 'give') ? 'Taruh Barang' : 'Ambil Barang' ?></td>
                        <td><?= $record->date; ?></td>
                        <td><?= $record->product_price * $record->total_product; ?></td>
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
      <div class="modal fade" id="modal-give">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Taruh Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?= base_url("transaction/update") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Request Barang Hari Ini</label>
                      <select name="request_id" class="form-control select2bs4" style="width: 100%;" required>
                        <?php 
                        foreach ($requests as $request) {
                          echo '<option value="'.$request->id.'">(ID '.$request->id.') '.$request->product_name.' - Sisa Barang ('.$request->stock.')</option>';
                        }
                        ?>
                      </select>
                      <input type="hidden" class="form-control" name="type" value="give" required>
                    </div>
                    <div class="form-group">
                      <label>Toko</label>
                      <select name="store_id" class="form-control select2bs4" style="width: 100%;" required>
                        <?php 
                        foreach ($stores as $store) {
                          echo '<option value="'.$store->id.'">'.$store->name.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Kuantitas Produk</label>
                      <input type="number" class="form-control" name="total_product" placeholder="Kuantitas" required>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Taruh</button>
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
      <div class="modal fade" id="modal-take">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ambil Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?= base_url("transaction/update") ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Toko</label>
                      <select name="store_id" class="form-control select2bs4" style="width: 100%;" id="store_id" required>
                        <option>Pilih Toko</option>
                        <?php 
                        foreach ($stores as $store) {
                          echo '<option value="'.$store->id.'">'.$store->name.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Request Barang</label>
                      <select name="request_id" class="form-control select2bs4" style="width: 100%;" id="request_id" required>
                      </select>
                      <input type="hidden" class="form-control" name="type" value="take" required>
                    </div>
                    <div class="form-group">
                      <label>Kuantitas Produk</label>
                      <input type="number" class="form-control" name="total_product" placeholder="Kuantitas" required>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Ambil</button>
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
      $('#store_id').change(function(e) {

        $('#request_id').empty();

        var data = {
          'store_id':$('#store_id').val()
        }

        $.ajax({
          type: 'POST',
          url: "<?php echo base_url("transaction/gettransactionbystore")?>",
          data: data,
          dataType: "json",
          success: function(resultData) { 
            var toAppend = '';
            $.each(resultData,function(i,o){
              toAppend += '<option value="'+o.id+'">(ID '+o.id+') '+o.date+' '+o.product_name+' - Barang titipan ('+o.stock+')</option>';
           });
            $('#request_id').append(toAppend);
          }
        });

      })
    });
  </script>
