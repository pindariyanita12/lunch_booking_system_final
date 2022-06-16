@include('layouts.admin-app')

<body>
    @include('admin.navbar')

    <div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}

                <button type="button" class="close" data-dismiss="alert">x</button>
            </div>
        @endif

        @if (session()->has('alert'))
            <div class="alert alert-success">
                {{ session()->get('alert') }}

                <button type="button" class="close" data-dismiss="alert">x</button>
            </div>
        @endif
    </div>
    <br>
    <h3 class="text-center">{{ trans('home.dailydishestitle') }}
    </h3>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" aria-expanded="true"
                    href="#tab1">{{ trans('home.dailydishes') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">{{ trans('home.monthwisereport') }}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false"
                            href="#tab2">{{ trans('home.employeewise') }}</a></li>
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false"
                            href="#tab3">{{ trans('home.traineewise') }}</a>
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
                <br>
            </div>

            <div class="tab-pane" id="tab2">

                <form action='' method="get">
                    <select name="id" style="cursor: Pointer;" class="form-select form-select-sm-1  text-black border-0"
                        id="idis">
                        <option value="" selected disabled><?php echo date('M'); ?></option>
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
                            <th>{{ trans('home.titleempid') }}</th>
                            <th>{{ trans('home.titlename') }}</th>
                            <th>{{ trans('home.totaldishes') }}</th>
                            <th>{{ trans('home.titleaction') }}</th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="tab3">
                <form action='' method="get">
                    <select name="idis2" style="cursor: Pointer;"
                        class="form-select form-select-sm-1  text-black border-0" id="idis2">
                        <option value="" selected disabled><?php echo date('M'); ?></option>
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
                            <th>{{ trans('home.titleempid') }}</th>
                            <th>{{ trans('home.titletraineename') }}</th>
                            <th>{{ trans('home.totaldishes') }}</th>
                            <th>{{ trans('home.titleaction') }}</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    function getMonthName(month) {
        const d = new Date();
        d.setMonth(month - 1);
        const monthName = d.toLocaleString("default", {
            month: "long"
        });
        return monthName;

    }
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
            serverSide: true,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    filename: 'Daily Dishes ' + '-' + getMonthName(monthis),
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
            serverSide: true,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    filename: getMonthName(monthis) + ' record Employee',
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
            serverSide: true,
            dom: 'lrBfrtip',
            buttons: [

                {
                    extend: 'csv',
                    text: 'Export CSV',
                    filename: getMonthName(monthis2) + ' record Trainee',
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
