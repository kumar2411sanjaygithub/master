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
                  <div id="emp4">{{$client_add1}}, {{$client_add2}},</div>
                  <div id="emp5">{{$client_city}}, @if(!empty($client_state) && $client_state!='PLEASE SELECT'){{  \App\Common\StateList::get_state_name($client_state) }},@endif</div>
                  <div id="emp6">{{$client_country}}, PIN-{{$client_pin}}.</div>
              </div>

                  <div class="row">&nbsp;</div>
                  <span style="float:right;">Date:{{$date}}</span>
             <div style="font-size:14px;font-weight:600;">Debit Note Number: {{$application_no}}</div>

              <div class="row">&nbsp;</div>
              <div class="row">&nbsp;</div>
              <div class="text-center" style="font-size:15px;font-weight:600;">Sub:Debit Note for {{$client_name}} ({{$client_iex_portfolio}})</div>
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
                    <td  style="font-size:12px;">Debit Note for NOC raised to {{$discom}} for<br>{{$client_name}} for the Period<br>from {{$from_date}} to {{$end_date}}.</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{$amount}}</td>
                  </tr>
                  @if($gst_applicable=='YES')
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;">2</td>
                    <td  style="font-size:12px;">CGST</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs.  {{isset($cgst)?$cgst:0}}</td>
                  </tr>
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;">3</td>
                    <td  style="font-size:12px;">SGST</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{isset($sgst)?$sgst:0}}</td>
                  </tr>
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;">4</td>
                    <td  style="font-size:12px;">UTGST</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{isset($utgst)?$utgst:0}}</td>
                  </tr>
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;">5</td>
                    <td  style="font-size:12px;">IGST</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{isset($igst)?$igst:0}}</td>
                  </tr>
                  @php $gst_total=@$cgst+@$sgst+@$utgst+@$igst; @endphp
                  @endif
                  @php $grand_total=$amount+@$gst_total @endphp
                  <tr>
                    <td  style="font-size:12px;vertical-align:middle;"></td>
                    <td  style="font-size:12px;">Total Amount</td>
                    <td  style="font-size:12px;vertical-align:middle;font-weight:600;">Rs. {{$grand_total}}</td>
                  </tr>
                  </tbody>
                </table>
             </div>
             <div class="row">&nbsp;</div>
                @php
                    $convert_word = \App\Common\FinancialFunctions::getIndianCurrency($grand_total);
                @endphp
             <div class="row text-center" style="font-size:15px;font-weight:600;">Net Amount Payable: {{ucwords($convert_word) }}</div>
             <div class="row">&nbsp;</div>
            <div class="row text-center" style="font-size:14px;font-weight:600;"><span style="font-size:18px;">*</span>This is a computer generated bill hence do not require any signature.</div>
               <div @if($gst_applicable=='YES') style="margin-top:6.5%;text-align:center;" @else style="margin-top:11.5%;text-align:center;" @endif>
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
