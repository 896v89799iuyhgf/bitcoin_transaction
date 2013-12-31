<fieldset>
    <legend>From</legend>
    <div class="control-group">
        <label class="control-label" for="senderWallet">Sender Wallet Id</label>

        <div class="controls">
            <select name="sender[Wallet]" id="senderWallet">
                {foreach $wallets as $wallet}
                    <option value="{$wallet.wallet_id}">{$wallet.address}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="amount">Bitcoin Amount</label>

        <div class="controls">
            <input type="text" name="amount" id="amount" placeholder="Bitcoin Amount">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderName">Sender Name</label>

        <div class="controls">
            <input type="text" name="sender[Name]" id="senderName" placeholder="Sender Name" value="{$user.name}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderAddress">Sender Address</label>

        <div class="controls">
            <input type="text" name="sender[Address]" id="senderAddress" placeholder="Address" value="{$user.address}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderCity">Sender City</label>

        <div class="controls">
            <input type="text" name="sender[City]" id="senderCity" placeholder="City" value="{$user.city}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderState">Sender State</label>

        <div class="controls">
            <input type="text" name="sender[State]" id="senderState" placeholder="State" value="{$user.state}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderPostal">Sender Zip/Postal Code</label>

        <div class="controls">
            <input type="text" name="sender[Postal]" id="senderPostal" placeholder="Zip/Postal Code" maxlength="5" value="{$user.zip_code}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="senderCountry">Sender Country</label>

        <div class="controls">
            <input type="text" name="sender[Country]" id="senderCountry" placeholder="Country" value="{$user.country}">
        </div>
    </div>
</fieldset>
