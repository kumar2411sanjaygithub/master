<style type="text/css">
  .form-group {
     margin-bottom: 0px !important; 
}
</style>

          <div id="ConvertData{{ $value->id }}" class="modal fade" role="dialog">
          <form method="GET"  action="{{url('/manageofficials/deletedepartments/'.$value->id)}}">
           {{ csrf_field() }}
          <div class="modal-dialog modal-confirm">
            <div class="modal-content">
              <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                <h4 class="modal-title text-center">VIEW DETAILS</h4>
              </div>
              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
              <div class="form-group row ">
                  <label class="col-sm-3 control-label">EMPLOYEE NAME</label>
                  <div class="col-sm-3">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-3 control-label">EMPLOYEE ID</label>
                  <div class="col-sm-3">
                      <p>{{ $value->employee_id }}</p>
                  </div>                  
                </div>
                <div class="form-group row ">
                  <label class="col-sm-3 control-label">DESIGNATION</label>
                  <div class="col-sm-6">
                      <p>{{ $value->designation }}</p>
                  </div>
                </div>
                <div class="form-group row ">                  
                  <label class="col-sm-3 control-label">EMAIL ID</label>
                  <div class="col-sm-6">
                      <p>{{ $value->email }}</p>
                  </div>
                </div>
                <div class="form-group row ">                 
                  <label class="col-sm-3 control-label">CONTACT NUMBER</label>
                  <div class="col-sm-3">
                      <p>{{ $value->contact_number }}</p>
                  </div>
                  <label class="col-sm-3 control-label">TELEPHONE NUMBER</label>
                  <div class="col-sm-3">
                      <p>{{ $value->telephone_number }}</p>
                  </div>

                </div>
                <div class="form-group row ">                  
                  <label class="col-sm-3 control-label">USER NAME</label>
                  <div class="col-sm-6">
                      <p>{{ $value->username }}</p>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-3 control-label">DEPARTMENT NAME</label>
                  <div class="col-sm-6">
                      <p>{{ @$value->department['depatment_name'] }}</p>
                  </div>
                </div>
                <div class="form-group row ">                 
                  <label class="col-sm-3 control-label">ROLE</label>
                  <div class="col-sm-6">
                      <p>{{  @$value->rolename->name }}</p>
                  </div>
                </div>
                <div class="form-group row ">                 
                  <label class="col-sm-3 control-label">LINE1</label>
                  <div class="col-sm-6">
                      <p>{{ $value->line1 }}</p>
                  </div>
                </div>
                <div class="form-group row ">                 
                  <label class="col-sm-3 control-label">LINE2</label>
                  <div class="col-sm-6">
                      <p>{{ $value->line2 }}</p>
                  </div>
                </div>
                <div class="form-group row ">                 
                  <label class="col-sm-3 control-label">COUNTRY</label>
                  <div class="col-sm-3">
                      <p>{{ $value->country }}</p>
                  </div>
                  <label class="col-sm-3 control-label">STATE</label>
                  <div class="col-sm-3">
                   
                      <p> @if(!empty($value->state) && $value->state!='PLEASE SELECT'){{  \App\Common\StateList::get_state_name($value->state) }}@endif</p>
                  </div> 

                </div>
                <div class="form-group row ">                  
                  <label class="col-sm-3 control-label">CITY/TOWN</label>
                  <div class="col-sm-3">
                      <p>{{ $value->city }}</p>
                  </div> 
                  <label class="col-sm-3 control-label">PIN CODE</label>
                  <div class="col-sm-3">
                      <p>{{ $value->pin_code }}</p>
                  </div> 

                </div>
                <div class="form-group row ">                  
                  <label class="col-sm-3 control-label">MOBILE NUMBER</label>
                  <div class="col-sm-3">
                      <p>{{ $value->comm_mob }}</p>
                  </div>
                  <label class="col-sm-3 control-label">TELEPHONE NUMBER</label>
                  <div class="col-sm-3">
                      <p>{{ $value->comm_telephone }}</p>
                  </div>  

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
              </div>
            </div>
          </div>
          </form>
        </div>