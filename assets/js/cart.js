// Hàm cập nhật tổng tiền, giảm giá động theo checkbox
function updateCartSummary() {
    console.log('Updating cart summary...');
    let total = 0;
    let voucherDiscount = parseInt($('body').attr('data-voucher-discount')) || 0;
    $('.cart-checkbox:checked').each(function() {
        let price = parseInt($(this).data('price'));
        let amount = parseInt($(this).data('amount'));
        total += price * amount;
    });
    let discountMoney = voucherDiscount > 0 ? Math.round(total * voucherDiscount / 100) : 0;
    let cartTotal = $('#cart-total');
    let voucherArea = $('#voucher-discount-area');
    let cartTotalFinal = $('#cart-total-final');
    if (cartTotal.length) cartTotal.text((total + discountMoney).toLocaleString() + ' đ');
    if (voucherArea.length) {
        if (voucherDiscount > 0) {
            voucherArea.html(
                '<div class="cart-summary-label" style="color:green;">Giảm giá ('+voucherDiscount+'%)</div>' +
                '<div class="cart-summary-value" style="color:green;">-' + discountMoney.toLocaleString() + ' đ</div>'
            );
        } else {
            voucherArea.html('');
        }
    }
    if (cartTotalFinal.length) cartTotalFinal.text((total - discountMoney).toLocaleString() + ' đ');
}

$(document).ready(function() {
    console.log('Document ready, initializing cart...');
    
    // Kiểm tra jQuery
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }

    // Sự kiện chọn tất cả
    const $selectAll = $('#select-all');
    if ($selectAll.length) {
        $selectAll.prop('checked', true);
        $selectAll.on('change', function() {
            $('.cart-checkbox').prop('checked', this.checked);
            updateCartSummary();
        });
    }
    // Sự kiện thay đổi từng checkbox
    $('.cart-checkbox').on('change', updateCartSummary);
    updateCartSummary();

    // Nút THANH TOÁN chỉ gửi sản phẩm được chọn
    $('#checkout-btn').on('click', function() {
        const selected = $('.cart-checkbox:checked').map(function() { return this.value; }).get();
        if (selected.length === 0) {
            alert('Vui lòng chọn ít nhất 1 sản phẩm để thanh toán!');
            return;
        }
        window.location.href = 'checkout.php?selected=' + encodeURIComponent(selected.join(','));
    });

    // AJAX áp dụng voucher 
    $('#voucher-form').on('submit', function(e) {
        e.preventDefault();
        const code = $('#voucher_code').val();
        const $btn = $('#apply-voucher-btn');
        $btn.prop('disabled', true);
        $.post('apply-voucher.php', { voucher_code: code }, function(res) {
            $btn.prop('disabled', false);
            $('#voucher-message').text(res.message);
            $('body').attr('data-voucher-discount', res.discount || 0);
            updateCartSummary();
        }, 'json');
    });

    // AJAX tăng/giảm số lượng
    $('.cart-qty-btn').on('click', function() {
        console.log('Quantity button clicked');
        const $row = $(this).closest('tr');
        const isbn = $row.data('isbn');
        const $qtyInput = $row.find('.cart-qty-input');
        let amount = parseInt($qtyInput.val());
        const action = $(this).data('action');
        if (action === 'plus') amount++;
        if (action === 'minus') amount--;
        if (amount < 1) amount = 1;

        console.log('Updating quantity:', { isbn, amount, action });

        const $buttons = $row.find('.cart-qty-btn');
        $buttons.prop('disabled', true);

        $.ajax({
            url: 'cart.php',
            method: 'POST',
            data: {
                action: 'update_qty',
                isbn: isbn,
                amount: amount
            },
            dataType: 'json',
            success: function(res) {
                console.log('Update quantity response:', res);
                if (res.success) {
                    $qtyInput.val(amount);
                    $row.find('.cart-checkbox').data('amount', amount);
                    // Cập nhật thành tiền của sản phẩm
                    const price = parseInt($row.find('.cart-checkbox').data('price'));
                    $row.find('.cart-price-sale').last().text((price * amount).toLocaleString() + ' đ');
                    updateCartSummary();
                } else {
                    alert(res.message || 'Có lỗi xảy ra!');
                }
            },
            error: function(xhr, status, error) {
                console.error('Update quantity error details:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText,
                    statusText: xhr.statusText
                });
                alert('Có lỗi xảy ra khi cập nhật số lượng! Chi tiết: ' + error);
            },
            complete: function() {
                $buttons.prop('disabled', false);
            }
        });
    });

    // AJAX xóa sản phẩm
    $('.cart-remove-btn').on('click', function(e) {
        e.preventDefault();
        console.log('Delete button clicked');
        
        if (!confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')) return;
        
        const $row = $(this).closest('tr');
        const isbn = $row.data('isbn');
        console.log('Deleting item:', isbn);
        
        const $btn = $(this);
        $btn.prop('disabled', true);

        $.ajax({
            url: 'cart.php',
            method: 'POST',
            data: {
                action: 'delete',
                isbn: isbn
            },
            dataType: 'json',
            success: function(res) {
                console.log('Delete response:', res);
                if (res.success) {
                    $row.fadeOut(300, function() {
                        $(this).remove();
                        updateCartSummary();
                        // Check if cart is empty and show empty cart message
                        if ($('.cart_item').length === 0) {
                            $('.cart-left').html(`
                                <div class="cart-empty">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div>
                                        <div class="cart-empty-title">Giỏ hàng rỗng!</div>
                                    </div>
                                </div>
                            `);
                            $('#checkout-btn').prop('disabled', true);
                        }
                    });
                } else {
                    alert(res.message || 'Có lỗi xảy ra!');
                }
            },
            error: function(xhr, status, error) {
                console.error('Delete error details:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText,
                    statusText: xhr.statusText
                });
                alert('Có lỗi xảy ra khi xóa sản phẩm! Chi tiết: ' + error);
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });
});