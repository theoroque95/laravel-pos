<div class="modal modal-danger fade" id="modal-void">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Finalize Transaction</h4>
      </div>
      <div class="modal-body">
        <p>If you wish to void a sale, kindly input the required fields below:</p>
          {{ csrf_field() }}
          <label for="modal-orderno">Order No.</label>
          <input type="text" class="form-control" id="modal-orderno" placeholder="Enter Order #" name="orderNumber" required="true">
          <label for="modal-password">Admin Password</label>
          <input type="password" class="form-control" id="modal-password" placeholder="Enter Admin Password" name="password" required="true">

          <div class="alert alert-dismissible" id="void-notif" style="margin-top:5px; display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <span id="void-notif-message"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline" onclick="voidSale()">Void
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>