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
        left: 20px;
        transform: translateY(-50%);
        height: 22px;
        width: auto;
    }
    .card-number-wrapper {
        position: relative;
    }
</style>

<div class="step_info">
    <div class="container" style="padding-left: 30px;">Make a payment</div>
    <div class="container text-dark mt-1" style="padding-left: 30px; padding-right: 30px;font-size:13px;">
    <p class="mb-0 pb-0">You won't be charged until the doctor will approve your order.</p>
    </div>
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

    @include('landing.layout.addons')

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
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
        @php
        $consult_fee = 49;
        $med_n_del_fee = 30;
        @endphp

        <div class="card p-4 m-3">
            <h5>Invoice: </h5>
            <table class="table ">
                <tr>
                    <td>Consult Fee</td>
                    <td>$<span id="consult_fee">{{$consult_fee}}</span></td>
                </tr>
                <tr>
                    <td>Medication and Delivery</td>
                    <td>$<span id="med_n_del">{{$med_n_del_fee}}</span></td>
                </tr>
                
                <!--- addons items ---> 
                @php 
                $totaladdons_bill = 0;
                @endphp
                @foreach($orderaddons as $orderaddonss)
                <tr>
                    <td><a href="/remove_order_addon_item/{{$orderaddonss->id}}" class="remove_icon">x</a> {{$orderaddonss->itemDetail->item_name}} <span class="addon_label">- Addon </span> </td>
                    <td>${{$orderaddonss->itemDetail->item_price}}</td>
                </tr>
                @php 
                $totaladdons_bill = $totaladdons_bill+$orderaddonss->itemDetail->item_price;
                @endphp
                @endforeach
                <!--- ending addons items --->

                @php
                $totalbill = $consult_fee+$med_n_del_fee+$totaladdons_bill;
                @endphp

                <tr>
                    <th>Total Bill: </th>
                    <th>${{$totalbill}}
                        <input type="hidden" value="{{$totalbill}}" name="amount">
                    </th>
                </tr>

            </table>
        </div>
        <button style="border-radious:50px" type="button" class="btn btn-dark ms-3 mb-3" data-bs-toggle="modal" data-bs-target="#addonsModal">
            Add Addons Medicines
        </button>

        <!--- ending invoice card --->
        


        <input type="hidden" name="order_id" value="{{ request('orderid') }}">
        @csrf


        <div class="row stripediv">
            <div class="col-md-12 mt-3">
                <input size='4' type="text" class="form-control input-custom py-2 px-4" id="cardName" placeholder="Cardholder name:">
            </div>

            <div class="col-md-12 mt-3 required card-number-wrapper">
                <input type="text" class="form-control input-custom card-number" size='16' id="cardNumber" placeholder="Credit Card Number:">
                <span class="invalid_card_num d-none text-danger m-2">Invalid Card Number</span>
            </div>
            
            <div class="col-md-6 mt-3 expiration required">
                <input type="text" class="form-control input-custom py-2 px-4 card-expiry" id="cardExpiry" placeholder="Card Expiration (MM / YYYY):">
            </div>

            <span class="invalid_card_date d-none text-danger m-2">Invalid Card Expiry Date</span>

            <div class="col-md-6 mt-3 cvc required">
                <input type="text" class="form-control input-custom py-2 px-4 card-cvc" id="cardCVV" placeholder='CVC ex. 311' size='4'>
                <span class="invalid_card_cvc d-none text-danger m-2">Invalid Card CVC</span>
            </div>

            <div class='form-row row mt-4 mb-2'>
                <div class='col-md-12 error form-group d-none'>
                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                </div>
            </div>

            <div class="mt-3 w-100 text-end">
                <button type="submit" class="button-custom submitbtn">Submit</button>
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

            // Get the expiry date value
            const expiryDate = $('#cardExpiry').payment('cardExpiryVal');
            
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: expiryDate.month,
                exp_year: expiryDate.year
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
    $('#cardExpiry').payment('formatCardExpiry');

    // Format card CVC input
    $('#cardCVV').payment('formatCardCVC');

    // Show card type icon on card number input
    $('#cardNumber').on('keyup change', function() {
        const cardType = $.payment.cardType($(this).val());
        const cardIconUrl = `/src/assets/img/${cardType}.png`;

        if (cardType) {
            if ($('.credit-card-icon').length === 0) {
                $(this).css('padding-left', '45px');
                $('<img class="credit-card-icon" src="' + cardIconUrl + '" />').insertBefore($(this));
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

    // Handle Expiry Date input
    $('#cardExpiry').on('input', function() {
        const maxLength = 9; // Format: MM / YYYY (9 characters)

        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });

    // Validate Cardholder Name input
    $('#cardName').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]+/g, '');
    });
});

</script>

<script>
    function checkAllFields() {
    const cardNumberValid = $.payment.validateCardNumber($('#cardNumber').val());
    const cardExpiryValid = $.payment.validateCardExpiry($('#cardExpiry').payment('cardExpiryVal'));
    const cardCVCValid = $.payment.validateCardCVC($('#cardCVV').val());
    const cardNameValid = $('#cardName').val().trim().length > 0;

    if (cardNumberValid && cardExpiryValid && cardCVCValid && cardNameValid) {
        $('#submitBtn').prop('disabled', false);
    } else {
        $('#submitBtn').prop('disabled', true);
    }
}

$(document).ready(function() {
    // ... (Rest of your existing JavaScript code in the $(document).ready function) ...

    // Add event listeners to each input field
    $('#cardNumber, #cardExpiry, #cardCVV, #cardName').on('input', function() {
        checkAllFields();
    });
});
</script>


@php 
$countadded_addons = 0;
@endphp
@foreach($orderaddons as $orderaddonss)

@php 
$countadded_addons = $loop->count;
@endphp

@endforeach


@if($countadded_addons == 0)
<script>
$(document).ready(function(){
    $('#addonsModal').modal('show');
});

</script>
@endif


@include('landing.layout.footer')