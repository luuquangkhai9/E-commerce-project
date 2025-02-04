define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'Uet_zalopayment',
                component: 'Uet_ZaloPayment/js/view/payment/method-renderer/zalopayment-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);