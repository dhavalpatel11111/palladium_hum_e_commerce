<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="categoryform" name="categoryform">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Category</label>
                        <div class="col-sm-10">
                            <input type="text" name="category" id="category" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" id="image" placeholder="Enter Image">
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10 justify-content-end d-flex">
                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;"  data-bs-dismiss="modal">Close</button>

                            <button type="submit" id="submit" class="btn btn-primary float-right w-25">Save</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>