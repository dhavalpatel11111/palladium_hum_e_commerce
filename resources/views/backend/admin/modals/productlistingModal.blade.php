<div class="modal fade" id="productlistingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" onsubmit="return false" id="productistingForm">
                    <div class="mb-3">
                        <input type="hidden" name="allimg" id="allimg" value="">
                        <input type="hidden" name="hid" id="hid" value=" ">
                        <input type="hidden" name="folder" id="folder" value=" ">
                        <input type="hidden" name="ei" id="ei" value=" ">

                        @csrf
                        <label for="productName" class="p-1">Product Name</label>

                        <input type="text" class="form-control" id="productName" placeholder="Product Name"
                            name="productName">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="p-1">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description"
                            name="description">
                    </div>

                    <div class="mb-3">
                        <label for="product_brief" class="p-1">Product Brief Description</label>
                        <textarea class="form-control" rows="4" cols="50" id="product_brief"
                            placeholder="Description of the product..." name="product_brief"></textarea>

                    </div>

                    <div class="mb-3">
                        <label class="sr-only p-1" for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="price" placeholder="Price"
                                name="price">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="sr-only p-1" for="discount_price">Discount Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" id="discount_price" placeholder="Discount Price"
                                name="discount_price">
                        </div>
                    </div>

                    
                    
                    <div class="mb-3">
                        <label class="sr-only p-1" for="category">Category</label>
                        
                        <select class="form-select" id="category" name="category">
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="sr-only p-1" for="subCategory">Sub Category</label>
                        
                        <select class="form-select" id="subCategory" name="subCategory">
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantity" class="p-1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantity"
                        name="quantity">
                    </div>
                    
                    <div id="dropzoneDragArea" class="dropzone mb-5 rounded">
                        <div class="dz-message"><span>Drop files here or click to upload.</span></div>
                        <div class="dropzone-previews"></div>
                    </div>
                    <div class="imglist" id="dropzoneImg">
                    
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
