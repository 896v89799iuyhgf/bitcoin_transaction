<table class="table">
    <thead>
    <tr>
        <td><h3 class="text-center">From</h3></td>
        <td><h3 class="text-center">To</h3></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2">
            <a target="_blank" class="pull-left" href="{$short_code}">Receipt URL Address</a>
            {literal}
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style pull-right">
                    <a class="addthis_button_preferred_1"></a>
                    <a class="addthis_button_preferred_2"></a>
                    <a class="addthis_button_preferred_3"></a>
                    <a class="addthis_button_preferred_4"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script>
                <script type="text/javascript"
                        src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e3b96c90bb96cd7"></script>
                <!-- AddThis Button END -->
            {/literal}
        </td>
    </tr>
    <tr>
        <td>
            <dl class="dl-horizontal">
                <dt>Date of Transaction</dt>
                <dd>{$trans.transaction_date}</dd>
                <dt>Total Bitcoins</dt>
                <dd>{$trans.total}</dd>
            </dl>
        </td>
        <td>
            <dl class="dl-horizontal">
                <dt>Status</dt>
                <dd>{if $trans.transaction_hash != ''}Completed{/if}</dd>
                <dt>Confirmation link</dt>
                <dd><a target="_blank" href="https://blockchain.info/tx/{$trans.transaction_hash}">Blockchain
                        Confirmation Link</a></dd>
            </dl>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="text-center">Sender</h4>
            <dl class="dl-horizontal">
                <dt>Wallet Id</dt>
                <dd>{$trans.sender_wallet}</dd>
                <dt>Name</dt>
                <dd>{$user.name}</dd>
                <dt>Address</dt>
                <dd>{$user.address}</dd>
                <dt>State</dt>
                <dd>{$user.state}</dd>
                <dt>City</dt>
                <dd>{$user.city}</dd>
                <dt>Zip/postal code</dt>
                <dd>{$user.zip_code}</dd>
                <dt>Country</dt>
                <dd>{$user.country}</dd>
            </dl>
        </td>
        <td>
            <h4 class="text-center">Receiver</h4>
            <dl class="dl-horizontal">
                <dt>Wallet Id</dt>
                <dd>{$trans.wallet_id}</dd>
                <dt>Name</dt>
                <dd>{$trans.name}</dd>
                <dt>Address</dt>
                <dd>{$trans.address}</dd>
                <dt>State</dt>
                <dd>{$trans.state}dd>
                <dt>City</dt>
                <dd>{$trans.city}</dd>
                <dt>Zip/postal code</dt>
                <dd>{$trans.zip_code}</dd>
                <dt>Country</dt>
                <dd>{$trans.country}</dd>
            </dl>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <dl class="dl-horizontal">
                <dt>Reason for Payment</dt>
                <dd>{$trans.payment_reason}</dd>
                <dt>Order Number</dt>
                <dd>{$trans.order_number}</dd>
                <dt>Notes</dt>
                <dd>{$trans.notes}</dd>
            </dl>
        </td>
    </tr>
    </tbody>
</table>
