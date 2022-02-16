<?php (defined('BASEPATH')) or exit('No direct script access allowed');


if (!function_exists('is_login')) {
    function is_login()
    {
        $app = &get_instance();
        if ($app->session->userdata('logged_in')) {
            return true;
        }
        return false;
    }
}

if (!function_exists('userinfo')) {
    function userinfo($var = null)
    {
        $app = &get_instance();
        $userinfo = $app->session->userdata('login_user');
        if (is_null($var)) {
            return $userinfo;
        } else {
            return $userinfo[$var];
        }
    }
}

if (!function_exists('formatBukti')) {
    function formatBukti($nomor = null)
    {
        if (strlen($nomor) == 1) {
            return '00000' . $nomor;
        } else if (strlen($nomor) == 2) {
            return '0000' . $nomor;
        } else if (strlen($nomor) == 3) {
            return '000' . $nomor;
        } else if (strlen($nomor) == 4) {
            return '00' . $nomor;
        } else {
            return '0' . $nomor;
        }
    }
}

if (!function_exists('upload_path')) {
    function upload_path()
    {
        $path_year = '../uploads/' . date('Y') . '/';
        if (!is_dir($path_year)) {
            mkdir($path_year);
        }
        $path_month = $path_year . date('m') . '/';
        if (!is_dir($path_month)) {
            mkdir($path_month);
        }

        return $path_month;
    }
}

if (!function_exists('upload_url')) {
    function upload_url($filepath)
    {
        if ($_SERVER['HTTP_HOST'] != 'localhost') {
            $upload_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $upload_url .= "://" . @$_SERVER['HTTP_HOST'] . $filepath;
        } else {
            $upload_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $upload_url .= "://" . @$_SERVER['HTTP_HOST'] . $filepath;
        }

        return $upload_url;
    }
}

if (!function_exists('handle_image')) {
    function handle_image($image)
    {
        if (!empty($image) && substr($image, 0, 4) != 'http') {
            $image = upload_url($image);
        }

        return $image;
    }
}

if (!function_exists('encode')) {
    function encode($string)
    {
        return encrypt_decrypt('encrypt', $string);
    }
}

if (!function_exists('decode')) {
    function decode($string)
    {
        return encrypt_decrypt('decrypt', $string);
    }
}

if (!function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '4y0b3b@sk4nD!R1d4r1r!b4';
        $secret_iv = 'h1DupT4np@r!b@';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}

/*==-- Image link --==*/
if (!function_exists('image_url')) {
    function image_url($url)
    {
        $base_url = str_replace('/administrator', '', site_url());
        return str_replace($base_url . 'media/images/', "", $url);
    }
}

/*==-- Print link --==*/
if (!function_exists('print_link')) {
    function print_link($link, $title)
    {
        $anchor = anchor($link, '<i class="fa fa-print"></i>', array('class' => 'btn btn-sm btn-success', 'title' => $title));
        return $anchor;
    }
}

/*==-- Edit link --==*/
if (!function_exists('edit_link')) {
    function edit_link($link, $title)
    {
        $anchor = '<a href="#" data-href="' . site_url($link) . '" class="btn btn-sm green-jungle ajax" title="' . $title . '"><i class="fa fa-pencil"></i></a>';
        return $anchor;
    }
}

/*==-- Delete link --==*/
if (!function_exists('delete_link')) {
    function delete_link($link, $title, $alert)
    {
        $anchor = anchor($link, '<i class="fa fa-trash-o"></i>', array('class' => 'btn btn-sm red-flamingo', 'title' => $title, 'onclick' => "return confirm('" . sprintf(lang('alert_delete'), $alert) . "');"));
        return $anchor;
    }
}

/*==-- Add URL --==*/
if (!function_exists('add_url')) {
    function add_url($controller)
    {
        return site_url($controller . '/create');
    }
}

/*==-- JSON to Array --==*/
if (!function_exists('to_array')) {
    function to_array($json)
    {
        $array = json_decode($json, TRUE);
        return (is_array($array)) ? $array : FALSE;
    }
}

/*==-- Array to JSON --==*/
if (!function_exists('to_json')) {
    function to_json($array)
    {
        return (is_array($array)) ? json_encode($array) : FALSE;
    }
}

/*==-- Age calculator --==*/
if (!function_exists('age')) {
    function age($birthdate)
    {
        $from = new DateTime($birthdate);
        $to   = new DateTime('today');
        return $from->diff($to)->y;
    }
}

/*==-- Rupiah currency --==*/
if (!function_exists('rupiah')) {
    function rupiah($val)
    {
        $value = number_format($val, 0, ',', '.');
        return 'Rp. ' . $value;
    }
}

/*==-- return save --==*/
if (!function_exists('returnSave')) {
    function returnSave($save, $submit, $control, $action, $return_url = NULL)
    {
        if ($action == 'insert') {
            $act_msg = 'added';
        } else {
            $act_msg = 'updated';
        }
        if ($save === TRUE) {
            if ($submit == '1') {
                echo successMessage($control . ' succesfully ' . $act_msg . '.', $return_url);
            } elseif ($submit == '2') {
                echo successMessage($control . ' succesfully ' . $act_msg . '.', $return_url . '/insert');
            }
        } else {
            echo errorMessage('Failed to save ' . $control . '.');
        }
    }
}

/*==-- Success message --==*/
if (!function_exists('successMessage')) {
    function successMessage($message, $redirect = NULL)
    {
        $msg = '<div class="alert alert-success alert-solid" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-checkmark-circle alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                  <span>' . trim($message) . '</span>
                </div>
              </div>';
        if ($redirect != NULL) {
            $msg .= '<script>$("html, body").animate({ scrollTop: 0 }, 600); setTimeout("window.location=\'' . site_url($redirect) . '\'",1000)</script>';
        } else {
            $msg .= '<script>$("html, body").animate({ scrollTop: 0 }, 600);</script>';
        }
        return $msg;
    }
}

/*==-- Error message --==*/
if (!function_exists('errorMessage')) {
    function errorMessage($message)
    {
        $msg = '<div class="alert alert-danger alert-solid" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-alert alert-icon tx-32"></i>
                  <span>' . trim($message) . '</span>
                </div>
              </div>';
        $msg .= '<script>$("html, body").animate({ scrollTop: 0 }, 600);</script>';
        return $msg;
    }
}

if (!function_exists('deleteMessage')) {
    function deleteMessage($status, $title)
    {
        if ($status == "success") {
            echo successMessage($title . ' successfully deleted.');
        } elseif ($status == "error") {
            echo errorMessage('Failed to delete ' . $title);
        }
    }
}

if (!function_exists('clearForm')) {
    function clearForm()
    {
        return '<script>$("input,textarea,select").val("");</script>';
    }
}

if (!function_exists('loadPage')) {
    function loadPage($url, $title)
    {
        return "<script>
        var url = '$url';
        var title = '$title';
        $('#content-container').load(url);
        document.title = title + ' | Endraw';
        window.history.pushState('', title, url);
        $(this).parent().siblings().removeClass('active');
        $(this).parent().siblings().find('ul').hide();
        $(this).parent().siblings().find('li').removeClass('active');
        $(this).parent().siblings().find('.icon-thumbnail').removeClass('bg-success');
        $(this).parent().addClass('active');
        $(this).parent().parent().parent().siblings().removeClass('active');
        $(this).parent().parent().parent().siblings().find('li').removeClass('active');
        $(this).parent().parent().parent().siblings().find('.icon-thumbnail').removeClass('bg-success');
        $(this).parent().parent().parent().addClass('active');
        $(this).siblings('.icon-thumbnail').addClass('bg-success');
        </script>";
    }
}

/*==-- Ajax redirect --==*/
if (!function_exists('ajaxRedirect')) {
    function ajaxRedirect($redirect = '', $timer = 10000)
    {
        if ($timer == 0) {
            return '<script>window.location.href="' . site_url($redirect) . '";</script>';
        } else {
            return '<script>setTimeout("window.location.href=\'' . site_url($redirect) . '\'",' . $timer . ');</script>';
        }
    }
}

if (!function_exists('excerpt')) {
    function excerpt($content, $length = 200, $striptags = FALSE, $delimiter = '')
    {
        $excerpt = explode('<div style="page-break-after: always;"><span style="display:none">&nbsp;</span></div>', $content, 2);
        if (count($excerpt) > 1) {
            $excerpt_fix = ($striptags != FALSE) ? strip_tags(htmlspecialchars_decode($excerpt[0])) : closetags(htmlspecialchars_decode($excerpt[0]));
        } else {
            $excerpt_fix = ($striptags != FALSE) ? strip_tags(substr(htmlspecialchars_decode($content), 0, $length)) : closetags(substr(htmlspecialchars_decode($content), 0, $length));
        }
        return ($length < strlen($content)) ? $excerpt_fix . $delimiter : $excerpt_fix;
    }
}

if (!function_exists('closetags')) {
    function closetags($html)
    {
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];

        $len_opened = count($openedtags);

        if (count($closedtags) == $len_opened) {
            return $html;
        }

        $openedtags = array_reverse($openedtags);

        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }
}

if (!function_exists('date_indo')) {
    function date_indo($fulldate)
    {
        $date = substr($fulldate, 8, 2);
        $month = get_month(substr($fulldate, 5, 2));
        $year = substr($fulldate, 0, 4);
        return $date . ' ' . $month . ' ' . $year;
    }
}

if (!function_exists('date_indonesia')) {
    function date_indonesia($fulldate)
    {
        $date = substr($fulldate, 8, 2);
        $month = get_month(substr($fulldate, 5, 2));
        $year = substr($fulldate, 0, 4);
        return $date . ' ' . $month . ' ' . $year;
    }
}

if (!function_exists('date_simple')) {
    function date_simple($fulldate)
    {
        $date = substr($fulldate, 8, 2);
        $month = substr($fulldate, 5, 2);
        $year = substr($fulldate, 0, 4);
        return $date . '-' . $month . '-' . $year;
    }
}

if (!function_exists('date_normal')) {
    function date_normal($fulldate)
    {
        $date = substr($fulldate, 8, 2);
        $month = get_month3(substr($fulldate, 5, 2));
        $year = substr($fulldate, 0, 4);
        $time = substr($fulldate, 11, 8);
        return $date . '/' . $month . '/' . $year . ' ' . $time;
    }
}

if (!function_exists('date_time')) {
    function date_time($fulldate)
    {
        $date = substr($fulldate, 0, 2);
        $month = get_month2(substr($fulldate, 3, 3));
        $year = substr($fulldate, 7, 4);
        $time = substr($fulldate, 12, 5);
        return $year . '-' . $month . '-' . $date . ' ' . $time;
    }
}

if (!function_exists('mysql_date')) {
    function mysql_date($fulldate)
    {
        $date = substr($fulldate, 0, 2);
        $month = substr($fulldate, 3, 2);
        $year = substr($fulldate, 6, 4);
        $time = substr($fulldate, 11, 8);
        return $year . '-' . $month . '-' . $date . ' ' . $time;
    }
}

if (!function_exists('month_romawi')) {
    function month_romawi($month)
    {
        switch ($month) {
            case 1:
                return "I";
            case 2:
                return "II";
            case 3:
                return "III";
            case 4:
                return "IV";
            case 5:
                return "V";
            case 6:
                return "VI";
            case 7:
                return "VII";
            case 8:
                return "VIII";
            case 9:
                return "IX";
            case 10:
                return "X";
            case 11:
                return "XI";
            case 12:
                return "XII";
        }
    }
}

if (!function_exists('get_month')) {
    function get_month($month)
    {
        switch ($month) {
            case 1:
                return "Januari";
            case 2:
                return "Februari";
            case 3:
                return "Maret";
            case 4:
                return "April";
            case 5:
                return "Mei";
            case 6:
                return "Juni";
            case 7:
                return "Juli";
            case 8:
                return "Agustus";
            case 9:
                return "September";
            case 10:
                return "Oktober";
            case 11:
                return "November";
            case 12:
                return "Desember";
        }
    }
}

if (!function_exists('get_month2')) {
    function get_month2($month)
    {
        switch ($month) {
            case "Jan":
                return "01";
            case "Feb":
                return "02";
            case "Mar":
                return "03";
            case "Apr":
                return "04";
            case "May":
                return "05";
            case "Jun":
                return "06";
            case "Jul":
                return "07";
            case "Aug":
                return "08";
            case "Sep":
                return "09";
            case "Oct":
                return "10";
            case "Nov":
                return "11";
            case "Dec":
                return "12";
        }
    }
}

if (!function_exists('get_month3')) {
    function get_month3($month)
    {
        switch ($month) {
            case "01":
                return "Jan";
            case "02":
                return "Feb";
            case "03":
                return "Mar";
            case "04":
                return "Apr";
            case "05":
                return "May";
            case "06":
                return "Jun";
            case "07":
                return "Jul";
            case "08":
                return "Aug";
            case "09":
                return "Sep";
            case "10":
                return "Oct";
            case "11":
                return "Nov";
            case "12":
                return "Dec";
        }
    }
}


if (!function_exists('terbilang')) {
    function terbilang($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = terbilang($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = terbilang($nilai / 10) . " puluh" . terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . terbilang($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = terbilang($nilai / 100) . " ratus" . terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = terbilang($nilai / 1000) . " ribu" . terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = terbilang($nilai / 1000000) . " juta" . terbilang($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = terbilang($nilai / 1000000000) . " milyar" . terbilang(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = terbilang($nilai / 1000000000000) . " trilyun" . terbilang(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}


if (!function_exists('duration')) {
    function duration($time)
    {
        $diff = $time / 1000;

        if ($diff < 1) {
            return 'less than 1 sec';
        }

        $time_rules = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'min',
            1 => 'sec'
        );

        foreach ($time_rules as $secs => $str) {
            $div = $diff / $secs;
            if ($div >= 1) {
                $t = round($div);
                return $t . ' ' . $str .
                    ($t > 1 ? 's' : '');
            }
        }
    }
}

if (!function_exists('format_number')) {
    function format_number($number, $decimal = 0)
    {
        $number = round($number, $decimal);
        return number_format($number, $decimal, ',', '.');
    }
}

if (!function_exists('array_unshift_assoc')) {
    function array_unshift_assoc(&$arr, $key, $val)
    {
        $arr = array_reverse($arr, true);
        $arr[$key] = $val;
        $arr = array_reverse($arr, true);
        return $arr;
    }
} 
/* End of file common_helper.php */
/* Location: ./system/helpers/common_helper.php */
