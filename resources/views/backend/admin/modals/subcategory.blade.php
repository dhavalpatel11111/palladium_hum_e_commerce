<div class="modal fade" id="subCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="subCategoryform" name="subCategoryform">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>


             
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="category"
                                name="category">
                            </select>
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">subCategory</label>
                        <div class="col-sm-10">
                            <input type="text" name="subCategory" id="subCategory" class="form-control">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image"
                            placeholder="Enter Image">
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10 justify-content-end d-flex">
                            <button type="submit" id="submit" class="btn btn-primary float-right w-25">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
