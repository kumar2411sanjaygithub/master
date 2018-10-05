@extends('theme.layouts.default')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
    <label  class="control-label"><u>DISCOM</u> <u>&</u> <u>SLDC</u> <u>LIST OF STATE</u></label>
     </h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">TRADER'S SETTING</a></li>
        <li><a href="{{route('discom-sldc-state.index')}}"><u>DISCOM</u> <u>&</u> <u>SLDC</u></a></li>
      </ol>
    </section>
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <form method="post" action="{{ isset($get_state_discom)?url('/discom-sldc-state/'.$get_state_discom->id):route('discom-sldc-state.store')}}">
              {{csrf_field()}}
               {{ (@$get_state_discom->id!='')?method_field('PATCH'):method_field('POST')}}
              <div class="row">
                  <div class="col-md-2 {{ $errors->has('state') ? 'has-error' : '' }}">
                    <label  class="control-label">STATE</label>
                    <select class="form-control input-sm" style="width: 100%;" id="state" name="state" {{isset($get_state_discom)?"disabled='disabled'":''}}>
                        <option value="">SELECT STATE</option>
                         <?php
                          $state_list = \App\Common\StateList::get_states();
                              ?>
                        @foreach($state_list as $state_code=>$state_ar)
                          @if(isset($inset_stateDiscom)&&!in_array($state_code,@$inset_stateDiscom) || isset($get_state_discom))
                            <option value="{{$state_code}}" {{ isset($get_state_discom) && $get_state_discom->state == $state_code || old('state')==  $state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                          @endif
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                </div>
              <div class="col-md-3">
                 <div class="col-sm-12 col-md-12" id='TextBoxesGroup2'>
                   <div id="TextBoxDiv2">
                      <label  class="control-label">SLDC</label>
                      <input class="form-control input-sm" type="text" placeholder="ENTER SLDC 1" id="textbox2" name="sldc[]">
                </div>
                 <button type="button" class="btn btn-info btn-xs" id="addButton2" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-plus pointer" ></i></button>
               </div>
                @php
                  @$get_sldc=json_decode(@$get_state_discom->sldc);
                  if(@$get_sldc)
                  {
                  foreach($get_sldc as $sldc_datas)
                  {
                    foreach($sldc_datas as $sk=>$sldc_data)
                    {
                      if($sldc_data!='')
                      {
                @endphp
                     <div class="col-sm-12 col-md-12" id=>
                       <div id="">
                          <input class="form-control input-sm" type="text" placeholder="ENTER SLDC 1" name="sldc[]" value="{{$sldc_data}}">
                    </div>
                     <a href="{{url('discom-sldc-state/delsldc/'.$get_state_discom->id.'/e_del/'.$sk)}}" class="btn btn-danger btn-xs" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-minus pointer" ></i></a>
                   </div>
              @php
                      }
                    }
                  }
                }
              @endphp
              <div class="col-sm-12 col-md-12" id='TextBoxesGroup22'>
              </div>
            </div>
              <div class="col-md-3">
                 <div class="col-md-12" id='TextBoxesGroup'>
                   <div id="TextBoxDiv1">
                      <label  class="control-label">DISCOM</label>
                      <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM 1" id="textbox1" name="discom[]">
                </div>
                 <button type="button" class="btn btn-info btn-xs" id="addButton" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-plus pointer" ></i></button>
               </div>
                @php
                  @$get_discom=json_decode($get_state_discom->discom);
                  if(@$get_discom)
                  {
                  foreach($get_discom as $discom_datas)
                  {
                    foreach($discom_datas as $dk=>$discom_data)
                    {
                      if($discom_data!='')
                      {
                @endphp
                     <div class="col-sm-12 col-md-12" id=>
                       <div id="">
                          <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM 1" name="discom[]" value="{{$discom_data}}">
                    </div>
                     <a href="{{url('discom-sldc-state/deldiscom/'.$get_state_discom->id.'/e_del/'.$dk)}}" class="btn btn-danger btn-xs" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-minus pointer" ></i></a>
                   </div>
              @php
                      }
                    }
                  }
                }
              @endphp
              <div class="col-md-12" id='TextBoxesGroup11'>
              </div>
            </div>

              <div class="col-md-3">
                 <div class="col-md-12" id='TextBoxesGroup3'>
                   <div id="TextBoxDiv3">
                      <label  class="control-label">VOLTAGE</label>
                      <input class="form-control input-sm" type="text" placeholder="ENTER VOLTAGE 1" id="textbox3" name="voltage[]">
                </div>
                 <button type="button" class="btn btn-info btn-xs" id="addButton3" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-plus pointer" ></i></button>
               </div>
                @php
                  @$get_voltage=json_decode(@$get_state_discom->voltage);
                  if(@$get_voltage)
                  {
                  foreach($get_voltage as $voltage_datas)
                  {
                    foreach($voltage_datas as $vk=>$voltage_data)
                    {
                      if($voltage_data!='')
                      {
                @endphp
                     <div class="col-sm-12 col-md-12" id=>
                       <div id="">
                          <input class="form-control input-sm" type="text" placeholder="ENTER VOLTAGE 1" name="voltage[]" value="{{$voltage_data}}">
                    </div>
                     <a href="{{url('discom-sldc-state/delvoltage/'.$get_state_discom->id.'/e_del/'.$vk)}}" class="btn btn-danger btn-xs" style="margin-left:103%;margin-top:-50px;"><i class="glyphicon glyphicon-minus pointer" ></i></a>
                   </div>
              @php
                      }
                    }
                  }
                }
              @endphp
              <div class="col-md-12" id='TextBoxesGroup33'>
              </div>
            </div>

            </div>

              <div class="row">
                 <div class="col-md-10"></div>
                 @if(isset($get_state_discom))
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">UPDATE</button></div>
                  @else
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs">SAVE</button></div>
                  @endif
                  <div class="col-md-1"><button type="reset" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>

              </div>
          </form>
        </div>
      </div>
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                  <th class="srno">SR.NO</th>
                  <th>STATE</th>
                  <th>SLDC</th>
                  <th>DISCOM</th>
                  <th>VOLTAGE</th>
                  <th class="act1">ACTION</th>
                </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @if (count($stateDiscomData) > 0)
                     @foreach ($stateDiscomData as $k=>$stateDiscom)
                      <tr>
                        <td>{{$i}}</td>
                        <td>
                        @php
                          $state_list = \App\Common\StateList::get_states();
                        @endphp
                        @foreach($state_list as $state_code=>$state_ar)
                          @if($state_code==$stateDiscom->state)
                            {{$state_ar['name']}}
                          @endif
                        @endforeach
                        </td>
                        <td>
                          @php
                            $sldc_arr=json_decode($stateDiscom->sldc,TRUE);
                            $last_sldc_Element = end($sldc_arr);

                            foreach($sldc_arr as $sldc_datas)
                            {
                              foreach($sldc_datas as $sk=>$sldc_data)
                              {
                                if($sk!=key($last_sldc_Element))
                                {
                                  echo $sldc_data.',&nbsp;';
                                }
                                else
                                {
                                  echo $sldc_data;
                                }
                              }
                            }
                          @endphp
                        </td>
                        <td>
                          @php
                            $discom_arr=json_decode($stateDiscom->discom,TRUE);
                            $last_discom_Element = end($discom_arr);
                            foreach($discom_arr as $discom_datas)
                            {
                              foreach($discom_datas as $dk=>$discom_data)
                              {
                                if($dk!=key($last_discom_Element))
                                {
                                  echo $discom_data.',&nbsp;';
                                }
                                else
                                {
                                  echo $discom_data;
                                }
                              }
                            }
                          @endphp
                        </td>
                        <td>
                          @php
                            $voltage_arr=json_decode($stateDiscom->voltage,TRUE);
                            $lastElement = end($voltage_arr);
                            foreach($voltage_arr as $voltage_datas)
                            {
                              foreach($voltage_datas as $vk=>$voltage_data)
                              {
                                if($vk!=key($lastElement))
                                {
                                  echo $voltage_data.',&nbsp;';
                                }
                                else
                                {
                                  echo $voltage_data;
                                }
                              }
                            }
                          @endphp
                        </td>
                       <td>
                        <a href="{{ route('discom-sldc-state.edit',[$stateDiscom->id]) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" data-toggle="modal" data-target="#deleteData{{ $stateDiscom->id }}"><span class="glyphicon glyphicon-trash text-danger" ></span></a>

                       </td>
                      <div id="deleteData{{ $stateDiscom
                     ->id }}" class="modal fade" role="dialog">
                         <form method="POST"  action="{{url('discom-sldc-state/'.$stateDiscom->id)}}">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                         <div class="modal-dialog modal-confirm">
                           <div class="modal-content">
                             <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                               <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                             </div> -->
                             <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                               <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO DELETE THESE RECORDS?</p></center>
                             </div>
                             <div class="modal-footer">
                              <div class="text-center">
                               <button type="submit" class="btn btn-info btn-xs">YES</button>
                               <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
                             </div>
                             </div>
                           </div>
                         </div>
                         </form>
                       </div>
                      </tr>
                        @php $i++; @endphp
                    @endforeach
                  @else
                    <tr>
                        <td colspan="6" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                </tbody>
                </table>
                 <div class="row">
                   <div class="col-md-6"><br>
                     Total Records: {{ $stateDiscomData->total() }}
                   </div>
                   <div class="col-md-6">
                     <div class="pull-right"> {{ $stateDiscomData->links() }}</div>
                   </div>
                 </div>


            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>
    </section>
    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">

  var a=2;var b=2;var c=2;
  $(document).delegate("#addButton","click",function(){
  $("#TextBoxesGroup11").append('<div class=" extra-discom-container"><input type="text" class="form-control input-sm" placeholder="ENTER DISCOM '+a+'" id="fx'+a+'" name="discom[]" value="" autocomplete="nope"><span class=""><i class="glyphicon glyphicon-minus pointer btn btn-danger btn-xs" id="discom-subtract" style="margin-left:103%;margin-top:-50px;"></i></span></div>');
  $('#fx'+a).focus();
  count_row();
  a+=1;
});

function count_row(){
  $i=1;
}

$(document).delegate("#discom-subtract","click",function(){
  $(this).closest(".extra-discom-container").remove();
});

  $(document).delegate("#addButton2","click",function(){
  $("#TextBoxesGroup22").append('<div class=" extra-sldc-container"><input type="text" class="form-control input-sm" placeholder="ENTER SLDC '+b+'" id="fx1'+b+'" name="sldc[]" value="" autocomplete="nope"><span class=""><i class="glyphicon glyphicon-minus pointer btn btn-danger btn-xs" id="sldc-subtract" style="margin-left:103%;margin-top:-50px;"></i></span></div>');
  $('#fx1'+b).focus();
  count_row();
  b+=1;
});

function count_row(){
  $i=1;
}

$(document).delegate("#sldc-subtract","click",function(){
  $(this).closest(".extra-sldc-container").remove();
});

  $(document).delegate("#addButton3","click",function(){
  $("#TextBoxesGroup33").append('<div class=" extra-voltage-container"><input type="text" class="form-control input-sm" placeholder="ENTER VOLTAGE '+c+'" id="fx2'+c+'" name="voltage[]" value="" autocomplete="nope"><span class=""><i class="glyphicon glyphicon-minus pointer btn btn-danger btn-xs" id="voltage-subtract" style="margin-left:103%;margin-top:-50px;"></i></span></div>');
  $('#fx2'+c).focus();
  count_row();
  c+=1;
});

function count_row(){
  $i=1;
}

$(document).delegate("#voltage-subtract","click",function(){
  $(this).closest(".extra-voltage-container").remove();
});
</script>


    <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>
  @endsection
