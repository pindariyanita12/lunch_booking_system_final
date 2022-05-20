<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel Datatable using Yajra Tutorial Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

    </style>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.admindashboard.show') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'lunch_dates',
                        name: 'lunch_dates'
                    },
                    {
                        data: 'userempid',
                        name: 'Emp Id'
                    },
                    {
                        data: 'username',
                        name: 'Name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

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
    <div class="container">
        <br>
        <table class="table table-bordered data-table" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Emp Id</th>
                    <th>NAME</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>
