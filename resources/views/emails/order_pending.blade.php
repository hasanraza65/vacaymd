<!DOCTYPE html>
<html>
  <head>
    <title>Order Pending</title>
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
        <br>
        <center>
        <b><p>Your order # {{$orderData->order_num}} status has been changed to pending by our doctor.</p></b><br>
        </center>


      </div>
      <div class="card-footer">
      @include('emails.includes.footer')
      </div>
    </div>
  </body>
</html>