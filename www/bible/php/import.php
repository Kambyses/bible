<?php

error_reporting(E_ALL);
ini_set("memory_limit", -1);

date_default_timezone_set ("Europe/Tallinn");

header("Content-Type: text/plain; charset=utf-8");

$conn_string = "host=172.17.0.2 port=5432 dbname=bible user=postgres password=78EFGqpoiuytrewq";
pg_connect($conn_string);




$bible = file_get_contents("bible.txt");
//$bible = substr($bible, 0, 1000000);
$bible = str_split($bible);
$chapter   = 0;
$paragraph = 0;
$intcount  = 0;
$pos_in_chapter = 0;
$pos_in_paragraph = 0;
$query = "";
$query_count = 0;
$run_num = 1;

pg_query("DELETE FROM bible WHERE run_num = " . $run_num . ";\n");



foreach($bible as $pos_int_text => $char) {
	if (base64_encode($char) === base64_encode(mb_strtolower($char))) {
		$case = "'lowercase'";
	} elseif (base64_encode($char) === base64_encode(mb_strtoupper($char))) {
		$case = "'uppercase'";
	} else {
		$case = "NULL";
	}
	if (!empty($char) && (int)$char) {
		$intcount += 1;
	}
	$pos_in_chapter += 1;
	$pos_in_paragraph += 1;
	if ($chapter === 0 && $char === "[") {
		$chapter = 1;
		$paragraph = 1;
		$pos_in_chapter = 1;
		$pos_in_paragraph = 1;
	}
	if ($intcount > 5) {
		$chapter += 1;
		$paragraph += 1;
		$pos_in_chapter = 1;
		$pos_in_paragraph = 1;
		$intcount = 0;
	}
	$ascii = (int)ord($char);
	if ($ascii === 194) {
		$paragraph += 1;
		$pos_in_paragraph = 1;
	}
	$query_count += 1;
	$query .= "INSERT INTO bible (id, \"character\", ascii_code, character_length, character_case, chapter_num, paragraph_num, text_pos, chapter_pos, paragraph_pos, run_num) VALUES (" . ($pos_int_text + 1) . ", '" . 
		pg_escape_string(rawurlencode($char))  . "', " . $ascii . ", " . strlen($char) . ", " . $case . ", " . $chapter . ", " . $paragraph . ", " . ($pos_int_text + 1) . ", " . $pos_in_chapter . ", " . $pos_in_paragraph . ", " . $run_num . ");\n";
	if ($query_count >= 10000) {
		$query = "BEGIN TRANSACTION\n;" . $query . "COMMIT;";
		pg_query($query);
		$query_count = 0;
		$query = "";
		flush();
		usleep(100);
	}
}
if ($query_count) {
	$query = "BEGIN TRANSACTION\n;" . $query . "COMMIT;";
	pg_query($query);
	$query_count = 0;
	$query = "";
	flush();
	usleep(100);
}

echo count($bible);





exit;


echo "OK 1";
if (!pg_connect($conn_string)) {
	echo pg_last_error();
	exit;
}
$dbconn = @pg_connect($conn_string);
echo "OK 3" . pg_last_error();
$sql = pg_query("select count(*) from estonia.planet_osm_point");
$row = pg_fetch_all($sql);
print_r($row);


echo "OK " . date("Y-m-d H:i:s");

if (!function_exists("pg_connect")) {
echo "NOP";
}


exit;
echo phpinfo();
exit;




/*

error_reporting(E_ALL);

echo "OK " . date("Y-m-d H:i:s");

$conn_string = "host=localhost port=5432 dbname=planet_osm user=postgres password=78EFGqpoiuytrewq";
echo "OK 1";
if (!@pg_connect($conn_string)) {
	echo pg_last_error();
}
$dbconn = @pg_connect($conn_string);
echo "OK 3" . pg_last_error();
$sql = pg_query("select count(*) from estonia.planet_osm_point");
$row = pg_fetch_all();
print_r($row);

echo "nok";
*/