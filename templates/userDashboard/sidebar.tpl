<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <li class="nav-header">User Dashboard</li>
        <li class="{if $page =='profile'}active{/if}"><a href="user_dashboard?page=profile">Profile</a></li>
        <li class="{if $page =='settings'}active{/if}"><a href="user_dashboard?page=settings">Account Settings</a></li>
        <li class="{if $page =='wallet'}active{/if}"><a href="user_dashboard?page=wallet">Wallet</a></li>
        <li class="divider"></li>
        <li class="nav-header">Receipt</li>
        <li class="{if $page =='receipt'}active{/if}"><a href="user_dashboard?page=receipt">Create Receipt</a></li>
        <li class="{if $page =='receipt_history'}active{/if}"><a href="user_dashboard?page=receipt_history">Receipt History</a></li>
    </ul>
</div>
