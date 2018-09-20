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
            <!-- Main content -->
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
                                    <div class="col-md-2"><label  class="control-label  mlt1">CLIENT DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><button type="button" class="btn  btn-info btn-xs" name="cdw5" id="cdw5">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cdw4" id="cdw4">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy"><input type="checkbox" class="minimal"></th>
                                             <th class="srno">SR.NO</th>
                                             <th>FIELD NAME</th>
                                             <th>CURRENT VALUE</th>
                                             <th>UPDATED VALUE</th>
                                             <th class="act">ACTION</th>
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

                                                <td><input type="checkbox" class="minimal vl" ></td>
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

                                             <td><a href="/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
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
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
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

    })

    $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
    })
    });
    </script>
   @endsection
