<!DOCTYPE html>
    <html lang="en-US">
      <head>
          <meta charset="utf-8">
      </head>
      <body>
        @if($billnature == 'INVOICE')
          <div>Dear Sir,</div>
            <br>
            Kindly find the attached bills for the power purchase through IEX for the delivery date {{ $dateName }}. TPTCL has decided not to dispatch hard copies of bill as a GREEN INITIATIVE.<br>
            It is hereby requested to consider the soft copy of the bill for processing.
          </div>
          Regards,
          <br><br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @else
         <div>
          Dear Sir,
            <br>
            Kindly find the attached payment advice for the power sold through IEX for the delivery date {{ $dateName }}.TPTCL has decided not to dispatch hard copies of bill as a GREEN INITIATIVE.<br>
            It is hereby requested to consider the soft copy of the Payment Advice for processing.
          </div>
          Regards,
          <br><br>
          {{$trader_name}} Exchange Team
          <br>
          0120-6102210/13
          <br>
          px@tatapower.com
        @endif
      </body>
    </html>