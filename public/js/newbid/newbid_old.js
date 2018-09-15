// code for add bid tab code start
$(document).ready(function(){
  $(".addbidtab").hide();
  // $(".addbidbtn").click(function() {
  //   $(".addbidtab").removeClass('hidden');
  //   $(".addbidtab").fadeIn( 2000 );
  //   // $(".recordtable").show();
  // });
});
// code for add bid tab code end
// recod table show hide code start
$(document).ready(function() {

    $(".hdate").hide('slow');
    $(".recordtable").hide('slow');
    // $(document).on('click','.showrecordtable',function(){
    //   $(".recordtable").show('slow');
    // });
});

// $(".hdate").hide();


$(document).ready(function() {

    // $("#client").on('keyup', function() {
    //    alert($('#client').val());



    // });

    // function  sateConverter(i,x){
    //     // alert(i);
    //     startdate = i;
    //     enddate = x;
    //   }
     // console.log(startdate,enddate);
    // show tab on click earlier date yes no start
    $(".oneyes").click(function() {
        $(".hdate").show("slow");
        $(".hideonearlier").hide("slow");
        $(".recordtable").hide('slow');
    });
    $(".twono").click(function() {
        $(".hdate").hide("slow");
        $(".hideonearlier").show("slow");
        if($('._checkbox').length){
            $(".recordtable").show('slow');
        }

    });
    // show tab on click earlier date yes no end

});

$(document).ready(function() {
    {
      $('li[role="tab"]').removeClass("disabled");
      $('ul[aria-label="Pagination"]').hide();
    }
});
// <!-- time jq start -->
function makeTimer() {
var days = 0;
var hours = 0;
var minutes = 0;
var seconds = 0;
    var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
    endTime = (Date.parse(endTime) / 1000);

    var now = new Date();
    now = (Date.parse(now) / 1000);

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

    if (hours < "10") {
        hours = "0" + hours;
    }
    if (minutes < "10") {
        minutes = "0" + minutes;
    }
    if (seconds < "10") {
        seconds = "0" + seconds;
    }

    $("#days").html(days + "<span class='spanbb0'>Days</span>");
    $("#hours").html(hours + "<span class='spanbb0'>:</span>");
    $("#minutes").html(minutes + "<span class='spanbb0'>:</span>");
    $("#seconds").html(seconds + "<span class='spanbb0'></span>");

}
setInterval(function() {
    makeTimer();
}, 1000);

function updateLink() {
    var portfolio_id = 'PORTFOLO1234';
    // document.getElementById('portfolio_id').value;
    var exchange = 'IEX';
    // document.getElementById('exchange').value;
    var date = today();
    // document.getElementById('date').value;
    var hit_link = 'mass_bid_placement.php?portfolio_id=' + portfolio_id + '&exchange=' + exchange + '&date=' + date;
    window.open(hit_link, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700px, height=2700px');
    return false;
}

function today() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = mm + '-' + dd + '-' + yyyy;
    return today;
}

// <!-- time jq end -->



function checkfile(sender) {
    var validExts = new Array(".xlsx", ".xls", ".zip");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
        alert("Invalid file selected, valid files are of " +
            validExts.toString() + " types.");
        return false;
    } else return true;
}

// select all checkbox
// $(document).on('click', '#select_all', function(e) {
//     if ($(this).is(':checked', true)) {
//         $(".emp_checkbox").prop('checked', true);
//     } else {
//         $(".emp_checkbox").prop('checked', false);
//     }
//     // set all checked checkbox count
//     // $("#select_count").html("Delete " + $("input.emp_checkbox:checked").length + " Selected");
// });
// set particular checked checkbox count
// $(".emp_checkbox").on('click', function(e) {
//     $("#select_count").html("Delete " + $("input.emp_checkbox:checked").length + " Selected");
// });

$(document).ready(function() {
    $(".pxiltab").hide();
    $('input.pxil_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'PXIL') {
            $(".pxiltab").show();
            $(".iextab").hide();
        }
    });
    $('input.iex_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'IEX') {
            $(".pxiltab").hide();
            $(".iextab").show();
        }
    });
});

//code added by piyush
$(document).ready(function(){
     /*
     * Get Time Slot
    */
    var timeSlotFn = function(){
      var ary = [];
      for(var i = 0; i <= 23; i++){
        for(var j = 1; j <= 4; j++){
          (j == 1) ? ((i < 10) ? ary.push('0'+i+':00') : ary.push(i+':00')) : ((i < 10) ? ary.push('0'+i+':'+(j - 1)*15) : ary.push(i+':'+(j - 1)*15))
        }
      }
      return ary;
    }



    /*
    *
    */
    var parseIn = function(date_time){
        var d = new Date();
        d.setHours(date_time.split(':')[0]);
        d.setMinutes(date_time.split(':')[1]);
        return d;
      }

    /*
    *
    */
    function getTimeIntervals(time1, time2, numbers) {
          var arr = [];
          while(time1 < time2){
            var a1 = time1.toTimeString().substring(0,5);
            // console.log(a1);
            time1.setMinutes(time1.getMinutes() + numbers);
            var a2 = time1.toTimeString().substring(0,5);
            arr.push(a1+'-'+a2);
          }
          return arr;
        }


    /*
    *
    */
    function getTotalMinutes(_d1, _d2, blockNumber){
      var d1 = new Date();
      var d2 = new Date();
      d1.setHours(_d1.split(':')[0]);
      d1.setMinutes(_d1.split(':')[1]);
      d2.setHours(_d2.split(':')[0]);
      d2.setMinutes(_d2.split(':')[1]);
      var difference = d2.getTime() - d1.getTime(); // This will give difference in milliseconds
      var totalMin = Math.round(difference / 60000);
      var bidDiff = (totalMin / blockNumber);
      var checkDiff = (bidDiff % 15);
      return (checkDiff === 0) ? getTimeIntervals(d1, d2, bidDiff) : false;
    }

    /*
     * Open Modle with all data for place bid
     * Created by Piyush Shukla
     */

    $('#add_bid').click(function(){
      $("#bid-form-edit").hide();
        if($("#client").val()=='' || $("#bid_date").val()==''){
            swal('Error!', 'Please select client and delivery date !!!.', 'error');
            return false;
        }
        var exchange = '';
        if ($('#exchange_pxil').is(':checked')) {
            var exchange = 'PXIL';
        }
        if ($('#exchange_iex').is(':checked')) {
            var exchange = 'IEX';
        }
        if(exchange==''){
            swal('Error!', 'Please select exchange !!!.', 'error');
            return false;
        }
        var timeslot = timeSlotFn();
        val = "";
        val+='<option value="">select</option>';
        for (var i = 0; i < timeslot.length; i++) {
                val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
        }
        val+='<option value="24:00">24:00</option>';
        $("#time_slot_from").html(val);

        val = "";
        val+='<option value="">select</option>';
        for (var i = 0; i < timeslot.length; i++) {
            if(timeslot[i] > '00:00'){
                val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
            }
        }
        val+='<option value="24:00">24:00</option>';
        $("#time_slot_to").html(val);

        $(".addbidtab").removeClass('hidden');
        $(".addbidtab").fadeIn( 1000 );

    });

     $("#bid_type").on('change', function() {
        var bid_type = $("#bid_type").val();
        if(bid_type=='block'){
            $("#no_of_block_div").show();
        }else{
            $("#no_of_block_div").hide();
        }
    });


    $("#time_slot_from").on('change', function() {
        var time_slot_from = $("#time_slot_from").val();
        var timeslot = timeSlotFn();
        val = "";
        for (var i = 0; i < timeslot.length; i++) {
            if(timeslot[i] > time_slot_from){
                // console.log(timeslot[i]);
                val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
            }
        }
        val+='<option value="24:00">24:00</option>';
        $("#time_slot_to").html(val);
        $("#no_of_block").val('1');
    });

    $("#time_slot_to").on('change', function() {
        var data =  getTimeIntervals(parseIn($("#time_slot_from").val()), parseIn($("#time_slot_to").val()), 15);
        // console.log(data);
        $("#no_of_block").val(data.length).addClass('has-value');
    });


    $('#save_biddetails').click(function(){
        if($("#client").val()==''){
            // alert("Please select client");
            swal('Error!', 'Please select client !!!.', 'error');
            $("#client").focus();
            return false;
        }
        if($("#bid_type").val()==''){
            swal('Error!', 'Please select bid type !!!.', 'error');
            $("#bid_type").focus();
            return false;
        }
        if($("#bid_action").val()==''){
            swal('Error!', 'Please select trade type !!!.', 'error');
            $("#bid_action").focus();
            return false;
        }
        if($("#time_slot_from").val()==''){
            swal('Error!', 'Please select time slot from !!!.', 'error');
            $("#time_slot_from").focus();
            return false;
        }
        if($("#time_slot_to").val()==''){
            swal('Error!', 'Please select time slot to !!!.', 'error');
            $("#time_slot_to").focus();
            return false;
        }
        if($("#bid_mw").val()==''){
            swal('Error!', 'Please enter bid quantum !!!.', 'error');
            $("#bid_mw").focus();
            return false;
        }
        if($("#bid_price").val()==''){
            swal('Error!', 'Please enter bid price !!!.', 'error');
            $("#bid_price").focus();
            return false;
        }
        if(($("#bid_price").val() < 0) || ($("#bid_price").val() > 20000)){
            swal('Error!', 'Bidding price between 0 to 20000. Please enter valid bid price !!!.', 'error');
            $("#bid_price").focus();
            return false;
        }

        var exchange = '';
        if ($('#exchange_pxil').is(':checked')) {
            var exchange = 'pxil';
        }
        if ($('#exchange_iex').is(':checked')) {
            var exchange = 'iex';
        }
        if(exchange==''){
            swal('Error!', 'Please select exchange !!!.', 'error');
            return false;
        }
        var bid_array =[];
        if($("#bid_type").val()=='block'){
          if(($("#no_of_block").val() < 0) || ($("#no_of_block").val() > 60)){
              swal('Error!', 'No of blocks between 0 to 60. Please enter valid no of blocks !!!.', 'error');
              $("#bid_price").focus();
              return false;
          }
          if(($("#bid_mw").val() < 0.1) || ($("#bid_mw").val() > 100)){
              swal('Error!', 'Bid quantum between 0.1 to 100. Please enter valid bid quantum !!!.', 'error');
              $("#bid_price").focus();
              return false;
          }
           var no_of_block = $("#no_of_block").val();
           var _final =  getTotalMinutes($("#time_slot_from").val(), $("#time_slot_to").val(), no_of_block);
           if(_final){

           var bidData = {
                exchange: exchange,
                client_id: $('#client_id').val(),
                bid_date: $('#bid_date').val(),
                bid_type: $('#bid_type').val(),
                bid_action: $('#bid_action').val(),
                time_slot_from: $('#time_slot_from').val(),
                time_slot_to: $('#time_slot_to').val(),
                bid_mw: $('#bid_mw').val(),
                bid_price: $('#bid_price').val(),
                no_of_block : $("#no_of_block").val(),
                _token : $('#_token').val()
            }
        }else{
            swal('Error!', 'Please enter valid block number !!!.', 'error');
            return false;
        }

        }else{
            var bidData = {
                exchange: exchange,
                client_id: $('#client_id').val(),
                bid_date: $('#bid_date').val(),
                bid_type: $('#bid_type').val(),
                bid_action: $('#bid_action').val(),
                time_slot_from: $('#time_slot_from').val(),
                time_slot_to: $('#time_slot_to').val(),
                bid_mw: $('#bid_mw').val(),
                bid_price: $('#bid_price').val(),
                _token : $('#_token').val()
               }
        }
        // console.log(bidData);
        var url = '/placebid/addnewbid/power';

        $.ajax({
              type: 'post',
              url: url,
              data: bidData,
              dataType: 'json',
              success: function(data) {
                var  count = data.placebidDataProcess.length;
                if(count){
                    var trData="";
                    for (var i=0; i<count; i++) {
                      if(data.placebidDataProcess[i].bid_action == 'sell'){
                        trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                          '<td>'+
                                            '<label class="mda-checkbox">'+
                                              '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                            '</label>'+
                                          '</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                          '<td>'+
                                              '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                          '</td>'+
                                        '</tr>';
                      }else{
                        trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                          '<td>'+
                                            '<label class="mda-checkbox">'+
                                              '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                            '</label>'+
                                          '</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                          '<td>'+
                                              '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                          '</td>'+
                                        '</tr>';
                      }

                    }
                     $(".recordtable").show('slow');
                     $('.show-new-bid').html(trData);
                     // View All bid In Preview and confirm Page

                }
                else{
                    $('.show-new-bid').html('');

                }
                var  placebidDataSubmittedcount = data.placebidDataSubmitted.length;
                if(placebidDataSubmittedcount){
                  var singleBid="";
                    var blockBid="";
                    for (var x=0; x<placebidDataSubmittedcount; x++) {
                      if(data.placebidDataSubmitted[x].bid_type=='single'){
                        if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                          singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }else{
                          singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }
                      }

                      if(data.placebidDataSubmitted[x].bid_type=='block'){
                        if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                          blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }else{
                          blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }
                      }
                    }
                    $("#set_delivery_date").html($("#bid_date").val());
                     $("#single-bid-data").html(singleBid);
                     $("#block-bid-data").html(blockBid);
                }else{
                    $("#single-bid-data").html('');
                    $("#block-bid-data").html('');
                }
                    $(".recordtable").show('slow');
                    $('#bid_type').val(''),
                    $('#bid_action').val(''),
                    $('#time_slot_from').val(''),
                    $('#time_slot_to').val(''),
                    $('#bid_mw').val(''),
                    $('#bid_price').val(''),
                    $("#no_of_block").val(''),
                    $("#set_delivery_date").html($("#bid_date").val());
                    // $("#sset_delivery_date").html($("#bid_date").val());

                swal('Success!', 'Bid added successfully !!!.', 'success');
                // $('#myModal').modal('hide');
              },
              error: function (response) {
                var valHtml = '<div class="alert alert-danger fade in alert-dismissible">'+
                          '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                            if(response.responseJSON.msg){
                                valHtml+= '<strong>Error! </strong>'+response.responseJSON.msg;
                              }else{
                                valHtml+= '<strong>Error!</strong> Serve error occurred !!!';
                              }
                  valHtml += '</div>';
                $(".msg_error").html(valHtml);
              }
          });

    });



  $("#bid_date").on('change', function() {
        if($("#client").val()==''){
            // alert("Please select client");
            swal('Error!', 'Please select client !!!.', 'error');
            $("#bid_date").val('');
            return false;
        }

        if($('#exchange_pxil'). prop("checked") == true){
          var exchange = 'pxil';
        }
        if($('#exchange_iex'). prop("checked") == true){
          var exchange = 'iex';
        }
        var urlget = '/placebid/getallbid/power';
        var dataSubmit = {
                exchange : exchange,
                client_id : $("#client_id").val(),
                bid_date : $("#bid_date").val(),
                _token :$("#_token").val()
            }
        $.ajax({
              type: 'post',
              url: urlget,
              data:dataSubmit,
              dataType: 'json',
              success: function(data) {
                // console.log(data);
                var  count = data.placebidDataProcess.length;
                if(count){
                    var trData="";
                    for (var i=0; i<count; i++) {
                      if(data.placebidDataProcess[i].bid_action == 'sell'){
                        trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                          '<td>'+
                                            '<label class="mda-checkbox">'+
                                              '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                            '</label>'+
                                          '</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                          '<td>'+
                                              '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                          '</td>'+
                                        '</tr>';
                      }else{
                        trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                          '<td>'+
                                            '<label class="mda-checkbox">'+
                                              '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                            '</label>'+
                                          '</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                          '<td>'+
                                              '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                          '</td>'+
                                        '</tr>';
                      }

                    }
                     $(".recordtable").show('slow');
                     $('.show-new-bid').html(trData);
                     // View All bid In Preview and confirm Page

                }
                else{
                    $('.show-new-bid').html('');

                }
                var  placebidDataSubmittedcount = data.placebidDataSubmitted.length;
                if(placebidDataSubmittedcount){
                  var singleBid="";
                    var blockBid="";
                    for (var x=0; x<placebidDataSubmittedcount; x++) {
                      if(data.placebidDataSubmitted[x].bid_type=='single'){
                        if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                          singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }else{
                          singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }
                      }

                      if(data.placebidDataSubmitted[x].bid_type=='block'){
                        if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                          blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }else{
                          blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                          '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                        '</tr>';
                        }
                      }
                    }
                    $("#set_delivery_date").html($("#bid_date").val());
                     $("#single-bid-data").html(singleBid);
                     $("#block-bid-data").html(blockBid);
                }else{
                    $("#single-bid-data").html('');
                    $("#block-bid-data").html('');
                }
              },
              error: function (response) {

              }
          });
    });

    $(document).on('click', '#remove-bid-data', function(event) {
      // swal("Are you sure you want to do this?", {
      //   buttons: ["Cancle", "Ok"],
      // });
      $(this).parents('tr').remove();
      var bid_id = $(this).attr("bid_id");
      $('table tr').filter("[id='" + bid_id + "']").remove();

      if(bid_id!=''){
        var url = '/placebid/deletebid/'+bid_id;
        $.ajax({
          type: 'get',
          url: url,
          dataType: 'json',
          success: function(data) {
            var valHtml = '<div class="alert alert-info alert-dismissable" style="margin-top:5px">' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
            '<strong>Success! </strong>' + data.msg + '</div>';
            $("#message").html(valHtml);
          },
          error: function (response) {
            var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                      '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        if(response.responseJSON.errors){
                            $.each( response.responseJSON.errors , function(key, value){
                              valHtml+= '<li>'+value+'</li>';
                            });
                          }else{
                            valHtml+= '<li>Serve error occurred !!!</li>';
                          }
              valHtml += '</div>';
            $("#message").html(valHtml);
          }
        });
      }else{
        var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                          valHtml+= '<li>Serve error occurred !!!</li>';
            valHtml += '</div>';
          $("#message").html(valHtml);
      }
    });

    $('.checked_all').on('change', function() {
            $('._checkbox').prop('checked', $(this).prop("checked"));
    });

    $(document).on("click","._checkbox",function() {
            // console.log($('._checkbox:checked').length , $('._checkbox').length)
        if($('._checkbox:checked').length == $('._checkbox').length){
               $('.checked_all').prop('checked',true);
        }else{
               $('.checked_all').prop('checked',false);
        }
    });

    $('#delete_all').on('click', function(e) {
        var allVals = [];
         $("._checkbox:checked").each(function() {
         allVals.push($(this).attr('data-id'));
         });
         //alert(allVals.length); return false;
         if(allVals.length <=0)
         {
         // alert("Please select bid.");
         swal('Error!', 'Please select bid !!!.', 'error');
         }
         else {
         WRN_PROFILE_DELETE = "Are you sure you want to delete this Bid?";
         var check = confirm(WRN_PROFILE_DELETE);
         if(check == true){
           //for server side

           // var join_selected_values = allVals.join(",");
           // console.log(join_selected_values);
           var JsonData = {
              _token:$('#_token').val(),
              ids:allVals
           }
           // console.log(JsonData);
           $.ajax({
               type: "POST",
               url: "/placebid/deleteallselectedbid",
               cache:false,
               data: JsonData,
                  success: function(response)
                   {

                       swal('Success!', 'All selected bid deleted successfully !!!.', 'success');
                   },
                   error: function (response) {
                      console.log(response);
                   }
               });
            //for client side
             $.each(allVals, function( index, value ) {
             $('table tr').filter("[data-row-id='" + value + "']").remove();
             });


         }
        }
      });

    $('#confirm_place_bid').on('click', function(e) {
        var allVals = [];
         $("._checkbox").each(function() {
         allVals.push($(this).attr('data-id'));
         });
         if(allVals.length <=0)
         {
             // alert("Please enter bid !!!");
             swal('Error!', 'Please save bid first !!!.', 'error');
             return false;
         }
         var JsonData = {
            _token:$('#_token').val(),
            client_id:$('#client_id').val(),
            bid_date:$('#bid_date').val(),
            ids:allVals
         }
         $.ajax({
             type: "POST",
             url: "/placebid/confirmplacebid",
             cache:false,
             data: JsonData,
                success: function(data)
                 {
                    $.each(allVals, function( index, value ) {
                     $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                    swal('Success!', 'Bid successfully placed !!!.', 'success');
                 },
                 error: function (response) {
                    console.log(response);
                 }
             });
            // console.log(allVals);
     });

  //Bid Edit
  $(document).on('click', '.edit-bid-data', function(event) {

    // $("#demo_123").addClass('hidden');
    var bid_type = $(event.currentTarget).attr("bid-type");
    if(bid_type!=''){
      var exchange = '';
      if($('#exchange_pxil'). prop("checked") == true){
           exchange = 'pxil';
        }
        if($('#exchange_iex'). prop("checked") == true){
           exchange = 'iex';
        }
      var JsonData = {
            _token:$('#_token').val(),
            client_id:$('#client_id').val(),
            bid_date:$('#bid_date').val(),
            exchange:exchange,
            bid_type:bid_type,
         }
      // console.log(JsonData);
      var url = '/placebid/getbiddetailsbybidtype/power';
      $.ajax({
        type: 'post',
        url: url,
        cache:false,
        data: JsonData,
        success: function(data) {
          var  count = data.placebidDataForEdit.length;
          if(count){
              var trData="";
              for (var i=0; i<count; i++) {
                if(data.placebidDataForEdit[i].bid_action == 'sell'){
                  trData += '<tr class="gradeX" data-row-id="'+data.placebidDataForEdit[i].id+'">'+
                                    '<td>'+
                                      '<label class="mda-checkbox">'+
                                        '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataForEdit[i].id+'"><em class="bg-blue-500"></em>'+
                                      '</label>'+
                                    '</td>'+
                                    '<td class="text-danger">'+data.placebidDataForEdit[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataForEdit[i].bid_action+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataForEdit[i].time_slot_from+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataForEdit[i].time_slot_to+'</td>'+
                                    '<td class="text-danger">-'+data.placebidDataForEdit[i].bid_mw+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataForEdit[i].bid_price+'</td>'+
                                    '<td>'+
                                        '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataForEdit[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataForEdit[i].id+'" src="/img/assets/delete.svg"></span>'+
                                    '</td>'+
                                  '</tr>';
                }else{
                  trData += '<tr class="gradeX" data-row-id="'+data.placebidDataForEdit[i].id+'">'+
                                    '<td>'+
                                      '<label class="mda-checkbox">'+
                                        '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataForEdit[i].id+'"><em class="bg-blue-500"></em>'+
                                      '</label>'+
                                    '</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].bid_type+'</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].bid_action+'</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].time_slot_from+'</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].time_slot_to+'</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].bid_mw+'</td>'+
                                    '<td class="text-success">'+data.placebidDataForEdit[i].bid_price+'</td>'+
                                    '<td>'+
                                        '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataForEdit[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataForEdit[i].id+'" src="/img/assets/delete.svg"></span>'+
                                    '</td>'+
                                  '</tr>';
                }

              }
               $(".recordtable").show('slow');
               $('.show-new-bid').html(trData);
               // View All bid In Preview and confirm Page

          }
          else{
              $('.show-new-bid').html('');

          }
        },
        error: function (response) {
          var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                      if(response.responseJSON.errors){
                          $.each( response.responseJSON.errors , function(key, value){
                            valHtml+= '<li>'+value+'</li>';
                          });
                        }else{
                          valHtml+= '<li>Serve error occurred !!!</li>';
                        }
            valHtml += '</div>';
          $("#message").html(valHtml);
        }
      });
    }else{
      var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        valHtml+= '<li>Serve error occurred !!!</li>';
          valHtml += '</div>';
        $("#message").html(valHtml);
    }
  });

  //Edit bid one by one
  $(document).on('click', '.edit-bid', function(event) {
    $('.hideonearlier#demo_123').hide();
    var bid_id = $(event.currentTarget).attr("bid_id");
    if(bid_id!=''){

      var url = '/placebid/getbiddetailsbyid/'+bid_id;
      $.ajax({
        type: 'get',
        url: url,
        cache:false,
        success: function(data) {
          // console.log(data.placebidData);
          // addbidtab
          $('#bid-form-edit').css("display", "block");
          $('#bid_type_updated').val(data.placebidData.bid_type);
          $('#bid_action_updated').val(data.placebidData.bid_action);
          // $('#time_slot_from').val(data.placebidData.time_slot_from);
          // $('#time_slot_to').val(data.placebidData.time_slot_to);
          $('#bid_mw_updated').val(data.placebidData.bid_mw);
          $('#bid_price_updated').val(data.placebidData.bid_price);
          $('#bid_id_for_updated').val(data.placebidData.id);

          var timeslot = timeSlotFn();
          val = "";
          for (var i = 0; i < timeslot.length; i++) {
            if(timeslot[i] == data.placebidData.time_slot_from){
              val+='<option value="' + timeslot[i] + '" selected>' + timeslot[i] + '</option>';
            }else{
              val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
            }
          }
          $("#time_slot_from_updated").html(val);

          val = "";
          for (var i = 0; i < timeslot.length; i++) {
              if(timeslot[i] >= data.placebidData.time_slot_to){
                  val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
              }
          }
          val+='<option value="24:00">24:00</option>';
          $("#time_slot_to_updated").html(val);
        },
        error: function (response) {
          var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                      if(response.responseJSON.errors){
                          $.each( response.responseJSON.errors , function(key, value){
                            valHtml+= '<li>'+value+'</li>';
                          });
                        }else{
                          valHtml+= '<li>Serve error occurred !!!</li>';
                        }
            valHtml += '</div>';
          $("#message").html(valHtml);
        }
      });
    }else{
      var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        valHtml+= '<li>Serve error occurred !!!</li>';
          valHtml += '</div>';
        $("#message").html(valHtml);
    }
  });



 //Edit bid one by one
  $(document).on('click', '#update_biddetails', function(event) {
      if($("#client").val()==''){
          swal('Error!', 'Please select client !!!.', 'error');
          $("#client").focus();
          return false;
      }
      if($("#bid_type_updated").val()==''){
          swal('Error!', 'Please select bid type !!!.', 'error');
          $("#bid_type_updated").focus();
          return false;
      }
      if($("#bid_action_updated").val()==''){
          swal('Error!', 'Please select trade type !!!.', 'error');
          $("#bid_action_updated").focus();
          return false;
      }
      if($("#time_slot_from_updated").val()==''){
          swal('Error!', 'Please select time slot from !!!.', 'error');
          $("#time_slot_from_updated").focus();
          return false;
      }
      if($("#time_slot_to_updated").val()==''){
          swal('Error!', 'Please select time slot to !!!.', 'error');
          $("#time_slot_to_updated").focus();
          return false;
      }
      if($("#bid_mw_updated").val()==''){
          swal('Error!', 'Please enter bid quantum !!!.', 'error');
          $("#bid_mw_updated").focus();
          return false;
      }
      if($("#bid_price_updated").val()==''){
          swal('Error!', 'Please enter bid price !!!.', 'error');
          $("#bid_price_updated").focus();
          return false;
      }
      if(($("#bid_price_updated").val() < 0) || ($("#bid_price_updated").val() > 20000)){
          swal('Error!', 'Bidding price between 0 to 20000. Please enter valid bid price !!!.', 'error');
          $("#bid_price_updated").focus();
          return false;
      }

      var exchange = '';
      if ($('#exchange_pxil').is(':checked')) {
          var exchange = 'pxil';
      }
      if ($('#exchange_iex').is(':checked')) {
          var exchange = 'iex';
      }
      if(exchange==''){
          swal('Error!', 'Please select exchange !!!.', 'error');
          return false;
      }

      var bidData = {
          exchange: exchange,
          client_id: $('#client_id').val(),
          bid_date: $('#bid_date').val(),
          bid_type: $('#bid_type_updated').val(),
          bid_action: $('#bid_action_updated').val(),
          time_slot_from: $('#time_slot_from_updated').val(),
          time_slot_to: $('#time_slot_to_updated').val(),
          bid_mw: $('#bid_mw_updated').val(),
          bid_price: $('#bid_price_updated').val(),
          _token : $('#_token').val()
         }
      var url = '/placebid/updatebiddata/power/'+$('#bid_id_for_updated').val();
      $.ajax({
        type: 'post',
        url: url,
        cache:false,
        data: bidData,
        success: function(data) {
          $('#bid-form-edit').css('display', "none");
          var  count = data.placebidDataProcess.length;
          if(count){
              var trData="";
              for (var i=0; i<count; i++) {
                if(data.placebidDataProcess[i].bid_action == 'sell'){
                  trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                    '<td>'+
                                      '<label class="mda-checkbox">'+
                                        '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                      '</label>'+
                                    '</td>'+
                                    '<td class="text-danger">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                    '<td class="text-danger">-'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                    '<td>'+
                                        '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                    '</td>'+
                                  '</tr>';
                }else{
                  trData += '<tr class="gradeX" data-row-id="'+data.placebidDataProcess[i].id+'">'+
                                    '<td>'+
                                      '<label class="mda-checkbox">'+
                                        '<input type="checkbox" class="_checkbox" data-id="'+data.placebidDataProcess[i].id+'"><em class="bg-blue-500"></em>'+
                                      '</label>'+
                                    '</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].bid_type+'</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].bid_action+'</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].time_slot_from+'</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].time_slot_to+'</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].bid_mw+'</td>'+
                                    '<td class="text-success">'+data.placebidDataProcess[i].bid_price+'</td>'+
                                    '<td>'+
                                        '<span><img class="headericon zoom edit-bid" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/edit.svg"> | <img class="headericon zoom" id="remove-bid-data" bid_id="'+data.placebidDataProcess[i].id+'" src="/img/assets/delete.svg"></span>'+
                                    '</td>'+
                                  '</tr>';
                }

              }
               $(".recordtable").show('slow');
               $('.show-new-bid').html(trData);
               // View All bid In Preview and confirm Page

          }
          else{
              $('.show-new-bid').html('');

          }
          var  placebidDataSubmittedcount = data.placebidDataSubmitted.length;
          if(placebidDataSubmittedcount){
            var singleBid="";
              var blockBid="";
              for (var x=0; x<placebidDataSubmittedcount; x++) {
                if(data.placebidDataSubmitted[x].bid_type=='single'){
                  if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                    singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                    '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                  '</tr>';
                  }else{
                    singleBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                  '</tr>';
                  }
                }

                if(data.placebidDataSubmitted[x].bid_type=='block'){
                  if(data.placebidDataSubmitted[x].bid_action == 'sell'){
                    blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                    '<td class="text-danger">-'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                    '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                  '</tr>';
                  }else{
                    blockBid += '<tr id="'+data.placebidDataSubmitted[x].id+'">'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
                                    '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
                                  '</tr>';
                  }
                }
              }
              $("#set_delivery_date").html($("#bid_date").val());
               $("#single-bid-data").html(singleBid);
               $("#block-bid-data").html(blockBid);
          }else{
              $("#single-bid-data").html('');
              $("#block-bid-data").html('');
          }
              $(".recordtable").show('slow');
              $("#set_delivery_date").html($("#bid_date").val());
              // $("#sset_delivery_date").html($("#bid_date").val());

          swal('Success!', 'Bid updated successfully !!!.', 'success');
          // $('#myModal').modal('hide');
        },
        error: function (response) {
          var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                      if(response.responseJSON.errors){
                          $.each( response.responseJSON.errors , function(key, value){
                            valHtml+= '<li>'+value+'</li>';
                          });
                        }else{
                          valHtml+= '<li>Serve error occurred !!!</li>';
                        }
            valHtml += '</div>';
          $("#message").html(valHtml);
        }
      });
  });




// $(document).on('click', '.update-bid', function(event) {
//     var bid_id = $(event.currentTarget).attr("bid_id");
//     if(bid_id!=''){

//       var url = '/placebid/getbiddetailsbyid/'+bid_id;
//       $.ajax({
//         type: 'get',
//         url: url,
//         cache:false,
//         success: function(data) {
//           // console.log(data.placebidData);
//           // addbidtab
//           $('#bid-form-edit').css("display", "block");
//           $('#bid-form-edit').removeClass("hidden");
//           $('#bid_type').val(data.placebidData.bid_type);
//           $('#bid_action').val(data.placebidData.bid_action);
//           // $('#time_slot_from').val(data.placebidData.time_slot_from);
//           // $('#time_slot_to').val(data.placebidData.time_slot_to);
//           $('#bid_mw').val(data.placebidData.bid_mw);
//           $('#bid_price').val(data.placebidData.bid_price);
//           $('#bid_id_for_update').val(data.placebidData.id);

//           var timeslot = timeSlotFn();
//           val = "";
//           for (var i = 0; i < timeslot.length; i++) {
//             if(timeslot[i] == data.placebidData.time_slot_from){
//               val+='<option value="' + timeslot[i] + '" selected>' + timeslot[i] + '</option>';
//             }else{
//               val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
//             }
//           }
//           $("#time_slot_from").html(val);

//           val = "";
//           for (var i = 0; i < timeslot.length; i++) {
//               if(timeslot[i] >= data.placebidData.time_slot_to){
//                   val+='<option value="' + timeslot[i] + '">' + timeslot[i] + '</option>';
//               }
//           }
//           val+='<option value="24:00">24:00</option>';
//           $("#time_slot_to").html(val);
//         },
//         error: function (response) {
//           var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
//                     '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//                       if(response.responseJSON.errors){
//                           $.each( response.responseJSON.errors , function(key, value){
//                             valHtml+= '<li>'+value+'</li>';
//                           });
//                         }else{
//                           valHtml+= '<li>Serve error occurred !!!</li>';
//                         }
//             valHtml += '</div>';
//           $("#message").html(valHtml);
//         }
//       });
//     }else{
//       var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
//                   '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//                         valHtml+= '<li>Serve error occurred !!!</li>';
//           valHtml += '</div>';
//         $("#message").html(valHtml);
//     }
//   });

  // $('#confirm_place_bid_for_earlier_date').on('click', function(e) {
  //       var allVals = [];
  //        $("._checkbox").each(function() {
  //        allVals.push($(this).attr('data-id'));
  //        });
  //        if(allVals.length <=0)
  //        {
  //            // alert("Please enter bid !!!");
  //            swal('Error!', 'Please save bid first !!!.', 'error');
  //            return false;
  //        }
  //        var JsonData = {
  //           _token:$('#_token').val(),
  //           ids:allVals
  //        }
  //        $.ajax({
  //            type: "POST",
  //            url: "/placebid/confirmplacebid",
  //            cache:false,
  //            data: JsonData,
  //               success: function(data)
  //                {
  //                 // console.log(data.placebidDataSubmitted);
  //                   var  countsubmitted = data.placebidDataSubmitted.length;
  //                   if(countsubmitted){
  //                     var singleBid="";
  //                       var blockBid="";
  //                       for (var x=0; x<countsubmitted; x++) {
  //                         if(data.placebidDataSubmitted[x].bid_type=='single'){
  //                           if(data.placebidDataSubmitted[x].bid_action == 'sell'){
  //                              singleBid += '<tr>'+
  //                                             '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
  //                                             '<td class="text-danger">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
  //                                             '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
  //                                             '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
  //                                           '</tr>';
  //                           }else{
  //                              singleBid += '<tr>'+
  //                                             '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_from+'</td>'+
  //                                             '<td class="text-success">'+data.placebidDataSubmitted[x].time_slot_to+'</td>'+
  //                                             '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
  //                                             '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
  //                                           '</tr>';
  //                           }

  //                         }
  //                         if(data.placebidDataSubmitted[x].bid_type =='block'){
  //                             var _final =  getTotalMinutes(data.placebidDataSubmitted[x].time_slot_from, data.placebidDataSubmitted[x].time_slot_to, data.placebidDataSubmitted[x].no_of_block);
  //                             // console.log(_final);
  //                             blockBid+=blockBid;
  //                             if(_final){
  //                                 for(var j=0; j<_final.length; j++){
  //                                     // alert('hide');
  //                                     if(data.placebidDataSubmitted[x].bid_action == 'sell'){
  //                                       blockBid += '<tr>'+
  //                                                       '<td class="text-danger">'+_final[j].split('-')[0]+'</td>'+
  //                                                       '<td class="text-danger">'+_final[j].split('-')[1]+'</td>'+
  //                                                       '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
  //                                                       '<td class="text-danger">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
  //                                                     '</tr>';
  //                                     }else{
  //                                       blockBid += '<tr>'+
  //                                                       '<td class="text-success">'+_final[j].split('-')[0]+'</td>'+
  //                                                       '<td class="text-success">'+_final[j].split('-')[1]+'</td>'+
  //                                                       '<td class="text-success">'+data.placebidDataSubmitted[x].bid_mw+'</td>'+
  //                                                       '<td class="text-success">'+data.placebidDataSubmitted[x].bid_price+'</td>'+
  //                                                     '</tr>';
  //                                     }
  //                                 }
  //                             }

  //                         }
  //                       }
  //                       $("#set_delivery_date").html($("#bid_date").val());
  //                        $("#single-bid-data").append(singleBid);
  //                        $("#block-bid-data").append(blockBid);
  //                        $.each(allVals, function( index, value ) {
  //                          $('table tr').filter("[data-row-id='" + value + "']").remove();
  //                         });
  //                   }else{
  //                       $("#single-bid-data").append('');
  //                       $("#block-bid-data").append('');
  //                   }

  //                   swal('Success!', 'Bid successfully placed !!!.', 'success');
  //                },
  //                error: function (response) {
  //                   console.log(response);
  //                }
  //            });
  //           // console.log(allVals);
  //    });
// id="edit-bid-data" bid_id=
  // currentRow=null;


});
