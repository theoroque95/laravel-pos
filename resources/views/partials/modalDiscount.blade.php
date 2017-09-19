<div class="modal modal-info fade" id="modal-discount">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Apply a discount</h4>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <label for="discount-coupon">Discount</label>
          <select class="form-control select2" style="width: 100%;" id="discount-coupon">
            <option selected="selected">- Select Discount -</option>
            @foreach ($discounts as $discount)
                <option value="{{ $discount->id }}" percentage="{{ $discount->percentage }}" class="{{ $discount->name }}">{{ ucfirst($discount->name) }} ({{ $discount->percentage }}%)</option>
            @endforeach
          </select>

          <div class="alert alert-dismissible" id="void-notif" style="margin-top:5px; display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <span id="void-notif-message"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline" onclick="applyDiscount()">Apply
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>