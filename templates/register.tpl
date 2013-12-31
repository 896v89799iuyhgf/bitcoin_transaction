{include file="blocks/header.tpl"}
<form class="form-horizontal form-register" method="post" action="register">
    {if $site_error != ''}
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {$site_error}
        </div>
    {/if}
    <div class="control-group">
        <label class="control-label" for="registerUsername">Username</label>
        <div class="controls">
            <input type="text" name="registerUsername" id="registerUsername" placeholder="Username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerPassword">Password</label>
        <div class="controls">
            <input type="password" name="registerPassword" id="registerPassword" placeholder="Password">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerEmail">Email</label>
        <div class="controls">
            <input type="text" name="registerEmail" id="registerEmail" placeholder="Email">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerPhoneNumber">Phone Number</label>
        <div class="controls">
            <input type="text" name="registerPhoneNumber" id="registerPhoneNumber" placeholder="Phone Number">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            {$key}
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Register</button>
        </div>
    </div>
</form>
{include file="blocks/footer.tpl"}
