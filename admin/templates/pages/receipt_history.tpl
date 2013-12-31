<table class="table">
    <thead>
    <tr>
        <td>Receiver Name</td>
        <td>Receiver Address</td>
        <td>Amount</td>
        <td>Transaction Date</td>
        <td>Note</td>
        <td>&nbsp;</td>
    </tr>
    </thead>
    <tbody>
    {foreach $transactions as $trans}
        <tr>
            <td>{$trans.name}</td>
            <td>{$trans.address}</td>
            <td>{math equation ="x/100000000" x=$trans.total}</td>
            <td>{$trans.transaction_date}</td>
            <td>{$trans.notes}</td>
            <td><a href="admin_dashboard?page=receipt_detail&item={$trans.id}&user={$user_id}">Detail</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
