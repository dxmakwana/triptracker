@extends('masteradmin.layouts.app')
<title>Profityo | New Product Or Service</title>
@if(isset($access['update_vendors']) && $access['update_vendors'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center justify-content-between">
          <div class="col-auto">
          <h1 class="m-0">Edit Vendor</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('business.home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Vendor</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-auto">
            <ol class="breadcrumb float-sm-right">
            <a href="{{route('business.purchasvendor.index')}}" class="add_btn_br">Cancel</a>
              <a href="#"><button class="add_btn">Save</button></a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content --> 
    <section class="content px-10">
      <div class="container-fluid">
        <!-- card -->
        @if(Session::has('purchases-vendor-edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('purchases-vendor-edit') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @php
        Session::forget('purchases-vendor-edit');
    @endphp
    @endif
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Basic Information</h3>
          </div>
         
          <!-- /.card-header -->
          <form method="POST"
          action="{{ route('business.purchasvendor.update', ['PurchasesVendor' => $PurchasVendore->purchases_vendor_id]) }}">
          @csrf
          @method('Patch')
          <div class="card-body2">
            <div class="row pad-5">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="vendorname">Vendor Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('purchases_vendor_name') is-invalid @enderror" id="purchases_vendor_name" name="purchases_vendor_name" placeholder="Vendor Name"  value="{{ $PurchasVendore->purchases_vendor_name }}">
                  @error('purchases_vendor_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-8">
    <!-- <div class="form-group">
        <label for="vendorname">Type</label>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check d-flex">
                    <input class="form-check-input mr-2" type="radio" name="vendor_type" value="purchases_vendor_type" {{ old('vendor_type', $PurchasVendore->purchases_vendor_type) == 'on' ? 'checked' : '' }} id="regularType">
                    <label class="form-check-label">
                        <strong>Regular</strong> (Companies That Provide Goods and Services to your Business (E.G. Internet and Utility Providers).)
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check d-flex">
                    <input class="form-check-input mr-2" type="radio" name="vendor_type" value="purchases_vendor_type" {{ old('vendor_type', $PurchasVendore->purchases_vendor_contractor_type) == 'on' ? 'checked' : '' }} id="contractorType">
                    <label class="form-check-label">
                        <strong>1099-NEC Contractor</strong> (Contractors that Perform a Service for Which you Pay them and Provide a 1099-NEC Form.)
                    </label>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="form-group">
    <label for="vendorname">Type</label>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check d-flex">
                <input class="form-check-input mr-2" type="radio" name="type" value="Vendor" {{ old('type', $PurchasVendore->purchases_vendor_type) == 'Vendor' ? 'checked' : '' }} id="regularType">
                <label class="form-check-label" for="regularType">
                    <strong>Regular</strong> (Companies That Provide Goods and Services to your Business (E.G. Internet and Utility Providers).)
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check d-flex">
                <input class="form-check-input mr-2" type="radio" name="type" value="1099-NEC Contractor" {{ old('type', $PurchasVendore->purchases_vendor_type) == '1099-NEC Contractor' ? 'checked' : '' }} id="contractorType">
                <label class="form-check-label" for="contractorType">
                    <strong>1099-NEC Contractor</strong> (Contractors that Perform a Service for Which you Pay them and Provide a 1099-NEC Form.)
                </label>
            </div>
        </div>
    </div>
</div>
</div>


            <!-- <div id="vendorregular">
              <div class="modal_sub_title">Primary Contact</div>
              <div class="row pad-5"> -->
<!--  -->

<div id="vendorregular">
              <div class="modal_sub_title">Primary Contact</div>
              <div class="row pad-5">

              <div class="col-md-6" id="contractorFields" style="display: none;">
                <div class="form-group">
                    <label for="vendorfirstname">Contractor Type</label>
                    <select class="form-control select2" name="purchases_contractor_type" style="width: 100%;">
                        <option value="">Select Contractor Type</option>
                        <option value="Individual" {{ old('purchases_contractor_type', $PurchasVendore->purchases_contractor_type) == 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Business" {{ old('purchases_contractor_type', $PurchasVendore->purchases_contractor_type) == 'Business' ? 'selected' : '' }}>Business</option>
                    </select>
                </div>
            </div>


            <div class="col-md-6" id="ssnField" style="display: none;">
                <div class="form-group">
                    <label for="vendorsocialsecuritynumber">Social Security Number</label>
                    <input type="text" class="form-control" id="purchases_vendor_security_number" name="purchases_vendor_security_number" value="{{ $PurchasVendore->purchases_vendor_security_number }}" placeholder="Enter Number">
                </div>
            </div>

<!--  -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorfirstname">First Name</label>
                    <input type="text" class="form-control" id="vendorfirstname" name="purchases_vendor_first_name" placeholder="Enter First Name" value="{{ $PurchasVendore->purchases_vendor_first_name }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorlastname">Last Name</label>
                    <input type="text" class="form-control" id="vendorlastname" name="purchases_vendor_last_name" placeholder="Enter Last Name" value="{{ $PurchasVendore->purchases_vendor_last_name }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendoremail">Email</label>
                    <input type="email" class="form-control" id="vendoremail" name="purchases_vendor_email" placeholder="Enter Email" value="{{ $PurchasVendore->purchases_vendor_email }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendoraddress1">Address Line 1</label>
                    <input type="text" class="form-control" id="vendoraddress1" name="purchases_vendor_address1" placeholder="Enter a Location" value="{{ $PurchasVendore->purchases_vendor_address1 }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendoraddress2">Address Line 2</label>
                    <input type="text" class="form-control" id="vendoraddress2" name="purchases_vendor_address2" placeholder="Enter a Location" value="{{ $PurchasVendore->purchases_vendor_address2 }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control from-select select2 @error('purchases_vendor_country_id') is-invalid @enderror" name="purchases_vendor_country_id" id="purchases_vendor_country_id" style="width: 100%;">
                  <option value="">Select Country</option>
                        @foreach($Country as $con)
                        <option value="{{ $con->id }}" @if($con->id == $PurchasVendore->purchases_vendor_country_id) selected @endif>
                                {{ $con->name }}
                            </option>
                        @endforeach
                    </select>
                    <!-- <select class="form-control select2" name="purchases_vendor_country_id" style="width: 100%;" value="{{ old('purchases_vendor_country_id') }}">
                      <option default>Select a Country...</option>
                      <option>USA</option>
                    </select> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorcity">City</label>
                    <input type="text" class="form-control" id="vendorcity" name="purchases_vendor_city_name" placeholder="Enter A City" value="{{ $PurchasVendore->purchases_vendor_city_name }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorzipcode">Postal/ZIP Code</label>
                    <input type="text" class="form-control" id="vendorzipcode" name="purchases_vendor_zipcode" placeholder="Enter a Zip Code" value="{{ $PurchasVendore->purchases_vendor_zipcode }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Province/State</label>
                    <select class="form-control from-select select2 @error('purchases_vendor_state_id') is-invalid @enderror" name="purchases_vendor_state_id" id="purchases_vendor_state_id" style="width: 100%;">
                  <option value="">Select State</option>
                        @foreach($States as $states)
                        <option value="{{ $states->id }}" @if($states->id == $PurchasVendore->purchases_vendor_state_id) selected @endif>
                                {{ $states->name }}
                            </option>
                        @endforeach
                    </select>
                    <!-- <select class="form-control select2" name="purchases_vendor_state_id" style="width: 100%;" value="{{ old('purchases_vendor_name') }}">
                      <option default>Select a State...</option>
                      <option>Pennsylvania</option>
                    </select> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control from-select select2 @error('purchases_vendor_currency_id') is-invalid @enderror" name="purchases_vendor_currency_id" style="width: 100%;">
                      <option value="">Select a Currency</option>
                      @foreach($Country as $cur)
                          <option value="{{ $cur->id }}" @if($cur->id == $PurchasVendore->purchases_vendor_currency_id) selected @endif>
                              {{ $cur->currency }} ({{ $cur->currency_symbol }}) - {{ $cur->currency_name }}
                          </option>
                      @endforeach
                    </select>
                    <!-- <select class="form-control select2" name="purchases_vendor_currency_id" style="width: 100%;" value="{{ $PurchasVendore->purchases_vendor_currency_id }}">
                      <option default>Select a Currency...</option>
                      <option>CAD ($) - Canadian dollar</option>
                      <option>USD ($) - United States dollar</option>
                      <option>AED (AED) - UAE dirham</option>
                      <option>AFN (؋) - Afghani</option>
                      <option>ALL (Lek) - Lek</option>
                    </select> -->
                  </div>
                </div>
              </div>
              <div class="modal_sub_title">Additional Information</div>
              <div class="row pad-5">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendoraccountnumber">Account Number</label>
                    <input type="number" class="form-control" id="vendoraccountnumber" name="purchases_vendor_account_number" placeholder="Enter Account Number" value="{{ $PurchasVendore->purchases_vendor_account_number }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorphonenumber">Phone Number</label>
                    <input type="number" class="form-control" id="vendorphonenumber" name="purchases_vendor_phone" placeholder="Enter Phone Number" value="{{ $PurchasVendore->purchases_vendor_phone }}">
                  </div>
                </div>
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorphonenumber">Fax</label>
                    <input type="number" class="form-control" id="vendorphonenumber" name="purchases_vendor_fax" placeholder="Enter Fax" value="{{ $PurchasVendore->purchases_vendor_fax }}">
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorphonenumber">Mobile</label>
                    <input type="number" class="form-control" id="vendorphonenumber" name="purchases_vendor_mobile" placeholder="Enter Mobile" value="{{ $PurchasVendore->purchases_vendor_mobile }}">
                  </div>
                </div>
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorphonenumber">Toll free</label>
                    <input type="number" class="form-control" id="vendorphonenumber" name="purchases_vendor_toll_free" placeholder="Enter Toll free" value="{{ $PurchasVendore->purchases_vendor_toll_free }}">
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="vendorwebsite">Website</label>
                    <input type="text" class="form-control" id="vendorwebsite" name="purchases_vendor_website" placeholder="Enter Website" value="{{ $PurchasVendore->purchases_vendor_website }}">
                  </div>
                </div>
              </div>
            </div>
         
          <div class="row py-20 px-10">
            <div class="col-md-12 text-center">
            <a href="{{route('business.purchasvendor.index')}}" class="add_btn_br">Cancel</a>
              <a href="#"><button class="add_btn">Save</button></a>
            </div>
          </div><!-- /.col -->
        </div>
        </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function() {
    $('#purchases_vendor_country_id').change(function() {
        var country_id = $(this).val();
        var stateSelect = $('#purchases_vendor_state_id');

        if (country_id) {
            $.ajax({
                url: '{{ url('business/vendorgetstates') }}/' + country_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    stateSelect.empty();
                    stateSelect.append('<option value="">Select State</option>');
                    $.each(data, function(key, value) {
                        stateSelect.append('<option value="'+ value.id +'" ' + (value.id == '{{ $PurchasVendore->purchases_vendor_state_id }}' ? 'selected' : '') + '>' + value.name + '</option>');
                    });
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr.responseText);
                }
            });
        } else {
            stateSelect.empty();
            stateSelect.append('<option value="">Select State</option>');
        }
    });

    // Trigger change event on page load to set the initial state options
    $('#purchases_vendor_country_id').trigger('change');
});
</script>



@endsection
@endif