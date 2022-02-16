<div class="col-md-12" id="listBarang">
    <div class="main-card mb-3 card">
        <div class="card-body" style="min-height: 530px;">
            <div class="input-group"> </div>
            <table id="tabelBarang" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="20%">Kode Barang</th>
                        <th width="40%">Nama Barang</th>
                        <th width="20%">Harga</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="cetakModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cetak Label</h3>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12"> <input style="text-align: start;" type="text" id="itcode" class="form-control form-group" disabled> </div>
                        <div class="col-md-4" align="right">Jumlah Label</div>
                        <div class="col-md-8"> <input type="text" id="jumlah" class="form-control form-group" style="text-align: end;"> </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="prosesCetak()" data-dismiss="modal">Cetak</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/'); ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>sweetalert.min.js"></script>
<script>
    loadBarang();
    $("#jumlah").on('keyup', function() {
        jmml = this.value.replace(',', '').replace(',', '').replace(',', '');
        $("#jumlah").val(formatNumber(jmml));
    });

    function loadBarang() {
        tabelbarang = $("#tabelBarang").DataTable({
            destroy: true,
            dom: 'lcBftip',
            buttons: {
                buttons: [{
                    text: 'Tambah',
                    attr: {
                        id: 'tambah'
                    },
                    action: function(e, dt, node, config) {
                        tambah()
                    }
                }, ],
                dom: {
                    button: {
                        className: "btn btn-primary ml-3 tambah"
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            ajax: {
                url: "<?= site_url('AdminController/getBarang') ?>",
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
                }, {
                    data: "tombol"
                }
            ],

        })
    }

    function edit(idnya) {
        window.location = "<?= site_url('edit-barang?q=') ?>" + idnya;
    }

    function hapus(idnya) {
        swal({
                title: "Data akan dihapus?",
                text: " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: "<?= site_url('hapus-barang?q='); ?>" + idnya,

                        dataType: 'json',
                        success: function(data) {
                            toastr["success"](data.message);
                            loadBarang();
                        }
                    });
                } else {
                    swal("Batal Menghapus Data!");
                }
            });
    }

    function tambah() {
        window.location = "<?= site_url('tambah-barang') ?>";
    }

    function cetak(itcode) {
        $("#itcode").val(itcode);
    }

    function prosesCetak() {
        jml = $("#jumlah").val().replace(',', '').replace(',', '').replace(',', '');
        itcode = $("#itcode").val();
        window.open("<?= site_url('cetak-barcode?q='); ?>" + itcode + "&j=" + jml);
    }

    function formatNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>