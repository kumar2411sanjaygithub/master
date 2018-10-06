@extends('theme.layouts.default')
@section('content')

<style type="text/css">
  .uc{
text-transform : uppercase

}
</style>
     <section class="content-header">
      <div class="col-md-7">
          <h5 class="pull-left"><label  class="control-label pull-right mt-1"><u>APPROVE BASIC DETAILS</u></h5>&nbsp;&nbsp;&nbsp; {{$client_details[0]['company_name']}}<span class="hifan">|</span> {{$client_details[0]['crn_no']}} <span class="hifan">|</span> {{$client_details[0]['iex_portfolio']}}<span class="hifan">|</span> {{$client_details[0]['pxil_portfolio']}}</label>
        </div>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="/client/new">APPROVE REQUEST</a></li>
                  <li><a href="/client/existing">CLIENT</a></li>
                  <li><a href="/client/existing">EXISTING</a></li>
                  <li class="#"><u>BASIC DETAILS</u></li>
               </ol>
    </section>
            <section class="content">
                 @if (\Session::has('success'))
                 <div class="alert alert-success alert-dismissible fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <span class="glyphicon glyphicon-ok"></span> &nbsp;{!! \Session::get('success') !!}
                </div>
                @endif
              <div class="row">
                <div class="col-xs-12">
                  <div class="row">
                  <div class="col-md-6"></div>
                    <div class="col-md-6 pull-right">
                       <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right "><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                    </div>
                </div>
                <div class="box">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pull-right">
                            @if (count($clientData) > 0)
                             <form class="pull-right" action="{{ url()->to('multiple-approve/Rejected') }}" method="post" id="approve_data">
                               {{ csrf_field() }}
                              <input type="hidden" name="selected_status" class="selected_status">
                              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>
                              <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs">REJECT ALL</a>
                          </form>
                        @endif
                    &nbsp;
                           @if (count($clientData) > 0)
                              <form class="pull-left" action="{{ url()->to('multiple-approve/Approved') }}" method="post" id="approve_data">
                                {{ csrf_field() }}
                                <input type="hidden" name="selected_status" class="selected_status">
                                <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

                                <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                              </form>
                           @endif
                       </div>
                    </div>
                      <div id="myModal" class="modal fade" style="display: none;">
                        <div class="modal-dialog modal-confirm model-xs">
                          <div class="modal-content">
                              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS?</p></center>
                              </div>
                              <div class="modal-footer" >
                                 <div class="text-center">
                                 <button type="button" href="#"   class="btn btn-xs  btn-info">
                                  <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="myModalRej" class="modal fade" style="display: none;">
                      <div class="modal-dialog modal-confirm">
                        <div class="modal-content">                 
                          <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                            <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS?</p></center>
                          </div>
                          <div class="modal-footer">
                            <div class="text-center">
                            <button type="button" href="#"   class="btn btn-info btn-xs">
                              <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
                <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                      <tr>
                         <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbutton" name="select_all"></th>
                         <th class="srno vl">SR.NO</th>
                         <th class="vl">FIELD NAME</th>
                         <th class="vl">CURRENT VALUE</th>
                         <th class="vl">UPDATED VALUE</th>
                         <th class="act vl">ACTION</th>
                      </tr>
                 </thead>
                 <tbody>                            
                    <?php
                   
                     $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                    ?>
                    @forelse ($clientData as $key => $value)
                    <tr>
                        <td style="padding:5px!important;"><input type="checkbox" class="minimal1 vl deletedbutton" value="{{ $value->id }}" name="select_all"></td>
                        <td class="text-center vl">{{ $key+$clientData->firstItem() }}</td>
                        <td class="text-center vl uc">{{ $input_lebels[$value->attribute_name]}}</td>
                        <td class="text-center vl">
                        @if(in_array($value->old_att_value,$state_data))
                          <?php
                          $state_list = \App\Common\StateList::get_states();
                          ?>
                          @foreach($state_list as $state_code=>$state_ar)
                            @if($state_code==$value->old_att_value)
                              {{$state_ar['name']}}
                           @endif
                          @endforeach
                        @else
                          {{ $value->old_att_value }}
                        @endif
                      </td>
                       <td class="text-center vl">
                        @if(in_array($value->updated_attribute_value,$state_data))
                          <?php
                          $state_list = \App\Common\StateList::get_states();
                          ?>
                          @foreach($state_list as $state_code=>$state_ar)
                            @if($state_code==$value->updated_attribute_value)
                              {{$state_ar['name']}}
                           @endif
                          @endforeach
                        @else
                          {{ $value->updated_attribute_value }}
                        @endif

                     <td class="vl"><a href="/modified/{{ $value->id }}/approved"><span  class="text-success glyphicon glyphicon-ok" name="cd0" id="cd0"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/modified/{{ $value->id }}/rejected"><span  class="text-danger glyphicon glyphicon-remove" name="cd0" id="cd0"></span></a></td>
                                          </tr> 
                  @empty
                  <tr class="alert-danger" ><th colspan='6'>No Data Found.</th></tr>
                  @endforelse
                </tbody>
            </table>
            <div class=" col-md-12">
                <div class="col-md-6"><br>
                Total Records: {{ $clientData->total() }}
                </div>
                   <div class="col-md-6">
                      <div class=" pull-right">{{$clientData->links()}}</div>
                        </div>
                        </div>
                      </div>
                       </div>
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
@endsection
