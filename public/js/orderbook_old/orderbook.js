//code added by piyush
$(document).ready(function(){
  /*
   * Get Time Slot
   */
   $( "#date_from" ).datepicker({
      autoclose: true,
      format:'dd/mm/yyyy'
    });

   $( "#date_to" ).datepicker({
      autoclose: true,
      format:'dd/mm/yyyy'
    });

  $('.searchBidDeatils').click(function(){
      // var date_rgx = /(\d{4})-(\d{2})-(\d{2})/;
      // if(!date_to.match(date_rgx))
      // {
      //   alert("Please enter to date in YYYY-MM-DD format")
      //   $('date_to').focus();
      //   return false;
      // }
      var date_from = $('#date_from').val();
      var date_to = $('#date_to').val();
      var client_id = $('.search_text').val();
      if(client_id == "")
      {
        swal('Error!', 'Please enter user !!!.', 'error');
        $('.search_text').focus();
        return false;
      }
      if(date_from == "")
      {
        swal('Error!', 'Please enter from date !!!.', 'error');
        $('#date_from').focus();
        return false;
      }
      if(date_to == "")
      {
        swal('Error!', 'Please enter to date !!!.', 'error');
        $('#date_to').focus();
        return false;
      }
      if(date_from > date_to)
      {
        swal('Error!', 'From date should not be greater than to date !!!.', 'error');
        $('#date_to').focus();
        return false;
      }

      var orderbookData = {
          client_id: $('#user_id').val(),
          client_name: $('.search_text').val(),
          date_to: $('#date_to').val(),
          date_from: $('#date_from').val(),
          bid_type: $('#bid_type').val(),
          order_status: $('#order_status').val(),
          sort_status: $('#sort_status').val(),
          exchange: $('#exchange').val(),
          order_nature: $('#order_nature').val(),
          _token : $('#_token').val()
        }
        console.log(orderbookData);
        // var bid_array =[];
        // if($("#bid_type").val()=='block'){

        // }
        var url = '/orderbook/orderbookdata';
        $.ajax({
              type: 'post',
              url: url,
              data: orderbookData,
              dataType: 'json',
              success: function(data) {
                // console.log(data.placebidData);
                var trData='';
                if (data.iexPlaceBidData) {
                  for (var i = 0; i < data.iexPlaceBidData.length; i++) {
                    trData += '<tr class="gradeX">'+
                                    // "id": 45,
                                    // "client_id": 1,
                                    // "bid_date": "03/07/2018",
                                    // "bid_type": "single",
                                    // "bid_action": "buy",
                                    // "time_slot_from": "00:00",
                                    // "time_slot_to": "00:15",
                                    // "bid_mw": "12",
                                    // "bid_price": "1200",
                                    // "no_of_block": null,
                                    // "staff_id": null,
                                    // "status": 1,
                                    // "order_no": null,
                                    // "created_at": "2018-03-06 04:36:03",
                                    // "updated_at": "2018-03-06 04:36:03"
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                    '<td class="text-danger">'+data.iexPlaceBidData[i].bid_type+'</td>'+
                                  '</tr>';
                  };
                }

                // $("#set_delivery_date").html($("#bid_date").val());
                // swal('Success!', 'Bid added successfully !!!.', 'success');
                // $('#loading').html("").hide();
              },
              error: function (response) {

              }
          });

    });
});
