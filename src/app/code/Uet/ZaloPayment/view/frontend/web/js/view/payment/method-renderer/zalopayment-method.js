define(
    [
        'jquery',
        'Magento_Checkout/js/view/payment/default',
        'Magento_Checkout/js/action/place-order',
        'Magento_Checkout/js/action/select-payment-method',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/checkout-data',
        'Magento_Checkout/js/model/payment/additional-validators',
        'mage/url',
    ],
    function (
        $,
        Component,
        placeOrderAction,
        selectPaymentMethodAction,
        customer,
        checkoutData,
        additionalValidators,
        url
    ) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Uet_ZaloPayment/payment/zalopayment'
            },
            placeOrder: function (data, event) {
                if (event) {
                    event.preventDefault();
                }
                var self = this,
                    placeOrder,
                    emailValidationResult = customer.isLoggedIn(),
                    loginFormSelector = 'form[data-role=email-with-possible-login]';
                if (!customer.isLoggedIn()) {
                    $(loginFormSelector).validation();
                    emailValidationResult = Boolean($(loginFormSelector + ' input[name=username]').valid());
                }
                if (emailValidationResult && this.validate() && additionalValidators.validate()) {
                    this.isPlaceOrderActionAllowed(false);
                    placeOrder = placeOrderAction(this.getData(), false, this.messageContainer);

                    $.when(placeOrder).fail(function () {
                        self.isPlaceOrderActionAllowed(false);
                    }).done(this.afterPlaceOrder.bind(this));
                    return true;
                }
                return false;
            },

            getPaymentAcceptanceMarkSrc: function () {
                return window.checkoutConfig.payment.zalopay.logoSrc;
            },
            
            selectPaymentMethod: function () {
                selectPaymentMethodAction(this.getData());
                checkoutData.setSelectedPaymentMethod(this.item.method);
                return true;
            },

            afterPlaceOrder: function (quoteId) {
                var request = $.ajax({
                    url: url.build('Uetzalopayment/payment/placeOrder'),
                    type: 'POST',
                    dataType: 'json',
                    data: {quote_id: quoteId}
                });

                request.done(function (response) {
                    if (response.status) {
                        window.location.replace(response.payment_url);
                    } else {
                        alert(response.error_msg);
                        window.location.replace('cart');
                    }
                });
            }
        });
    }
);
