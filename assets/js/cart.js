// Hàm cập nhật tổng tiền, giảm giá động theo checkbox
function updateCartSummary() {
    let total = 0;
    let voucherDiscount = parseInt(document.body.getAttribute('data-voucher-discount')) || 0;
    document.querySelectorAll('.cart-checkbox:checked').forEach(cb => {
        let price = parseInt(cb.getAttribute('data-price'));
        let amount = parseInt(cb.getAttribute('data-amount'));
        total += price * amount;
    });
    let discountMoney = voucherDiscount > 0 ? Math.round(total * voucherDiscount / 100) : 0;
    let cartTotal = document.getElementById('cart-total');
    let voucherArea = document.getElementById('voucher-discount-area');
    let cartTotalFinal = document.getElementById('cart-total-final');
    if (cartTotal) cartTotal.textContent = (total + discountMoney).toLocaleString() + ' đ';
    if (voucherArea) {
        if (voucherDiscount > 0) {
            voucherArea.innerHTML =
                '<div class="cart-summary-label" style="color:green;">Giảm giá ('+voucherDiscount+'%)</div>' +
                '<div class="cart-summary-value" style="color:green;">-' + discountMoney.toLocaleString() + ' đ</div>';
        } else {
            voucherArea.innerHTML = '';
        }
    }
    if (cartTotalFinal) cartTotalFinal.textContent = (total - discountMoney).toLocaleString() + ' đ';
}


document.addEventListener('DOMContentLoaded', function() {
  
    // Sự kiện chọn tất cả
    const selectAll = document.getElementById('select-all');
    if (selectAll) {
        selectAll.checked = true;
        selectAll.addEventListener('change', function() {
            document.querySelectorAll('.cart-checkbox').forEach(cb => { cb.checked = selectAll.checked; });
            updateCartSummary();
        });
    }
    // Sự kiện thay đổi từng checkbox
    document.querySelectorAll('.cart-checkbox').forEach(cb => {
        cb.addEventListener('change', updateCartSummary);
    });
    updateCartSummary();

    // Nút THANH TOÁN chỉ gửi sản phẩm được chọn
    const checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.onclick = function() {
            const selected = Array.from(document.querySelectorAll('.cart-checkbox:checked'))
                .map(cb => cb.value);
            if (selected.length === 0) {
                alert('Vui lòng chọn ít nhất 1 sản phẩm để thanh toán!');
                return;
            }
            window.location.href = 'checkout.php?selected=' + encodeURIComponent(selected.join(','));
        };
    }

    // AJAX áp dụng voucher 
    const voucherForm = document.getElementById('voucher-form');
    if (voucherForm) {
        voucherForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const code = document.getElementById('voucher_code').value;
            const btn = document.getElementById('apply-voucher-btn');
            if (btn) btn.disabled = true;
            fetch('apply-voucher.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'voucher_code=' + encodeURIComponent(code)
            })
            .then(response => response.json())
            .then(res => {
                if (btn) btn.disabled = false;
                document.getElementById('voucher-message').textContent = res.message;
                document.body.setAttribute('data-voucher-discount', res.discount || 0);
                updateCartSummary();
            });
        });
    }
}); 

