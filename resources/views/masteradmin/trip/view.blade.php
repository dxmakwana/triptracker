@extends('masteradmin.layouts.app')
<title>View Trip | Trip Tracker</title>
@if(isset($access['book_trip']) && $access['book_trip'])
  @section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center justify-content-between">
          <div class="col-auto">
            <h1 class="m-0">Trip Detail</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('masteradmin.home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Trip Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content px-10">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Basic Information</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p class="company_business_name">{{ $trip->tr_name ?? ''}}</p>
                <p class="company_details_text">{{ \Carbon\Carbon::parse($trip->tr_start_date ?? '')->format('M d, Y') }} - {{ \Carbon\Carbon::parse($trip->tr_end_date ?? '')->format('M d, Y') }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card-header d-flex p-0 justify-content-center tab_panal">
          <ul class="nav nav-pills p-2 tab_box">
            <li class="nav-item"><a class="nav-link active" href="#Traveleroverview" data-toggle="tab">Traveler Information</a></li>
            <li class="nav-item"><a class="nav-link" href="#Agentinfo" data-toggle="tab">Agent Information</a></li>
            <li class="nav-item"><a class="nav-link" href="#Tasksinfo" data-toggle="tab">Tasks</a></li>
            <li class="nav-item"><a class="nav-link" href="#Documentsinfo" data-toggle="tab">Documents</a></li>
            <li class="nav-item"><a class="nav-link" href="#Emailsinfo" data-toggle="tab">Related Emails</a></li>
          </ul>
        </div><!-- /.card-header -->
          <div class="tab-content px-20">
            <div class="tab-pane active" id="Traveleroverview">
                @include('masteradmin.trip.traveler-information')
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="Agentinfo">
              @include('masteradmin.trip.agent-information')
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="Tasksinfo">
              <div class="card">
                <div class="card-header">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-auto"><h3 class="card-title">Activity</h3></div>
                    <div class="col-auto"><a href="new-invoice.html"><button class="reminder_btn">Create invoice</button></a></div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search by Description">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex">
                      <div class="input-group date" id="fromdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#fromdate"/>
                        <div class="input-group-append" data-target="#fromdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                        </div>
                      </div>
                      <div class="input-group date" id="todate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#todate"/>
                        <div class="input-group-append" data-target="#todate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body2">
                  <div class="row">
                    <div class="col-md-12" id="accordion">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header accordion-button">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <P class="mb-0">Apr 19</P>
                            </div>
                            <div class="col-auto align-items-center d-flex">
                              <img src="dist/img/send.svg" class="send_icon">
                              <p class="invoiceid_text mar_15 mb-0">Estimate #2 for $13.50</p>
                            </div>
                            <div class="col-auto">
                              <button class="status_btn mar_15">Sent</button>
                            </div>
                          </div>
                        </div>
                      </a>
                      <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row justify-content-between">
                            <div class="col-auto">
                              <table class="table estimate_detail_table">
                                <div>
                                  <td><strong>Invoice Date</strong></td>
                                  <td>2024-04-04</td>
                                </tr>
                                <tr>
                                  <td><strong>Due Date</strong></td>
                                  <td>Within 30 Days</td>
                                </tr>
                                <tr>
                                  <td><strong>P.O/S.O</strong></td>
                                  <td>adasd</td>
                                </tr>
                                <tr>
                                  <td><strong>Items</strong></td>
                                  <td>1</td>
                                </tr>
                                <tr>
                                  <td><strong>Total</strong></td>
                                  <td>$13.50</td>
                                </tr>
                              </table>
                            </div>
                            <div class="col-auto">
                              <a href="#"><button class="add_btn_br">View related events</button></a>
                              <a href="view-estimate.html"><button class="add_btn">view Estimate</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" id="accordion">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapsetwo">
                        <div class="card-header accordion-button">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <P class="mb-0">Apr 19</P>
                            </div>
                            <div class="col-auto align-items-center d-flex">
                              <img src="dist/img/send.svg" class="send_icon">
                              <p class="invoiceid_text mar_15 mb-0">Estimate #2 for $13.50</p>
                            </div>
                            <div class="col-auto">
                              <button class="status_btn mar_15">Sent</button>
                            </div>
                          </div>
                        </div>
                      </a>
                      <div id="collapsetwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row justify-content-between">
                            <div class="col-auto">
                              <table class="table estimate_detail_table">
                                <div>
                                  <td><strong>Invoice Date</strong></td>
                                  <td>2024-04-04</td>
                                </tr>
                                <tr>
                                  <td><strong>Due Date</strong></td>
                                  <td>Within 30 Days</td>
                                </tr>
                                <tr>
                                  <td><strong>P.O/S.O</strong></td>
                                  <td>adasd</td>
                                </tr>
                                <tr>
                                  <td><strong>Items</strong></td>
                                  <td>1</td>
                                </tr>
                                <tr>
                                  <td><strong>Total</strong></td>
                                  <td>$13.50</td>
                                </tr>
                              </table>
                            </div>
                            <div class="col-auto">
                              <a href="#"><button class="add_btn_br">View related events</button></a>
                              <a href="view-estimate.html"><button class="add_btn">view Estimate</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->



  @endsection
@endif