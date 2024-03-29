@extends('backend.admin.layouts.index')
@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 ps-5">Category</h4>
        <div class="card p-2 ms-3" style="width: 1225px;">
            <div class="row gy-3">
                <div>
                    <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="addCategory">
                        Add Category
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table pt-2 " id="categoryTable">
                        <thead class="table-light  mt-3">
                            <tr class="text-nowrap">
                                <th class="text-dark ">Id</th>
                                <th class="text-dark ">Category</th>
                                <th class="text-dark ">Image</th>
                                <th class="text-dark ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admin.modals.categoryModal');
@endsection

@section('admin-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    <script>
        $(document).ready(function() {


            var headers = $('meta[name="csrf-token"]').attr('content');

            let list = $('#categoryTable').dataTable({
                searching: true,
                paging: true,
                pageLength: 10,

                "ajax": {
                    url: "{{ route('admin.list_data') }}",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'action'
                    }
                ],
            });



            $("#categoryModal").on("hidden.bs.modal", function() {
                $("#categoryform")[0].reset();
                $("#hid").val("");
                $("#categoryform").resetForm();
                $("#categoryform").find('.error').removeClass('error');
            });

            $("#categoryModal").on("hidden.bs.modal", function() {
                $("#categoryform")[0].reset();
                $("#hid").val("");
                $("#categoryform").resetForm();
                $("#categoryform").find('.error').removeClass('error');
            });



            $("#categoryform").submit(function() {
                    var formData = new FormData($("#categoryform")[0]);
                    $.ajax({
                        url: "{{ route('admin.category_save') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {
                    
                   
                            $('#categoryTable').DataTable().ajax.reload();

                        }
                    });
                }),


            $(document).on('click', '#addCategory', function() {
                $('#categoryModal').modal('show');
            });

            $(document).on('click', '#submit', function() {
                $('#categoryModal').modal('hide');
            });


            $(document).on('click', '.edit', function() {

                var editId = this.getAttribute('id');

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.edit_data') }}",
                    data: {
                        _token: $("[name='_token']").val(),
                        id: editId,
                    },
                    success: function(response) {
                        $('#categoryModal').modal('show');

                        var data = JSON.parse(response);
                        $('#hid').val(data.id);
                        $('#category').val(data.category);
                    },
                });
            });

            $(document).on('click', '.delete', function() {

                var deleteId = this.getAttribute('id');

                console.log(deleteId);

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.delete_data') }}",
                    data: {
                        _token: $("[name='_token']").val(),
                        id: deleteId
                    },
                    success: function(response) {
                        console.log('response:', response.res);
                        alert(response.res)
                        $('#categoryTable').DataTable().ajax.reload();



                    },
                });
            });

        });
    </script>
@endsection
