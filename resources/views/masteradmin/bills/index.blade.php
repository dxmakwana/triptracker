@extends('masteradmin.layouts.app')
<title>Profityo | View All Bills</title>
@if(isset($access['view_bills']) && $access['view_bills'] == 1) 
@section('content')
<!-- @include('flatpickr::components.style') -->
<link rel="stylesheet" href="{{ url('public/vendor/flatpickr/css/flatpickr.css') }}">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center justify-content-between">
          <div class="col-auto">
            <h1 class="m-0">{{ __('Bills') }}</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('business.home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{ __('Bills') }}</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-auto">
            <ol class="breadcrumb float-sm-right">
              @if(isset($access['add_bills']) && $access['add_bills']) 
                <a href="{{ route('business.bill.create') }}"><button class="add_btn"><i
                      class="fas fa-plus add_plus_icon"></i>{{ __('Create A Bill') }}</button></a>
              @endif
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content px-10">
      <div class="container-fluid">
        @if(Session::has('bill-add'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('bill-add') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
          @php
          Session::forget('bill-add');
          @endphp
        @endif

        <!-- Small boxes (Stat box) -->
        <div class="col-lg-12 px-20 fillter_box">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <p class="m-0 filter-text"><i class="fas fa-solid fa-filter"></i>Filters</p>
            </div><!-- /.col -->
            <div class="col-auto">
              <p class="m-0 float-right filter-text">Clear Filters<i class="fas fa-regular fa-circle-xmark"></i></p>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-lg-3 col-1024 col-md-6 px-10">
              <select class="form-control select2" style="width: 100%;" id="sale_vendor_id" name="sale_vendor_id">
                <option  value="" default>All Vendors</option>
                @foreach($vendor as $value)
                <option value="{{ $value->purchases_vendor_id }}">{{ $value->purchases_vendor_name }} </option>
                @endforeach
              </select>
            </div>
            <div class="col-lg-4 col-1024 col-md-6 px-10 d-flex">
              <div class="input-group date" id="fromdate" data-target-input="nearest">
                <x-flatpickr id="from-datepicker" placeholder="From"/>
                <div class="input-group-append">
                  <span class="input-group-text" id="from-calendar-icon">
                      <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
              </div>
              <div class="input-group date" id="todate" data-target-input="nearest">
                <x-flatpickr id="to-datepicker" placeholder="To" />
                <div class="input-group-append">
                  <span class="input-group-text" id="to-calendar-icon">
                      <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div id="filter_data">
          <div class="card px-20">
            <div class="card-body1">
              <div class="col-md-12 table-responsive pad_table">
                <table id="example4" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Vendors</th>
                      <th>Number</th>
                      <th>Date</th>
                      <th>Due Date</th>
                      <th>Amount Due</th>
                      <th>Status</th>
                      <th class="sorting_disabled text-right" data-orderable="false">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if (count($allBill) > 0)
                  @foreach ($allBill as $value)
                    <tr id="row-bill-{{ $value->sale_bill_id }}">
                      <td>{{ $value->vendor->purchases_vendor_name ?? ''}}</td>
                      <td>{{ $value->sale_bill_number }}</td>
                      <td>{{ \Carbon\Carbon::parse($value->sale_bill_date)->format('M d, Y') }}</td>
                      <td>{{ \Carbon\Carbon::parse($value->sale_bill_valid_date)->format('M d, Y') }}</td>
                      <td>{{ $value->sale_bill_due_amount }}</td>
                      <td><span class="status_btn Paid_status">{{ $value->sale_status }}</span></td>
                      <td>
                        <ul class="navbar-nav ml-auto float-right">
                          <li class="nav-item dropdown d-flex align-items-center">
                            <a class="d-block invoice_underline" data-toggle="modal" data-target="#recordpaymentpopup">Record a payment</a>
                            <a class="nav-link user_nav" data-toggle="dropdown" href="#">
                              <span class="action_btn"><i class="fas fa-solid fa-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a href="{{ route('business.bill.view',$value->sale_bill_id) }}" class="dropdown-item">
                                <i class="fas fa-regular fa-eye mr-2"></i> View
                              </a>
                              <a href="{{ route('business.bill.edit',$value->sale_bill_id) }}" class="dropdown-item">
                                <i class="fas fa-solid fa-pen-to-square mr-2"></i> Edit
                              </a>
                              <a href="{{ route('business.bill.duplicate',$value->sale_bill_id) }}" class="dropdown-item">
                                <i class="fas fa-regular fa-copy mr-2"></i> Duplicate
                              </a>
                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deletebill_{{ $value->sale_bill_id }}">
                                <i class="fas fa-solid fa-trash mr-2"></i> Delete
                              </a>


                            </div>
                          </li>
                        </ul>
                      </td>

                      <div class="modal fade" id="deletebill_{{ $value->sale_bill_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <form method="POST" action="{{ route('business.bill.destroy', ['id' => $value->sale_bill_id]) }}" id="delete-form-{{ $value->sale_bill_id }}" data-id="{{ $value->sale_bill_id }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body pad-1 text-center">
                              <i class="fas fa-solid fa-trash delete_icon"></i>
                              <p class="company_business_name px-10"><b>Delete Bill</b></p>
                              <p class="company_details_text px-10">Delete Bill {{ $value->sale_bill_id }}</p>
                              <p class="company_details_text">Are You Sure You Want to Delete This Bill?</p>
                              <button type="button" class="add_btn px-15" data-dismiss="modal">Cancel</button>
                              <button type="button" class="delete_btn px-15" data-id="{{ $value->sale_bill_id }}">Delete</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    </tr>

                    @endforeach    
                    @else
                        <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No records found</td></tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div><!-- /.card-body -->
          </div><!-- /.card-->
        </div>  
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
 
  <div class="modal fade" id="recordpaymentpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Record A Manual Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row pxy-15 px-10">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Payment Date</label>
                  <div class="input-group date" id="estimatedate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" placeholder="" data-target="#estimatedate">
                    <div class="input-group-append" data-target="#estimatedate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Amount</label>
                  <input type="number" class="form-control" aria-describedby="inputGroupPrepend" placeholder="$12.50"> 
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Method</label>
                  <select class="form-control form-select">
                    <option>Select a Payment Method...</option>
                    <option>Bank Payment</option>
                    <option>Cash</option>
                    <option>Check</option>
                    <option>Credit Card</option>
                    <option>PayPal</option>
                    <option>Other Payment Method</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label>Account <span class="text-danger">*</span></label>
                <select class="form-control form-select" required>
                  <option>Select a Payment Account...</option>
                  <option>Cash on Hand (USD)</option>
                  <option>Chisom Latifat (AED)</option>
                  <option>INR for cash (INR)</option>
                  <option>Shareholder Loan (USD)</option>
                  <option>Wave Payroll Clearing (USD)</option>
                </select>
                <p class="mb-0">Any Account Into Which You Deposit And Withdraw Funds From.</p>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="recordpaymentmemonotes">Memo / Notes</label>
                  <textarea id="recordpaymentmemonotes" class="form-control" rows="3" placeholder="Enter your text here"></textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="add_btn_br" data-dismiss="modal">Cancel</button>
          <button type="submit" class="add_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ url('public/vendor/flatpickr/js/flatpickr.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment"></script>

<script>
$(document).on('click', '.delete_btn', function() {
    var invoiceId = $(this).data('id'); 
    var form = $('#delete-form-' + invoiceId);
    var url = form.attr('action'); 

    $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(), 
        success: function(response) {
          // console.log(response);
            if (response.success) {
              // alert('jiiii');
               //count update when delete the record 
               var table = $('#example4').DataTable();

                var row = $('#row-bill-' + invoiceId); 

                if (row.length > 0) {
                    table.row(row).remove().draw(false); 
                }
               
                $('#row-bill-' + invoiceId).remove();

                $('#deletebill_' + invoiceId).modal('hide');
              
                // alert(response.message);
            } else {
                alert('An error occurred: ' + response.message);
            }
        },
        error: function(xhr) {
            alert('An error occurred while deleting the record.');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    var defaultStartDate = "";  
    var defaultEndDate = "";    
    var defaultSaleCusId = "";  
  
        $('#from-datepicker').val(defaultStartDate);
   
        $('#to-datepicker').val(defaultEndDate);

        $('#sale_vendor_id').val(defaultSaleCusId);

        var fromdatepicker = flatpickr("#from-datepicker", {
          locale: 'en',
                altInput: true,
                dateFormat: "MM/DD/YYYY",
                altFormat: "MM/DD/YYYY",
                allowInput: true,
                parseDate: (datestr, format) => {
                  return moment(datestr, format, true).toDate();
                },
                formatDate: (date, format, locale) => {
                  return moment(date).format(format);
                }
            });
            document.getElementById('from-calendar-icon').addEventListener('click', function () {
              fromdatepicker.open(); 
            });

          var todatepicker = flatpickr("#to-datepicker", {
            locale: 'en',
              altInput: true,
              dateFormat: "MM/DD/YYYY",
              altFormat: "MM/DD/YYYY",
              allowInput: true,
              parseDate: (datestr, format) => {
                return moment(datestr, format, true).toDate();
              },
              formatDate: (date, format, locale) => {
                return moment(date).format(format);
              }
          });
          document.getElementById('to-calendar-icon').addEventListener('click', function () {
            todatepicker.open(); 
          });

          $('.filter-text').on('click', function() {
                clearFilters();
            });

            
   
    // Function to fetch filtered data
    function fetchFilteredData() {
        var formData = {
            start_date: $('#from-datepicker').val(),
            end_date: $('#to-datepicker').val(),
            sale_vendor_id: $('#sale_vendor_id').val(),
            _token: '{{ csrf_token() }}'
        };



        // alert(start_date);
        // alert(end_date);
        // alert(sale_cus_id);
        // alert(sale_estim_number);
        // console.log('Form Data:', formData); // Debug: Log form data to console


        $.ajax({
        url: '{{ route('business.bill.index') }}',
        type: 'GET',
        data: formData,
        success: function(response) {
            $('#filter_data').html(response); // Update the results container with HTML content
            
        },
        error: function(xhr) {
            console.error('Error:', xhr);
                // alert('An error occurred while fetching data.');
            }
        });

      }



    // Attach change event handlers to filter inputs
    $('#sale_vendor_id, #from-datepicker, #to-datepicker').on('change keyup', function(e) {
      e.preventDefault(); 
      fetchFilteredData();
    });

    function clearFilters() {
    // Clear filters
    $('#sale_vendor_id').val('').trigger('change');


    const fromDatePicker = flatpickr('#from-datepicker');
    const toDatePicker = flatpickr('#to-datepicker');
    fromDatePicker.clear(); // Clears the "from" datepicker
    toDatePicker.clear();   // Clears the "to" datepicker

    // $('#from-datepicker').flatpickr().clear();  // Clear "from" datepicker
    // $('#to-datepicker').flatpickr().clear();    // Clear "to" datepicker

    fetchFilteredData(); 
    }


    });

</script>

@endsection
@endif