<table class="table">
    <thead>
    <tr>
        <td>Username</td>
        <td>Action</td>
        <td>IP Address</td>
        <td>Time</td>
    </tr>
    </thead>
    <tbody>
    {foreach $history as $row}
        <tr>
            <td>{$row.username}</td>
            <td>{$row.action}</td>
            <td>{$row.ip_address}</td>
            <td>{$row.time}</td>
        </tr>
    {/foreach}
    </tbody>
</table>
