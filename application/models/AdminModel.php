<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function getBarang()
    {
        return $this->db->query("SELECT id,item_code,item_name,format(harga,0) harga FROM m_barang where item_code is not null order by id desc")->result_array();
    }

    public function saveBarang()
    {
        $data = array(
            'diskon' => str_replace(',', '', $_POST['diskon']),
            'harga' => str_replace(',', '', $_POST['harga']),
            'item_code' => $_POST['item_code'],
            'item_name' => $_POST['item_name'],
            'stok' => str_replace(',', '', $_POST['stok'])
        );
        if ($_POST['type'] == 'add') {
            return $this->db->insert('m_barang', $data);
        } else {
            return $this->db->update('m_barang', $data, ['id' => $_POST['id']]);
        }
    }

    public function getDetailBarang()
    {
        $id = $_REQUEST['q'];
        return $this->db->query("SELECT * FROM m_barang WHERE id='$id'")->row();
    }

    public function hapusBarang()
    {
        $id = $_REQUEST['q'];
        return $this->db->query("DELETE FROM m_barang WHERE id='$id'");
    }

    public function getNama($code)
    {
        return $this->db->query("SELECT item_name as nama FROM m_barang where item_code='$code'")->row('nama');
    }
}
