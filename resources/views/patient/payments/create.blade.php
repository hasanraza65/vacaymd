@extends('layouts.layout')
@section('title','Make Payment')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/users">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

                <!--- form card start --->
                <div class="container mt-5">
                <h2 class="mb-4">Stripe Card Payment</h2>
                <form id="payment-form">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="john.doe@example.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="card-element" class="form-label">Credit or Debit Card</label>
                        <!---<div id="card-element" class="form-control"></div>---> 
                        <input type="text" class="form-control" placeholder="42424 42424 42424">
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                    </div>

                    <button id="submit-button" class="btn btn-primary" type="submit">Submit Payment</button>
                </form>
                 </div>
                <!--- form card ending --->

            </div>
        </div>

        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script>
    // Replace with your Stripe public key
    const stripePublicKey = 'pk_test_51JtQRGFctVkiOwDv7swRmxjWJ0G6i50O8AEQ84GGkBJIDlu0VxqvKHhH5QFpQcprh0kdVlWRjFLeLW6im7kkilPs00q9Ij3wkC';

    const stripe = Stripe(stripePublicKey);
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const paymentForm = document.getElementById('payment-form');
    paymentForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        if (!name || !email) {
            alert('Please fill in your full name and email address.');
            return;
        }

        const { error, paymentMethod } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: name,
                email: email,
            },
        });

        if (error) {
            const displayError = document.getElementById('card-errors');
            displayError.textContent = error.message;
        } else {
            handlePaymentMethod(paymentMethod);
        }
    });

    async function handlePaymentMethod(paymentMethod) {
        // Here you can send the paymentMethod.id to your server to create a payment intent
        console.log('Payment method:', paymentMethod);
    }
</script>

@endsection