<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.produk').addClass('active');
    });

    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="feather icon-layout bg-c-blue"></i>
          <div class="d-inline">
            <h5>Tambah Gambar <?= $produk->nama ?></h5>
            <span>Berikut daftar gambar produk <?= $produk->nama ?>.</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class=" breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="<?= site_url('vendor/home') ?>"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= site_url('vendor/produk') ?>">Produk</a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= site_url('vendor/produk_gambar/i/'.$produk->id) ?>"><?= $produk->nama ?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">
          <div class="row">
            
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Data Produk</h5>
                    <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive">
                    <table class="table table-responsive">
                      <tbody>
                        <tr>
                          <th width="15%">Nama Produk</th>
                          <td width="1%">:</td>
                          <td><?= $produk->nama ?></td>
                        </tr>
                        <tr>
                          <th>Kategori Produk</th>
                          <td>:</td>
                          <td><?= $kategory_produk ?></td>
                        </tr><tr>
                          <th>Harga Produk</th>
                          <td>:</td>
                          <td>Rp. <?= rupiah($produk->harga); ?></td>
                        </tr>
                        <tr>
                          <th>Tanggal Posting</th>
                          <td>:</td>
                          <td><?php echo date('d F Y', strtotime($produk->tgl)); ?></td>
                        </tr>
                        <tr>
                          <th>Kuantitas Penjualan (Stok)</th>
                          <td>:</td>
                          <td><?= $produk->kuantitas_penjualan ?></td>
                        </tr>
                        <tr>
                          <th>Link Produk</th>
                          <td>:</td>
                          <td>
                            <a class="btn btn-primary btn-rounded btn-sm" href="<?= site_url('produk/detail/'.$produk->slug) ?>" target="_blank"><span class="fa fa-eye"></span></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Form Tambah Gambar Produk</h5>
                    <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive">
                    <div class="form-group">
                      <p><?= $this->session->flashdata('error'); ?></p>
                    </div>
                    <form action="<?= site_url('vendor/produk_gambar/proses') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">            
                      <input type="hidden" name="id_produk" value="<?= $produk->id ?>" style="display: none">
                      <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                      <div class="form-group">
                        <label>Gambar</label><br>
                        <?= $this->session->flashdata('upload_error') ?>
                          <input id="uploadImage" type="file" name="gambar" onchange="PreviewImage();" class="form-control"/>
                        <p class="help-block">Max. 2MB</p>
                        <img id="uploadPreview" style="width:200px; height:200px;" />
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary form-control" onclick="refreshTokens()" type="submit"> Simpan</button>
                      </div>
                      <? form_close(); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5>Data Gambar Produk <?= $produk->nama ?></h5>
                    <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive">
                    <table id="compact" class="table table-responsive table-bordered table-hover nowrap" width="100%">
                      <thead>
                        <tr><th width="1%">No</th>
                        <th width="300px">Gambar</th>
                        <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- DataTables -->
<script src="<?= base_url('assets/') ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>datatables/js/dataTables.bootstrap.js"></script>

<script src="<?= base_url('assets/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $('#compact').DataTable({
      oLanguage: {
        sProcessing: "loading..."
      },
      processing: true,
      serverSide: true,
      ajax: {"url": "<?= base_url() ?>vendor/produk_gambar/json/<?= $produk->id ?>", "type": "POST"},
      columns: [
      {
        "data": "id",
        "orderable": false
      },
      {"data": "gambar"},
      {"data": "view","orderable": false}
      ],
      rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    //Fun Hapus
    function hapus(id)
    {
        if(confirm('Anda yakin ingin menghapus data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : '<?php echo site_url("vendor/produk_gambar/hapus/'+id+'") ?>',
                type: "POST",
                dataType: "JSON",
                data: { <?= $this->security->get_csrf_token_name(); ?> : function () {
                  refreshTokens();
                  return $( "#csrfHash" ).val();
              }},
              success: function(data)
              {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Data Gagal Dihapus, Data Mungkin Sedang Digunakan');
                }
            });
        }
    }

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>