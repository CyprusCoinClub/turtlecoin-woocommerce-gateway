/*
 * Copyright (c) 2018, Ryo Currency Project
*/
function cypruscoin_showNotification(message, type='success') {
    var toast = jQuery('<div class="' + type + '"><span>' + message + '</span></div>');
    jQuery('#cypruscoin_toast').append(toast);
    toast.animate({ "right": "12px" }, "fast");
    setInterval(function() {
        toast.animate({ "right": "-400px" }, "fast", function() {
            toast.remove();
        });
    }, 2500)
}
function cypruscoin_showQR(show=true) {
    jQuery('#cypruscoin_qr_code_container').toggle(show);
}
function cypruscoin_fetchDetails() {
    var data = {
        '_': jQuery.now(),
        'order_id': cypruscoin_details.order_id
    };
    jQuery.get(cypruscoin_ajax_url, data, function(response) {
        if (typeof response.error !== 'undefined') {
            console.log(response.error);
        } else {
            cypruscoin_details = response;
            cypruscoin_updateDetails();
        }
    });
}

function cypruscoin_updateDetails() {

    var details = cypruscoin_details;

    jQuery('#cypruscoin_payment_messages').children().hide();
    switch(details.status) {
        case 'unpaid':
            jQuery('.cypruscoin_payment_unpaid').show();
            jQuery('.cypruscoin_payment_expire_time').html(details.order_expires);
            break;
        case 'partial':
            jQuery('.cypruscoin_payment_partial').show();
            jQuery('.cypruscoin_payment_expire_time').html(details.order_expires);
            break;
        case 'paid':
            jQuery('.cypruscoin_payment_paid').show();
            jQuery('.cypruscoin_confirm_time').html(details.time_to_confirm);
            jQuery('.button-row button').prop("disabled",true);
            break;
        case 'confirmed':
            jQuery('.cypruscoin_payment_confirmed').show();
            jQuery('.button-row button').prop("disabled",true);
            break;
        case 'expired':
            jQuery('.cypruscoin_payment_expired').show();
            jQuery('.button-row button').prop("disabled",true);
            break;
        case 'expired_partial':
            jQuery('.cypruscoin_payment_expired_partial').show();
            jQuery('.button-row button').prop("disabled",true);
            break;
    }

    jQuery('#cypruscoin_exchange_rate').html('1 XCY = '+details.rate_formatted+' '+details.currency);
    jQuery('#cypruscoin_total_amount').html(details.amount_total_formatted);
    jQuery('#cypruscoin_total_paid').html(details.amount_paid_formatted);
    jQuery('#cypruscoin_total_due').html(details.amount_due_formatted);

    jQuery('#cypruscoin_integrated_address').html(details.integrated_address);

    if(cypruscoin_show_qr) {
        var qr = jQuery('#cypruscoin_qr_code').html('');
        new QRCode(qr.get(0), details.qrcode_uri);
    }

    if(details.txs.length) {
        jQuery('#cypruscoin_tx_table').show();
        jQuery('#cypruscoin_tx_none').hide();
        jQuery('#cypruscoin_tx_table tbody').html('');
        for(var i=0; i < details.txs.length; i++) {
            var tx = details.txs[i];
            var height = tx.height == 0 ? 'N/A' : tx.height;
	    var explorer_url = cypruscoin_explorer_url+'/transaction.html?hash='+tx.txid;
            var row = ''+
                '<tr>'+
                '<td style="word-break: break-all">'+
                '<a href="'+explorer_url+'" target="_blank">'+tx.txid+'</a>'+
                '</td>'+
                '<td>'+height+'</td>'+
                '<td>'+tx.amount_formatted+' XCY</td>'+
                '</tr>';

            jQuery('#cypruscoin_tx_table tbody').append(row);
        }
    } else {
        jQuery('#cypruscoin_tx_table').hide();
        jQuery('#cypruscoin_tx_none').show();
    }

    // Show state change notifications
    var new_txs = details.txs;
    var old_txs = cypruscoin_order_state.txs;
    if(new_txs.length != old_txs.length) {
        for(var i = 0; i < new_txs.length; i++) {
            var is_new_tx = true;
            for(var j = 0; j < old_txs.length; j++) {
                if(new_txs[i].txid == old_txs[j].txid && new_txs[i].amount == old_txs[j].amount) {
                    is_new_tx = false;
                    break;
                }
            }
            if(is_new_tx) {
                cypruscoin_showNotification('Transaction received for '+new_txs[i].amount_formatted+' XCY');
            }
        }
    }

    if(details.status != cypruscoin_order_state.status) {
        switch(details.status) {
            case 'paid':
                cypruscoin_showNotification('Your order has been paid in full');
                break;
            case 'confirmed':
                cypruscoin_showNotification('Your order has been confirmed');
                break;
            case 'expired':
            case 'expired_partial':
                cypruscoin_showNotification('Your order has expired', 'error');
                break;
        }
    }

    cypruscoin_order_state = {
        status: cypruscoin_details.status,
        txs: cypruscoin_details.txs
    };

}
jQuery(document).ready(function($) {
    if (typeof cypruscoin_details !== 'undefined') {
        cypruscoin_order_state = {
            status: cypruscoin_details.status,
            txs: cypruscoin_details.txs
        };
        setInterval(cypruscoin_fetchDetails, 30000);
        cypruscoin_updateDetails();
        new ClipboardJS('.clipboard').on('success', function(e) {
            e.clearSelection();
            if(e.trigger.disabled) return;
            switch(e.trigger.getAttribute('data-clipboard-target')) {
                case '#cypruscoin_integrated_address':
                    cypruscoin_showNotification('Copied destination address!');
                    break;
                case '#cypruscoin_total_due':
                    cypruscoin_showNotification('Copied total amount due!');
                    break;
            }
            e.clearSelection();
        });
    }
});
