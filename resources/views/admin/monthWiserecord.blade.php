<!DOCTYPE html>
<html lang="en">

<head>
    <title>Monthwise Record</title>
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
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
       .dt-button, .buttons-csv ,.buttons-html5{
        margin-left: 10px;
        margin-bottom: 20px;
    }

    </style>
    <script type="text/javascript">
        $(document).ready(function() {

            const params = new URLSearchParams(window.location.search);
            $('.data-table').DataTable({

                processing: true,
                serverSide: false,
                dom: 'lBfrtip',
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
                    url: "{{ route('admin.monthWiserecord.monthWise') }}",
                    data: {
                        idis: params.get('id')
                    }
                },
                columns: [{
                        data: 'userempid',
                        name: 'userempid'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'uniquerecord',
                        name: 'uniquerecord'
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
    <h3 class="text-center">{{trans('home.monthwisetitle')}}
    </h3>
    <div class="container">

        <br>
        <table class="table table-bordered data-table" id="dataTable">
            <thead>
                <tr>

                    <th>Emp Id</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>
