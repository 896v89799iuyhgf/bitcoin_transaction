<form class="form-horizontal" method="post" action="user_dashboard">
    <div class="control-group">
        <label class="control-label" for="profileName">Name</label>
        <div class="controls">
            <input type="text" name="profileName" id="profileName" placeholder="Name" value="{$user.name}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="profileAddress">Address</label>
        <div class="controls">
            <input type="text" name="profileAddress" id="profileAddress" placeholder="Address" value="{$user.address}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="profileCity">City</label>
        <div class="controls">
            <input type="text" name="profileCity" id="profileCity" placeholder="City" value="{$user.city}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="profileState">State</label>
        <div class="controls">
            <input type="text" name="profileState" id="profileState" placeholder="State" value="{$user.state}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="profileZipCode">Zip/Postal Code</label>
        <div class="controls">
            <input type="text" name="profileZipCode" id="profileZipCode" placeholder="Zip/Postal Code" value="{$user.zip_code}" maxlength="5">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="profileCountry">Country</label>
        <div class="controls">
            <input type="text" name="profileCountry" id="profileCountry" placeholder="Country" value="{$user.country}">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Save</button>
            <input type="hidden" name="saveProfile" value="{if $user === false}insert{else}update{/if}">
        </div>
    </div>
</form>
