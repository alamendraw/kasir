<html>

<head>
    <title>Struk Pembayaran</title>
    <style>

    </style>
</head>

<body style='font-family:tahoma; '>
    <!-- 219 -->
    <table style='width:58mm; font-family:calibri; border-collapse: collapse; font-size:11px;' border='0'>
        <tr>
            <td width='100%' align='center' style="padding-bottom: 8px;">
                <span style="font-weight: bold; font-size:18px;">TOKO AURA</span></br>
                <span style="font-weight: bold;"> Desa Cikalong Kec.Cilamaya Kab.Karawang</span></br>
                <span>Whatsapp : 08568432233</span></br>
            </td>
        </tr>
        <tr>
            <td width='100%' style="border-bottom: solid 1px black;">
                <span style="float:left;">No.Bukti : <?= formatBukti($head->no_kwitansi); ?></span>
                <span style="float:right;"><?= date_simple($head->tanggal) ?></span>
            </td>
        </tr>


    </table>

    <table cellspacing='0' cellpadding='0' style='width:58mm; font-size:11px; font-family:calibri;  border-collapse: collapse;' border='0'>
        <?php
        $diskon = 0;
        $total = 0;
        foreach ($detail as $row) {
            $diskon = $diskon + $row['diskon'];
            $total = $total + $row['total'];
        ?>
            <tr>
                <td style='vertical-align:top;font-weight: bold;padding-top:4px;' colspan="3"><?= $row['item_name']; ?></td>
            </tr>
            <tr>
                <td style='vertical-align:top'><?= $row['qty']; ?> x</td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'><?= number_format($row['harga']); ?></td>
                <td style='text-align:right; vertical-align:top'><?= number_format($row['total']); ?></td>
            </tr>
            <tr>
                <td style='vertical-align:top'><?= (empty($row['diskon'])) ? '' : 'Disc (Rp)'; ?></td>
                <td style='text-align:right; vertical-align:top' colspan="2"><?= (empty($row['diskon'])) ? '' : '(' . number_format($row['diskon']) . ')'; ?></td>
            </tr>

        <?php } ?>


        <tr>
            <td colspan='3' style="border-bottom:1px dashed black;"> </td>
        </tr>
        <tr>
            <td colspan='3'>&nbsp;</td>
        </tr>

        <tr>
            <td colspan='2'>
                <div style='text-align:right'>Total belanja : </div>
            </td>
            <td style='text-align:right;'>Rp. <?= number_format($total) ?></td>
        </tr>
        <tr>
            <td colspan='2'>
                <div style='text-align:right'>Potongan : </div>
            </td>
            <td style='text-align:right; border-bottom:solid 0.5px black;'>Rp. <?= number_format($diskon) ?></td>
        </tr>
        <tr>
            <td colspan='2'>
                <div style='padding-bottom:6px;text-align:right;font-weight:bold;font-size:13px;'>Total : </div>
            </td>
            <td style='padding-bottom:6px;text-align:right; font-size:13px;font-weight:bold;;'>Rp. <?= number_format($total - $diskon) ?></td>
        </tr>
        <tr>
            <td colspan='2'>
                <div style='text-align:right'>Cash : </div>
            </td>
            <td style='text-align:right; '>Rp. <?= number_format($head->bayar) ?></td>
        </tr>

        <tr>
            <td colspan='2'>
                <div style='text-align:right'>Kembali : </div>
            </td>
            <td style='text-align:right; '>Rp. <?= number_format($head->kembali) ?></td>
        </tr>
    </table>
    <table style='width:58mm; font-size:11px;' cellspacing='2'>
        <tr></br>
            <td align='center'>------ Terimakasih ------</br></td>
        </tr>
    </table>
</body>

</html>