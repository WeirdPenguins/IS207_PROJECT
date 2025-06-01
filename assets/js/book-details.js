

function increaseQuantity() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function addToCart(isbn) {
    let quantity = parseInt(document.getElementById('quantity').value);
    if (isNaN(quantity) || quantity < 1) quantity = 1;
    window.location.href = '../Rebook/cart.php?id=' + isbn + '&qty=' + quantity;
}

function buyNow(isbn) {
    const quantity = document.getElementById('quantity').value;
    window.location.href = '../Rebook/cart.php?id=' + isbn + '&qty=' + quantity + '&redirect=checkout';
}

function switchTab(tabName) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
}

$(document).ready(function(){
    $('.book-detail-row').each(function(){
        var maxHeight = 0;
        $(this).children().each(function(){
            if ($(this).height() > maxHeight) maxHeight = $(this).height();
        });
        $(this).children().height(maxHeight);
    });
});