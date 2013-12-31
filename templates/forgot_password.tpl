{include file="blocks/header.tpl"}
<form class="form-horizontal form-forgot" method="post" action="forgot_password">
    {if $inform != ''}
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {$inform}
        </div>
    {/if}
    <div class="control-group">
        <label class="control-label" for="forgotEmail">Please enter your email</label>
        <div class="controls">
            <input type="text" name="forgotEmail" id="forgotEmail" placeholder="Email">
        </div>
    </div><div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Send</button>
        </div>
    </div>
    </form>
{include file="blocks/footer.tpl"}
