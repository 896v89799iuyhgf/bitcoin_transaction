</div>
<div id="footer">
    <div class="container" style="padding: 10px">
        <p class="muted credit">{$dayNumber.Counts} receipts and {if isset($dayNumber.Total)}{$dayNumber.Total}{else}0{/if} of bitcoin exchanged today. </p>
        <p class="muted credit">{$weekNumber.Counts} Total Nuimber of receipts and {if isset($weekNumber.Total)}{$weekNumber.Total}{else}0{/if} of bitcoin exchange this week</p>
        <p class="muted credit">{$monthNumber.Counts} of receipts and {if isset($monthNumber.Total)}{$monthNumber.Total}{else}0{/if} of bitcoin exchange this month</p>
        <p class="muted credit">{$yearNumber.Counts} of receipts and {if isset($yearNumber.Total)}{$yearNumber.Total}{else}0{/if} of bitcoin exchange this year</p>
        <p class="muted credit">Total number of users: {$userNumber}</p>
    </div>
</div>
</BODY>
</HTML>
