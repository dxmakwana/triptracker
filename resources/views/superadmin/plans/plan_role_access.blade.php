<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profityo | Subscription Plans Access</title>
    @include('layouts.headerlink')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.navigation')
        @include('layouts.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0">Subscription Plans Access</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Subscription Plans Access</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="#"><button class="add_btn_br">Cancel</button></a>
                                <a href="#"><button class="add_btn">Save</button></a>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content px-10">
                <div class="container-fluid">
                      <!-- card -->
                      @if(Session::has('plan-role'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('plan-role') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @php
                        Session::forget('plan-role');
                        @endphp
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Details</h3>
                        </div>
                        <form method="POST" action="{{ route('plans.updaterole', ['plan' => $plan->sp_id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body2">
                                <div class="col-md-12 table-responsive pad_table">
                                    <table class="table table-hover text-nowrap plan_access_table">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th class="text-center">Add</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>
                                                <th class="text-center">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                            <input type="hidden" name="mid_{{ $permission->mname }}" value="{{ $permission->mid }}">
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input parent-checkbox" type="checkbox" {{ $permission->is_access ? 'checked' : '' }}
                                                                name="{{ $permission->mname }}"
                                                                id="chk_{{ $permission->mname }}" value="1">
                                                            <label class="form-check-label"
                                                                for="chk_{{ $permission->mname }}">{{ $permission->mtitle }}</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_add ? 'checked' : '' }}
                                                            name="add_{{ $permission->mname }}"
                                                            id="chk_add_{{ $permission->mname }}" value="1">
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_view ? 'checked' : '' }}
                                                            name="view_{{ $permission->mname }}"
                                                            id="chk_view_{{ $permission->mname }}" value="1"> -->
                                                        <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_update ? 'checked' : '' }}
                                                            name="update_{{ $permission->mname }}"
                                                            id="chk_update_{{ $permission->mname }}" value="1">
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_update ? 'checked' : '' }}
                                                            name="update_{{ $permission->mname }}"
                                                            id="chk_update_{{ $permission->mname }}" value="1"> -->
                                                        <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_delete ? 'checked' : '' }}
                                                            name="delete_{{ $permission->mname }}"
                                                            id="chk_delete_{{ $permission->mname }}" value="1">

                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_delete ? 'checked' : '' }}
                                                            name="delete_{{ $permission->mname }}"
                                                            id="chk_delete_{{ $permission->mname }}" value="1"> -->
                                                        <input class="form-check-input child-checkbox {{ $permission->mname }}-checkbox" type="checkbox" {{ $permission->is_access_view ? 'checked' : '' }}
                                                            name="view_{{ $permission->mname }}"
                                                            id="chk_view_{{ $permission->mname }}" value="1">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.card-body -->
                            <div class="col-md-12">
                                <div class="row plan_acc_report_lable">
                                    <div class="form-check">
                                        <input class="form-check-input parent-checkbox" type="checkbox" id="chk_reports" name="reports_parent" {{ $reports_parent_checked ? 'checked' : '' }}>
                                        <label class="form-check-label" for="chk_reports">Reports</label>
                                    </div>
                                </div>
                                <div class="row report_row justify-content-between">
                                    @foreach ($reports as $report)
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <label class="form-check-label" for="chk_{{ $report->mname }}">{{ $report->mtitle }}</label>
                                                <input class="form-check-input child-checkbox report-child-checkbox" type="checkbox" {{ $report->is_access ? 'checked' : '' }} name="{{ $report->mname }}" id="chk_{{ $report->mname }}" value="1">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12 text-center py-20">
                                <a href="{{ route('plans.index') }}" class="add_btn_br px-10">Cancel</a>
                                <button type="submit" class="add_btn px-10">Save</button>
                            </div>
                        </form>
                    </div><!-- /.card -->
                </div><!-- /.container-fluid -->
            </section>
        </div><!-- /.content-wrapper -->
    </div><!-- /.wrapper -->

    @include('layouts.footerlink')
    <script>
        $(document).ready(function() {
            function updateParentCheckboxes(parentSelector, childSelector) {
                $(childSelector).change(function() {
                    var parentDiv = $(this).closest('div');
                    var allChecked = parentDiv.find(childSelector + ':checked').length === parentDiv.find(childSelector).length;
                    parentDiv.find(parentSelector).prop('checked', allChecked);
                });
            }

            updateParentCheckboxes('.parent-checkbox', '.child-checkbox');

            $('#chk_reports').change(function() {
                var isChecked = $(this).is(':checked');
                $('.report_row').find('.child-checkbox').prop('checked', isChecked);
            });

            $('.report_row .child-checkbox').change(function() {
                var allChecked = $('.report_row .child-checkbox:checked').length === $('.report_row .child-checkbox').length;
                $('#chk_reports').prop('checked', allChecked);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.parent-checkbox').change(function() {
                var isChecked = $(this).is(':checked');
                $(this).closest('tr').find('.child-checkbox').prop('checked', isChecked);
            });

            $('.child-checkbox').change(function() {
                var parentRow = $(this).closest('tr');
                var allChecked = parentRow.find('.child-checkbox:checked').length > 0;
                parentRow.find('.parent-checkbox').prop('checked', allChecked);
            });
        });
    </script>

      

</body>
</html>
