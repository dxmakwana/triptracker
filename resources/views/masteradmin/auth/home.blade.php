@extends('masteradmin.layouts.app')
<title>Dashboard | Trip Tracker</title>
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ url('public/dist/img/logo.png') }}" alt="Trip Tracker Logo">
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row px-20">
                    <div class="col-lg-12 col-md-12 col-mdash-box">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-md-6 col-mdash-box">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-md-6 col-mdash-box">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-md-6 col-mdash-box">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->
                    <div class="col-lg-2 col-md-6 col-mdash-box">
                        <!-- small box -->

                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-6">

                        <!-- /Latest Expense -->
                    </section>
                    <!-- /.Left col -->
                    <section class="col-lg-6 connectedSortable">
                    </section>
                    <!-- right col -->
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
    </div>
    <!-- ./wrapper -->
    <p>{{ session('showModal') }}</p>
    @if (session()->has('showModal'))
        <!-- Bootstrap Modal -->
        <div class="modal fade show" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Notice</h5>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('showModal') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary">Purchase Plan</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
