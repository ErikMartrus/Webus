<div id="paypal-button"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        <?php if(MODE == 'live') { ?>
        env: 'production',
        <?php } else {?>
        env: 'sandbox',
        <?php } ?>
        commit: true,
        client: {
            sandbox: '<?php echo PayPal_CLIENT_ID; ?>',
            production: '<?php echo PayPal_CLIENT_ID; ?>'
        },
        payment: function (data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {
                                total: '<?php echo $total ?>',
                                currency: '<?php echo CURRENCY; ?>'
                            }
                        }
                    ]
                }
            });
        },
        onAuthorize: function (data, actions) {
            return actions.payment.execute().then(function () {
                window.location = "<?php echo APP_URL ?>" +  "execute-payment.php?payment_id=" + data.paymentID + "&payer_id=" + data.payerID + "&token=" + data.paymentToken + "&payer_email=" +data.payerEmail;
            });
        }
    }, '#paypal-button');
</script>