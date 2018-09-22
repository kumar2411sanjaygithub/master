@extends('theme.layouts.default')
@section('content')
        <section class="content-header">
               <h5><label  class="control-label"><u>APPROVE BASIC  DETAILS</u></label></h5>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="#">APPROVE REQUEST</a></li>
                  <li><a href="active">CLIENT</a></li>
                  <li><a href="active"><u>EXISTING</u></a></li>
               </ol>
            </section>

            <section class="content">
               @if (\Session::has('success'))
            <div class="alert alert-success mt10" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! \Session::get('success') !!}
            </div>
            @endif
               <div class="row">
                  <div class="col-xs-12">

                           <div class="box">
                              <div class="box-body">
                                 <div class="row">

                                    <div class="col-md-12">

                                    @if (count($clientData) > 0)
                                    <form class="pull-right" action="{{ url()->to('multiple-approve/Approved') }}" method="post" id="approve_data">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="selected_status" class="selected_status">
                                      <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

                                      <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                                    </form>
                                    @endif

                                    @if (count($clientData) > 0)
                                    <form class="pull-right" action="{{ url()->to('multiple-approve/Rejected') }}" method="post" id="approve_data">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="selected_status" class="selected_status">
                                      <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>

                                      <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                                    </form>
                                    @endif
                                  </div>
                                  <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                                        <div id="myModal" class="modal fade" style="display: none;">
                                          <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                              <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                                <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                              </div>
                                              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                                <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? IF CHOOSE YES, THEN THIS PROCESS CANNOT BE UNDONE.</p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" href="#"   class="btn btn-danger">
                                                  <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                                                </button>
                                                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div id="myModalRej" class="modal fade" style="display: none;">
                                          <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                              <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                                <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                              </div>
                                              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                                <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? IF CHOOSE YES, THEN THIS PROCESS CANNOT BE UNDONE.</p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" href="#"   class="btn btn-danger">
                                                  <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                                                </button>
                                                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>

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

                                              @isset($clientData)
                                          <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                                          @foreach ($clientData as $key => $value)
                                          <tr>


                                                <td style="padding:5px!important;"><input type="checkbox" class="minimal1 vl deletedbutton" value="{{ $value->id }}" name="select_all"></td>

                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $input_lebels[$value->attribute_name]}}</td>
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

                                             <td class="vl"><a href="/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @endisset


                                       </tbody>
                                    </table>
                                 </div>
                              </div>


                     </div>
                  </div>
               </div>
            </section>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
            $('.deletedbutton').click(function(){
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

            $(".deleteallbutton").click(function(){
                  if($(this).prop('checked')){
                    $(".deletedbutton").prop("checked",true);
                    var array = [];
                    $('.deletedbutton').each(function(){
                      if($(this).prop('checked')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_status').val(array);
                  }else{
                      $('.selected_status').val('');
                    $(".deletedbutton").prop("checked",false);
                  }
            });
    </script>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
             <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
  <script>
    $(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
      })

    });

    </script>
   @endsection
