<section class="content px-10" id="list-info" class="tab">
                <div class="container-fluid">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @php
                            Session::forget('success');
                        @endphp
                    @endif

                    <!-- Main row -->
                    <div id="filter_data">
                        <div class="card px-20">
                            <div class="card-body1">
                                <div class="col-md-12 table-responsive pad_table">
                                    <table id="listview4" class="table table-hover text-nowrap data-table">
                                        <thead>
                                            <tr>
                                                <th>daxa Name</th>
                                                <th>Agent Name</th>
                                                <th>Traveler Name</th>
                                                <th>Price</th>
                                                <th>Start to End Date</th>
                                                <th>Status</th>
                                                <th class="sorting_disabled text-right" data-orderable="false">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        

                                            @foreach ($trip as $value)
                                                <tr>
                                                    <td>{{ $value->tr_name ?? '' }}</td>
                                                    <td>{{ $value->users_first_name ?? '' }}
                                                        {{ $value->users_last_name ?? '' }}</td>
                                                    <td>{{ $value->tr_traveler_name ?? '' }}</td>
                                                    <td>{{ $value->tr_value_trip ?? '' }}</td>

                                                    <td>{{ \Carbon\Carbon::parse($value->tr_start_date ?? '')->format('M d, Y') }}

                                                        {{ \Carbon\Carbon::parse($value->tr_end_date ?? '')->format('M d, Y') }}
                                                    </td>

                                                    <td>
                                                        @php
                                                            $statusName = $value->trip_status->tr_status_name ?? '';

                                                            $buttonColor = match (strtolower($statusName)) {
                                                              'trip request' => '#DB9ACA',
                                                                'trip proposal' => '#F6A96D',
                                                                'trip modification' => '#FBC11E',
                                                                'trip accepted' => '#28C76F',
                                                                'trip sold' => '#C5A070',
                                                                'trip lost' => '#F56B62',
                                                                'trip completed' => '#F56B62',
                                                                'trip pending' => '#F6A96D',
                                                                'in process' => '#F6A96D',
                                                            };
                                                        @endphp

                                                        <button type="button" class="btn text-white"
                                                            style="background-color: {{ $buttonColor }};">
                                                            {{ $statusName }}
                                                        </button>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('trip.view', $value->tr_id) }}"><i
                                                                class="fas fa-eye edit_icon_grid"></i></a>
                                                        <a href="{{ route('trip.edit', $value->tr_id) }}"><i
                                                                class="fas fa-pen edit_icon_grid"></i></a>
                                                        <a data-toggle="modal"
                                                            data-target="#delete-product-modal-{{ $value->tr_id }}"><i
                                                                class="fas fa-trash delete_icon_grid"></i></a>

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade"
                                                            id="delete-product-modal-{{ $value->tr_id }}" tabindex="-1"
                                                            role="dialog">
                                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('trip.destroy', $value->tr_id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-body text-center">
                                                                            <p><b>Delete Trip</b></p>
                                                                            <p>Are you sure you want to delete this trip?
                                                                            </p>
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card-->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>