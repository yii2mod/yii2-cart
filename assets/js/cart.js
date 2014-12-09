/**
 * Cart Manager
 * @author Dmitry Semenov <disemx@gmail.com>
 */
var cartManager = {
    init: function () {
        this.cartPjaxId = '#cartContainer';
        this.cartViewUrl = '/cart/index';
        this.addActionUrl = '/cart/add';
        this.removeActionUrl = '/cart/delete';
    },
    /**
     * Add product to cart
     * @param
     */
    add: function (productId) {
        var quantity = $('#quantityFor' + productId).val();
        $.ajax({
            url: this.addActionUrl,
            type: "POST",
            data: {action: 'add', productId: productId, quantity: quantity},
            success: function (data, textStatus, jqXHR) {
                if (data.success === true) {
                    if ($(cartManager.cartPjaxId).length !== 0) {
                        $.when($.pjax.reload({
                            container: cartManager.cartPjaxId,
                            timeout: 3000,
                            url: cartManager.cartViewUrl,
                            enablePushState: false
                        })).done(function () {
                            cartManager.success(data.message);
                        });
                    } else {
                        $(".cart-summary").html(data.cartSummary);
                        cartManager.success(data.message);
                    }
                } else {
                    cartManager.fail(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                cartManager.fail(data.message);
            }
        });
        return false;
    },
    /**
     * Remove product from cart
     * @param dataKey
     */
    remove: function (dataKey) {
        $.ajax({
            url: this.removeActionUrl,
            type: "POST",
            data: {action: 'delete', dataKey: dataKey},
            success: function (data, textStatus, jqXHR) {
                if ($(cartManager.cartPjaxId).length !== 0) {
                    $.when($.pjax.reload({
                        container: cartManager.cartPjaxId,
                        timeout: 3000,
                        url: cartManager.cartViewUrl,
                        enablePushState: false
                    })).done(function () {
                        cartManager.success(data.message);
                    });
                } else {
                    cartManager.success(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                cartManager.fail(data.message);
            }
        });
        return false;
    },
    success: function (message) {
        $.notification(message, "", "success");
    },
    fail: function (message) {
        $.notification(message, "", "danger");
    }
};

$(function () {
    cartManager.init();
});

