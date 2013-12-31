<div class="row-fluid">
    <div class="span12">
        <hr>
        <div class="control-group">
            <label class="control-label" for="idReason">Reason for Payment</label>

            <div class="controls">
                <input type="text" name="payment_reason" id="idReason" placeholder="Reason for Payment" class="span12">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="idOrderNumber">Reference/Order Number</label>

            <div class="controls">
                <input type="text" name="order_number" id="idOrderNumber" placeholder="Reference/Order Number" class="span12">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="idNotes">Notes</label>

            <div class="controls">
                <textarea name="notes" rows="5" id="idNotes" class="span12"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Send</button>
                <input type="hidden" name="saveReceipt" value="1">
            </div>
        </div>
    </div>
</div>
