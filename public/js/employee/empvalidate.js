$(document).ready(function() {
  $(document).on('click', '#save_officials,#update_officials', function(event) {

//alert(1);
    // validation start
    
    var name = $('#name').val();

       if(name == "")
         {
           swal('Error!', 'Please Enter  Name !!!.', 'error');
           $('#name').focus();
           return false;
         }
    var email = $('#email').val();
       if(email == "")
         {
           swal('Error!', 'Please Enter Email !!!.', 'error');
           $('#email').focus();
           return false;
         }
    var contact_number = $('#contact_number').val();
       if(contact_number == "")
         {
           swal('Error!', 'Please Enter contact No. !!!.', 'error');
           $('#contact_number').focus();
           return false;
         }
    var username = $('#username').val();
       if(username == "")
         {
           swal('Error!', 'Please Enter User Name !!!.', 'error');
           $('#username').focus();
           return false;
         }
    var password = $('#password').val();
       if(password == "")
         {
           swal('Error!', 'Please Enter Password !!!.', 'error');
           $('#password').focus();
           return false;
         }
    var confirmed = $('#confirmed').val();
       if(confirmed == "")
         {
           swal('Error!', 'Please Enter Confirm Password !!!.', 'error');
           $('#confirmed').focus();
           return false;
         }
    if(password!= confirmed){
       swal('Error!', 'Please Enter Same Password !!!.', 'error');
           $('#confirmed').focus();
           return false;
    }
    var designation = $('#designation').val();
       if(designation == "")
         {
           swal('Error!', 'Please Enter Designation !!!.', 'error');
           $('#designation').focus();
           return false;
         }
    // var role_id = $('#role_id').val();
    //    if(role_id == "")
    //      {
    //        swal('Error!', 'Please Select Role !!!.', 'error');
    //        $('#role_id').focus();
    //        return false;
    //      }
    var department_id = $('#department_id').val();
       if(department_id == "")
         {
           swal('Error!', 'Please Select Department !!!.', 'error');
           $('#department_id').focus();
           return false;
         }
    var line1 = $('#line1').val();
       if(line1 == "")
         {
           swal('Error!', 'Please Enter Address Line 1 !!!.', 'error');
           $('#line1').focus();
           return false;
         }
    var country = $('#country').val();
       if(country == "")
         {
           swal('Error!', 'Please Select Country !!!.', 'error');
           $('#country').focus();
           return false;
         }
    var state = $('#state').val();
       if(state == "")
         {
           swal('Error!', 'Please Select State !!!.', 'error');
           $('#state').focus();
           return false;
         }
    var city = $('#city').val();
       if(city == "")
         {
           swal('Error!', 'Please Enter City !!!.', 'error');
           $('#city').focus();
           return false;
         }
    var pin_code = $('#pin_code').val();
       if(pin_code == "" )
         {
           swal('Error!', 'Please Enter Pin Code !!!.', 'error');
           $('#pin_code').focus();
           return false;
         }
  var pin_code = $('#pin_code').val();
         if(pin_code.length!= 6)
         {
           swal('Error!', 'Please Enter 6 digit Pin Code !!!.', 'error');
           $('#pin_code').focus();
           return false;
         }
    // validation end
    });
  });
// code for check all for approver
  $('.approver_check').on('change', function() {
    $('.approver').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".approver",function() {
    if($('.approver:checked').length == $('.approver').length){
      $('.approver_check').prop('checked',true);
    }else{
      $('.approver_check').prop('checked',false);
    }
  });
// code for check all for checker
  $('.checker_check').on('change', function() {
    $('.checker').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".checker",function() {
    if($('.checker:checked').length == $('.checker').length){
      $('.checker_check').prop('checked',true);
    }else{
      $('.checker_check').prop('checked',false);
    }
  });
// code for check all for delete
  $('.delete_check').on('change', function() {
    $('.delete').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".delete",function() {
    if($('.delete:checked').length == $('.delete').length){
      $('.delete_check').prop('checked',true);
    }else{
      $('.delete_check').prop('checked',false);
    }
  });
// code for check all for edit
  $('.edit_check').on('change', function() {
    $('.edit').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".edit",function() {
    if($('.edit:checked').length == $('.edit').length){
      $('.edit_check').prop('checked',true);
    }else{
      $('.edit_check').prop('checked',false);
    }
  });
// code for check all for view
  $('.view_check').on('change', function() {
    $('.view').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".view",function() {
    if($('.view:checked').length == $('.view').length){
      $('.view_check').prop('checked',true);
    }else{
      $('.view_check').prop('checked',false);
    }
  });
// code for check all for add
  $('.add_check').on('change', function() {
    $('.add').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".add",function() {
    if($('.add:checked').length == $('.add').length){
      $('.add_check').prop('checked',true);
    }else{
      $('.add_check').prop('checked',false);
    }
  });
// code for check all by admin
  $('#select_all').on('change', function() {
    $('.admin_check').prop('checked', $(this).prop("checked"));
  });
  $(document).on("click",".admin_check",function() {
    if($('.admin_check:checked').length == $('.admin_check').length){
      $('#select_all').prop('checked',true);
    }else{
      $('#select_all').prop('checked',false);
    }
  });

