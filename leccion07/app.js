
var stripe = Stripe('pk_test_Bjpl87z8desnfTgH0xui7nXF005JzvwyWY');
var elements = stripe.elements();

var card = elements.create('card');
card.mount('#card-element');

card.addEventListener('change', function(event) {
  var errorElement = document.getElementById('card-errors');
  if (event.error) {
    errorElement.textContent = event.error.message;
  } else {
    errorElement.textContent = '';
  }
});

function paySubmit(stripe, card, clientSecret)  {
  stripe.confirmCardPayment(clientSecret, {
    payment_method: {
      card: card,
    },
    setup_future_usage: 'off_session'
  }).then(function(result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      if (result.paymentIntent.status === 'succeeded') {
        stripePaymentIntentHandler(result.paymentIntent);
      }
    }
  });
}

function stripePaymentIntentHandler(paymentIntent) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'paymentIntent');
  hiddenInput.setAttribute('value', paymentIntent.payment_method);
  form.appendChild(hiddenInput);
  form.submit();
}
