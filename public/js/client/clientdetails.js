$(document).ready(function() {
  $(document).on('click', '#saveclient', function(event) {

  	var company_name = $('#company_name').val();
		   if(company_name == "")
		     {
		       swal('Error!', 'Please Enter Company Name !!!.', 'error');
		       $('#company_name').focus();
		       return false;
		     }
		var gstin = $('#gstin').val();
		   if(gstin == "")
		     {
		       swal('Error!', 'Please Enter GSTIN !!!.', 'error');
		       $('#gstin').focus();
		       return false;
		     }
		var pan = $('#pan').val();
		   if(pan == "")
		     {
		       swal('Error!', 'Please Enter PAN !!!.', 'error');
		       $('#pan').focus();
		       return false;
		     }
		var cin = $('#cin').val();
		   if(cin == "")
		     {
		       swal('Error!', 'Please Enter CIN No. !!!.', 'error');
		       $('#cin').focus();
		       return false;
		     }
		// var new_sap_id = $('#new_sap_id').val();
		//    if(new_sap_id == "")
		//      {
		//        swal('Error!', 'Please Enter Accounting Id. !!!.', 'error');
		//        $('#new_sap_id').focus();
		//        return false;
		//      }
		// var short_id = $('#short_id').val();
		//    if(short_id == "")
		//      {
		//        swal('Error!', 'Please Enter Short Id !!!.', 'error');
		//        $('#short_id').focus();
		//        return false;
		//      }
		var email = $('#email').val();
		   if(email == "")
		     {
		       swal('Error!', 'Please Enter Short Id !!!.', 'error');
		       $('#email').focus();
		       return false;
		     }
		
		
		var pri_contact_no = $('#pri_contact_no').val();
		   if(pri_contact_no == "")
		     {
		       swal('Error!', 'Please Enter Your Contact NO !!!.', 'error');
		       $('#pri_contact_no').focus();
		       return false;
		     }
		// var old_sap_id = $('#old_sap_id').val();
		//    if(old_sap_id == "")
		//      {
		//        swal('Error!', 'Please Enter Old Account Id !!!.', 'error');
		//        $('#old_sap_id').focus();
		//        return false;
		//      }
		// var bill_line1 = $('#bill_line1').val();
		//    if(bill_line1 == "")
		//      {
		//        swal('Error!', 'Please Enter Address Line 1 !!!.', 'error');
		//        $('#bill_line1').focus();
		//        return false;
		//      }
		// var bill_country = $('#bill_country').val();
		//    if(bill_country == "")
		//      {
		//        swal('Error!', 'Please Select Country !!!.', 'error');
		//        $('#bill_country').focus();
		//        return false;
		//      }
		// var bill_state = $('#bill_state').val();
		//    if(bill_state == "")
		//      {
		//        swal('Error!', 'Please Select State !!!.', 'error');
		//        $('#bill_state').focus();
		//        return false;
		//      }
		// var bill_city = $('#bill_city').val();
		//    if(bill_city == "")
		//      {
		//        swal('Error!', 'Please Enter City/Town !!!.', 'error');
		//        $('#bill_city').focus();
		//        return false;
		//      }
		// var bill_pin = $('#bill_pin').val();
		//    if(bill_pin == "")
		//      {
		//        swal('Error!', 'Please Enter Pin Code !!!.', 'error');
		//        $('#bill_pin').focus();
		//        return false;
		//      }
		// var bill_mob = $('#bill_mob').val();
		//    if(bill_mob == "")
		//      {
		//        swal('Error!', 'Please Enter Mobile No. !!!.', 'error');
		//        $('#bill_mob').focus();
		//        return false;
		//      }
		//  var bill_telephone = $('#bill_telephone').val();
		//    if(bill_telephone&&(bill_telephone.toString().length > 20))
		//      {

		//        swal('Error!', 'Telephone Number Must Be Less Than 20 Digits !!!.', 'error');
		//        $('#bill_telephone').focus();
		//        return false;
		//      }
		
  	  //  var name_of_substation = $('#name_of_substation').val();
		   // if(name_of_substation == "")
		   //   {
		   //     swal('Error!', 'Please Select Substation !!!.', 'error');
		   //     $('#name_of_substation').focus();
		   //     return false;
		   //   }
		 var reg_line1 = $('#reg_line1').val();
		   if(reg_line1 == "")
		     {
		       swal('Error!', 'Please Enter Address Line 1 !!!.', 'error');
		       $('#reg_line1').focus();
		       return false;
		     }
		var reg_country = $('#reg_country').val();
		   if(reg_country == "")
		     {
		       swal('Error!', 'Please Select Country !!!.', 'error');
		       $('#reg_country').focus();
		       return false;
		     }
		var reg_state = $('#reg_state').val();
		   if(reg_state == "")
		     {
		       swal('Error!', 'Please Select State !!!.', 'error');
		       $('#reg_state').focus();
		       return false;
		     }
		var reg_city = $('#reg_city').val();
		   if(reg_city == "")
		     {
		       swal('Error!', 'Please Enter City/Town !!!.', 'error');
		       $('#reg_city').focus();
		       return false;
		     }
		var reg_pin = $('#reg_pin').val();
		   if(reg_pin == "")
		     {
		       swal('Error!', 'Please Enter Pin Code !!!.', 'error');
		       $('#reg_pin').focus();
		       return false;
		     }
		var reg_mob = $('#reg_mob').val();
		   if(reg_mob == "")
		     {
		       swal('Error!', 'Please Enter Mobile No. !!!.', 'error');
		       $('#reg_mob').focus();
		       return false;
		     }
		 var reg_telephone = $('#reg_telephone').val();
		   if(reg_telephone&&(reg_telephone.toString().length > 20))
		     {

		       swal('Error!', 'Telephone Number Must Be Less Than 20 Digits !!!.', 'error');
		       $('#reg_telephone').focus();
		       return false;
		     }
		// var del_lin1 = $('#del_lin1').val();
		//    if(del_lin1 == "")
		//      {
		//        swal('Error!', 'Please Enter Address Line 1 !!!.', 'error');
		//        $('#del_lin1').focus();
		//        return false;
		//      }
		// var del_country = $('#del_country').val();
		//    if(del_country == "")
		//      {
		//        swal('Error!', 'Please Select Country !!!.', 'error');
		//        $('#del_country').focus();
		//        return false;
		//      }
		// var del_state = $('#del_state').val();
		//    if(del_state == "")
		//      {
		//        swal('Error!', 'Please Select State !!!.', 'error');
		//        $('#del_state').focus();
		//        return false;
		//      }
		// var del_city = $('#del_city').val();
		//    if(del_city == "")
		//      {
		//        swal('Error!', 'Please Enter City/Town !!!.', 'error');
		//        $('#del_city').focus();
		//        return false;
		//      }
		// var del_pin = $('#del_pin').val();
		//    if(del_pin == "")
		//      {
		//        swal('Error!', 'Please Enter Pin Code !!!.', 'error');
		//        $('#del_pin').focus();
		//        return false;
		//      }
		// var del_mob = $('#del_mob').val();
		//    if(del_mob == "")
		//      {
		//        swal('Error!', 'Please Enter Mobile No. !!!.', 'error');
		//        $('#del_mob').focus();
		//        return false;
		//      }
		//  var del_telephone = $('#del_telephone').val();
		//    if(del_telephone&&(del_telephone.toString().length > 20))
		//      {

		//        swal('Error!', 'Telephone Number Must Be Less Than 20 Digits !!!.', 'error');
		//        $('#del_telephone').focus();
		//        return false;
		//      }

		// var maxm_injection = $('#maxm_injection').val();
		//    if(maxm_injection = 2"")
		     
		//        swal('Error!', 'Please Enter Injection Quantum !!!.', 'error');
		//        $('#maxm_injection').focus();
		//        return false;
		//      }

		

		// var maxm_injection = $('#maxm_injection').val();
		
		//       if(maxm_injection.length > 10)
		//       {
		//         swal('Error!', 'Maximium Injection Quantum Should Not Be Greater Than 10 Digits  !!!.', 'error');
		//        $('#maxm_injection').focus();
		//         return false;
		//       }
		//      var maxm_withdrawal = $('#maxm_withdrawal').val();
		
		//       if(maxm_withdrawal.length > 10)
		//      {
		//        swal('Error!', 'Maximium Withdrawal Quantum Should Not Be Greater Than 10 Digits  !!!.', 'error');
		//        $('#maxm_withdrawal').focus();
		//        return false;
		//      }

		
		// var discom = $('#discom').val();
		//    if(discom == "")
		//      {
		//        swal('Error!', 'Please Enter DISCOM !!!.', 'error');
		//        $('#discom').focus();
		//        return false;
		//      }

		//    if(discom.length > 15)
		//      {
		//        swal('Error!', ' DISCOM  Lenght Should Be 15!!!.', 'error');
		//        $('#discom').focus();
		//        return false;
		//      }
		// var voltate_level = $('#voltate_level').val();
		//    if(voltate_level == "")
		//      {
		//        swal('Error!', 'Please  Select Voltage Level !!!.', 'error');
		//        $('#voltate_level').focus();
		//        return false;
		//      }
		// var state_type = $('#state_type').val();
		//    if(state_type == "")
		//      {
		//        swal('Error!', 'Please Select State Type !!!.', 'error');
		//        $('#state_type').focus();
		//        return false;
		//      }
		// var point_of_interconnection = $('#point_of_interconnection').val();
		//    if(point_of_interconnection == "")
		//      {
		//        swal('Error!', 'Please Select Point of Interconnection !!!.', 'error');
		//        $('#point_of_interconnection').focus();
		//        return false;
		//      }
		//  var power_trade_type = $('#power_trade_type').val();
		//    if(power_trade_type == "")
		//      {
		//        swal('Error!', 'Please Select Trade Type !!!.', 'error');
		//        $('#power_trade_type').focus();
		//        return false;
		//      }

		//    var iex_stat = $('#iex_status').val();
		//    if(iex_stat == "")
		//      {
		//        swal('Error!', 'Please Select IEX Status !!!.', 'error');
		//        $('#state_type').focus();
		//        return false;
		//      }
		//     var pxil_stat = $('#pxil_status').val();
		//    if(pxil_stat == "")
		//      {
		//        swal('Error!', 'Please Select PXIL Status !!!.', 'error');
		//        $('#state_type').focus();
		//        return false;
		//      }

		//  var name_of_sub_system = $('#name_of_sub_system').val();
		//    if(name_of_sub_system.length > 10)
		//      {
		//        swal('Error!', 'Sub System Should Not Be Greater Than 10 Words !!!.', 'error');
		//        $('#name_of_sub_system').focus();
		//        return false;
		//      }
	
		// var basic_status = $('#basic_status').val();
		//    if(basic_status == "")
		//      {
		//        swal('Error!', 'Please select basic status!!!.', 'error');
		//        $('#basic_status').focus();
		//        return false;
		//      }
});
  });