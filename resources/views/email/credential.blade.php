<!DOCTYPE html>
    <html lang="en-US">
      <head>
          <meta charset="utf-8">
      </head>
      <!-- <body> -->
        <body style="background-color:#ffffe0;width:700px;padding-top:10px;padding-left:3px;">
        <div>Dear {{$clientname}},</div>
        <br/>
        <div>You recently subscribed to CRM System. Your login has been created to allow you to seamlessly manage the same.</div>
        <br>
        <div>Please find your Login credentials below.</div><br>
        <div><strong>Login ID</strong> : {{$crn_no}} </div><br>
        <div><strong>password</strong> : {{ $password }}</div><br>
        <div>To login and manage&nbsp;<a href="http://139.59.21.22/">click here</a></div>
        <br><br>
        <div><strong>With Regards,</strong></div>
        <div>Tata Power Trading Ltd</div>
      </body>
    </html>