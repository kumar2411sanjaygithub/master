<!DOCTYPE html>
    <html lang="en-US">
      <head>
          <meta charset="utf-8">
      </head>
      <body>
        @if($billtype == 'CF')
          <div>Dear Sir,</div>
          <div>
            <br>
            Please find attached bill for Consultancy Fee. Request you to provide the payment details once same is processed.
          </div>
          <br><br>
          Regards,
          <br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @elseif($billtype == 'EXRC')
          <div>Dear Sir,</div>
          
          <div>
         
            <br>
            Please find attached bill for Client Registration Fee. Request you to provide the payment details once same is processed.
          </div>
          <br><br>
          Regards,
          <br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
          @elseif($billtype == 'NOC')
          <div>Dear Sir,</div>
         
          <div>
         
            <br>
            Please find attached bill for NOC (Standing Clearence) Fee. Request you to provide the payment details once same is processed.
          </div>
         <br><br>
          Regards,
          <br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @elseif($billtype == 'RENEWAL')
          <div>Dear Sir,</div>
          
          <div>
         
            <br>
            Please find attached bill for Client Renewal Fee. Request you to provide the payment details once same is processed.
          </div>
         <br><br>
          Regards,
          <br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @elseif($billtype == 'EXPF')
          <div>Dear Sir,</div>
          
          <div>
         
            <br>
            Please find attached bill for Exchange Proccessing Fee. Request you to provide the payment details once same is processed.
          </div><br><br>
          Regards,
          <br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @else
          <div>Dear Sir,</div>
        <br/>
        <div>Your Manual Bill for DD {{$dateName}} has not been received yet. Request to submit it before 11:00 AM .</div>
        <br/><br/>
        <div>With Regards,</div>
        <div>Tata Power Trading Ltd</div>
        @endif
        
      </body>
    </html>