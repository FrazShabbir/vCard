<div class="modal-header">
    <h5 class="modal-title">Modal title</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<form action="{{ route('address.update') }}" method="POST">
    <div class="modal-body">
        <input type="hidden" name="address_id"  value="{{ $address->id }}">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="street_one">Street Address*</label>
                <input type="text" class="form-control" name="street_one" placeholder="e.g. Google"
                    value="{{ $address->street_one }}" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="street_two">Street Address two</label>
                <input type="text" class="form-control" name="street_two" placeholder="e.g. Google"
                    value="{{ $address->street_two }}">
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="flat_no">Flat No*</label>
                <input type="text" class="form-control" name="flat_no" placeholder="e.g. 12"
                    value="{{ $address->flat_no }}" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="phone">phone*</label>
                <input type="text" class="form-control" name="phone" placeholder="e.g. 92312345678"
                    value="{{ $address->phone }}" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="postal_code">postal_code*</label>
                <input type="text" class="form-control" name="postal_code" placeholder="e.g. 92312345678"
                    value="{{ $address->postal_code }}" required>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="country_id">Country*</label>
                <select name="country_id" id="country_id" class="form-control" required>
                   <option value="{{ $address->country_id }}" selected>{{ $address->country?->name }}</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="state_id">State*</label>
                <select name="state_id" id="state_id" class="form-control" required>
                    <option value="{{ $address->state_id }}" selected>{{ $address->state?->name }}</option>

                </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="city_id">City*</label>
                <select name="city_id" id="city_id" class="form-control" required>
                    <option value="{{ $address->city_id }}" selected>{{ $address->city?->name }}</option>

                </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="address_type">Address Type</label>
                <select name="address_type" id="address_type" class="form-control" required>
                    <option value="home" {{ $address->address_type == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="office" {{ $address->address_type == 'office' ? 'selected' : '' }}>Office</option>
                    <option value="other" {{ $address->address_type == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="is_primary">Make Primary</label>
                <select name="is_primary" id="is_primary" class="form-control" required>
                    <option value="1" {{ $address->is_primary == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $address->is_primary == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="col-md-12 col-sm-12 mb-3">
                <label for="additional_info">Additional Info</label>
                <input type="text" class="form-control" name="additional_info" placeholder="e.g. Any additional info"
                    value="{{ $address->additional_info }}">
            </div>
        </div>





    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
