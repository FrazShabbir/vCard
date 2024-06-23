<form action="{{ route('user.product.update', $product->slug) }}" method="POST">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-3">
                    <label for="name" class="required">Name</label>
                    <input type="text" required class="form-control required" id="name" name="name"
                        placeholder="Product Name" value="{{ $product->name }}">
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="original_price" class="required">Original Price</label>
                    <input type="text" required class="form-control required" id="original_price"
                        name="original_price" placeholder="200" value="{{ $product->original_price }}">
                </div>

                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="sale_price" class="required">Sale price</label>
                    <input type="text" required class="form-control required" id="sale_price" name="sale_price"
                        placeholder="200" value="{{ $product->sale_price }}">
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-3">
                    <label for="description" class="required">Description</label>
                    <textarea required class="form-control required" id="description" name="description" placeholder="Description...">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-3">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Choose Product Image</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
    </div>
</form>
