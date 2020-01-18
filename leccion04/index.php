<?php

require_once "vendor/autoload.php";

use \Stripe;

if (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) {

    Stripe\Stripe::setApiKey('sk_test_55NS8pv3pkzdBTvCzlI72Gje00XQOCMaq6');
 
    $token = $_POST['stripeToken'];
 
    try {
        $charge = Stripe\Charge::create([
            "amount" => 1000,
            "currency" => "eur",
            "source" => $token,
            "description" => "Pagando con PHP"
        ]);
        echo json_encode($charge);
    } catch (\Stripe\Error\Card $e) {    
        echo json_encode(["error"=> $e->getMessage()]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Intermedio: Lección 04</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>

  <body>
    <form action="" method="post" id="payment-form">
    <div class="form-row">
      <label for="card-element">
        Introduce tu tarjeta
      </label>
      <div id="card-element"></div>

      <div id="card-errors" role="alert"></div>
    </div>

    <button>Enviar</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="/app.js"></script>
  </body>
</html>
