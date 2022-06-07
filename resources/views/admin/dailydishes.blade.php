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
        #idis{
            width:250px;
        }
        #idis2{
            width:250px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            const params = new URLSearchParams(window.location.search);
            $('table.display').dataTable();

            var $table1 = $('#dataTable').DataTable({
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
                        idis: $('#idis').val()
                    },
                    complete: function(data) {
                        if ($('#idis').val() == null) {
                            const d = new Date();
                            let month = d.getMonth();
                            // alert(month+1);
                            data['idis'] = month+1;
                        }
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
            $('#idis').change(function() {
                var $table2 = $('#showemployee').DataTable({
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
                                columns: [0,1,2] 
                            }
                        }

                    ],
                    ajax: {
                        url: "{{ route('admin.dailydishes.employees') }}",
                        data: {
                            idis: $('#idis').val()
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
            });
            $('#idis2').change(function() {
                var $table3 = $('#showtrainee').DataTable({
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
                                columns: [0,1,2] 
                            }
                        }

                    ],
                    ajax: {
                        url: "{{ route('admin.dailydishes.trainees') }}",
                        data: {
                            idis2: $('#idis2').val()
                        },

                        extend: 'csv',
                        text: 'Export CSV',
                        className: 'btn-space',
                        exportOptions: {
                            orthogonal: null,
                            columns: [0,1,2] 
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
        });
    </script>
    <script>
        $(document).on("click","#edit-item",function(){
            var myBookId = $(this).data('id');
            var myBookNo = $(this).data('userid');
            var myBookName = $(this).data('name');
            var myBookemail = $(this).data('email');
            $(".modal-body #empNo").val( myBookId );
            $(".modal-body #empName").val( myBookName);
            $(".modal-body #empMail").val( myBookemail);
            $(".modal-body #empId").val( myBookNo);
                let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('exampleModal')) 
                modal.show();
            });
    </script>
</head>

<body>
    @include('admin.navbar')
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    <br>
    <h3 class="text-center">{{trans('home.dailydishestitle')}}
    </h3>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" aria-expanded="true" href="#tab1">Daily Dishes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Employee Monthwise</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false" href="#tab2">Employee</a></li>
                    <li><a class="dropdown-item" data-toggle="tab" aria-expanded="false" href="#tab3">Non-Employee</a>
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
                            <th>Date</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                </table>
                <div class="">
                    <h3 class="text-center">{{trans('home.dailydishestotal') }}
                        : {{ $totaldishes }}</h3>Previous1Next
                </div>
            </div>

            <div class="tab-pane" id="tab2">

                <form action='' method="get">
                    <select name="id" style="cursor: Pointer;" class="form-select form-select-sm-1  text-black border-0"
                        id="idis">
                        <option value="" selected disabled>Select Month</option>
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
                            <th>Emp id</th>
                            <th>Employee Name</th>
                            <th>Total</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="tab3">
                <form action='' method="get">
                    <select  name="id" style="cursor: Pointer;" class="form-select form-select-sm-1  text-black border-0"
                        id="idis2">
                        <option value="" selected disabled>Select Month</option>
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
                            <th>Emp id</th>
                            <th>Nonemployee Name</th>
                            <th>Total</th>
                            <th>Action</th>
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
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>some content</p>
        <form action="{{route('admin.admindashboard.edit')}}" method="POST">
            @csrf
        <input type="text" name="empId" id="empId" value="" hidden/>
        <input type="text" name="empNo" id="empNo" value="" />
        <input type="text" name="empName" id="empName" value="" />
        <input type="text" name="empMail" id="empMail" value="" readonly/>
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
</html>
