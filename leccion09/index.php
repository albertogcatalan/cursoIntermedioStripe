<?php



?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Intermedio: Lección 09</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <style>
          .container {
              padding: 0 15px;
          }
      </style>
  </head>

  <body class="d-flex flex-column h-100">

      <main role="main" class="flex-shrink-0">
          <div class="container">
              <h1 class="mt-5">Open Metrics</h1>
              <p class="lead">Bienvenidos a nuestro panel abierto de métricas.</p>
              <div class="row mt-2">
                  <div class="col-sm-4">
                      <div class="card text-center text-white bg-primary">
                          <div class="card-header">Clientes</div>
                          <div class="card-body">
                              <h5 class="card-title"><strong><span id="panel-customers">0</span></strong></h5>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4">
                      <div class="card text-center">
                          <div class="card-header">Suscripciones activas</div>
                          <div class="card-body">
                              <h5 class="card-title"><strong><span id="panel-subscriptions">0</span></strong></h5>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4">
                      <div class="card text-center text-white bg-success">
                          <div class="card-header">Ingresos totales</div>
                          <div class="card-body">
                              <h5 class="card-title"><strong><span id="panel-amount">0</span></strong> €</h5>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </main>

      <script src="/app.js"></script>
  </body>
</html>
