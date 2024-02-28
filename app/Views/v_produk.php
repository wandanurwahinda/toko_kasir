<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?=$subjudul ?></h3>

                <div class="card-tools">
                <button onclick="NewWin=window.open('<?= base_url('Laporan/PrintDataProduk') ?>','NewWin','toolbar=no, width=1100,heigh=500,scrollbars=yes')" class="btn btn-tool "><i class="fas fa-print"></i> Print
        </button>
                  <button class="btn btn-tool " data-toggle="modal" data-target="#tambah-data"><i class="fas fa-plus"></i> Tambah Data
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                if (session()->getFlashdata('pesan')){
                  echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>';
                  echo session()->getFlashdata('pesan');
                  echo '</h5></div>';
                }
                ?>

                <?php 
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?> 
                    <div class="alert alert-success alert-dismissible">
                      <h4>Periksa Lagi Entery Form !!</h4>
                      <ul>
                        <?php foreach ($errors as $key => $errors) { ?>
                            <li><?= esc($error) ?></li>
                          <?php } ?>
                      </ul>
                    </div>
                <?php } ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr  class="text-center">
                            <th width="50px">No</th>
                            <th>Kode/Barcode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>harga jual</th>
                            <th>Stok</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $no = 1;
                 foreach ($produk as $key => $value) { ?>
                    <tr class="<?= $value['stok']==0 ? 'bg-danger' : '' ?>">
                      <td class="text-center"><?= $no++ ?></td>
                      <td class="text-center"><?= $value['kode_produk'] ?></td>
                      <td><?= $value['nama_produk'] ?></td>
                      <td class="text-center"><?= $value['nama_kategori'] ?></td>
                      <td class="text-center"><?= $value['nama_satuan'] ?></td>
                      <td class="text-right">Rp. <?= number_format($value['harga_beli'], 0) ?></td>
                      <td class="text-right">Rp. <?= number_format($value['harga_jual'], 0) ?></td>
                      <td class="text-center"><?= $value['stok'] ?></td>
                      <td class="text-center">
                        <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value['id_produk'] ?>"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value['id_produk'] ?>"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                <?php  }   ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="modal fade" id="tambah-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open('Produk/InsertData') ?>
            <div class="modal-body">

              <div class="form-group">
                   <label for="">Kode Produk</label>
                  <input name="kode_produk" class="form-control" value="<?= old('kode_produk') ?>" placeholder="Kode Produk" required>
              </div>

              <div class="form-group">
                   <label for="">Nama Produk</label>
                  <input name="nama_produk" class="form-control"  value="<?= old('nama_produk') ?>" placeholder="Nama Produk" required>
              </div>

              <div class="form-group">
                   <label for="">Kategori</label>
                  <select name="id_kategori" class="form-control">
                    <option value="">--pilih kategori--</option>
                    <?php foreach ($kategori as $key => $value) { ?>
                      <option value="<?= $value[ 'id_kategori'] ?>"><?= $value[ 'nama_kategori'] ?></option>
                    <?php } ?>

                  </select>
              </div>

              <div class="form-group">
                   <label for="">Satuan</label>
                  <select name="id_satuan" class="form-control">
                    <option value="">--pilih Satuan--</option>
                    <?php foreach ($satuan as $key => $value) { ?>
                      <option value="<?= $value['id_satuan'] ?>"><?= $value[ 'nama_satuan'] ?></option>
                    <?php } ?>
                  </select>
              </div>

              <div class="form-group">
                   <label for="">Harga Beli</label>
                   <div class="input-group mb-3">
                   <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input name="harga_beli" id="harga_beli" class="form-control"  value="<?= old('harga_beli') ?>" placeholder="Harga Beli" required>
              </div>
              </div>

              <div class="form-group">
                   <label for="">Harga Jual</label>
                   <div class="input-group mb-3">
                   <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input name="harga_jual" class="form-control" id="harga_jual"  value="<?= old('harga_jual') ?>" placeholder="Harga Jual" required>
              </div>
              </div>

              <div class="form-group">
                   <label for="">Stok</label>
                  <input name="stok" type="number"  value="<?= old('stok') ?>" class="form-control" placeholder="Stok" required>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <?php foreach ($produk as $key => $value) { ?>
        <div class="modal fade" id="edit-data<?= $value['id_produk'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open('Produk/UpdateData/' .$value['id_produk']) ?>
            <div class="modal-body">

              <div class="form-group">
                   <label for="">Kode Produk</label>
                  <input name="kode_produk" class="form-control" value="<?= $value['kode_produk'] ?>" placeholder="Kode Produk" readonly>
              </div>

              <div class="form-group">
                   <label for="">Nama Produk</label>
                  <input name="nama_produk" class="form-control" value="<?= $value['nama_produk'] ?>" placeholder="Nama Produk" required>
              </div>

              <div class="form-group">
                   <label for="">Kategori</label>
                  <select name="id_kategori" class="form-control">
                    <option value="">--pilih kategori--</option>
                    <?php foreach ($kategori as $key => $k) { ?>
                      <option value="<?= $k['id_kategori'] ?>" <?= $value['id_kategori'] == $k['id_kategori'] ? 'selected' :'' ?>><?= $k['nama_kategori'] ?></option>
                    <?php } ?>
                  </select>
              </div>

              <div class="form-group">
                   <label for="">Satuan</label>
                  <select name="id_satuan" class="form-control">
                    <option value="">--pilih Satuan--</option>
                    <?php foreach ($satuan as $key => $s) { ?>
                      <option value="<?= $s['id_satuan'] ?>" <?= $value['id_satuan'] == $s['id_satuan'] ? 'selected' :'' ?>><?= $s['nama_satuan'] ?></option>
                    <?php } ?>
                  </select>
              </div>

              <div class="form-group">
                   <label for="">Harga Beli</label>
                   <div class="input-group mb-3">
                   <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input name="harga_beli" id="harga_beli<?= $value['id_produk'] ?>" value="<?= $value['harga_beli'] ?>" class="form-control" placeholder="Harga Beli" required>
              </div>
              </div>

              <div class="form-group">
                   <label for="">Harga Jual</label>
                   <div class="input-group mb-3">
                   <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input name="harga_jual" id="harga_jual<?= $value['id_produk'] ?>" value="<?= $value['harga_jual'] ?>" class="form-control" placeholder="Harga jual" required>
              </div>
              </div>


              <div class="form-group">
                   <label for="">Stok</label>
                  <input name="stok" type="number" value="<?= $value['stok'] ?>" class="form-control" placeholder="Stok" required>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>

<!-- Modell delete Data-->
<?php foreach ($produk as $key => $value) { ?>
        <div class="modal fade" id="delete-data<?= $value['id_produk']?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
            <p>Apakah Anda Yakin Hapus <?= $value['nama_produk'] ?></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <a href="<?= base_url('produk/HapusData/' . $value['id_produk']) ?>" class="btn btn-danger btn-flat">Delete</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>
      
     <script>
         $(function () {
       $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "paging": true,
      "info": true,
      "ordering": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });


  new AutoNumeric('#harga_jual', {
     digitGroupSeparator: ',',
    decimalPlaces: 0
      });

      new AutoNumeric('#harga_beli', {
        digitGroupSeparator: ',',
    decimalPlaces: 0
      });

      <?php foreach ($produk as $key => $value) { ?>
       new AutoNumeric('#harga_jual<?= $value['id_produk'] ?>', {
        digitGroupSeparator: ',',
        decimalPlaces: 0
       });

       new AutoNumeric('#harga_beli<?=  $value['id_produk'] ?>', {
        digitGroupSeparator: ',',
        decimalPlaces: 0
       });
     <?php } ?>
</script>