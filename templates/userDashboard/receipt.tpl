<div class="container-fluid">
    <form id="bitform" class="form-horizontal" action="user_dashboard" method="post">
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
                {include file="../blocks/receive_block.tpl"}
            </div>
        </div>
        {include file="../blocks/note.tpl"}
    </form>
</div>
