<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'portal';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['page-kasir'] = 'KasirController';
$route['page-admin'] = 'AdminController';
$route['data-barang'] = 'AdminController/dataBarang';
$route['tambah-barang'] = 'AdminController/tambahBarang';
$route['edit-barang'] = 'AdminController/editBarang';
$route['hapus-barang'] = 'AdminController/hapusBarang';
$route['cetak-barcode'] = 'AdminController/barcode';
$route['img-barcode'] = 'AdminController/set_barcode';
$route['cetak-struk'] = 'KasirController/cetakStruk';
