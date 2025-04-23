<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yajra DataTable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


</head>

<body>

    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <div class="card-header mb-3">
                    <h3 class="card-title">Yarja DataTables</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive ">
                    <table class=" table datatable" id="data">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        const table = $(document).ready(function() {
            $('#data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false
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
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('table').on("click", ".user-delete", function() {
                const UserId = $(this).data('id');
                if (UserId && confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: `/users/destroy/${UserId}`,
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE" // Laravel-এ সঠিক মেথডের জন্য
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                location.reload(); // বা table.ajax.reload()
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert("Error: " + xhr.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
