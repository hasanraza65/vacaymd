<!DOCTYPE html>
<html>
  <head>
    <title>New Order Confirmation</title>
    <style>
      /* Set the background color of the body to light grey */
      body {
        background-color: #F6F6F6;
      }

      /* Style for the white background card */
      .card {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 0px 30px 0px rgba(158.25, 158.25, 158.25, 0.29);
        max-width: 600px;
        margin: auto;
        padding: 20px;
      }

      /* Style for the card header */
      .card-header {
        background-color: #fff2cc;
        padding: 10px;
        text-align: center;
      }

      /* Style for the logo in the card header */
      .logo {
        width: 200px;
        height: auto;
        margin: 0 auto;
        display: block;
      }

      /* Style for the heading in the card body */
      .card-heading {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-top: 30px;
      }

      /* Style for the table in the card body */
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;
      }

      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }

      /* Style for the card footer */
      .card-footer {
        text-align: center;
        margin-top: 30px;
      }
    </style>
  </head>
  <body>
    <div class="card">
      <div class="card-header">
      @include('emails.includes.header')
      </div>
      <div class="card-body">
        
        <h2 class="card-heading">New Order: {{$orderData->order_num}}</h2>
        <table>
          <tr>
            <th>Patient Name</th>
            <td>{{$orderData->userDetail->name}}</td>
          </tr>
          <tr>
            <th>Order number</th>
            <td>{{$orderData->order_num}}</td>
          </tr>
          <tr>
            <th>Patient Email</th>
            <td>{{$orderData->userDetail->email}}</td>
          </tr>
          <tr>
            <th>Patient Phone</th>
            <td>{{$orderData->userDetail->phone}}</td>
          </tr>
          <tr>
            <th>Patient DOB</th>
            <td>{{$orderData->userDetail->dob}}</td>
          </tr>
          <tr>
            <th>Payment Status</th>
            <td>@if($orderData->payment_status == 1)
                Paid
                @else
                Unpaid
                @endif
            </td>
          </tr>
          <tr style="background-color: black; color: white">
            <th>Order Amount</th>
            <td>${{$orderData->total_amount}}</td>
          </tr>
          
          
          
        </table>

        <br>
        <center>
        <p>Please update your location in your account when you are in Nevada</p>  
        <br>
        <p>By law, we can only provide consultations if you are present in Nevada</p>
        </center>
      </div>
      <div class="card-footer">
      @include('emails.includes.footer')
      </div>
    </div>
  </body>
</html>