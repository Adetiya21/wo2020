<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets/"); ?>datatables/css/dataTables.bootstrap.css">
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="hidden-sm hidden-xs">Riwayat Belanja</h1>
                <h1 class="hidden-md hidden-lg" style="font-size: 18pt;">Riwayat Belanja</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb">

                    <li><a href="<?php echo site_url('') ?>"><i class="glyphicon glyphicon-home"></i></a>
                    </li>
                    <li>Riwayat</li>
                </ul>

            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">


        <div class="row">
         <div class="col-md-9" id="customer-orders">
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab4-1" data-toggle="tab"><i class="icon-star"></i><b>Riwayat Belanja</b></a>
                    </li>
                    <li class=""><a href="#tab4-2" data-toggle="tab"><b>Via Pembayaran</b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab4-1">
                        <p align="justify"><b>Hai, untuk informasi tentang rekening pembayaran, silakan buka di menu Via Pembayaran. Kami akan segera mengkonfirmasi pesanan setelah anda melakukan pembayaran, silakan kirim bukti pembayaran langsung dengan klik detail pesanan.</b> Happy Shopping!</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th>Invoice Order</th>
                                            <th>Tanggal Order</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4-2">
                        <h3>Pembayaran Via Transfer Bank</h3>
                        <img src="<?php echo base_url() ?>assets/front_end/images/support/tf.png" alt="" width="220px" class="hidden-sm hidden-xs">
                        <img src="<?php echo base_url() ?>assets/front_end/images/support/paypal.jpg" alt="" width="40%" class="hidden-md hidden-lg">
                        <br><hr>
                        <h3>No. Rekening : 0000000000</h3>
                            <h4>Nama : Khairi Ramadhan</h4>
                        <hr><br>
                        
                        <br>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.tabs -->

        </div>
        <!-- /.col-md-9 -->

        <div class="col-md-3">
          <div class="panel panel-default sidebar-menu">

            <div class="panel-heading">
              <h3 class="panel-title">Profil User</h3>
          </div>

          <div class="panel-body">

              <ul class="nav nav-pills nav-stacked">
                <li class="akun">
                  <a href="<?= site_url('akun') ?>"><i class="fa fa-user"></i> Akun Saya</a>
              </li>
              <li class="riwayat">
                  <a href="<?= site_url('riwayat') ?>"><i class="fa fa-list"></i> Riwayat Belanja</a>
              </li>
              <li>
                  <a href="<?= site_url('welcome/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
              </li>
          </ul>
      </div>

  </div>
</div>

</div>

</div>


</div>
</div>

<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front_end/js/jquery-1.11.0.min.js"><\/script>')
</script>
<!-- DataTables -->
<script src="<?= base_url("assets/"); ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets/"); ?>datatables/js/dataTables.bootstrap.js"></script>
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

    var table = $('#mytable').DataTable({
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url() ?>riwayat/json", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "invoice"},
        {"data": "tgl"},
        {"data": "total",
        render: function(data) { 
            var reverse = data.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');
                  return 'Rp. '+ribuan;
            },
            defaultContent: 'total'
            
        },
        {"data": "status"},
        {"data": "view","orderable": false},
        ],
        order: [[2, 'desc']],
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

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.riwayat').addClass('active');
    });
</script>