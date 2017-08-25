<div class="modal modal-info fade" id="modal-cashier">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Finalize Transaction</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to finalize this transaction?</p>
        <p><strong>Total: </strong>&#8369;<span id="modal-total"></span></p>
        <label for="modal-tendered">Add Cash</label>
        <input type="number" class="form-control" id="modal-tendered" placeholder="e.g. 1000" name="tendered" required="true">
        <div class="alert alert-danger alert-dismissible" id="payment-error" style="margin-top:5px; display: none">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span id="payment-error-message"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline" onclick="confirmTransaction()">Confirm
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>