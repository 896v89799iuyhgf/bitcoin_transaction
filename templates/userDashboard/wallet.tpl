<form class="form-horizontal" method="post" action="user_dashboard">
    <table class="table">
        <thead>
        <tr>
            <th>Wallet ID</th>
            <th>Wallet Password</th>
        </tr>
        </thead>
        <tbody>
        {if $wallets}
            {foreach $wallets as $wallet}
                <tr class="wallet_row">
                    <input type="hidden" class="wallet_id" name="walletID[]" value="{if isset($wallet.wallet_id)}{$wallet.wallet_id}{else}0{/if}">
                    <td><input type="text" name="walletAddress[]" placeholder="Wallet Id" value="{$wallet.address}"></td>
                    <td><input type="text" name="walletPassword[]" placeholder="Password" value="{$wallet.password}"></td>
                    <td><input type="button" class="btn btn-primary delete_wallet" value="Delete"></td>
                </tr>
            {/foreach}
        {else}
            <tr class="wallet_row">
                <input type="hidden" class="wallet_id" name="walletID[]" value="0">
                <td><input type="text" name="walletAddress[]" placeholder="Wallet Id" value=""></td>
                <td><input type="text" name="walletPassword[]" placeholder="Password" value=""></td>
                <td><input type="button" class="btn btn-primary delete_wallet" value="Delete"></td>
            </tr>
        {/if}
        <tr>
            <td colspan="3">
                <input type="hidden" name="saveWallet" value="1">
                <input type="button" class="btn btn-primary add_wallet" value="Add">
                <button type="submit" class="btn">Save</button>
            </td>
        </tr>
        </tbody>
    </table>
</form>
