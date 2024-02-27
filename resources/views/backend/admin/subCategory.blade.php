@extends('backend.admin.layouts.index')
@section('admin-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 ps-5">SubCategory</h4>
    <div class="card p-2">
        <div class="row gy-3">
            <div>
                <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="addSubCategory">
                    Add SubCategory
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table pt-2 " id="subCategoryTable">
                    <thead class="table-light  mt-3">
                        <tr class="text-nowrap">
                            <th class="text-dark ">Id</th>
                            <th class="text-dark ">Category</th>
                            <th class="text-dark ">Sub Category</th>
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

@include('backend.admin.modals.subCategory');
@endsection

@section('admin-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

                // var headers = $('meta[name="csrf-token"]').attr('content');

                function subCategoryList() {
                    $('#subCategoryTable').dataTable({
                        searching: true,
                        paging: true,
                        pageLength: 10,

                        "ajax": {
                            url: "{{ route('admin.sub_category_list') }}",
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
                                data: 'sub_category'
                            },
                            {
                                data: 'image'
                            },
                            {
                                data: 'action'
                            }
                        ],
                    });
                }

                subCategoryList();

                $('form[id="subCategoryform"]').validate({
                        rules: {
                            name: "required",
                            subCategory: "required",
                        },
                        messages: {
                            name: 'This field is required',
                            subCategory: "Plz select Category",

                        },
                        submitHandler: function() {
                            var formData = new FormData($("#subCategoryform")[0]);
                            $.ajax({
                                url: "{{ route('admin.sub_category_save') }}",
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function(response) {
                                    console.log("We got response!");
                                    $('#subCategoryTable').DataTable().ajax.reload();
                                }
                            });
                        }})



                    $("#subCategoryModal").on("hidden.bs.modal", function() {
                        $("#subCategoryform")[0].reset();
                        $("#hid").val("");
                        $("#subCategoryform").resetForm();
                        $("#subCategoryform").find('.error').removeClass('error');
                    });

                    $("#subCategoryModal").on("hidden.bs.modal", function() {
                        $("#subCategoryform")[0].reset();
                        $("#hid").val("");
                        $("#subCategoryform").resetForm();
                        $("#subCategoryform").find('.error').removeClass('error');
                    });






                    $(document).on('click', '#addSubCategory', function() {
                        $('#subCategoryModal').modal('show');
                    });

                    $(document).on('click', '#submit', function() {
                        $('#subCategoryModal').modal('hide');
                    });



                    var categoryData = $.ajax({
                        type: "POST",
                        url: "{{ route('admin.category_data') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            var categoryOption = "";
                            categoryOption += '<option value="" selected disabled>' + "Please select role" +
                                '</option>'
                            for (let i = 0; i < response.length; i++) {
                                categoryOption += '<option value="' + response[i].id + '">' + response[i]
                                    .category + '</option>';
                            }
                            $("#category").html(categoryOption);
                        },
                    })


                    $(document).on('click', '.edit', function() {

                        var editId = this.getAttribute('data-id');


                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.edit_sub_category_data') }}",
                            data: {
                                _token: $("[name='_token']").val(),
                                id: editId,
                            },
                            success: function(response) {

                                $('#subCategoryModal').modal('show');

                                let finaldata = JSON.parse(response)

                                $('#hid').val(finaldata.id);
                                $('#category').val(finaldata.category);
                                $('#subCategory').val(finaldata.sub_category);
                            },
                        });
                    });



                    $(document).on('click', '.delete', function() {

                        var deleteId = this.getAttribute('data-id');

                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.delete_sub_category_data') }}",
                            data: {
                                _token: $("[name='_token']").val(),
                                id: deleteId
                            },
                            success: function(response) {
                                $('#subCategoryTable').DataTable().ajax.reload();

                                console.log('deleted');


                            },
                        });
                    });

                });
</script>
@endsection