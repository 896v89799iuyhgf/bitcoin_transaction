<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <li class="nav-header">Admin Panel</li>
        <li class="{if $page =='main' || $page =='ip_history'}active{/if}"><a href="admin_dashboard?page=main">Users</a></li>
        <li class="{if $page =='add_user'}active{/if}"><a href="admin_dashboard?page=add_user">Add User</a></li>
        <li class="divider"></li>
        <li class="nav-header">Fees</li>
        <li class="{if $page =='set_fee'}active{/if}"><a href="admin_dashboard?page=set_fee">Set Fee</a></li>
    </ul>
</div>
