{include file="blocks/header.tpl"}
<form class="form-signin" method="post" action="login">
    {if $site_error != ''}
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {$site_error}
        </div>
    {/if}
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="text" class="input-block-level" placeholder="Email address" name="loginEmail">
    <input type="password" class="input-block-level" placeholder="Password" name="loginPassword">
    <label class="checkbox">
        <input type="checkbox" value="1" name="remember_me"> Remember me
    </label>
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
    <a class="pull-right" href="forgot_password">Forgot Password</a>
</form>
{include file="blocks/footer.tpl"}
