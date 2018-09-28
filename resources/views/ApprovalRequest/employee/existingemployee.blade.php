@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label"><u>EMPLOYEE DETAILS MODIFICATION REQUEST</u></label></h5>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
          <li><a href="#">APPROVE REQUEST</a></li>
          <li><a href="active">EMPLOYEE</a></li>
          <li><a href="active"><u>EXISTING</u></a></li>
      </ol>
</section>

    <!-- Main content -->
    <section class="content">
      @if(session()->has('updatemsg'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('updatemsg') }}
            </div>
          @endif
      <div class="row">
        <div class="col-xs-12">
          <div class="row">&nbsp;</div>
          <div class="row">
            <div class="col-md-2">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="SEARCH" id="search">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" name="go" id="go"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div>
            </div>
           <div class="col-md-6"></div>
            <div class="col-md-4 text-right">
                @if (count($employeeData) > 0)
            <form class="pull-right" action="{{ url()->to('exists-employee-approve/Approved') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

              <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
            </form>
            @endif

            @if (count($employeeData) > 0)
            <form class="pull-right" action="{{ url()->to('exists-employee-approve/Rejected') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>

              <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
            </form>
            @endif


                <div id="myModal" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModalRej" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>

        <div class="box">
          <div class="box-body">
      <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal1 deleteallbutton" name="select_all"></th>
        <th class="srno vl">SR.NO</th>
        <th  class="vl">EMPLOYEE NAME</th>
        <th  class="vl">USER NAME</th>
        <th  class="vl">FIELD NAME</th>
        <th  class="vl">UPDATED VALUE</th>
        <th  class="vl">CURRENT VALUE</th>
        <th class="act vl">ACTION</th>
      </tr>
      </thead>
      <tbody>

                            @if(count($employeeData)>0)

                            <?php $i=1; ?>
                            @foreach ($employeeData as $key => $value)
                            <tr>
                              <td><input type="checkbox" name="select_all" value="{{ $value->id }}" class="minimal1 @if($value->approve_status =='1' ||$value->approve_status =='2') @else deletedbutton @endif" @if($value->approve_status =='1' ||$value->approve_status =='2') disabled @endif></td>
                              <td><span class="">{{$i}}</span></td>
                              <td >{{ $value->user['name'] }} </td>
                              <td class="text-center">{{ $value->user['username'] }} </td>
                              <!-- <td class="text-center">{{ $value->official_id }}</td> -->
                              @if($keys[$value->keyname]!="Password")
                              <td class="text-center"><span class="hidden">{{$key = $value->keyname}}</span>
                              <?php echo isset($keys[$value->keyname])?$keys[$value->keyname]:$value->keyname; ?>
                              </td>

                              @if(in_array($value->value,$state_data))
                                 <?php
                                 $state_list = \App\Common\StateList::get_states();
                                 ?>
                                 @foreach($state_list as $state_code=>$state_ar)
                                   @if($state_code==$value->value)
                                   <td class="text-center">{{ $state_ar['name'] }}</td>
                                  @endif
                                 @endforeach
                               @else
                                 <td class="text-center">{{ $value->value }}</td>
                               @endif
                              
                              @else
                              <td class="text-center"><span class="hidden">{{$key = $value->keyname}}</span>
                              <?php echo isset($keys[$value->keyname])?$keys[$value->keyname]:$value->keyname; ?>
                              </td>

                              <td class="text-center">**{{ base64_encode($value->value)}}****</td>
                              @endif

                              <td class="text-center">-</td>
                              @if($value->approve_status =='0')
                              <td class="text-center">
                                <span class="">
                                  <a href="employee/approve/{{ $value->id }}"><button type="button" class="btn btn-raised btn-info btn-xs">APPROVE</button></a>
                                </span>

                                <span class="">
                                  <a href="/employee/reject/{{ $value->id }}"><button type="button" class="btn btn-raised btn-danger btn-xs">REJECT</button></a>
                                </span>
                              </td>
                              @elseif($value->approve_status =='1')
                              <td class="text-center">
                                  <span class="text-primary">APPROVED</span>
                                </td>
                                @elseif($value->approve_status =='2')
                              <td class="text-center">
                                  <span class="text-danger">REJECTED</span>
                                </td>
                              @endif
                            </tr>
                            <?php
                              $i++;
                            ?>
                              @endforeach
                                       @else
                                       <tr class="alert-danger" ><th colspan='9'>No Data Found.</th></tr>
                                       @endif
      </tbody>
      </table>

  <!-- /.box-body -->
</div>
</div>
</div>
    </section>


    @endsection
@section('content_foot')

  <script>
    $(function () {
        $('input[type="checkbox"].minimal1, input[type="radio"].minimal1').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
      });

    });

    </script>
    <script type="text/javascript">
            $('.deletedbutton').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
            $('.deletedbutton').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
      $(document).delegate('#delete-button-modal','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rej','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rej").trigger('click');
         return false;
      }
      });

            $(".deleteallbutton").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbutton").iCheck('check');
                    var array = [];
                    $('.deletedbutton').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_status').val(array);
                  }else{
                      $('.selected_status').val('');
                    $(".deletedbutton").iCheck('uncheck');
                  }
            });
            $('.deleteallbutton').on('ifUnchecked', function(event) {
                $('.selected_status').val('');
                $(".deletedbutton").iCheck('uncheck');
            });

    </script>


 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>

  <script>
    $("#search").keyup(function () {
        var value = this.value.toLowerCase().trim();

        $("table tr").each(function (index) {
            if (!index) return;
            $(this).find("td").each(function () {
                var id = $(this).text().toLowerCase().trim();
                var not_found = (id.indexOf(value) == -1);
                $(this).closest('tr').toggle(!not_found);
                return not_found;
            });
        });
    });
  </script>
@endsection
