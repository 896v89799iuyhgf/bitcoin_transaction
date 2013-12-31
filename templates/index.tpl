{*{config_load file="test.conf" section="setup"}*}
{include file="blocks/header.tpl" title=foo}
<div class="container-fluid">
    <form id="bitform" class="form-horizontal" action="process" method="post">
        {if $site_error != ''}
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {$site_error}
            </div>
        {/if}
        <input type="hidden" name="send_bitcoin" value="1">
        <div class="row-fluid">
            <div class="span6">
                {*From Section*}
                {include file="blocks/sender_block.tpl"}
            </div>
            <div class="span6">
                {*To Section*}
                {include file="blocks/receive_block.tpl"}
            </div>
        </div>
        {include file="blocks/note.tpl"}
    </form>
</div>
{include file="blocks/footer.tpl"}
