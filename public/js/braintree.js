
const button = document.querySelector('#submit-button')

let sponsor = document.getElementById('sponsor').value

let apartment = document.getElementById('apartment').value

braintree.dropin.create({
    // Insert your tokenization key here
    authorization: 'sandbox_jy8f34ff_r2zzkr3mvj58wgd2',
    container: '#dropin-container'
  }, function (createErr, instance) {
    button.addEventListener('click', function () {
      instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
       
        sponsor = this.sponsor.value
        console.log(sponsor)
        console.log(apartment)
        axios.post('http://127.0.0.1:8000/api/payment-request', {

            paymentMethodNonce : payload.nonce,
            key : 'Pagamento team6',
            sponsor_id : sponsor,
            apartment_id : apartment
        }).then(function(result) {
          console.log(result.data)
          instance.teardown(function (teardownErr) {
            if (teardownErr) {
              console.error('Could not tear down Drop-in UI!');
            } else {
              console.info('Drop-in UI has been torn down!');
              // Remove the 'Submit payment' button
              $('#submit-button').remove();
            }
          });

          if (result) {
            $('#checkout-message').html('<h1 class="text-white">Success</h1><p>Your Drop-in UI is working! Check your <a class="btn btn-pink" href="http://127.0.0.1:8000/admin/apartments">Transaction Done Succesfully</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
          } else {
            console.log(result);
            $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
          }
        }).catch(err =>{
          console.log(err)
        })
      });
    });
  });