<table class="table">
    <thead>
        <tr>
            <td>User ID</td>
            <td>Email</td>
            <td>User Name</td>
            <td>Status</td>
            <td>Group</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
    {foreach $users as $user}
        <tr>
            <td>{$user.id}</td>
            <td>{$user.email}</td>
            <td>{$user.username}</td>
            <td>
                {if $user.status == 0}Disabled{elseif $user.status == 2}Blocked{else}Enabled{/if}
            </td>
            <td>{$user.user_group}</td>
            <td><a href="?page=user_edit&user={$user.id}" class="btn btn-info">Edit</a></td>
            <td><a href="?page=ip_history&user={$user.id}" class="btn btn-info">IP History</a></td>
            <td><a href="?page=receipt_history&user={$user.id}" class="btn btn-info">Receipt History</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
