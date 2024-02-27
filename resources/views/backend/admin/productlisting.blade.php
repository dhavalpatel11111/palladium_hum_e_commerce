@extends('backend.admin.layouts.index')
@section('admin-content')
<style>
    .imglist {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
        flex-wrap: wrap;
    }

    .image {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
        margin: 27px;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 ps-5">Category</h4>
    <div class="card p-2 ms-3" style="width: 1225px;">
        <div class="row gy-3">
            <div>
                <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="listProduct">
                    Add Product
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table pt-2 " id="productlistingTable">
                    <thead class="table-light  mt-3">
                        <tr class="text-nowrap">
                            <th class="text-dark ">Id</th>
                            <th class="text-dark ">Product Name</th>
                            <th class="text-dark ">Description</th>
                            <th class="text-dark ">Discount Price</th>
                            <th class="text-dark ">Product Brief</th>
                            <th class="text-dark ">Price</th>
                            <th class="text-dark ">Category</th>
                            <th class="text-dark ">SubCategory</th>
                            <th class="text-dark ">Quantity</th>
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

@include('backend.admin.modals.productlistingModal');
@endsection

@section('admin-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {

        $(document).on('click', '#listProduct', function() {
            $('#productlistingModal').modal('show');
        });


        var headers = $('meta[name="csrf-token"]').attr('content');

        $(function() {
            var headers = $('meta[name="csrf-token"]').attr('content');

            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('admin.productlistingImg') }}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                maxFileSize: 24,
                addRemoveLinks: true,
                uploadMultiple: true,
                parallelUploads: 10,
                maxFiles: 24,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function() {
                    this.on('dz_complete', function(file) {
                        $('.dz-preview').remove();
                    })

                    this.on("addedfile", function(file) {
                        var dropzone = this;
                        clearDropzone = function() {
                            dropzone.removeAllFiles(true);
                        };

                    });
                    this.on("removedfile", function(file) {
                        file.previewElement.remove();
                    });

                    this.on('sending', function(file, xhr, formData) {
                        let hidden_id = $('#hid').val();
                        formData.append("id", hidden_id)
                    });

                    this.on("successmultiple", function(file,
                        responseText) {
                        let dropzoneImg = responseText.allimg

                        let dropzoneImgfinal = dropzoneImg;

                        let editImg = $("#allimg").val();

                        $('#folder').val(responseText.tempFolder);

                        let editImgLength = editImg.length;

                        // hidden Img set condition

                        if (editImgLength > 1) {
                            $('#allimg').val(dropzoneImg + ',' +
                                editImg);
                        } else {
                            $('#allimg').val(dropzoneImg);

                        }

                        console.log('tempFolder', responseText.tempFolder);


                        // removeButtonDZ()

                    });

                    // function removeButtonDZ(tempFolder) {
                    // this.on('removedfile', function(file) {
                    // $folder = $('#folder').val()

                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{ route('admin.removeButtonDZ') }}",
                    //     headers: {
                    //         'X-CSRF-TOKEN': $(
                    //                 'meta[name="csrf-token"]')
                    //             .attr('content')
                    //     },
                    //     data: {
                    //         target_file: file.name,
                    //         type: "removeButtonDZ"
                    //     }
                    // });

                    // console.log('tempFolder', tempFolder);

                    // });
                    $(document).on('hidden.bs.modal', '.modal', function() {
                        myDropzone.removeAllFiles(
                            true);
                    });

                }

            })
        });








        var categoryData = $.ajax({
            type: "POST",
            url: "{{ route('admin.category_data') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var categoryOption = "";
                categoryOption += '<option value="" selected disabled>' +
                    "Please select role" +
                    '</option>'
                for (let i = 0; i < response.length; i++) {
                    categoryOption += '<option value="' + response[i].id +
                        '">' + response[
                            i]
                        .category + '</option>';
                }
                $("#category").html(categoryOption);
            },
        })


        $(document).on("change", "#category", function() {
            var categoryid = $(this).val();
            $.ajax({

                data: {
                    categoryid: categoryid
                },
                url: "{{ route('admin.sub_category_data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var subCategoryOption = "";

                    subCategoryOption +=
                        '<option value="" selected disabled>' +
                        "Please select role" +
                        '</option>'

                    for (let i = 0; i < response.length; i++) {
                        subCategoryOption += '<option value="' + response[i]
                            .id + '">' +
                            response[i].sub_category + '</option>';
                    }
                    $("#subCategory").html(subCategoryOption);
                }
            });

        });



        let hiddenImg = $("#allimg").val();

        console.log('hiddenImg', hiddenImg.length);


        $("#productistingForm").submit(function() {
            var formData = new FormData($("#productistingForm")[0]);
            $.ajax({
                url: "{{ route('admin.productlisting_save') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    $('#productistingForm').trigger('reset');
                    $("#dropzoneImg").html('');
                    $("#dropzone-previews").html('');
                    table.ajax.reload();
                    $('#productlistingModal').modal('hide');
                }
            });
        })




        var table = $('#productlistingTable').DataTable({
            searching: true,
            paging: true,
            pageLength: 10,
            ajax: {
                url: "{{ route('admin.productlisting_listing') }}",
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'product_name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'discount_price'
                },
                {
                    data: 'product_brief'
                },
                {
                    data: 'price'
                },
                {
                    data: 'category'
                },
                {
                    data: 'sub_category'
                },
                {
                    data: 'quantity'
                },
                {
                    data: 'action'
                }
            ]

        });


        $("#productlistingModal").on("hidden.bs.modal", function() {
            $("#productistingForm")[0].reset();
            $("#hid").val("");
            $("#productistingForm").trigger('reset');
            $("#productistingForm").find('.error').removeClass('error');
            $('#allimg').val('');
            $('#dropzoneImg').append('');
            $("#dropzoneImg").html('');
            $("#dropzone-previews").html('');
            table.ajax.reload();
        });


        $(document).on('click', '.edit', function() {
            let editId = this.getAttribute('id');

            $.ajax({
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'editId': editId
                },
                url: "{{ route('admin.productlisting_edit') }}",
                success: function(data) {

                    let singleproductListingData = data[
                        'singleproductListingData'];

                    let dropzoneWithData = data['dropzoneWithData']


                    let dropzoneWithimgArray = data['imgArray'];


                    $('#allimg').val(dropzoneWithimgArray);
                    $('#dropzoneImg').append(dropzoneWithData);

                    $('#hid').val(singleproductListingData.id);
                    $('#category').val(singleproductListingData.category);
                    $('#description').val(singleproductListingData
                        .description);
                    $('#discount_price').val(singleproductListingData
                        .discount_price);
                    $('#price').val(singleproductListingData.price);
                    $('#product_brief').val(singleproductListingData
                        .product_brief);
                    $('#productName').val(singleproductListingData
                        .product_name);
                    $('#quantity').val(singleproductListingData.quantity);
                    $('#subCategory').val(singleproductListingData
                        .sub_category);

                    $('#productlistingModal').modal('show');
                },
                error: function(e) {
                    console.log("error", e);
                }

            })

        })


        $(document).on('click', '.delete_img', function() {
            let imageName = this.getAttribute('data-image');
            let delId = this.getAttribute('data-id');

            $(this).parent().hide()

            $.ajax({
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'deleteDropzoneImageId': delId,
                    'deleteDropzoneImageName': imageName,
                },
                url: "{{ route('dropzone.delete') }}",
                success: function(data) {

                    let hidden_img_val = $('#allimg').val();



                    var newImageArr = hidden_img_val.split(",");



                    let arraycontainsImgIndex = (newImageArr.indexOf(
                        imageName));


                    newImageArr.splice(arraycontainsImgIndex, 1)


                    $('#allimg').val(newImageArr);


                    table.ajax.reload();
                },
                error: function(e) {
                    console.log("error", e);
                }

            })

        })


        $(document).on('click', '.delete', function() {

            var deleteId = this.getAttribute('id');

            $.ajax({
                type: "post",
                url: "{{ route('admin.productlisting_delete') }}",
                data: {
                    _token: $("[name='_token']").val(),
                    deleteId: deleteId
                },
                success: function(response) {
                    table.ajax.reload();

                },
            });
        });

    });
</script>
@endsection