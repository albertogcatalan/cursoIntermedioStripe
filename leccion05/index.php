<?php

require_once "vendor/autoload.php";
require "Stats.php";

$stats = new Stats('sk_test_55NS8pv3pkzdBTvCzlI72Gje00XQOCMaq6');
$chargeList = $stats->getChargeList(100);
$totalAmount = $stats->getTotalAmount($chargeList);

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Intermedio: Lección 05</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body>
  <div class="container">
    <div class="row mt-5">
        <div class="col-sm-3">
            <div class="card">
            <div class="card-header">
              Ingresos
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
              Total: <strong><span id="connected_users"><?php echo $totalAmount['paid']; ?></span></strong> €
              </li>
              <li class="list-group-item">
              Fallido: <strong><span id="connected_users"><?php echo $totalAmount['failed']; ?></span></strong> €
              </li>
            </ul>
            </div>
        </div>
        <div class="col-sm-9">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Fecha</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ($chargeList as $charge) {
                    if ($charge->paid) {
                        echo '<tr class="table-success">';
                    } else {
                        echo '<tr class="table-danger">';
                    }
                    echo '<th scope="row"><a href="https://dashboard.stripe.com/test/payments/'.$charge->id.'" target="_blank">'.$charge->id.'</a></th>';
                    echo '<td>'.($charge->amount/100).' €</td>';
                    echo '<td>'.date('d/m/Y H:i:s', $charge->created).'</td>';
                    echo '</tr>';
                }
            ?>
          </tbody>
        </table>
        </div>
    </div>
</div>
</html>
