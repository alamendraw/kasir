<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body" style="min-height: 530px;">
            <h4 style="font-weight: bold;">Data Barang</h4>
            <hr>
            <form id="formBarang" action="<?= site_url('AdminController/saveBarang') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-row">

                    <div class="col-md-4">
                        <input name="type" placeholder="" value="<?= $type; ?>" type="hidden" class="form-control clear">
                        <input name="id" placeholder="" value="<?= ($type == 'edit') ? $data->id : ''; ?>" type="hidden" class="form-control clear">

                        <div class="position-relative form-group">
                            <label for="" class="">Kode Barang</label>
                            <input name="item_code" id="item_code" placeholder="" value="<?= ($type == 'edit') ? $data->item_code : ''; ?>" type="text" class="form-control clear">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="position-relative form-group">
                            <label for="" class="">Nama Barang</label>
                            <input name="item_name" id="item_name" placeholder="" value="<?= ($type == 'edit') ? $data->item_name : ''; ?>" type="text" class="form-control clear">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="" class="">Stok</label>
                            <input name="stok" id="stok" placeholder="" value="<?= ($type == 'edit') ? number_format($data->stok) : ''; ?>" style="text-align:end;" type="text" class="form-control clear">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="position-relative form-group">
                            <label for="" class="">Harga</label>
                            <input name="harga" id="harga" placeholder="" value="<?= ($type == 'edit') ? number_format($data->harga) : ''; ?>" style="text-align:end;" type="text" class="form-control clear">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="" class="">Diskon</label>
                            <input name="diskon" id="diskon" placeholder="" value="<?= ($type == 'edit') ? number_format($data->diskon) : ''; ?>" style="text-align:end;" type="text" class="form-control clear">
                        </div>
                    </div>
                </div>

                <button class="mt-2 btn btn-warning" id="kembali">Kembali</button>
                <button class="mt-2 btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/validation/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/jquery.form.min.js'); ?>"></script>
<script type="text/javascript">
    $("#harga").on('keyup', function() {
        har = this.value.replace(',', '').replace(',', '').replace(',', '');
        $("#harga").val(formatNumber(har))
    });
    $("#diskon").on('keyup', function() {
        dis = this.value.replace(',', '').replace(',', '').replace(',', '');
        $("#diskon").val(formatNumber(dis))
    });
    $("#stok").on('keyup', function() {
        qty = this.value.replace(',', '').replace(',', '').replace(',', '');
        $("#stok").val(formatNumber(qty))
    });
    $(function() {
        $("#formBarang").validate({
            errorElement: "span",
            errorClass: 'help-block',
            highlight: function(element) {
                $(element).parent().addClass('error');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass('error');
            },
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    success: function(resp) {
                        response = JSON.parse(resp);
                        if (response.status === 'success') {
                            toastr.success(response.message, 'Success', {
                                "closeButton": true
                            });
                            if ("<?= $type; ?>" == 'add') {
                                $(".clear").val('');
                            }

                        } else {
                            toastr.error(response.message, 'Error', {
                                "closeButton": true
                            });
                        }
                    },
                    error: function(data) {}
                });
            }
        });
    });


    $("#kembali").on('click', function() {
        window.location.href = "<?= site_url('data-barang'); ?>";
    });

    function formatNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>