<?php
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function check($route_name){
    $link = Session::has('linksss')? Session::get('linksss'): array();
    // dd($link);
    if(in_array($route_name, $link)){
        return true;
    }else{
        return false;
    }
}
function activeMenu($route_name, $is_full = true){
    if($is_full){
        $curren_route_name = Route::currentRouteName();
        if($curren_route_name == $route_name){
            echo 'menuActive';
        }
    }else{
        $curren_route_name = explode('.', Route::currentRouteName());
        $route_name = explode('.', $route_name);
        if($curren_route_name[1] == $route_name[1]){
            echo 'active';
        }
    }

}



function get_route_prefix(){
   return  str_replace('/', '', request()->route()->getPrefix());
}

function myEncrypt($value){
    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "TPGtpgSystem";

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt($value, $ciphering,$encryption_key, $options, $encryption_iv);

    // Display the encrypted string
    return base64_encode($encryption);

}

function myDecrypt($encryption){
    $encryption = base64_decode($encryption);
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Store the decryption key
    $decryption_key = "TPGtpgSystem";

    // Use openssl_decrypt() function to decrypt the data
    $decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

    // Display the decrypted string
    return $decryption;
}


function reverse_date($date_string){
    $a_date = explode('-', $date_string);
    if(sizeof($a_date) == 3){
        return $a_date[2] . '-' . $a_date[1] . '-' . $a_date[0];
    }else{
        return $date_string;
    }
}

function storeFile($file, $path){
    // Storage::put('avatars/1', $file);
    return $file->store($path);
}

function storeFileBase64($file){
    $type =  $file->getClientMimeType();
    $file = "data:".$type.";base64,".base64_encode(file_get_contents($file));
    return $file;
}

function storeBase64Image($file) {
    $imgData = Image::make($file)->encode('jpg');
    $file_base64 = "data:image/jpg;base64,".base64_encode($imgData);
    return $file_base64;
}

function showFile($file_path){
    return route('getfile', $file_path);
}

function get_day_kh($id)
{
    $arr = array(
        "0" => "០០",
        "01" => "០១",
        "02" => "០២",
        "03" => "០៣",
        "04" => "០៤",
        "05" => "០៥",
        "06" => "០៦",
        "07" => "០៧",
        "08" => "០៨",
        "09" => "០៩",
        "10" => "១០",
        "11" => "១១",
        "12" => "១២",
        "13" => "១៣",
        "14" => "១៤",
        "15" => "១៥",
        "16" => "១៦",
        "17" => "១៧",
        "18" => "១៨",
        "19" => "១៩",
        "20" => "២០",
        "21" => "២១",
        "22" => "២២",
        "23" => "២៣",
        "24" => "២៤",
        "25" => "២៥",
        "26" => "២៦",
        "27" => "២៧",
        "28" => "២៨",
        "29" => "២៩",
        "30" => "៣០",
        "31" => "៣១"
    );
    return $arr[$id];
}

function get_month_kh($number)
{
    $number = intval($number);
    // if($number<10){
    //     $number = array_map('intval', str_split($number));
    //     $number = $number[1];
    // }
    $arr = array(
        "0", "មករា", "កុម្ភៈ", "មីនា", "មេសា","ឧសភា","មិថុនា","កក្កដា","សីហា","កញ្ញា","តុលា","វិច្ឆិកា","ធ្នូ"
    );
    return $arr[$number];
}

function get_year_kh($year)
{
    $arr_year  = array_map('intval', str_split($year));
    $arr = array(
        "0" => "០",
        "1" => "១",
        "2" => "២",
        "3" => "៣",
        "4" => "៤",
        "5" => "៥",
        "6" => "៦",
        "7" => "៧",
        "8" => "៨",
        "9" => "៩"
    );
    $_year = $arr[$arr_year[0]].$arr[$arr_year[1]].$arr[$arr_year[2]].$arr[$arr_year[3]];
    return $_year;
}

function khmerDate($date=0)
{
    if($date){
        $date = $date;
    }else{
        $date = date('Y-m-d');
    }
    $date = explode('-', $date);
    $date = 'ថ្ងៃទី'.get_day_kh($date[2]).' ខែ'.get_month_kh($date[1]).' ឆ្នាំ'.get_year_kh($date[0]);
    return $date;
}

function khmerNumber($number){

    $arrayNumber  = array_map('intval', str_split($number));

    $arr = [
        "0" => "០",
        "1" => "១",
        "2" => "២",
        "3" => "៣",
        "4" => "៤",
        "5" => "៥",
        "6" => "៦",
        "7" => "៧",
        "8" => "៨",
        "9" => "៩"
    ];
    $res = '';
    foreach ($arrayNumber as $n) {
        $res .= $arr[$n];
    }

    return $res;
}
function reserveDate($date){
    $data = date('Y-m-d', strtotime($data));
    $d = explode('-', $date);
    return $d['2'].'-'.$d['1'].'-'.$d['0'];
}

// argument format  'Y-m-d'
function get_full_date_kh($date){
    $day = get_day_kh($date);
    $month = get_month_kh($date);
    $year = get_year_kh($date);
    return $day.' '. $month .' '. $year;
}

function translateDate($lang = 'en'){
    $date = date('Y-m-d');
    if($lang == 'kh'){
        return get_full_date_kh($date);
    }
    return $date;
}

function tran($en, $kh, $lang = 'en'){
    if($lang == 'kh'){
        return $kh;
    }
    return $en;
}

function numberFormat($amount, $f=2){
    return number_format((float)$amount, 2, '.', '');
}

function convert_number_khmer($number, $is_decimal = false)
{
    $stor_n = $number;
    if (($number < 0) || ($number > 9999999999))
    {
        return 0;
    }
    $gigaga = floor($number / 10000000);
    $giga = floor($number / 1000000);
    // Millions (giga)
    $number -= $giga * 1000000;
    $kilo = floor($number / 1000);
    // Thousands (kilo)
    $number -= $kilo * 1000;
    $hecto = floor($number / 100);
    // Hundreds (hecto)
    $number -= $hecto * 100;
    $deca = floor($number / 10);
    // Tens (deca)
    $n = $number % 10;
    // Ones
    $result = '';
    if ($gigaga)
    {
        $result .= convert_number_khmer($giga) .  'សែន';
    }
    if ($giga)
    {
        $result .= convert_number_khmer($giga) .  'លាន';
    }
    if ($kilo)
    {
        $result .= (empty($result) ? '' : ' ') .convert_number_khmer($kilo) . 'ពាន់';
    }
    if ($hecto)
    {
        $result .= (empty($result) ? '' : ' ') .convert_number_khmer($hecto) . 'រយ';
    }
    $ones = array('សូន្យ', 'មួយ', 'ពីរ', 'បី', 'បួន', 'ប្រាំ', 'ប្រាំមួយ', 'ប្រាំពី', 'ប្រាំបី', 'ប្រាំបួន', 'ដប់', 'ដប់មួយ', 'ដប់ពី', 'ដប់បី', 'ដប់បួន', 'ដប់ប្រាំ', 'ដប់ប្រាំមួយ', 'ដប់ប្រាំពីរ', 'ដប់ប្រាំបី', 'ដប់ប្រាំបួន');
    $tens = array('', '', 'ម្ភៃ', 'សាបសិប', 'សែសិប', 'ហាសិប', 'ហុកសិប', 'ចិតសិប', 'ប៉ែនសិប', 'កៅសិប');
    if ($deca || $n) {
        if (!empty($result))
        {
            $result .= '';
        }
        if ($deca < 2)
        {
            $result .= $ones[$deca * 10 + $n];
        } else {
            $result .= $tens[$deca];
            if ($n)
            {
                $result .= '' . $ones[$n];
            }
        }
    }
    if (empty($result))
    {
        $result = '';
    }

    if($is_decimal){
        $number_expord  = array_map('intval', str_split($stor_n));

        return $ones[$number_expord[0]].$ones[$number_expord[1]];
    }
    return $result;
}

function numberToKhmerText($number=0){
    $number = numberFormat($number);
    $explode_number = explode('.', $number);
    $int = convert_number_khmer($explode_number[0]).'';
    if($explode_number[1] != '00'){
        $float = 'ចុច'. convert_number_khmer($explode_number[1], true);

    }else{
        $explode_number[1] = 0;
        $float = convert_number_khmer($explode_number[1]);
    }
    if(!$int){
        return '.................................';
    }
    $words = ucfirst(strtolower( $int . $float ));
    return $words . ' ដុល្លាសហរដ្ឋអាមេរិក';
}
