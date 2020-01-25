<?php

require_once "../vendor/autoload.php";
require "../Stats.php";

$stats = new Stats('sk_test_55NS8pv3pkzdBTvCzlI72Gje00XQOCMaq6');
$totalAmount = $stats->getTotalAmount();

header('Content-Type: application/json');
echo json_encode($totalAmount['paid']);

?>
