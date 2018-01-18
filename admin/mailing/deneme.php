<?php


include 'functions.php';
include 'connect_db.php';
check_db($connected);

$list=$db->query("SELECT * FROM mail_list");

$data = array();

$i=0;
while($fetch=$list->fetch(PDO::FETCH_ASSOC)){
    $data[$i]["email"]=$fetch["email"];
    $i++;
}


// filename for download
$filename = "website_data_" . date('Ymd') . ".csv";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");

$out = fopen("php://output", 'w');

    fputcsv($out, array_values($data), ',', '"');


fclose($out);
exit;

?>