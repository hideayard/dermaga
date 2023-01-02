<?php
$server_location = "http://".$_SERVER['SERVER_NAME']."/project/SMS/";
$database = "smart";
function getParam($x, $i)
{
	$handle = @fopen("smsdrc".$i, "r");
	if (!$handle) {
    echo "Error! Couldn't open the file.";
	}
	else //if ($handle) 
	{
		while (!feof($handle)) 
		{
			$buffer = fgets($handle);
			if (substr_count($buffer, $x.' = ') > 0)
			{
				$split = explode($x." = ", $buffer);
				$param = str_replace(chr(13).chr(10), "", $split[1]);
			}
		}
		fclose($handle);
	}		
	
	return $param;
}

function ceknull($a)
{
	if($a==NULL)
	{
		return "-";
	}
	else
	{
		return $a;
	}
}
function cekbayar($a)
{

	switch($a)
	{
		case 0 : {return "BELUM LUNAS";}break;
		case 1 : {return "LUNAS";}break;
		case 2 : {return "?";}break;
		default:{return "-";};break;
	}
}

function cekselected($a,$b)
{
        if($a==$b){return "selected";}else{return '';}
}

function jam_skrg()
{
	date_default_timezone_set('Asia/Jakarta');
return date("H:i:s");
}
function tgl_skrg()
{
	date_default_timezone_set('Asia/Jakarta');
return date("Y-m-d");
}
function sakiki()
{
	date_default_timezone_set('Asia/Jakarta');
return date("d-m-Y-H-i-s");
}
	function redirect($url,$message){
		if(!empty($message)){
			echo "<script type='text/javascript'>window.alert('$message'); window.location=('$url')</script>";
		}else{
			echo "<script type='text/javascript'>window.location=('$url')</script>";
		}
	}
	function hari_tgl_jam($input)
	{
		$dayname = date('l', strtotime($input));
		$day = date('d', strtotime($input));
		$month = date('m', strtotime($input));
		$year = date('Y', strtotime($input));
		$jam = date('H:i', strtotime($input));

		if ($dayname == "Sunday") $namahari = "Minggu";
		else if ($dayname == "Monday") $namahari = "Senin";
		else if ($dayname == "Tuesday") $namahari = "Selasa";
		else if ($dayname == "Wednesday") $namahari = "Rabu";
		else if ($dayname == "Thursday") $namahari = "Kamis";
		else if ($dayname == "Friday") $namahari = "Jumat";
		else if ($dayname == "Saturday") $namahari = "Sabtu";

		switch($month){
			case 1 : $bln='Januari'; break;
			case 2 : $bln='Februari'; break;
			case 3 : $bln='Maret'; break;
			case 4 : $bln='April'; break;
			case 5 : $bln='Mei'; break;
			case 6 : $bln="Juni"; break;
			case 7 : $bln='Juli'; break;
			case 8 : $bln='Agustus'; break;
			case 9 : $bln='September'; break;
			case 10 : $bln='Oktober'; break;
			case 11 : $bln='November'; break;
			case 12 : $bln='Desember'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return "Hari ".$namahari.", Tanggal ".$day." ".$bln." ".$year." Sekitar Pukul ".$jam;
	}
	function jam($input)
	{
		$jam = date('H:i:s', strtotime($input));
		return $jam;
	}
	function date_indo($input) {
		$dayname = date('l', strtotime($input));
		$day = date('d', strtotime($input));
		$month = date('m', strtotime($input));
		$year = date('Y', strtotime($input));

		if ($dayname == "Sunday") $namahari = "Minggu";
		else if ($dayname == "Monday") $namahari = "Senin";
		else if ($dayname == "Tuesday") $namahari = "Selasa";
		else if ($dayname == "Wednesday") $namahari = "Rabu";
		else if ($dayname == "Thursday") $namahari = "Kamis";
		else if ($dayname == "Friday") $namahari = "Jumat";
		else if ($dayname == "Saturday") $namahari = "Sabtu";

		switch($month){
			case 1 : $bln='Januari'; break;
			case 2 : $bln='Februari'; break;
			case 3 : $bln='Maret'; break;
			case 4 : $bln='April'; break;
			case 5 : $bln='Mei'; break;
			case 6 : $bln="Juni"; break;
			case 7 : $bln='Juli'; break;
			case 8 : $bln='Agustus'; break;
			case 9 : $bln='September'; break;
			case 10 : $bln='Oktober'; break;
			case 11 : $bln='November'; break;
			case 12 : $bln='Desember'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $namahari.", ".$day." ".$bln." ".$year;
	}

    function date_indo2($input) {
		$day = date('d', strtotime($input));
		$month = date('m', strtotime($input));
		$year = date('Y', strtotime($input));
	return "$day/$month/$year";
	}

	function tgl_indo($input) {
		$dayname = date('l', strtotime($input));
		$day = date('d', strtotime($input));
		$month = date('m', strtotime($input));
		$year = date('Y', strtotime($input));

		if ($dayname == "Sunday") $namahari = "Minggu";
		else if ($dayname == "Monday") $namahari = "Senin";
		else if ($dayname == "Tuesday") $namahari = "Selasa";
		else if ($dayname == "Wednesday") $namahari = "Rabu";
		else if ($dayname == "Thursday") $namahari = "Kamis";
		else if ($dayname == "Friday") $namahari = "Jumat";
		else if ($dayname == "Saturday") $namahari = "Sabtu";

		switch($month){
			case 1 : $bln='Januari'; break;
			case 2 : $bln='Februari'; break;
			case 3 : $bln='Maret'; break;
			case 4 : $bln='April'; break;
			case 5 : $bln='Mei'; break;
			case 6 : $bln="Juni"; break;
			case 7 : $bln='Juli'; break;
			case 8 : $bln='Agustus'; break;
			case 9 : $bln='September'; break;
			case 10 : $bln='Oktober'; break;
			case 11 : $bln='November'; break;
			case 12 : $bln='Desember'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $day." ".$bln." ".$year;
	}

	function format_tgl_indo($input) {
		$dayname = date('l', strtotime($input));
		$day = date('d', strtotime($input));
		$month = date('m', strtotime($input));
		$year = date('Y', strtotime($input));

		if ($dayname == "Sunday") $namahari = "Minggu";
		else if ($dayname == "Monday") $namahari = "Senin";
		else if ($dayname == "Tuesday") $namahari = "Selasa";
		else if ($dayname == "Wednesday") $namahari = "Rabu";
		else if ($dayname == "Thursday") $namahari = "Kamis";
		else if ($dayname == "Friday") $namahari = "Jumat";
		else if ($dayname == "Saturday") $namahari = "Sabtu";

		switch($month){
			case 1 : $bln='Januari'; break;
			case 2 : $bln='Februari'; break;
			case 3 : $bln='Maret'; break;
			case 4 : $bln='April'; break;
			case 5 : $bln='Mei'; break;
			case 6 : $bln="Juni"; break;
			case 7 : $bln='Juli'; break;
			case 8 : $bln='Agustus'; break;
			case 9 : $bln='September'; break;
			case 10 : $bln='Oktober'; break;
			case 11 : $bln='November'; break;
			case 12 : $bln='Desember'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $day." ".$bln." ".$year;
	}

	function hari_indo($input) {
		$dayname = date('l', strtotime($input));

		if ($dayname == "Sunday") $namahari = "Minggu";
		else if ($dayname == "Monday") $namahari = "Senin";
		else if ($dayname == "Tuesday") $namahari = "Selasa";
		else if ($dayname == "Wednesday") $namahari = "Rabu";
		else if ($dayname == "Thursday") $namahari = "Kamis";
		else if ($dayname == "Friday") $namahari = "Jumat";
		else if ($dayname == "Saturday") $namahari = "Sabtu";

		return $namahari;
	}
	function sekarang(){
		date_default_timezone_set("Asia/Jakarta");
		$namahari=date('l');
		//$jam =date("h:i");
		$tgl =date('d');
		$bln =date('m');
		$thn =date('Y');
		return date_indo($namahari,$tgl,$bln,$thn);
	}
	function sekarang2(){
		date_default_timezone_set("Asia/Jakarta");
		$namahari=date('l');
		//$jam =date("h:i");
		$tgl =date('d');
		$bln =date('m');
		$thn =date('Y');
		return tgl_sekarang()." ".bln_sekarang()." ".thn_sekarang();
	}
	function tgl_sekarang(){
		date_default_timezone_set("Asia/Jakarta");
		return date('d');
	}
	function bln_sekarang(){
		date_default_timezone_set("Asia/Jakarta");
		$month = date('m');
		switch($month){
			case 1 : $bln='Januari'; break;
			case 2 : $bln='Februari'; break;
			case 3 : $bln='Maret'; break;
			case 4 : $bln='April'; break;
			case 5 : $bln='Mei'; break;
			case 6 : $bln="Juni"; break;
			case 7 : $bln='Juli'; break;
			case 8 : $bln='Agustus'; break;
			case 9 : $bln='September'; break;
			case 10 : $bln='Oktober'; break;
			case 11 : $bln='November'; break;
			case 12 : $bln='Desember'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $bln;
	}
	function bln_sekarang_3(){
		date_default_timezone_set("Asia/Jakarta");
		$month = date('m');
		switch($month){
			case 1 : $bln='JAN'; break;
			case 2 : $bln='FEB'; break;
			case 3 : $bln='MAR'; break;
			case 4 : $bln='APR'; break;
			case 5 : $bln='MAY'; break;
			case 6 : $bln="JUN"; break;
			case 7 : $bln='JUL'; break;
			case 8 : $bln='AGT'; break;
			case 9 : $bln='SEP'; break;
			case 10 : $bln='OKT'; break;
			case 11 : $bln='NOV'; break;
			case 12 : $bln='DEC'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $bln;
	}
	function bln_indo_in($a){

		switch($a){
			case 1 : $bln='JAN'; break;
			case 2 : $bln='FEB'; break;
			case 3 : $bln='MAR'; break;
			case 4 : $bln='APR'; break;
			case 5 : $bln='MAY'; break;
			case 6 : $bln="JUN"; break;
			case 7 : $bln='JUL'; break;
			case 8 : $bln='AGT'; break;
			case 9 : $bln='SEP'; break;
			case 10 : $bln='OKT'; break;
			case 11 : $bln='NOV'; break;
			case 12 : $bln='DEC'; break;
			default: $bln='Tidak diketahui'; break;
		}
		return $bln;
	}
	function thn_sekarang(){
		date_default_timezone_set("Asia/Jakarta");
		return date('Y');
	}
	function base_url() {
		return "http://localhost/";
	}
	function rupiah($nilaiUang){
		$nilaiRupiah 	= "";
		$jumlahAngka 	= strlen($nilaiUang);
		while($jumlahAngka > 3){
			$nilaiRupiah = "." . substr($nilaiUang,-3) . $nilaiRupiah;
			$sisaNilai = strlen($nilaiUang) - 3;
			$nilaiUang = substr($nilaiUang,0,$sisaNilai);
			$jumlahAngka = strlen($nilaiUang);
		}
		$nilaiRupiah = "Rp " . $nilaiUang . $nilaiRupiah . ",-";
		return $nilaiRupiah;
	}

	set_error_handler('exceptions_error_handler');
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}
	function tipe_user($user)
	{
		switch($user)
		{
			case 0 : return "Admin";
			case 1 : return "Owner";
			case 2 : return "Manager";
			case 3 : return "Pengajar";
			case 4 : return "Siswa";
			default : return "Pengunjung";
		}
	}
	function status_user($user)
	{
		switch($user)
		{
			case 0 : return "Nonaktif";
			case 1 : return "Aktif";
			case 2 : return "Pending";
		}
	}
	function status_tugas($tgs)
	{
		switch($tgs)
		{
			case 0 : return "BELUM SELESAI";
			case 1 : return "SELESAI";

		}
	}

function cekStatus($a)
{
	switch($a)
	{
		case 2 : {echo "Pending";}break;
		case 1 : {echo "Aktif";}break;
		case 0 : {echo "NonAktif";}break;
	}
}
function proses_sql($a,$sql)
{
	$db = new Config();
	$db->connect();
	switch($a)
	{
		case "select":{	$db->execute($sql);
						$data = $db->get_dataset();
						return $data;}break;
		default:{$db->execute($sql);}break;
	}
	$db->close_connection();
}

function cekakses($menu_id)
{
    $hasil = proses_sql('select','select * from m_akses where m_menu_mn_id=$menu_id');
}

function cekwarna($a)
{
	switch($a)
	{
		case "DIPESAN" : {return "color:slateblue";}break;
		case "BAYAR" : {return "color:green";}break;
		case "DIPROSES" : {return "color:blue";}break;
		case "LUNAS" : {return "color:brown";}break;
	}

}
function eksekusi($sql)
{
	$db = new Config();
	$db->connect();
	$db->execute($sql);
	$data = $db->get_dataset();
	$db->close_connection();
	return $data;

}
///tanpa return
function eksekusi2($sql)
{
	$db = new Config();
	$db->connect();
	$db->execute($sql);
	$db->close_connection();

}

function hitung_persen($a,$b)
{
    if($a==0){$a=1;}
    if($b==0){$b=1;}
    if($a>$b){//echo "round(($a-$b)/$b)<br>";
        return round((($a-$b)/$b),2)*100;
    }
    else
    {//echo "round(($a-$b)/$b)<br>";
        return round((($b-$a)/$a),2)*100;
    }
}
function getAge($date) {
	return intval(date('Y', time() - strtotime($date))) - 1970;
}
function getAgeFull($date) {
	$thn = intval(date('Y', time() - strtotime($date))) - 1970;
    if($thn>0)
	{
		return $thn;
	}
	else
	{

	}
}
function get_datatype($data)
{
	switch($data)
	{
		case 'date' : return "easyui-datebox";break;
		case 'text' : {return "easyui-layout";}break;
		default : return "easyui-textbox";break;
	}
}
function cek_isi_arr($data,$text)
{
		if($data==0)
		{
			//echo "alert(".$text.");";
			echo  "<html><body><script type='text/javascript'>";
			echo "alert('".$text."');";
			echo "window.location='home';//close();";
			echo "</script></body></html>";
		}
		else
			{
			//	echo "alert(".$text.");";
			}
//		echo $text;
}

function dateDiff($time1, $time2, $precision = 6, $offset = false) {

    // If not numeric then convert texts to unix timestamps

    if (!is_int($time1)) {
            $time1 = strtotime($time1);
    }

    if (!is_int($time2)) {
            if (!$offset) {
                    $time2 = strtotime($time2);
            }
            else {
                    $time2 = strtotime($time2) - $offset;
            }
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2

    if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
    }

    // Set up intervals and diffs arrays

    $intervals = array(
            'year',
            'month',
            'day',
            'hour',
            'minute',
            'second'
    );
    $diffs = array();

    // Loop thru all intervals

    foreach($intervals as $interval) {

            // Create temp time from time1 and interval

            $ttime = strtotime('+1 ' . $interval, $time1);

            // Set initial values

            $add = 1;
            $looped = 0;

            // Loop until temp time is smaller than time2

            while ($time2 >= $ttime) {

                    // Create new temp time from time1 and interval

                    $add++;
                    $ttime = strtotime("+" . $add . " " . $interval, $time1);
                    $looped++;
            }

            $time1 = strtotime("+" . $looped . " " . $interval, $time1);
            $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();

    // Loop thru all diffs

    foreach($diffs as $interval => $value) {

            // Break if we have needed precission

            if ($count >= $precision) {
                    break;
            }

            // Add value and interval
            // if value is bigger than 0

            if ($value > 0) {

                    // Add s if value is not 1

                    if ($value != 1) {
                            $interval.= "s";
                    }

                    // Add value and interval to times array

                    $times[] = $value . " " . $interval;
                    $count++;
            }
    }

    if (!empty($times)) {

            // Return string with times

            return implode(", ", $times);
    }
    else {

            // Return 0 Seconds

    }

    return '0 Seconds';
}


function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
function cek_status($a,$b,$c)
{
	if($a==0||$a=='0')
		{return $b;}
	else
		{return $c;}
}

function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}

function formatNumber($int)
{
	$i=strlen($int);
	for($i;$i<4;$i++)
	{
		$int = "0".$int;
	}
	return $int;
}

function isJson($string) {
	json_decode($string);
	return json_last_error() === JSON_ERROR_NONE;
 }
?>