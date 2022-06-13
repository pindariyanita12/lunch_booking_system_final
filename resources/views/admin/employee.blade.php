<!DOCTYPE html>
<html lang="en">
<head>
<title>Total Employees</title>
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
        h2{
            text-align:center;
            margin-top:35px;
        }
        /* #edit-emp{
            margin-left:4px;
        }
         */
         #addemp{
            margin-top:35px;
            margin-right:5px;   
         }
    </style>
</head>
<body>
    @include('admin.navbar')
    <div class="container">
    @if (count($errors) > 0)

<div class="alert alert-danger">

<ul>

@foreach ($errors->all() as $error)

<button type="button" class="close" data-dismiss="alert">x</button> {{ $error }}

@endforeach

</ul>

</div>

@endif
<div class="row">
    <div class="col-10"><h2>Total Employees</h2></div>
    <div class="col-2"> <button id="addemp" class="btn btn-primary"><i class="bi bi-plus"></i>Add Employee</button></div>
  </div>
    <div class="row table-responsive mt-3">
    <table class="table table-bordered data-table"> 
        <thead>
            <tr>
                <th>EMP_ID</th>
                <th>Name</th>
                <th>Email</th>  
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
            <form role="form" action="{{ route('admin.admindashboard.edit') }}" method="POST">
                @csrf
                <input type="text" name="empId" id="empId" value="" hidden />
                <div class="form-group">
                        <label class="control-label">EmployeeNo</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="empNo" placeholder="Only numeric values are allowed" id="empNo">
                        </div>
                </div>
                <div class="form-group mt-3">
                        <label class="control-label">EmployeeName</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="empName" id="empName">
                        </div>
                </div>
                <div class="form-group mt-3">
                        <label class="control-label">EmployeeEmail</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="empMail" id="empMail" value="" readonly>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form role="form" action="/addemployee" method="POST">
            @csrf
                    <div class="form-group">
                        <label class="control-label">EmployeeNo</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="emp_no" id="empno" value="" placeholder="EmpNo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label mt-3">EmployeeName</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="emp_name" id="empname"   placeholder="Name" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label mt-3">Employee Email</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="emp_email" id="empemail"  placeholder="Email"  value="" required>
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
    var table = $('.data-table').DataTable({
            destroy: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
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
        ajax: "{{ route('user.list') }}",
        columns: [
            {data: 'emp_id', name: 'emp_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  }
  $(document).ready(function() {
        initPage();
    });
</script>
<script>
     $(document).on("click", "#edit-emp", function() {
        var myBookId = $(this).data('empid');
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
    $(document).on("click","#addemp",function(){
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