@extends('theme.layouts.default')
@section('content')
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h5>
               <label  class="control-label"><u>ACCOUNT GROUP SETTING</u></label>

            </h5>
            <ol class="breadcrumb">
               <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
                <li><a href="/basicdetails">MANAGE CLIENT</a></li>
               <li class="#"><u>ACCOUNT GROUP SETTING</u></li>
            </ol>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="row">
               <div class="col-xs-12">
                    <div class="box">
                     <div class="box-body">
                        <div class="row addvalidationsetting hidden">
                           <div class="col-md-12">
                               <select class="form-control selectpicker" name="client_id" id="select-client" data-live-search="true">
                                 <option value="">Search Client</option>
                                  @foreach($Clientsdetails as $aa)
                                      @if(!in_array($aa['id'],$role_off) )
                                 <option value="<?php echo $aa['id']; ?>" data-tokens="<?php echo $aa['company_name'].$aa['crn_no']. $aa['short_id']. $aa['iex_portfolio']. $aa['pxil_portfolio'] ?>" @if(isset($client_id) && $aa['id'] == $client_id) selected @endif> <?php echo $aa['company_name'].'  '.'['.$aa['short_id'].']'.'['.$aa['crn_no'].']'.' '.'['.$aa['iex_portfolio'].']'.'['.$aa['pxil_portfolio'].']'; ?></option>
                                      @endif

                                 @endforeach
                               </select>




                           </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                          <div class="col-md-2">
                             <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="SEARCH" id="search">
                                <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="vg8" name="vg8"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                             </div>
                          </div>
                           <div class="col-md-1 pull-right">
                              <button type="button" class="btn btn-xs btn-info pull-right addvalidationsettingbtn"><span class="glyphicon glyphicon-plus"> </span> Add Group</button>
                           </div>
                        </div>
                        <div class="panel panel-default" id='checksearch'>
                           <div class="panel-body">
                            @if(count($Groupuserdetails)>0)
                            @foreach($Groupuserdetails as $groupdata)
                              <div class="panel panel-default contact-name">
                                 <div class="panel-body">
                                    <div class="panel panel-default">
                                       <div class="panel-body">
                                          <div class="row">
                                             <div class="col-md-3"><span class="glyphicon glyphicon-menu-hamburger"></span><span class="bold">&nbsp&nbsp {{$groupdata['group_name']}}</span></div>
                                             <div class="col-md-7"></div>
                                             <button type="button" class="btn btn-raised btn-info btn-xs" data-toggle="modal"  data-target="#myModal{{$groupdata['client_id']}}"> <span class="glyphicon glyphicon-plus"> </span> Add User</button>
                                             <div class="col-md-1"><button type="button" class="btn btn-raised btn-danger btn-xs deletegroup"  value="{{$groupdata['client_id']}}">DELETE</button></div>
                                          </div>
                                       </div>
                                    </div>
                                    @foreach($Clientsdetails as $Clientdata)
                                  @if($Clientdata['group_id'] == $groupdata['client_id'] && $Clientdata['group_role'] == 'Member')
                                    <div class="row">
                                       <div class="col-md-1"></div>
                                       <div class="col-md-10">
                                          <div class="well well-sm" style="border-radius:20px;height:35px;">
                                             <span class="pull-left"> {{$Clientdata['company_name']}}</span>
                                             <a href="{{url('deletenewuser_usegroupsetting')}}/{{$Clientdata['id']}}"><span class="pull-right glyphicon glyphicon-trash"></span></a>
                                          </div>
                                       </div>
                                       <div class="col-md-1"></div>
                                    </div>
                                    @endif
                                @endforeach
                                <div id="myModal{{$groupdata['client_id']}}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><center>Search New Client For {{$groupdata['group_name']}} Group</center></h4>
                                      </div>
                                      <div class="modal-body">
                                  <form method="post" action="">
                                      {{ csrf_field() }}

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="mda-form-group float-label rel-wrapper">
                                            <div class="mda-form-control bb0">
                                              <input type="hidden" name="group_id" class="group_id" value="{{ $groupdata['client_id']}}">
                                      <input type="hidden" name="group_name" class="group_name" value="{{ $groupdata['group_name']}}">
                                             <select class="form-control selectpicker select-client-modal"
                                             name="client_id"
                                              data-live-search="true">
                                               <option value="">Search Client</option>
                                                @foreach ($Clientsdetails as $aa)
                                                  @if($aa['id']!= $groupdata['client_id'] &&
                                                  $aa['group_id']!= $groupdata['client_id'])
                                               <option value="<?php echo $aa['id']; ?>" data-tokens="<?php echo $aa['company_name']; ?>" @if(isset($client_id) && $aa['id'] == $client_id) selected @endif> [{{$aa['company_name']}}] [{{$aa['crn_no']}}] [{{$aa['iex_portfolio']}}] [{{$aa['pxil_portfolio']}}]</option>
                                               @endif
                                               @endforeach
                                             </select>
                                            </div>
                                         </div>
                                      </div>
                                    </div>
                                  </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                                 </div>
                              </div>
                              @endforeach
                              @else
                                <div class="row">
                                    <div class="col-md-12 alert-danger" >
                                      <h5 align="center">No record Found.</h5>
                                    </div>
                                </div>
                              @endif
                              <div></div>
                           </div>
                        </div>
                     </div>
                  </div>
         </section>
         <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".addnewuser").click(function(){
          $(".addnewuser").addClass("hidden");
          $(".searchuser").removeClass("hidden").css('margin-right','10px');
      });
      $(".addnewuser1").click(function(){
          $(".addnewuser1").addClass("hidden");
          $(".searchuser1").removeClass("hidden").css('margin-right','10px');
      });
      $(".addnewuser2").click(function(){
          $(".addnewuser2").addClass("hidden");
          $(".searchuser2").removeClass("hidden").css('margin-right','10px');
      });
      // -------------
      $(".addvalidationsettingbtn").click(function(){
        $(".addvalidationsetting").removeClass("hidden");
        $(".addvalidationsettingbtn").hide();
      })
    });
  </script>
  <script type="text/javascript">
      $('#select-client').on('click', function(e) {
        e.preventDefault();
        if($('#select-client').val()=='')
          {
            return false;
          }
        var href_to_hit = $(this).closest('a').prop('href');
        swal({
            title: 'Are you sure?',
            text: 'You want to create a new group!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, create it!',
            closeOnConfirm: false
          },
          function(isConfirm) {
            if(isConfirm){
              swal('Created!', 'Your New Group has been created.', 'success');
              location.reload();
              var clientid = $("#select-client").val();
            $.ajax({
                   type:'POST',
                   url:'/creategroup',
                   data:{clientid:clientid,'_token':'{{ csrf_token() }}'},
                   success:function(data){
                      window.location.href=data;
                   }
                  });
            }
            else{
                swal("Cancelled", "Your New Group is Cancelled", "error");
                location.reload();
            }
          });
      });
  </script>
  <!-- Delete Group -->
      <script type="text/javascript">
      $('.deletegroup').on('click', function(e) {
        e.preventDefault();
        var group_id = $(this).val();
        var href_to_hit = $(this).closest('a').prop('href');
        swal({
            title: 'Are you sure?',
            text: 'You want to delete a group!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete it!',
            closeOnConfirm: false
          },
          function(isConfirm) {
            if(isConfirm){
              //location.reload();
              //var group_id = $("#select-client").val();
            $.ajax({
                   type:'GET',
                   url:'/deletegroup',
                   data:{group_id:group_id,'_token':'{{ csrf_token() }}'},
                   success:function(data){
                              if(data == 0)
                              {
                                  swal('Sorry!', 'Group can not be deleted. Before that make sure all users are deleted or not respectively this group.', 'error');
                                  setTimeout(function() {
                                    window.location.href='usergroupsetting';
                                    }, 5000);
                              }
                              else
                              {
                                swal('Deleted!', 'Your Group has been deleted.', 'success');
                                location.reload();
                              }
                   }
                  });
            }
            else{
                swal("Cancelled", "Your Group is Cancelled", "error");
                location.reload();
            }
          });
      });
  </script>
  <!-- End Delete Group -->
  <!-- modal search -->
    <script type="text/javascript">
      $('.select-client-modal').on('change', function(e) {
        e.preventDefault();
        var group_id = $(this).parent().find('.group_id').val();
        var group_name = $(this).parent().find('.group_name').val();
        //alert(group_id+"------"+group_name);
        var clientid = $(this).val();
        var href_to_hit = $(this).closest('a').prop('href');
        swal({
            title: 'Are you sure?',
            text: 'You want to create a new user!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, create it!',
            closeOnConfirm: false
          },
          function(isConfirm) {
            if(isConfirm){
              swal('Created!', 'Your New User has been created.', 'success');
              location.reload();
            $.ajax({
                   type:'POST',
                   url:'/addnewusersforgroup',
                   data:{clientid:clientid,group_id:group_id,group_name:group_name,'_token':'{{ csrf_token() }}'},
                   success:function(data){
                              window.location.href=data;
                   }
                  });
            }
            else{
                swal("Cancelled", "Your New User is Cancelled", "error");
                location.reload();
            }
          });
      });
  </script>
  <!-- end modal search -->
  <script type="text/javascript">
      $('.remove-department-detail').on('click', function(e) {
        e.preventDefault();
        var href_to_hit = $(this).closest('a').prop('href');
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
          },
          function() {
              // console.log(href_to_hit);
              $.get(href_to_hit).done(function(){
                swal('Deleted!', 'Your Data has been deleted.', 'success');
                $(e.currentTarget).closest('tr').remove();
              }).fail(function(){
                swal('Failed!', 'Opps! Your Data has not been deleted at this instance of time.', 'warning');
              });
          });
      });
  </script>
  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);
  </script>
  <script type="text/javascript">
       setTimeout(function() {
         $('#successMessage1').fadeOut('fast');
         }, 2000); // <-
     </script>

  <script type="text/javascript">
       setTimeout(function() {
         $('#deleteuserMessage1').fadeOut('fast');
         }, 2000); // <-
     </script>
  <script>
    $("#search").keyup(function () {
        var query = $(this).val().toLowerCase();
        $('div.contact-name .bold').each(function(){
             var $this = $(this);
             if($this.text().toLowerCase().indexOf(query) === -1)
                 $this.closest('div.contact-name').fadeOut();
            else $this.closest('div.contact-name').fadeIn();
        });
    });
  </script>
<script type="text/javascript">
//     $(document).ready(function() {
//    $('#select-client').select2();
// });
</script>
    @endsection
