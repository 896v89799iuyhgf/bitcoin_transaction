<form id="settingForm" class="form-horizontal" method="post" action="user_dashboard">
    {if $site_error != ''}
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {$site_error}
        </div>
    {/if}
    <div class="control-group">
        <label class="control-label" for="settingEmail">Email</label>

        <div class="controls">
            <input type="text" name="settingEmail" id="settingEmail" placeholder="Email" value="{$settings.email}" required>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="settingOldPassword">Current Password</label>

        <div class="controls">
            <input type="password" name="settingOldPassword" id="settingOldPassword" required>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="settingPassword">New Password</label>

        <div class="controls">
            <input type="password" name="settingPassword" id="settingPassword" required>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="settingPhone">Phone Number</label>

        <div class="controls">
            <input type="text" name="settingPhone" id="settingPhone" placeholder="Phone Number" value="{$settings.phone}" required>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Save</button>
            <input type="hidden" value="1" name="saveSetting">
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#settingForm').validate({
        rules: {
            'settingEmail' : {
                required: true
            },
            'settingPassword' : {
                required: true
            },
            'settingPhone' : {
                required: true,
                number: true
            }
        }
    });
</script>
