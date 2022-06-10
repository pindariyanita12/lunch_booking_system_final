<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        h3{
            text-align:center;
            margin-top:35px;
        }
        /* #edit-emp{
            margin-left:4px;
        }
         */
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
    <div class="d-flex justify-content-center mb-3">
        <h3>Total Employees</h3>
        <button type="button" id="addemp" class="btn btn-primary" style="height: 47px;margin-top:30px;margin-left: 15px;" ><i class="bi bi-plus"> Add Employee</i></button>
    </div>
    <div class="row table-responsive">
    <table class="table table-bordered data-table "> 
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
        processing: true,
        serverSide: true,
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