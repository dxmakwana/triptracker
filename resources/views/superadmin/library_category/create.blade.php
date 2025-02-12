<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Library Category Details | Trip Tracker</title>
    @include('layouts.headerlink')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.navigation')
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="m-0">{{ __('Add Category') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Analytics</a></li>
                                <li class="breadcrumb-item active">{{ __('Category') }}</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <form id="libraryForm" method="POST" action="{{ route('libraries-category.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body2">
                                <div class="row pxy-15 px-10">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lib_cate_name">Category Name <span
                                                    class="text-danger">*</span></label>
                                            <x-text-input type="text" class="form-control" id="lib_cat_name"
                                                placeholder="Enter Name" name="lib_cat_name" autofocus
                                                autocomplete="lib_cat_name" value="{{ old('lib_cat_name') }}" />
                                            <x-input-error class="mt-2" :messages="$errors->get('lib_cat_name')" />
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lib_cat_status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="lib_cat_status" name="lib_cat_status"
                                                autofocus>
                                                <option value="" disabled
                                                    {{ old('lib_cat_status') ? '' : 'selected' }}>
                                                    Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('lib_cat_status')" />
                                        </div>
                                    </div>

                                </div>


                                <div class="row pxy-15 px-10">

                                    {{-- <div class="col-md-12" id="dynamic_field">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div> --}}

                                </div>

                                <div class="row py-20 px-10">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ route('libraries-category.index') }}" class="add_btn_br px-10">Cancel</a>
                                        <button id="submitButton" type="submit" class="add_btn px-10">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
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
        </div>
        <!-- ./wrapper -->
    @include('layouts.footerlink')
</body>

</html>
