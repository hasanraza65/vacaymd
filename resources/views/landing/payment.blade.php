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
    <p class="mb-0 pb-0">You will not be charged till your prescription is approved.</p>
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
          data-cc-on-file="false"
          class="require-validation"
          id="paymentForm">
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
                <input name="cardholder-name" size='4' type="text" class="form-control input-custom py-2 px-4" id="cardholder-name" placeholder="Cardholder name:">
            </div>

            <div class="col-md-12 mt-3 required card-number-wrapper">
                <input name="card_number" type="text" class="form-control input-custom card-number" size='16' id="card-number" placeholder="Credit Card Number:">
                <span class="invalid_card_num d-none text-danger m-2">Invalid Card Number</span>
            </div>
            
            <div class="col-md-6 mt-3 expiration required">
                <input name="card_expiry" type="text" class="form-control input-custom py-2 px-4 card-expiry" id="card-expiry" placeholder="Card Expiration (MM / YYYY):">
            </div>

            <span class="invalid_card_date d-none text-danger m-2">Invalid Card Expiry Date</span>

            <div class="col-md-6 mt-3 cvc required">
                <input name="card_code" type="text" class="form-control input-custom py-2 px-4 card-cvc" id="card-code" placeholder='CVC ex. 311' size='4'>
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
     
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
     
});
</script>

<script>
$(document).ready(function() {
    // Format card number input
    $('#card-number').payment('formatCardNumber');

    // Format card expiry input
    $('#card-expiry').payment('formatCardExpiry');

    // Format card CVC input
    $('#card-code').payment('formatCardCVC');

    // Show card type icon on card number input
    $('#card-number').on('keyup change', function() {
        const cardType = $.payment.cardType($(this).val());
        const cardIconUrl = `/src/assets/img/${cardType}.png`;

        // Update the placeholder of the CVV input
        if (cardType === 'amex') {
            $('#card-code').attr('placeholder', 'CVC ex. 1234');
        } else {
            $('#card-code').attr('placeholder', 'CVC ex. 311');
        }

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
    $('#card-code').on('input', function() {
        var cardType = $.payment.cardType($('#cardNumber').val());

        if (cardType === 'amex') {
            if (this.value.length > 4) {
                this.value = this.value.slice(0, 4);
            }
        } else {
            if (this.value.length > 3) {
                this.value = this.value.slice(0, 3);
            }
        }
    });

    // Handle Expiry Date input
    $('#card-expiry').on('input', function() {
        const maxLength = 9; // Format: MM / YYYY (9 characters)

        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });

    // Validate Cardholder Name input
    $('#cardholder-name').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]+/g, '');
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