<?php foreach($errors as $error): ?>
<div class="error"><p><strong>CyprusCoin Gateway Error</strong>: <?php echo $error; ?></p></div>
<?php endforeach; ?>

<h1>CyprusCoin Gateway Settings</h1>

<div style="border:1px solid #ddd;padding:5px 10px;">
    <?php
         echo 'Wallet height: ' . $balance['height'] . '</br>';
         echo 'Your balance is: ' . $balance['balance'] . '</br>';
         echo 'Unlocked balance: ' . $balance['unlocked_balance'] . '</br>';
         ?>
</div>

<table class="form-table">
    <?php echo $settings_html ?>
</table>

<h4><a href="https://github.com/CyprusCoinClub/turtlecoin-woocommerce-gateway">Learn more about using the CyprusCoin payment gateway</a></h4>

<script>
function cypruscoinUpdateFields() {
    var useCyprusCoinPrices = jQuery("#woocommerce_cypruscoin_gateway_use_cypruscoin_price").is(":checked");
    if(useCyprusCoinPrices) {
        jQuery("#woocommerce_cypruscoin_gateway_use_cypruscoin_price_decimals").closest("tr").show();
    } else {
        jQuery("#woocommerce_cypruscoin_gateway_use_cypruscoin_price_decimals").closest("tr").hide();
    }
}
cypruscoinUpdateFields();
jQuery("#woocommerce_cypruscoin_gateway_use_cypruscoin_price").change(cypruscoinUpdateFields);
</script>

<style>
#woocommerce_cypruscoin_gateway_cypruscoin_address,
#woocommerce_cypruscoin_gateway_viewkey {
    width: 100%;
}
</style>
