{include file="blocks/header.tpl"}
<div class="row-fluid">
    <div class="span2">
        {include file='pages/sidebar.tpl'}
    </div>
    <div class="span10">
        <div class="well">
            {include file="pages/$page.tpl"}
        </div>
    </div>
</div>
{include file="blocks/footer.tpl"}
