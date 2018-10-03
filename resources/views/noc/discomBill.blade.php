<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div id="container">
         <div  style=" background: #f0f0f0;width: 100vw;display: flex;justify-content: center; padding: 20px;">
            <div style="width:100%;height:50px;background: #fff;padding: 30px 40px;">
               <div  style="text-align: center;"><img src="<?php echo public_path();?>/img/Tata_logo.svg" style="width:90px!important;height:90px!important;"></div>
                <div style="text-align:center;font-size:15px;font-weight:600;"><u>Debit Note</u></div>
               <div id="data3" style="margin-top:30px;">
                  <div id="emp1">To,</div>
                  <div class="row">&nbsp;</div>
                  <div id="emp3">{{$client_name}}</div>
                  <div id="emp4">{{$client_add1}} </div>
                  <div id="emp5">{{$client_add2}}</div>
                  <div id="emp5">{{$client_city}} {{$client_state}} {{$client_country}}</div>
                  <div id="emp6">PIN-{{$client_pin}}</div>
              </div>
                    <div class="row">&nbsp;</div>
                  <div class="row">&nbsp;</div>
                  <div class="row">&nbsp;</div>
                  <span style="float:right;">Date:{{$date}}</span>
             <div style="font-size:14px;font-weight:600;">Debit Note Number: {{$application_no}}</div>

              <div class="row">&nbsp;</div>
              <div class="row">&nbsp;</div>
              <div class="text-center" style="font-size:15px;font-weight:600;">Sub:Debit Note for {{$client_name}}({{$challan_no}})</div>
                 <div class="row">&nbsp;</div>
             <div style="margin-left:20%;">
                <table class="table table-bordered text-center table-condensed" style="width:80%;">
                  <tbody>
                  <tr>
                    <th style="font-size:12px;text-align:center;">Sr.No</th>
                    <th style="font-size:12px;text-align:center;">Particulars</th>
                    <th style="font-size:12px;text-align:center;">Amount</th>
                  </tr>
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;">1</td>
                    <td  style="font-size:12px;">Debit Note for NOC raised to DISCOM for<br>{{$client_name}} for the Period<br>from {{$from_date}} to {{$end_date}}.</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{$amount}}</td>
                  </tr>
                  </tbody>
                </table>
             </div>
             <div class="row">&nbsp;</div>
                @php
                    $convert_word = \App\Common\FinancialFunctions::getIndianCurrency($amount);
                @endphp
             <div class="row text-center" style="font-size:15px;font-weight:600;">Net Amount Payable: {{ucwords($convert_word) }} Only</div>
             <div class="row">&nbsp;</div>
             <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="row text-center" style="font-size:14px;font-weight:600;"><span style="font-size:18px;">*</span>This is a computer generated bill hence do not require any signature.</div>
               <div style="margin-top:12.5%;text-align:center;">
                     <div style="font-size:10px;font-weight:600;color:#4169E1;">Tata Power Trading Company Limited</div>
                     <div style="font-size:10px;font-weight:600;color:#4169E1;">Shatabdi Bhawan,2nd floor ,B 12-13,Sector-4,Noida-20130 Tel.: 0120-6102210/610 2213 Fax 0120-2540050/2540085</div>
                     <div style="font-size:10px;font-weight:600;color:#4169E1;">Website www.tatapowertrading.com Email:power@tatapowertrading.com</div>
                     <div style="font-size:10px;font-weight:600;color:#4169E1;">Regd.Office:Corporate Center ,34,Sant Tukaram Road,carnac Bunder,Mumbai 400009</div>
                     <div style="font-size:10px;font-weight:600;color:#4169E1;">Corporate Identification Number(CIN-U40100MH2003PLC143770)</div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
