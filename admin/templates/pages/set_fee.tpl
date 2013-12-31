<form class="form-horizontal" method="post" action="admin_dashboard">
    <div class="control-group">
        <label class="control-label" for="fees">Fee</label>

        <div class="controls">
            <input type="text" name="fees" id="fees" placeholder="Bitcoin Fee" value="{$fee.fee}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="fees">Fee Address</label>

        <div class="controls">
            <input type="text" name="fee_address" id="fee_address" placeholder="Bitcoin Address" value="{$fee.fee_address}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="fees">Type</label>

        <div class="controls">
            <select name="fee_type">
                <option {if $fee.fee_type == p}selected="selected"{/if} value="p">Percent</option>
                <option {if $fee.fee_type == n}selected="selected"{/if} value="n">BTC</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Save</button>
            <input type="hidden" name="updateFee" value="1">
        </div>
    </div>
</form>
