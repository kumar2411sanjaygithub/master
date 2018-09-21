
  <aside class="main-sidebar fs13">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Dashboard Menu Start -->
        <li>
          <a href="{{url('home')}}"><i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <!-- <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          </a>
        </li>
        <!-- Dashboard Menu End -->

        <!-- CRM Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tv"></i>
            <span>CRM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('lead.index') }}"><i class="fa fa-circle-o"></i>Lead</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Task</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Deal</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Email Management</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Maps</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Reports</a></li>
          </ul>
        </li>
        <!-- CRM Menu End -->

        <!-- Manage Client Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>Manage Client</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{ route('basic.details') }}"><i class="fa fa-circle-o"></i>Client Basic Details</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> DAM
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> IEX
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ route('addppadetailss') }}"><i class="fa fa-circle-o"></i>PPA</a></li>
                    <li><a href="{{ route('bid.bidview') }}"><i class="fa fa-circle-o"></i>Bid Setting</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bill Setting</a></li>
                    <li><a href="{{ route('validationSetting') }}"><i class="fa fa-circle-o"></i>Validation Setting</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> PXIL
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="#"><i class="fa fa-circle-o"></i>PPA</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bid Setting</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bill Setting</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Validation Setting</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> TAM
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> IEX
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="#"><i class="fa fa-circle-o"></i>PPA</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bill Setting</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> PXIL
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="#"><i class="fa fa-circle-o"></i>PPA</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bill Setting</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> REC
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{route('rec-bidding.biddingSearchindex')}}"><i class="fa fa-circle-o"></i>Bid Setting</a></li>
                <li><a href="{{route('rec-price.priceViewindex')}}"><i class="fa fa-circle-o"></i>Price Setting</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Due Days</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Success Fee</a></li>
                <li><a href="{{route('rec-exchange.exchangeViewindex')}}"><i class="fa fa-circle-o"></i>Exchange Ratio</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> ESCERT
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i>Bid Setting</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Price Setting</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Due Days</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Success Fee</a></li>
              </ul>
            </li>
            <li><a href="{{ route('agsetting') }}"><i class="fa fa-circle-o"></i>Accoutn Group Setting</a></li>
            <li><a href="{{ route('bared.barreddetails') }}"><i class="fa fa-circle-o"></i>Barred Client</a></li>
            <li><a href="{{route('tmnameview')}}"><i class="fa fa-circle-o"></i>TM Name Setting</a></li>
          </ul>
        </li>
        <!-- Manage Client Menu End -->

        <!-- Manage Employee Client Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sitemap"></i>
            <span>Manage Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('departments') }}"><i class="fa fa-circle-o"></i>Department</a></li>
            <li><a href="{{ route('permissionlist.index') }}"><i class="fa fa-circle-o"></i>Permission</a></li>
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i>Roles</a></li>
            <li><a href="{{ route('employee') }}"><i class="fa fa-circle-o"></i>Employee</a></li>
          </ul>
        </li>
        <!-- Manage Official Client Menu End -->

        <!-- Approve Request Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-check-square-o"></i> <span>Approve Request</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Client
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('approve.newclient') }}"><i class="fa fa-circle-o"></i> New</a></li>
                <li><a href="{{ route('approve.existingclient') }}"><i class="fa fa-circle-o"></i> Existing</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Employee
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('approve.newemployee') }}"><i class="fa fa-circle-o"></i> New</a></li>
                <li><a href="{{ route('approve.existingemployee') }}"><i class="fa fa-circle-o"></i> Existing</a></li>
              </ul>
            </li>
            <li><a href="{{route('insufficientpsm')}}"><i class="fa fa-circle-o"></i> Insufficient PSM</a></li>
          </ul>
        </li>
        <!-- Approve Request Menu End -->

        <!-- NOC Application Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>NOC</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ route('noc-applications.index') }}"><i class="fa fa-circle-o"></i>NOC Application</a>
               <a href="{{ route('nocapplicationapproval') }}"><i class="fa fa-circle-o"></i>NOC Application Approval</a>
               <a href="{{ route('billsetting.nocbilllist') }}"><i class="fa fa-circle-o"></i>NOC Bill Setting</a>
            </li>
          </ul>
        </li>
        <!-- NOC Application Menu End -->

        <!-- DAM Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>DAM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> IEX
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="/placebid/power"><i class="fa fa-circle-o"></i>Place Bid</a></li>
                    <li><a href="/power/orderbook"><i class="fa fa-circle-o"></i>Order Book</a></li>
                    <li><a href="/power/downloadbid"><i class="fa fa-circle-o"></i>Download Bid</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Bid Confirmation
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Submitted / Rejected</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Un-submitted</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Deleted</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>No Bid</a></li>
                      </ul>
                    </li>
                    <li><a href="/bidplacement/bidplacement"><i class="fa fa-circle-o"></i>Bid Placement Reminder</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Import
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{route('obligation')}}"><i class="fa fa-circle-o"></i>Obligation</a></li>
                        <li><a href="{{route('scheduling')}}"><i class="fa fa-circle-o"></i>Scheduling</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Rate Sheet</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Rate Sheet Graph</a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Periphery Losses
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{ route('pocdetails')}}"><i class="fa fa-circle-o"></i>POC</a></li>
                        <li><a href="{{ route('discomdetails')}}"><i class="fa fa-circle-o"></i>STU/DISCOM</a></li>
                      </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>RTC</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Profitablity</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> PXIL
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="#"><i class="fa fa-circle-o"></i>PPA</a></li>
                    <li><a href="{{route('bid.bidview')}}"><i class="fa fa-circle-o"></i>Bid Setting</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Bill Setting</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Validation Setting</a></li>
                  </ul>
                </li>
              </ul>
        </li>
        <!-- DAM Menu End -->

        <!-- Trader's Setting Menu Start -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Trader's Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="{{route('tmnameview')}}"><i class="fa fa-circle-o"></i>TM Name Setting</a></li> -->
            <li><a href="{{ route('discom-sldc-state.index') }}"><i class="fa fa-circle-o"></i>DISCOM & SLDC List</a></li>
          </ul>
        </li>
        <!-- Trader's Setting Menu End -->
      </ul>
    </section>
  </aside>
