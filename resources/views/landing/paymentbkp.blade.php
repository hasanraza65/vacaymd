@include('landing.layout.header')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>


<style>
    .card{
        border-style:none!important;
        background-color: 
    }
    .credit-card-icon {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        height: 20px;
        width: auto;
    }
</style>

<div class="step_info">
    <div class="container" style="padding-left: 30px;">Make a payment</div>
</div>

<div class="container" style="padding: 30px;">

    @if($errors->any())
        <div class="alert alert-danger m-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h6 class="my-4">Enter your credit card details</h6>

    <form role="form" 
          action="/patient/create-payment" 
          method="post" 
          class="require-validation"
          data-cc-on-file="false"
          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
          id="payment-form">
        <!---
        <div class="col-12">
            <div class="payments-method-container mb-4">
                <div onclick="showPaypal()" class="first">
                    <img src="/src/assets/img/PayPal.png" alt="">
                    <label class="button-container custom-register-checkbox-container w-100 mb-4 mt-4 d-flex justify-content-end">
                        <input type="radio" checked class="custom-radio-circle" name="payment" id="form-check-default">
                    </label>
                </div>
                <div class="second">
                    <img src="/src/assets/img/visa.png" alt="">
                    <label class="button-container custom-register-checkbox-container w-100 mb-4 mt-4 d-flex justify-content-end">
                        <input type="radio" class="custom-radio-circle" name="payment" id="form-check-default">
                    </label>
                </div>
            </div>
        </div> --->

        <!--- invoice ---> 

        <div class="card p-4 m-3">
            <h5>Invoice: </h5>
            <table class="table ">
                <tr>
                    <td>Consult Fee</td>
                    <td>$500</td>
                </tr>
                <tr>
                    <td>Medication Price</td>
                    <td>$600</td>
                </tr>
                <tr>
                    <td>Delivery Charges</td>
                    <td>$20</td>
                </tr>
                <tr>
                    <th>Total Bill: </th>
                    <th>$1120
                        <input type="hidden" value="1120" name="amount">
                    </th>
                </tr>
            </table>
        </div>

        <!--- ending invoice card --->
        


        <input type="hidden" name="order_id" value="{{ request('orderid') }}">
        @csrf


        <div class="row stripediv">
            <div class="col-md-6 mt-3">
                <input size='4' type="text" class="form-control input-custom py-2 px-4" id="cardName" placeholder="Cardholder Name:">
            </div>

            <div class="col-md-6 mt-3 cvc required">
                <input type="text" class="form-control input-custom py-2 px-4 card-cvc" id="cardCVV" placeholder='CVC ex. 311' size='4'>
                <span class="invalid_card_cvc d-none text-danger m-2">Invalid Card CVC</span>
            </div>

            <div class="col-md-12 mt-3  required">
                <input type="text" class="form-control input-custom py-2 px-4 card-number" size='20' id="cardNumber" placeholder="Credit Card Number:">
                <span class="invalid_card_num d-none text-danger m-2">Invalid Card Number</span>
            </div>
            
            <div class="col-md-6 mt-3 expiration required">
                <input type="text" class="form-control input-custom py-2 px-4 card-expiry-month" id="cardExpiryMonth" placeholder="Card Expiration Month:">
            </div>

            <div class="col-md-6 mt-3 expiration required">
                <input type="text" class="form-control input-custom py-2 px-4 card-expiry-year" id="cardExpiryYear" placeholder="Card Expiration Year:">
            </div>

            <span class="invalid_card_date d-none text-danger m-2">Invalid Card Expiry Date</span>

            <div class='form-row row mt-4 mb-2'>
                <div class='col-md-12 error form-group d-none'>
                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                </div>
            </div>

            <div class="mt-3 w-100 text-end">
                <button type="submit" class="button-custom">Submit Payment</button>
            </div>

        </div>
    </form>

    <!---
    <div class="paypaldiv">
    <a href="{{ route('payment.handle') }}"><img width="300" height="auto" src="/src/assets/img/paypalbtn.png"></a>
    </div> --->

</div>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('d-none');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('d-none');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('d-none')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>

<script>
$(document).ready(function() {
    // Format card number input
    $('#cardNumber').payment('formatCardNumber');

    // Format card expiry input
    $('#cardExpiryMonth, #cardExpiryYear').payment('formatCardExpiry');

    // Format card CVC input
    $('#cardCVV').payment('formatCardCVC');

    // Show card type icon on card number input
    $('#cardNumber').on('keyup change', function() {
        const cardType = $.payment.cardType($(this).val());
        const cardIconUrl = `/src/assets/img/${cardType}.png`;

        if (cardType) {
            if ($('.credit-card-icon').length === 0) {
                $(this).css('padding-left', '35px');
                $(this).before(`<img class="credit-card-icon" src="${cardIconUrl}" />`);
            } else {
                $('.credit-card-icon').attr('src', cardIconUrl);
            }
        } else {
            $('.credit-card-icon').remove();
            $(this).css('padding-left', '15px');
        }
    });

    // Validate CVC input
    $('#cardCVV').on('input', function() {
        if (this.value.length > 3) {
            this.value = this.value.slice(0, 3);
        }
    });

    // Validate card expiry input
    $('#cardExpiryMonth').on('input', function() {
        if (this.value.length > 2) {
            this.value = this.value.slice(0, 2);
        }
    });

    $('#cardExpiryYear').on('input', function() {
        if (this.value.length > 4) {
            this.value = this.value.slice(0, 4);
        }
    });
});
</script>


@include('landing.layout.footer')