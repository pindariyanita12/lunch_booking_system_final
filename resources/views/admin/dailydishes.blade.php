<!DOCTYPE html>
<html lang="en">

<head>
    <title>Datewise Records</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .dt-button,
        .buttons-csv,
        .buttons-html5 {
            margin-left: 10px;
            margin-bottom: 20px;
        }

        #idis {
            width: 250px;
        }

        #idis2 {
            width: 250px;
        }

        #showemployee {
            width: 100%;
        }
    </style>


</head>

<body>
    @include('admin.navbar')

    <div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <button type="button" class="close" data-dismiss="alert">x</button> {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        @if (session()->has('alert'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('alert') }}
            </div>
        @endif
    </div>
    <br>
    <h3 class="text-center">{{ trans('home.dailydishestitle') }}
    </h3>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" aria-expanded="true" href="#tab1">{{ trans('home.dailydishes') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">{{ trans('home.monthwisereport') }}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false" href="#tab2">{{ trans('home.employeewise') }}</a></li>
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false" href="#tab3">{{ trans('home.traineewise') }}</a>
                    </li>

                </ul>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <table class="table table-bordered data-table" id="dataTable">

                    <thead>
                        <tr>
                            <th>{{ trans('home.date') }}</th>
                            <th>{{ trans('home.totaldishes') }}</th>
                        </tr>
                    </thead>

                </table>
                <div class="">
                    <h3 class="text-center">{{ trans('home.dailydishestotal') }}
                        : {{ $totaldishes }}</h3>
                </div>
            </div>

            <div class="tab-pane" id="tab2">

                <form action='' method="get">
                    <select name="id" style="cursor: Pointer;" class="form-select form-select-sm-1  text-black border-0"
                        id="idis">
                        <option value="" selected disabled><?php echo date('M')?></option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1, date('Y'))) }}
                            </option>
                        @endfor
                    </select>
                </form>
                <hr>
                <br>
                <table class="table table-bordered showemployee" id="showemployee">

                    <thead>
                        <tr>
                            <th>{{trans('home.titleempid')}}</th>
                            <th>{{trans('home.titlename')}}</th>
                            <th>{{trans('home.totaldishes')}}</th>
                            <th>{{trans('home.titleaction')}}</th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="tab3">
                <form action='' method="get">
                    <select name="idis2" style="cursor: Pointer;"
                        class="form-select form-select-sm-1  text-black border-0" id="idis2">
                        <option value="" selected disabled><?php echo date('M')?></option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1, date('Y'))) }}
                            </option>
                        @endfor
                    </select>
                </form>
                <hr>
                <br>
                <table class="table table-bordered data-table" id="showtrainee">

                    <thead>
                        <tr>
                            <th>{{trans('home.titleempid')}}</th>
                            <th>{{trans('home.titletraineename')}}</th>
                            <th>{{trans('home.totaldishes')}}</th>
                            <th>{{trans('home.titleaction')}}</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <!-- edit Modal -->
    <div class="modal" tabindex="-1" id="exampleModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.admindashboard.edit') }}" method="POST">
                        @csrf
                        <input type="text" name="empId" id="empId" value="" hidden />
                        <input type="text" name="empNo" placeholder="Only numeric values are allowed" id="empNo"
                            value="" />
                        <input type="text" name="empName" id="empName" value="" />
                        <input type="text" name="empMail" id="empMail" value="" readonly />

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript">
    var monthis = $('#idis').val();
    var monthis2 = $('#idis2').val();
    var $table1, $table2, $table3;

    if (monthis == null || monthis == undefined) {
        var noww = new Date();
        var monthh = ("0" + (noww.getMonth() + 1)).slice(-1);
        monthis = (monthh);
    } else {
        monthis = $('#idis').val()
    }
    if (monthis2 == null || monthis2 == undefined) {
        var now = new Date();
        var month = ("0" + (now.getMonth() + 1)).slice(-1);
        monthis2 = (month);
    } else {
        monthis2 = $('#idis2').val()
    }

    function initPage1() {
        $table1 = $('#dataTable').DataTable({
            destroy: true,
            autoWidth: false,
            processing: true,
            serverSide: false,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'btn-space',
                    exportOptions: {
                        orthogonal: null
                    }
                }

            ],
            ajax: {
                url: "{{ route('admin.dailydishes.dailyDishes') }}",
                dataSrc: "data",
                data: {
                    idis: monthis
                }

            },
            columns: [{
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'total',
                    name: 'total'
                }

            ]
        });
    }

    function initPage2() {

        $table2 = $('#showemployee').DataTable({
            autoWidth: false,
            processing: true,
            destroy: true,
            serverSide: false,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'btn-space',
                    exportOptions: {
                        orthogonal: null,
                        columns: [0, 1, 2]
                    }
                }

            ],
            ajax: {
                url: "{{ route('admin.dailydishes.employees') }}",
                data: {
                    idis: monthis
                },
            },
            columns: [{
                    data: 'emp_id',
                    name: 'emp_id'
                },
                {
                    data: 'employeename',
                    name: 'employeename'
                },
                {
                    data: 'uniquerecord',
                    name: 'uniquerecord'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },

            ]
        });

    }

    function initPage3() {
        $table3 = $('#showtrainee').DataTable({
            autoWidth: false,
            destroy: true,
            processing: true,
            serverSide: false,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'btn-space',
                    exportOptions: {
                        orthogonal: null,
                        columns: [0, 1, 2]
                    }
                }

            ],
            ajax: {
                url: "{{ route('admin.dailydishes.trainees') }}",
                data: {
                    idis2: monthis2
                },

                extend: 'csv',
                text: 'Export CSV',
                className: 'btn-space',
                exportOptions: {
                    orthogonal: null,
                    columns: [0, 1, 2]
                }
            },

            columns: [{
                    data: 'trainee_id',
                    name: 'trainee_id'
                },
                {
                    data: 'traineename',
                    name: 'traineename'
                },
                {
                    data: 'uniquerecord',
                    name: 'uniquerecord'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },

            ]
        });
    }
    $(document).ready(function() {

        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.removeItem('activeTab');
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('[href="' + activeTab + '"]').tab('show');
        }
        initPage1();
        initPage2();
        initPage3();

    });

    $('#idis').change(function() {
        monthis = $('#idis').val();
        initPage2();
    });
    $('#idis2').change(function() {
        monthis2 = $('#idis2').val();
        initPage3();
    });

    $(document).on("click", "#edit-item", function() {
        var myBookId = $(this).data('id');
        var myBookNo = $(this).data('userid');
        var myBookName = $(this).data('name');
        var myBookemail = $(this).data('email');
        $(".modal-body #empNo").val(myBookId);
        $(".modal-body #empName").val(myBookName);
        $(".modal-body #empMail").val(myBookemail);
        $(".modal-body #empId").val(myBookNo);
        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('exampleModal'))
        modal.show();
    });

    $(document).on('click', '.employeedelete', function(e) {
        e.preventDefault();
        var idiss = $(this).data('id');
        var empid = $(this).data('idis');

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
                        url: "{{ route('admin.admindashboard.destroymonthwise') }}",
                        data: {
                            id: idiss,
                            idis: empid
                        },
                        success: function(data) {
                            alert("Deleted successfully");
                            location.reload()
                        }
                    });
                }
            });
    });

    $(document).on('click', '.traineedelete', function(e) {
        e.preventDefault();
        var idiss = $(this).data('id');
        var traineeid = $(this).data('idis');

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
                        url: "{{ route('admin.admindashboard.destroymonthwise') }}",
                        data: {
                            id: idiss,
                            idis: traineeid
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
