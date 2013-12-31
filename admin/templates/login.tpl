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
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
</form>
{include file="blocks/footer.tpl"}
