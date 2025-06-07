// Tab functions
function switchTab(tabName, event) {
    $('.tab-btn').removeClass('active');
    $(event.target).addClass('active');
    
    if(tabName === 'reviews') {
        $('#description-content').hide();
        $('#book-rating-wrapper').show();
    } else {
        $('#description-content').show();
        $('#book-rating-wrapper').hide();
    }
}

// Quantity functions
function increaseQuantity() {
    var qty = parseInt($('#quantity').val());
    $('#quantity').val(qty + 1);
}

function decreaseQuantity() {
    var qty = parseInt($('#quantity').val());
    if (qty > 1) {
        $('#quantity').val(qty - 1);
    }
}

// Cart functions
function addToCart(isbn) {
    var qty = parseInt($('#quantity').val());
    if (isNaN(qty) || qty < 1) qty = 1;
    window.location.href = 'cart.php?id=' + isbn + '&qty=' + qty;
}

function buyNow(isbn) {
    var qty = parseInt($('#quantity').val());
    if (isNaN(qty) || qty < 1) qty = 1;
    window.location.href = 'cart.php?id=' + isbn + '&qty=' + qty + '&redirect=checkout';
}

// Rating functions
function sendRating(isbn, point) {
    var comment = $('#rating-comment').val();
    
    // Validate comment length
    if (comment.length > 1000) {
        alert('Bình luận không được vượt quá 1000 ký tự');
        return;
    }

    // Send rating data to server
    $.ajax({
        url: 'rate-book.php',
        method: 'POST',
        data: {
            isbn: isbn,
            point: point,
            comment: comment
        },
        success: function(response) {
            try {
                if (response.success) {
                    // Update the rating section with new HTML
                    const ratingSection = document.querySelector('.rating-section');
                    if (ratingSection) {
                        ratingSection.innerHTML = response.html;
                    }
                    // Reinitialize event listeners
                    initializeRatingHandlers();
                    alert('Cảm ơn bạn đã đánh giá!');
                } else {
                    alert(response.message || 'Có lỗi xảy ra khi gửi đánh giá');
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                alert('Có lỗi xảy ra khi xử lý phản hồi từ máy chủ');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', error);
            alert('Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại sau.');
        }
    });
}

// Initialize when document is ready
$(document).ready(function() {
    // Initialize tab display
    $('#description-content').show();
    $('#book-rating-wrapper').hide();

    // Initialize rating stars
    $('.rating-star-btn').on('click', function() {
        var point = $(this).data('point');
        var isbn = $(this).data('isbn');
        
        // Update star colors
        $('.rating-star-btn span').css('color', '#ccc');
        $('.rating-star-btn').each(function(index) {
            if (index < point) {
                $(this).find('span').css('color', '#ffc107');
            }
        });
        
        // Show comment form
        $('#rating-comment-form').show();
    });

    // Submit rating button click handler
    $('#submit-rating').on('click', function() {
        const isbn = $(this).closest('.your-rating-box').find('.rating-star-btn').data('isbn');
        const point = $('.rating-star-btn span[style*="color: #ffc107"]').length;
        if (point === 0) {
            alert('Vui lòng chọn số sao đánh giá!');
            return;
        }
        sendRating(isbn, point);
    });

    // Equalize heights of book detail rows
    $('.book-detail-row').each(function() {
        var maxHeight = 0;
        $(this).children().each(function() {
            if ($(this).height() > maxHeight) maxHeight = $(this).height();
        });
        $(this).children().height(maxHeight);
    });
});