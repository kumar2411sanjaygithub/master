<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     
   </head>
   <body>
      <div id="target">
         <div style="background:#f0f0f0;width:100vw;display:flex;justify-content:center;         padding:20px;">
            <div style="width:100%;height:60%;background:#fff;padding:30px 40px;">
               <div style="text-align: center;" ><img src="<?php echo public_path();?>/img/Tata_logo.svg" style="width:90px!important;height:90px!important;"></div>
               <span style="margin-left:40px;">{{$date}}</span><span style="float:right;">{{$application_no}}</span>
               <div style="margin-top:30px;">
                  <div id="emp1">To</div>
                  <div id="emp2">KPTCL</div>
                  <div id="emp3">Chief Engineer(Electricity)</div>
                  <div id="emp4">State Load Despatch Centre</div>
                  <div id="emp5">No.28 Race Course Cross Road</div>
                  <div id="emp6">Banglore-560009</div>
               </div>
               <div class="row">&nbsp;</div>
               <div class="row">&nbsp;</div>
               <div style="font-size:14px;font-weight:600;">
                  <u>Sub: Standing Clearance for {{$sldc}} in Power Exchanges({{$exchange}})</u>
               </div>
               <div class="row">&nbsp;</div>
               <div>Dear Sir,</div>
               <div class="row">&nbsp;</div>
               <div style="font-size:13px;">
                  Tata Power Trading is a member of both the power exchange(IEX/PXIL),presently in operation.We have power purchase aggreement with
                  {{$sldc}} for Buying Power for their plant in karnataka. We request you to kindly issue the Standing Clearance
                  for Buying {{$quantum}} MW for {{$sldc}} power Exchange ({{$exchange}}) from {{$from_date}} to {{$end_date}}, as per Exchange Px-I format. Processing Fees of Rs.{{$amount}} with UTR no.
                  {{$challan_no}} is paid on {{$transcation_date}}.
               </div>
               <div class="row">&nbsp;</div>
               <div style="font-size:14px;font-weight:600;">Note: payment is made on {{$transcation_date}}</div>
               <div class="row">&nbsp;</div>
               <div class="row">&nbsp;</div>
               <div>Thank You ,</div>
               <div class="row">&nbsp;</div>
               <div>Your Faithfully,</div>
               <div>For Tata Power Trading Company Limited,</div>
               <div class="row">&nbsp;</div>
               <div class="row">&nbsp;</div>
               <div>(Anujesh Shahi)</div>
               <div>Head-Operations</div>
               <div style="margin-top:5%;text-align:center;">
                  <div style="font-size:10px;font-weight:600;">Tata Power Trading Company Limited</div>
                  <div style="font-size:10px;font-weight:600;">2nd Floor,Shatabdi Bhawan</div>
                  <div style="font-size:10px;font-weight:600;">B-12-13 Sector-4 Noida,Uttar Pardesh-201301</div>
                  <div style="font-size:10px;font-weight:600;">Tel 91 120-6102210,6102213,Fax: 91-120-2540050,91-120-2540085</div>
                  <div style="font-size:10px;font-weight:600;">www.tatapowertrading.com CIN: U40100MH20003PLC143770</div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html> 
