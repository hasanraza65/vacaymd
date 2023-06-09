@include('landing.layout.header')
    <style>
      body {
        text-align: center;
        padding:0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 50px;
        line-height: 100px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
      <div class="card m-3" style="margin-top:40px !important;border-radius:10px;">
      
       <img style="border-radius:200px; height:50px; max-width:50px; background: #9ABC66; margin:0 auto;" src="/src/assets/img/ICONN.png" alt="">
        <h1 class="mt-4">Thank You</h1> 
        <p>Thank you submitting you information. <br> Your information in under review and you will be notified <br> once your prescription has been approved.</p>

        <br>
        <span style="font-size:16px">You will not be charged till your prescription is approved.</span>
      
         <div class="m-4" style="margin-top:40px !important;">
         <a class="btn button-custom previous-button m-2"  href="https://vacaymd.com/">Homepage</a>
         <a class="btn button-custom submitbtn m-2"  href="https://orders.vacaymd.com/">Login</a>

         </div>
       </div>
  
      @include('landing.layout.footer')