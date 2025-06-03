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
    if(tabName === 'reviews') {
        document.getElementById('description-content').style.display = 'none';
        document.getElementById('book-rating-wrapper').style.display = '';
    } else {
        document.getElementById('description-content').style.display = '';
        document.getElementById('book-rating-wrapper').style.display = 'none';
    }
}

function sendRating(isbn, point) {
    $.ajax({
        url: 'rate-book.php',
        method: 'POST',
        data: { isbn: isbn, point: point },
        success: function(res) {
            if (res.success) {
                $('#book-rating').html(res.html);
            } else {
                alert(res.message || 'Có lỗi xảy ra!');
            }
        },
        error: function() {
            alert('Không thể gửi đánh giá.');
        }
    });
}

$(document).on('click', '.rating-star-btn', function(e) {
    e.preventDefault();
    var point = $(this).data('point');
    var isbn = $(this).data('isbn');
    sendRating(isbn, point);
});

$(document).ready(function(){
    $('.book-detail-row').each(function(){
        var maxHeight = 0;
        $(this).children().each(function(){
            if ($(this).height() > maxHeight) maxHeight = $(this).height();
        });
        $(this).children().height(maxHeight);
    });
});