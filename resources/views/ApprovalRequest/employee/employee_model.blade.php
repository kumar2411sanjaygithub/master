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
                  <label class="col-sm-offset-3 col-sm-3 control-label">EMPLOYEE NAME</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">EMPLOYEE ID</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">DESIGNATION</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">EMAIL ID</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">CONTACT NUMBER</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">TELEPHONE NUMBER</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">USER NAME</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>

                  <label class="col-sm-offset-3 col-sm-3 control-label">DEPARTMENT NAME</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">ROLE</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">LINE1</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">LINE2</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>
                  <label class="col-sm-offset-3 col-sm-3 control-label">COUNTRY</label>
                  <div class="col-sm-6">
                      <p>{{ $value->name }}</p>
                  </div>                  
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
          </form>
        </div>