<div class="modal modal-success fade" id="modal-replenish">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Replenish Stocks</h4>
      </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="quantity">Add Quantity in <strong><span id="modal-acronym"></span></strong></label>
            <input type="text" class="form-control" id="modal-quantity" placeholder="e.g. 1000" value="{{ old('quantity') }}" name="quantity" required="true">
          </div>

          <div class="alert alert-danger alert-dismissible" id="modal-error" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <div><strong>Error! </strong><span id="modal-error-message"></span></div>
          </div>

          <input type="hidden" name="id" id="modal-id">
          {{ csrf_field() }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-default" onclick="replenish()">Confirm</button>
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>