@include('layouts.admin-app')

<body>
    @include('admin.navbar')
    <div class="container">
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
        @if (session()->has('alert'))
            <div class="alert alert-success">
                {{ session()->get('alert') }}
                <button type="button" class="close" data-dismiss="alert">x</button>

            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert">x</button>

            </div>
        @endif
        <div class="row">

            <div class="col-12">
                <h2>{{ trans('home.totalemployees') }}</h2>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="mb-2 float-end"> <button id="addemp" class="btn btn-primary"><i
                    class="bi bi-plus"></i>{{ trans('home.addemployee') }}</button>
        </div>

        <table class="table table-bordered data-table" id="dataTable">
            <thead>
                <tr>
                    <th>{{ trans('home.titleempid') }}</th>
                    <th>{{ trans('home.titlename') }}</th>
                    <th>{{ trans('home.titleemail') }}</th>
                    <th>{{ trans('home.titleaction') }}</th>
                </tr>
            </thead>
        </table>

    </div>

    <!-- edit Modal -->
    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('home.editdetail') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{ route('admin.admindashboard.edit') }}" method="POST">
                        @csrf
                        <input type="text" name="empId" id="empId" value="" hidden />
                        <div class="form-group">
                            <label class="control-label">{{ trans('home.titleempid') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="empNo"
                                    placeholder="Only numeric values are allowed" id="empNo">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="control-label">{{ trans('home.titlename') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="empName" id="empName">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="control-label">{{ trans('home.titleemail') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="empMail" id="empMail" value=""
                                    readonly>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('home.addemployee') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/addemployee" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">{{ trans('home.titleempid') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="emp_no" id="empno" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mt-3">{{ trans('home.titlename') }}</label>
                            <div>
                                <input type="text" class="form-control input-lg" name="emp_name" id="empname" value=""
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mt-3">{{ trans('home.titleemail') }}</label>
                            <div>
                                <input type="email" class="form-control input-lg" name="emp_email" id="empemail"
                                    value="" required>
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
    </div>
</body>
<script type="text/javascript">
    function initPage() {
        var table = $('#dataTable').DataTable({
            responsive: true,
            destroy: true,
            processing: true,
            serverSide: true,


            dom: 'lrBfrtip',
            ajax: {
                url: "{{ route('user.list') }}"
            },
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
            columns: [{
                    data: 'emp_id',
                    name: 'emp_id',
                    defaultContent: "NA"
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    }
    $(document).ready(function() {
        initPage();
    });

    $(document).on("click", "#edit-emp", function() {

        var empId = $(this).data('empid');
        var empNo = $(this).data('userid');
        var empName = $(this).data('name');
        var empemail = $(this).data('email');
        $(".modal-body #empNo").val(empId);
        $(".modal-body #empName").val(empName);
        $(".modal-body #empMail").val(empemail);
        $(".modal-body #empId").val(empNo);

        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('exampleModal'))
        modal.show();
    });
    $(document).on("click", "#addemp", function() {
        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addModal'))
        modal.show();
    });

    $(document).on('click', '.empdelete', function(e) {
        e.preventDefault();
        var idiss = $(this).data('id');

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
                        url: "{{ route('admin.admindashboard.empdelete') }}",
                        data: {
                            id: idiss,
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
