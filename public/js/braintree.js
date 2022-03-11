
const button = document.querySelector('#submit-button')
let sponsor = document.getElementById('sponsor').value

console.log(sponsor)


braintree.dropin.create({
    // Insert your tokenization key here
    authorization: 'sandbox_jy8f34ff_r2zzkr3mvj58wgd2',
    container: '#dropin-container'
  }, function (createErr, instance) {
    button.addEventListener('click', function () {
      instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
        // When the user clicks on the 'Submit payment' button this code will send the
        // encrypted payment information in a variable called a payment method nonce
        
        axios.post('http://127.0.0.1:8000/api/payment-request', {

            paymentMethodNonce : payload.nonce,
            key : 'Pagamento team6',
            sponsor_id : '1',
            
        }).then( res => {
            console.log(res)
        }).catch(err =>{
            console.log(err)
        })
      });
    });
  });