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
          // bid_type: $('#bid_type').val(),
          // order_status: $('#order_status').val(),
          // sort_status: $('#sort_status').val(),
          // exchange: $('#exchange').val(),
          // order_nature: $('#order_nature').val(),
          _token : $('#_token').val()
        }
        // console.log(orderbookData);
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
                if (data.placebidData) {
                  var j =1;
                  for (var i = 0; i < data.placebidData.length; i++) {
                    trData += '<tr class="gradeA">'+
                                '<td class="text-center">'+j+'</td>'+
                                '<td class="text-center">'+data.placebidData[i].order_no+'</td>'+
                                '<td class="text-center">'+data.placebidData[i].biddate+'</td>'+
                                '<td class="text-center">'+data.placebidData[i].portfolio_id+'</td>'+
                                '<td class="text-center">'+data.placebidData[i].company_name+'</td>'+
                                '<td class="text-center"><a><span data-toggle="modal" order-no="'+data.placebidData[i].order_no+'" bid-type="single" data-target="#bid-details" class="text-info view-details">View</span></a></td>'+
                                '<td class="text-center"><a><span data-toggle="modal" order-no="'+data.placebidData[i].order_no+'" bid-type="block" data-target="#bid-details" class="text-info view-details">View</span></a></td>'+
                                '<td class="text-center">'+data.placebidData[i].order_placed_by+'</td>'+
                                // '<td>'+data.placebidData[i].status+'</td>'+
                              '</tr>';
                              j++;
                  }
                }else{
                  trData += '<tr class="gradeX">'+
                                      '<td class="text-center" colspan="7">Data Not Found</td>'+
                                    '</tr>';

                }

                $("#order-list").html(trData);
              },
              error: function (response) {

              }
          });

    });


    $(document).on('click', '.view-details', function(event){
      var order_no = $(this).attr("order-no");
      var bid_type = $(this).attr("bid-type");
      // alert(order_no);
      $.ajax({
         type:'get',
         url:'/orderbook/vieworderdetails/'+order_no+'/'+bid_type,
         success: function(data){
          // console.log(data);
            $("#bid-details .modal-dialog").html(data);
         },
        error: function (response) {
          console.log(response);
        }
      });
    });

});
