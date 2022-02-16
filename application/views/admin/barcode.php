<!-- kertas label : Ukuran label Golden Cock 121 -->
<style>
    @page {
        size: A4 landscape;
        margin: 10%;
    }

    .barcode {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 45mm;
        text-align: center;
    }
</style>

<table>
    <?php if ($jumlah % 2 == 0) { ?>
        <?php for ($i = 0; $i < $jumlah / 2; $i++) { ?>

            <tr>
                <td>
                    <div style=" width:76mm; height:38mm; padding:2mm;">
                        <div class="barcode">
                            <span><?= $nama; ?></span>
                            <img style="width: 100%;" src="<?= site_url('img-barcode?q=') . $code; ?>" alt="">
                        </div>
                    </div>
                </td>
                <td>
                    <div style=" width:76mm; height:38mm; padding:2mm;">
                        <div class="barcode">
                            <span><?= $nama; ?></span>
                            <img style="width: 100%;" src="<?= site_url('img-barcode?q=') . $code; ?>" alt="">
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <?php for ($i = 0; $i < $jumlah / 2 - 1; $i++) { ?>

            <tr>
                <td>
                    <div style=" width:76mm; height:38mm; padding:2mm;">
                        <div class="barcode">
                            <span><?= $nama; ?></span>
                            <img style="width: 100%;" src="<?= site_url('img-barcode?q=') . $code; ?>" alt="">
                        </div>
                    </div>
                </td>
                <td>
                    <div style=" width:76mm; height:38mm; padding:2mm;">
                        <div class="barcode">
                            <span><?= $nama; ?></span>
                            <img style="width: 100%;" src="<?= site_url('img-barcode?q=') . $code; ?>" alt="">
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td>
                <div style=" width:76mm; height:38mm; padding:2mm;">
                    <div class="barcode">
                        <span><?= $nama; ?></span>
                        <img style="width: 100%;" src="<?= site_url('img-barcode?q=') . $code; ?>" alt="">
                    </div>
                </div>
            </td>
            <td>

            </td>
        </tr>
    <?php }
    ?>

</table>

<script>
    print()
</script>