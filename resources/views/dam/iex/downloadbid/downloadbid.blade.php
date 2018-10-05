@extends('theme.layouts.default')
@section('content')
<section class="content-header">
  <h5><label  class="control-label"><u>Download Bid</u></label></h5>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
    <li><a href="/power/downloadbid">DEM</a></li>
    <li><a href="/power/downloadbid">IEX</a></li>
    <li class="#"><u>Download Bid</u></li>
  </ol>
</section>
<section>
  <div class="col-md-12">
    <div class="">
    <!-- <div class="container container-lg"> -->
    <div class="panel panel-default">
      <div class="panel-heading topheading">Bid Details</div>
      <div class="panel-body pt0 pb0">
        <form>
            <div class="col-md-12" style="display: none;">
              <div class="col-md-6 col-md-offset-4">
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="radio-inline c-radio">
                      <input id="inlineradioIEX" class="iex_radio checkbox_check1" type="radio" name="i-radio" value="IEX" checked><span class="ion-record"></span> IEX
                    </label>
                  </div>
                  <div class="col-sm-6">
                    <label class="radio-inline c-radio">
                      <input disabled="" id="inlineradioPXIL" class="pxil_radio checkbox_check2" type="radio" name="i-radio" value="PXIL"><span class="ion-record"></span> PXIL
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div><br>
            <div class="col-md-12 iextab">
              <div>
                <div class="panel panel-default nb nbbg np">
                  <div class="panel-body np">
                    <!-- // -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card ">
                          <div class="card-heading">
                              <label class=""><span class="fl"><u>Delivery Date :</u></span> &nbsp; {{ $date }}</label>

                              <div class="pull-right">
                              @if(count($bidData))
                              <a href="{{ URL::to('downloadbidallbids',$date) }}"><img data-placement="bottom" class="ml40" data-toggle="tooltip" title="Download All" src="{{ asset('img/assets/download.svg') }}" height="28px" width="28px"></a>
                              @endif
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="table-responsive p2 h350">
                            <table class="table table-striped table-hover" id="datatable1">
                              <thead class="tablehead">
                                <tr>
                                  <th class="text-center fs14">Sr. No</th>
                                  <th class="text-center fs14">Client Name</th>
                                  <th class="text-center fs14">Portfolio Id</th>
                                  <th class="text-center fs14">Balance</th>
                                  <!-- <th class="text-center fs14">Type</th> -->
                                  <th class="text-center fs14">Single Bid</th>
                                  <th  class="text-center fs14">Block Bid</th>
                                </tr>
                                <!-- <tr>
                                  <th class="text-center fs14"></th>
                                  <th class="text-center fs14">
                                    <input type="text" class="placesearch" placeholder="Search">
                                  </th>
                                  <th class="text-center fs14">
                                    <input type="text" class="placesearch" placeholder="Search">
                                  </th>
                                  <th class="text-center fs14">
                                    <img src="/img/icons/rupee.svg" height="19" width="19">
                                  </th>
                                  <th class="text-center fs14">
                                    <select class="bgw">
                                      <option>Please Select</option>
                                      <option>Single Bid</option>
                                      <option>Block Bid</option>
                                      <option>Both</option>
                                    </select>
                                  </th>
                                  <th class="text-center fs14">
                                    Upload <br>Time
                                  </th>
                                  <th class="text-center fs14">
                                    Download bid
                                  </th>
                                  <th class="text-center fs14">
                                    Upload Time
                                  </th>
                                  <th class="text-center fs14">
                                    Download bid
                                  </th>
                                </tr>   -->
                              </thead>
                              <tbody>
                                <?php $i = 1; ?>
                                @foreach($bidData as $key => $value)
                                <tr>
                                  <td class="text-center">{{  $i  }}</td>
                                  <td class="text-center">{{ $value->company_name }}
                                      @if($value->common_feeder_option == 'yes')
                                          <i class="fa fa-fw fa-flag"></i>
                                      @endif
                                  </td>
                                  <td class="text-center">{{ $value->iex_portfolio }}</td>
                                  <td class="text-center">{{  App\Common\FinancialFunctions::getoutstandingbalace($value->client_id) }}</td>
                                  <!-- <td class="text-center"></td> -->
                                  <!-- <td></td> -->
                                  <td class="text-center">
                                    <a href="{{ URL::to('/downloadbid/downloadbidexcel/new/single/'.$value->order_no,array($date,$value->client_id)) }}">
                                      <img data-placement="bottom" data-toggle="tooltip" title="Download" src="{{ asset('img/assets/download.svg') }}" height="28px" width="28px">
                                    </a>
                                  </td>
                                  <!-- <td>Other</td> -->
                                  <td class="text-center">
                                    <a href="{{ URL::to('/downloadbid/downloadbidexcel/new/block/'.$value->order_no,array($date,$value->client_id)) }}">
                                      <img data-placement="bottom" data-toggle="tooltip" title="Download" src="{{ asset('img/assets/download.svg') }}" height="28px" width="28px">
                                    </a>
                                  </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header">Bordered Table
                            <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a href="#" role="button" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false"><span class="icon mdi mdi-more-vert"></span></a>
                              <div role="menu" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(19px, 25px, 0px); top: 0px; left: 0px; will-change: transform;"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
                                <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-sm table-hover table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>Operating System</th>
                                  <th>Users</th>
                                  <th>Rebound</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Windows</td>
                                  <td>1.580</td>
                                  <td>20%</td>
                                </tr>
                                <tr>
                                  <td>Mac OS</td>
                                  <td>1.322</td>
                                  <td>55%</td>
                                </tr>
                                <tr>
                                  <td>Linux</td>
                                  <td>850</td>
                                  <td>45%</td>
                                </tr>
                                <tr>
                                  <td>Android</td>
                                  <td>560</td>
                                  <td>70%</td>
                                </tr>
                                <tr>
                                  <td>iOS</td>
                                  <td>450</td>
                                  <td>39%</td>
                                </tr>
                                <tr>
                                  <td>Other</td>
                                  <td>317</td>
                                  <td>67%</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <!-- // -->
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</section>
{{ Html::script('js/downloadbid/downloadbid.js') }}
@endsection
