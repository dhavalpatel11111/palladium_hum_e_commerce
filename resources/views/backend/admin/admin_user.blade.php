@extends('backend.admin.layouts.index')
@section('admin-content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 ps-5">User</h4>
    <div class="card p-2 ms-3" style="width: 1225px;">
        <div class="row gy-3">
            <div>
                <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="user_modalbtn">
                    Add User
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table pt-2 " id="usertable">
                    <thead class="table-light  mt-3">
                        <tr class="text-nowrap">
                            <th class="text-dark">No</th>
                            <th class="text-dark">Name</th>
                            <th class="text-dark">E-mail</th>
                            <th class="text-dark">Password</th>
                            <th class="text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AdduserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="AddUser_from" onsubmit="return false;">

                    @csrf
                    <div class="mb-3">
                        <label for="name" class="p-1"> Name</label>
                        <input type="hidden" name="hid" id="hid">
                        <input type="text" class="form-control" id="name" placeholder=" Name" name="name">
                    </div>



                    <div class="mb-3">
                        <label for="email" class="p-1">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="p-1">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        <div class="showPass" id="showPass">
                            <a id="passbtnshow"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                </svg></a>

                            <a id="passbtnhide">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                    <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                                </svg>
                            </a>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit"> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@section('admin-footer')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

        $("#passbtnhide").hide()

        $(document).on("click", "#passbtnshow", function() {
            $("#password").attr("type", "text");
            $("#passbtnshow").hide()
            $("#passbtnhide").show()
        })

        $(document).on("click", "#passbtnhide", function() {
            $("#password").attr("type", "password");
            $("#passbtnshow").show()
            $("#passbtnhide").hide()
        })

        $("#AdduserModal").on("hidden.bs.modal", function() {
            $("#AddUser_from")[0].reset();
            $("#hid").val("");
            $("#AddUser_from").validate().resetForm();
        });

        $("#user_modalbtn").on("click", function() {
            $('#AdduserModal').modal('show');
        })

        $(document).on('click', '#submit', function() {
            $('#AdduserModal').modal('hide');
        });

        $('form[id="AddUser_from"]').validate({
            rules: {
                name: "required",
                email: "required",
                password: "required",
            },
            messages: {
                name: 'This field is required',
                email: 'This field is required',
                password: 'This field is required',
            },
            submitHandler: function() {
                var formData = new FormData($("#AddUser_from")[0]);
                $.ajax({
                    url: "/admin/Add_user",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        $('#usertable').DataTable().ajax.reload();
                    }
                });
            },
        });

        var headers = $('meta[name="csrf-token"]').attr('content');
        let list = $('#usertable').dataTable({
            searching: true,
            paging: true,
            pageLength: 10,
            "ajax": {
                url: "/admin/user_list",
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
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'password'
                },
                {
                    data: 'action',
                }
            ],
        });

        $(document).on('click', '.edit', function() {
            var editId = this.getAttribute('id');
            $.ajax({
                type: "post",
                url: "/admin/edit_user",
                data: {
                    _token: $("[name='_token']").val(),
                    id: editId,
                },
                success: function(response) {
                    $('#AdduserModal').modal('show');
                    var data = JSON.parse(response);
                    $('#hid').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                },
            });
        });

        $(document).on('click', '.delete', function() {
            var deleteId = this.getAttribute('id');
            $.ajax({
                type: "post",
                url: "/admin/delete_user",
                data: {
                    _token: $("[name='_token']").val(),
                    id: deleteId
                },
                success: function(response) {
                    $('#usertable').DataTable().ajax.reload();
                },
            });
        });

    })
</script>

@endsection
@endsection