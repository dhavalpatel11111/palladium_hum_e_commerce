@extends('backend.admin.layouts.index')
@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Category</h4>
        <div class="card p-2">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
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
                        data: 'action'
                    }
                ],
            });






            // teamList();

            $("#categoryModal").on("hidden.bs.modal", function() {
                $("#categoryform")[0].reset();
                $("#hid").val("");
                $("#categoryform").validate().resetForm();
                $("#categoryform").find('.error').removeClass('error');
            });

            $("#categoryModal").on("hidden.bs.modal", function() {
                $("#categoryform")[0].reset();
                $("#hid").val("");
                $("#categoryform").validate().resetForm();
                $("#categoryform").find('.error').removeClass('error');
            });



            $('form[id="categoryform"]').validate({

                rules: {
                    name: "required",
                },
                messages: {
                    name: 'This field is required',

                },
                submitHandler: function() {
                    var formData = new FormData($("#categoryform")[0]);
                    $.ajax({
                        url: "{{ route('admin.category_save') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {
                            console.log("We got response!");
                            $('#categoryTable').DataTable().ajax.reload();

                        }
                    });
                },
            });


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
                        $('#categoryTable').DataTable().ajax.reload();

                        console.log('deleted');


                    },
                });
            });

        });
    </script>
@endsection
