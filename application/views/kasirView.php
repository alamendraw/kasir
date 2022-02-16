<style type="text/css">
    @font-face {
        font-family: headTitle;
        src: url(assets/fonts/title.ttf);
    }

    .headTitle {
        font-family: headTitle;
    }

    .tombol {
        height: 80px;
        font-size: large;
        font-weight: bold;
    }

    .table-wrapper {
        max-height: 350px;
        width: 100%;
        overflow: auto;
        display: inline-block;
    }

    .batal {
        color: cornsilk;
        font-weight: bold;
    }
</style>
<link rel="stylesheet" href="<?= base_url('assets/fontawesome.min.css') ?>" />

<div class="col-md-12">
    <div class="row">

        <div class="col-md-4">
            <div class="card mb-3 widget-content bg-malibu-beach">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-numbers text-white"><span class="headTitle">Toko Aura </span></div>
                        <div class="text-white" style="font-weight: bold;font-size: large;"><span>Kasir : <?= $this->session->userdata('namanya'); ?></span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-numbers text-white" style="font-size: xxx-large;"><span>TOTAL</span></div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white" style="font-size: xxx-large;"><span id="total">Rp. 0.00</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <button class="mb-2 mr-2 btn btn-success btn-lg btn-block tombol" onclick="bayar()">BAYAR </button>
            <button class="mb-2 mr-2 btn btn-primary btn-lg btn-block tombol" data-toggle="modal" data-target="#tundaModal">TUNDA </button>
            <button class="mb-2 mr-2 btn btn-info btn-lg btn-block tombol" onclick="panggil()">PANGGIL </button>
            <button class="mb-2 mr-2 btn btn-warning btn-lg btn-block tombol" onclick="hapus('all')">HAPUS </button>

            <button class="mb-2 mr-2 btn btn-danger btn-lg btn-block tombol" onclick="keluar()">KELUAR </button>
        </div>
        <!-- LIST TRANSAKSI  -->
        <div class="col-md-10" id="listTransaksi">
            <div class="main-card mb-3 card">
                <div class="card-body" style="height: 530px;">
                    <div class="input-group">
                        <input type="text" class="form-control" id="scan" placeholder="Scan Barcode Barang" aria-describedby="inputGroupPrepend">
                        <div class="input-group-prepend">
                            <button class="mb-3 mr-3 btn btn-info btn-lg btn-block" id="cari">Cari </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="mb-0 table" border='0' width="100%">
                            <thead>
                                <tr>
                                    <td align="center" style="font-weight: bold;" width="2%">#</td>
                                    <td align="center" style="font-weight: bold;" width="10%">Aksi</td>
                                    <td align="left" style="font-weight: bold;" width="33%">Nama Barang</td>
                                    <td align="center" style="font-weight: bold;" width="5%">QTY</td>
                                    <td align="right" style="font-weight: bold;" width="15%">Harga</td>
                                    <td align="right" style="font-weight: bold;" width="15%">diskon</td>
                                    <td align="right" style="font-weight: bold;" width="20%">Total</td>
                                </tr>
                            </thead>
                            <tbody class="listBarang">
                                <tr>
                                    <td colspan="6" align="center">Tidak ada data</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- LIST BARANG  -->
        <div class="col-md-10" id="listBarang">
            <div class="main-card mb-3 card">
                <div class="card-body" style="height: 530px;">
                    <div class="input-group"> </div>
                    <table id="tabelBarang" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">Kode Barang</th>
                                <th width="60%">Nama Barang</th>
                                <th width="20%">Harga</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- LIST PANGGIL  -->
        <div class="col-md-10" id="listPanggil">
            <div class="main-card mb-3 card">
                <div class="card-body" style="height: 530px;">
                    <div id="dataPanggil"> </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" id="item_code" class="form-control form-group">
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3" align="right">QTY</div>
                        <div class="col-md-9"> <input type="text" id="qty" class="form-control form-group"> </div>
                        <div class="col-md-3" align="right">Diskon</div>
                        <div class="col-md-9"> <input type="text" id="diskon" class="form-control"> </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateTrans()" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL BAYAR  -->
<div class="modal fade" id="bayarModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bayar Belanjaan</h3>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3" align="right">Total Belanja</div>
                        <div class="col-md-9"> <input style="text-align: end;" type="text" id="totalBelanja" class="form-control form-group"> </div>
                        <div class="col-md-3" align="right">Total Diskon</div>
                        <div class="col-md-9"> <input style="text-align: end;" type="text" id="totalDiskon" class="form-control form-group"> </div>
                        <div class="col-md-3" align="right">Total Bayar</div>
                        <div class="col-md-9"> <input style="text-align: end;" type="text" id="totalBayar" class="form-control form-group"> </div>
                        <div class="col-md-3" align="right">Bayar</div>
                        <div class="col-md-9"> <input style="text-align: end;" type="text" id="bayar" onkeyUp="hitungBayar()" class="form-control form-group"> </div>
                        <div class="col-md-3" align="right">Kembali</div>
                        <div class="col-md-9"> <input style="text-align: end;" type="text" id="kembalian" class="form-control form-group"> </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="prosesBayar()">Bayar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TUNDA  -->
<div class="modal fade" id="tundaModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tunda Belanjaan</h3>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4" align="right">Nama Pembeli</div>
                        <div class="col-md-8"> <input style="text-align: start;" type="text" id="namaPembeli" class="form-control form-group"> </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="prosesTunda()" data-dismiss="modal">Tunda</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>



<link rel="stylesheet" href="<?= base_url('assets/'); ?>sweetalert2.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>jquery.dataTables.min.css">
<link href="<?= base_url('assets/'); ?>buttons.dataTables.min.css" rel="stylesheet">
<script src="<?= base_url('assets/fontawesome.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>sweetalert2.js"></script>
<script src="<?= base_url('assets/'); ?>bootstrap.min.js"></script>

<script type="text/javascript">
    $("#scan").on('keypress', function(e) {
        if (e.which == 13) {
            addToList(this.value);
        }
    });
    $("#listBarang").hide();
    $("#listPanggil").hide();
    loadList();

    $("#cari").on('click', function() {
        showBarang();
        loadBarang();
    });

    function loadBarang() {
        tabelbarang = $("#tabelBarang").DataTable({
            destroy: true,
            dom: 'lcBftip',
            buttons: {
                buttons: [{
                    text: 'Batal',
                    attr: {
                        id: 'batal'
                    },
                    action: function(e, dt, node, config) {
                        showTransaksi()
                    }
                }, ],
                dom: {
                    button: {
                        className: "btn btn-warning ml-3 batal"
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            ajax: {
                url: "<?= site_url('KasirController/getBarang') ?>",
                dataSrc: ""
            },
            columns: [{
                    data: "item_code"
                },
                {
                    data: "item_name"
                },
                {
                    data: "harga",
                    className: "text-right"
                }
            ],

        })
    }

    $('#tabelBarang').on('click', 'tr', function() {
        var fila = tabelbarang.row(this).data();
        addToList(fila['item_code']);
        showTransaksi();
    });

    function loadList() {
        $.get("<?= site_url(); ?>/KasirController/listTransTemp", function(data) {
            result = JSON.parse(data);
            tbl = '';
            rtotal = 0;
            $(".listBarang tr").remove();
            if (result.length > 0) {
                for (let i = 0; i < result.length; i++) {
                    rtotal = rtotal + parseInt(result[i].total);
                    itcode = result[i].item_code;
                    tbl = "<tr >" +
                        "<td>" + (i + 1) + "</td>" +
                        "<td><div role='group' class='btn-group-sm nav btn-group'>" +
                        "<a href='javascript:void(0);' class='btn-shadow btn btn-sm btn-danger' onClick='hapus(" + itcode + ")' style='font-weight:bold;'><i class='fa  fa-trash'></i> </a>" +
                        "<a href='javascript:void(0);' class='btn-shadow btn btn-sm btn-primary' onClick='edit(" + itcode + ")' data-toggle='modal' data-target='#myModal' style='font-weight:bold;'><i class='fa  fa-edit'></i></a> " +
                        " </div></td>" +
                        "<td>" + result[i].item_name + "</td>" +
                        "<td align='center'>" + result[i].qty + "</td>" +
                        "<td align='right'>" + formatNumber(result[i].harga) + "</td>" +
                        "<td align='right'>" + formatNumber(result[i].diskon) + "</td>" +
                        "<td align='right'>" + formatNumber(result[i].total) + "</td>" +
                        " </tr>";
                    $(".listBarang").append(tbl);
                }
            } else {
                tbl = "<tr >" +
                    "<td colspan='6' align='center'>Data Tidak Ada</td>" +
                    " </tr>";
                $(".listBarang").append(tbl);

            }
            $("#total").html('Rp.' + formatNumber(rtotal) + '.00');
        });
    }

    function bayar() {
        $("#bayarModal").modal('toggle');
        $.get("<?= site_url() ?>/KasirController/bayar", function(data) {
            resBayar = JSON.parse(data);
            $("#totalBelanja").val(resBayar.total);
            $("#totalDiskon").val(resBayar.diskon);
            $("#totalBayar").val(resBayar.bayar);
            $("#bayar").val(0);
            $("#kembalian").val(0);
        });
    }

    function hitungBayar() {
        valTotBayar = $("#totalBayar").val().replace(',', '').replace(',', '').replace(',', '');
        valBayar = $("#bayar").val().replace(',', '').replace(',', '').replace(',', '');
        $("#bayar").val(formatNumber(valBayar));
        $("#kembalian").val(formatNumber(valBayar - valTotBayar));
    }

    function edit(itnya) {
        $("#item_code").val(itnya);
        $.get("<?= site_url() ?>/KasirController/GetTrans?itemcode=" + itnya, function(data) {
            result = JSON.parse(data);
            $("#qty").val(result['qty']);
            $("#diskon").val(result['diskon']);
        });
    }

    function hapus(itnya) {
        Swal.fire({
            title: 'Yakin akan dihapus?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= site_url() ?>/KasirController/DeleteTrans?itemcode=" + itnya);
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus',
                    showConfirmButton: false,
                    timer: 1500
                })
                loadList();
            }
        })
    }

    function updateTrans() {
        itnya = $("#item_code").val();
        qtynya = $("#qty").val();
        diskonnya = $("#diskon").val();
        $.post("<?= site_url() ?>/KasirController/UpdateTrans?itemcode=" + itnya + "&qty=" + qtynya + "&diskon=" + diskonnya, function() {
            loadList();
        });

    }

    function prosesBayar() {
        vbayar = $("#bayar").val().replace(',', '').replace(',', '').replace(',', '');;
        vkembalian = $("#kembalian").val().replace(',', '').replace(',', '').replace(',', '');;
        console.log(vkembalian);
        if (vkembalian <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Pembayaran Kurang',
                showConfirmButton: false,
                timer: 2000
            })
        } else {
            $.post("<?= site_url('KasirController/ProsesBayar?bayar=') ?>" + vbayar + "&kembali=" + vkembalian, function(data) {
                console.log('proses print dengan id : ' + data);
                loadList();
            });

            $("#bayarModal").modal('toggle');
        }

    }

    function addToList(itemCode) {
        $.post("<?= site_url() ?>/KasirController/AddListTrans?id=" + itemCode, function(data) {
            loadList();
            $("#scan").val('');
        });
    }

    function prosesTunda() {
        nama = $("#namaPembeli").val();
        $.post("<?= site_url() ?>/KasirController/tundaTrans?nama=" + nama, function(data) {
            loadList();
            $("#scan").val('');
        });
    }

    function panggil() {
        showPanggil();

        $.get("<?= site_url() ?>/KasirController/getPanggil", function(data) {
            resPang = JSON.parse(data);
            tampilPang = "<button class='mb-2 mr-2 btn btn-warning btn-md btn-block col-md-2' onclick='showTransaksi()'><span style='font-weight: bold; font-size: large;float: left;'> << Batal </span>  </button>";
            for (let i = 0; i < resPang.length; i++) {
                tampilPang += "<button class='mb-2 mr-2 btn btn-info btn-md btn-block' onclick='prosesPanggil(this.id)' id='" + resPang[i]['pembeli'] + "'><span style='font-weight: bold; font-size: large;float: left;'> " + resPang[i]['pembeli'] + " </span> <span style='font-weight: bold; font-size: large;float: right;'> Rp. " + resPang[i]['total'] + " </span></button>";
            }
            $("#dataPanggil").html(tampilPang);
        });
    }

    function prosesPanggil(beli) {
        $.post("<?= site_url() ?>/KasirController/loadPanggil?nama=" + beli, function() {
            loadList();
            showTransaksi();
        });
    }

    function formatNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function showTransaksi() {
        $("#scan").val('');
        $("#scan").focus();
        $("#listTransaksi").show();
        $("#listBarang").hide();
        $("#listPanggil").hide();
    }

    function showBarang() {
        $("#listTransaksi").hide();
        $("#listBarang").show();
        $("#listPanggil").hide();
    }

    function showPanggil() {
        $("#listTransaksi").hide();
        $("#listBarang").hide();
        $("#listPanggil").show();
    }

    function keluar() {
        window.location = "<?= site_url('portal/keluar') ?>";
    }
</script>