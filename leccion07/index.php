<?php

require_once "vendor/autoload.php";

use \Stripe;

Stripe\Stripe::setApiKey('sk_test_55NS8pv3pkzdBTvCzlI72Gje00XQOCMaq6');

if (isset($_POST['paymentIntent']) && !empty($_POST['paymentIntent'])) {
  
  $paymentMethod = Stripe\PaymentMethod::retrieve($_POST['paymentIntent']);

  $customer = Stripe\Customer::create([
    'email' => 'nuevo7@dominio.com',
    //'payment_method' => $paymentMethod->id,
  ]);

  $paymentMethod->attach(['customer' => $customer->id]);

  $customer->invoice_settings['default_payment_method'] = $paymentMethod->id;
  $customer->save();

  try {
    $pIntent = Stripe\PaymentIntent::create([
        "amount" => 3800,
        "currency" => "eur",
        "customer" => $customer->id,
        "payment_method" => $paymentMethod->id,
        "off_session" => true,
        "confirm" => true,
    ]);
    echo json_encode($pIntent);
  } catch (\Stripe\Error\Card $e) {    
      echo json_encode(["error"=> $e->getMessage()]);
  }

} else {
  $intent = Stripe\PaymentIntent::create([
    'amount' => 1600,
    'currency' => 'eur',
  ]);
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Intermedio: Lección 07</title>
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
    <script>
      var clientSecret = '<?php echo $intent->client_secret; ?>';
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        paySubmit(stripe, card, clientSecret);
      });
    </script>
  </body>
</html>
