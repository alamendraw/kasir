<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KasirModel extends CI_Model
{

    public function prosesMasuk()
    {
        $id = $_REQUEST['id'];
        return $this->db->query("SELECT * from pegawai where pin='$id'")->row();
    }

    public function getListTrans()
    {
        return $this->db->query("SELECT item_code,item_name,qty,harga,ifnull(diskon,0) diskon,total from trans_temp order by id desc")->result_array();
    }

    public function getBarang()
    {
        return $this->db->query("SELECT item_code,item_name,format(harga,0) harga FROM m_barang where item_code is not null")->result_array();
    }

    public function addListTrans($id)
    {
        return $this->db->query("INSERT INTO trans_temp (item_code,item_name,qty,harga,diskon,total)
        SELECT item_code,item_name,1 as qty,harga,diskon,(harga-ifnull(diskon,0)) total from m_barang WHERE item_code='$id'");
    }
    public function updateListTrans($id)
    {
        return $this->db->query("UPDATE trans_temp SET qty=qty+1, total=(qty*harga) WHERE item_code='$id'");
    }
    public function cekListTrans($id)
    {
        return $this->db->query("SELECT qty from trans_temp WHERE item_code='$id'")->row('qty');
    }
    public function updateTrans()
    {
        $itemcode = $_REQUEST['itemcode'];
        $qty = $_REQUEST['qty'];
        $diskon = $_REQUEST['diskon'];
        return $this->db->query("update trans_temp set qty='$qty', diskon='$diskon', total=(qty*harga)-diskon where item_code='$itemcode'");
    }
    public function getTrans()
    {
        $item_code = $_REQUEST['itemcode'];
        return $this->db->query("SELECT * from trans_temp where item_code='$item_code'")->row();
    }
    public function delTrans()
    {
        $item_code = $_REQUEST['itemcode'];
        if ($item_code == 'all') {
            return $this->db->query("DELETE from trans_temp");
        } else {
            return $this->db->query("DELETE from trans_temp where item_code='$item_code'");
        }
    }
    public function bayar()
    {
        return $this->db->query("SELECT format(sum(total),0) total, format(ifnull(sum(diskon),0),0) diskon,format((sum(total)-ifnull(sum(diskon),0)),0) bayar from trans_temp")->row();
    }

    public function ProsesBayar()
    {
        $kasir = $this->session->userdata('namanya');
        $bayar = $_REQUEST['bayar'];
        $kembali = $_REQUEST['kembali'];
        $proses = $this->db->query("insert into transaksi (kasir,nilai_belanja,diskon,total,bayar,kembali)
        SELECT '$kasir' kasir, nilai, diskon,total,'$bayar' bayar,$kembali kembali from(
            SELECT (qty*harga) nilai, sum(diskon) diskon, (total-ifnull(sum(diskon),0)) total from trans_temp
            )zx");
        if ($proses) {
            $id = $this->db->query("SELECT MAX(no_kwitansi) nomor from transaksi")->row('nomor');
            $this->db->query("insert into transaksi_detail
            SELECT '$id' no_kwitansi,item_code,item_name,qty,harga,diskon,total from trans_temp");
            $this->db->query("delete from trans_temp");
            return $id;
        } else {
            return false;
        }
    }

    public function tundaTrans()
    {
        $nama = $_REQUEST['nama'];
        $this->db->query("INSERT into trans_tunda (pembeli,item_code,item_name,qty,harga,diskon,total)
        SELECT '$nama',item_code,item_name,qty,harga,diskon,total from trans_temp");
        $this->db->query("DELETE from trans_temp");
    }

    public function getPanggil()
    {
        return $this->db->query("SELECT pembeli, FORMAT(sum(qty*total),0) total from trans_tunda where pembeli is not null GROUP BY pembeli")->result_array();
    }

    public function prosesPanggil()
    {
        $nama = $_REQUEST['nama'];
        $this->db->query("INSERT into trans_temp (item_code,item_name,qty,harga,diskon,total)
        SELECT item_code,item_name,qty,harga,diskon,total from trans_tunda where pembeli='$nama'");
        return $this->db->query("DELETE FROM trans_tunda where pembeli='$nama'");
    }

    public function dataStruk($id = '', $type = '')
    {
        if ($type == "head") {
            return $this->db->query("SELECT * FROM transaksi where no_kwitansi=$id")->row();
        } else {
            return $this->db->query("SELECT * FROM transaksi_detail where no_kwitansi=$id")->result_array();
        }
    }
}
