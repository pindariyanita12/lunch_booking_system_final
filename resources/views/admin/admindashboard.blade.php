<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lunch Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        .datepicker {
            width: 250px;
        }

        #addguests {
            margin-top: 35px;
        }
    </style>
</head>

<body>
    @include('admin.navbar')

    <br>
    @if (session()->has('alert'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('alert') }}
        </div>
    @endif
    <div class="container">

        <div class="row">

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255, 0, 0, 0.359)">
                        <h5 class="card-title">{{ trans('home.totaltrainees') }}</h5>
                        <p class="card-text">{{ $totaltrainees }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(73, 225, 73, 0.575)">
                        <h5 class="card-title">{{ trans('home.totalemployees') }}</h5>
                        <p class="card-text">{{ $totalemployees }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body" style="background-color: lightblue">
                        <h5 class="card-title">{{ trans('home.totaltodaydishes') }}</h5>
                        <p class="card-text">{{ $totaltrainees + $totalemployees }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255, 255, 0, 0.665)">
                        <h5 class="card-title">{{ trans('home.totalmonthlydishes') }}</h5>
                        <p class="card-text">{{ $totaldishes }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <br>
    <h3 class="text-center">{{ trans('home.admindashboardtitle') }} <?php echo ' ' . '(' . date('Y-m-d') . ')'; ?>
    </h3>

    <div class="container">
        <div class=" mb-2 float-end"> <button id="addguests" class="btn btn-primary"><i
                    class="bi bi-plus"></i>{{ trans('home.addguests') }}</button>
        </div>
        <div class="datepicker">
            <input class="form-control me-2" value="<?php echo date('Y-m-d'); ?>" id="showdate" name="date" type="date"
                placeholder="Search" aria-label="Search">
        </div>

        <br>
        <table class="table table-bordered data-table" id="dataTable">
            <thead>
                <tr>
                    <th>{{ trans('home.titleempid') }}</th>
                    <th>{{ trans('home.titlename') }}</th>
                    <th>{{ trans('home.titleaction') }}</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('home.addguests') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/addguests" method="POST">
                        @csrf
                        {{-- <div class="form-group">
                            <label class="control-label mt-3">{{ trans('home.guestname') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="guestname" id="guestname"
                                    value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mt-3">{{ trans('home.referralname') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="referral" id="referral" value="">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="control-label mt-3">{{ trans('home.totalguests') }}</label>
                            <div>
                                <input type="number" min=0 class="form-control input-lg" name="totalguests"
                                    id="totalguests" value="" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var dateis = $('#showdate').val();
    var mydatatable;
    if (dateis == null) {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        dateis = now.getFullYear() + "-" + (month) + "-" + (day);
    } else {
        dateis = $('#showdate').val()
    }
    $(document).on("click", "#addguests", function() {
        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addModal'))
        modal.show();
    });

    function initPage() {
        mydatatable = $('#dataTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ordering: false,
            dom: 'lrBfrtip',
            ajax: {
                url: "{{ route('admin.admindashboard.show') }}",
                data: {
                    date: dateis
                }
            },
            columns: [{
                    data: 'userempid',
                    name: 'userempid'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    }

    $(document).ready(function() {
        setInterval(function() {
            mydatatable.ajax.reload();
        }, 20000);
        initPage();
    });

    $('#showdate').change(function() {

        dateis = $('#showdate').val();
        initPage();

    });

    $(document).on('click', '.abc', function(e) {
        e.preventDefault();
        var idis = $(this).data('id');
        swal({
                title: "Are you sure!",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            }, )
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.admindashboard.destroy') }}",
                        data: {
                            id: idis,
                        },
                        success: function(data) {
                            alert("Deleted successfully");
                            location.reload()
                        }
                    });
                }
            });
    });
</script>

</html>
