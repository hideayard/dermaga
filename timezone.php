<?php
define('TIMEZONE', 'Asia/Jakarta');

$now = new DateTime();
$mins = $now->getOffset() / 60;

$sgn = ($mins < 0 ? -1 : 1);
$mins2 = abs($mins);
$hrs = floor($mins / 60);
$mins3 = $mins2 - ($hrs * 60);
var_dump($now);
// " now = $now , mins = $mins ,  sgn = $sgn , mins2 = $mins2 , hrs = $hrs , last mins = $mins3 <br>"; 
$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
echo "<hr>".$offset;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
$sql = "SET time_zone='$offset';";
$hasil = $db->rawQuery($sql);
var_dump($hasil);
?>