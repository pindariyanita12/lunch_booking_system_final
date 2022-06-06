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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            const params = new URLSearchParams(window.location.search);
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.admindashboard.show') }}",
                    data: {
                        date: params.get('date')
                    }
                },
                columns: [
                    {
                        data: 'userempid',
                        name: 'Emp Id'
                    },
                    {
                        data: 'lunch_dates',
                        name: 'lunch_dates'
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
    <br>
    <h3 class="text-center">{{trans('home.admindashboardtitle')}}
    </h3>

    <div class="container">
        <br>
        <table class="table table-bordered data-table" id="dataTable">
            <thead>
                <tr>
                    <th>Emp Id</th>
                    <th>Date</th>
                    <th>NAME</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
   
</body>

</html>
