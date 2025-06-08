function switchTab(tabName) {
    $('.tab-btn').removeClass('active');
    $(event.target).addClass('active');
    
    if(tabName === 'reviews') {
        $('#description-content').hide();
        $('#book-rating-wrapper').show();
        // Initialize rating handlers when switching to reviews tab
        initializeRatingHandlers();
    } else {
        $('#description-content').show();
        $('#book-rating-wrapper').hide();
    }
}

// Initialize tab display
$(document).ready(function() {
    $('#description-content').show();
    $('#book-rating-wrapper').hide();
});

function initializeRatingHandlers() {
    const ratingStarBtns = document.querySelectorAll('.rating-star-btn');
    const submitRatingBtn = document.getElementById('submit-rating');
    let selectedPoint = 0;

    // Remove existing event listeners
    ratingStarBtns.forEach(btn => {
        btn.replaceWith(btn.cloneNode(true));
    });
    if (submitRatingBtn) {
        submitRatingBtn.replaceWith(submitRatingBtn.cloneNode(true));
    }

    // Get fresh references after cloning
    const newRatingStarBtns = document.querySelectorAll('.rating-star-btn');
    const newSubmitRatingBtn = document.getElementById('submit-rating');

    newRatingStarBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            selectedPoint = parseInt(this.dataset.point);
            const stars = document.querySelectorAll('.rating-star-btn span');
            stars.forEach((star, index) => {
                star.style.color = index < selectedPoint ? '#ffc107' : '#ccc';
            });
        });
    });

    if (newSubmitRatingBtn) {
        newSubmitRatingBtn.addEventListener('click', function() {
            if (!selectedPoint) {
                alert('Vui lòng chọn số sao đánh giá!');
                return;
            }

            const comment = document.getElementById('rating-comment').value;
            const isbn = newRatingStarBtns[0].dataset.isbn;

            // Create form data
            const formData = new FormData();
            formData.append('isbn', isbn);
            formData.append('point', selectedPoint);
            formData.append('comment', comment);

            // Send POST request
            fetch('rate-book.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update the rating section with new HTML
                    const ratingSection = document.querySelector('.rating-section');
                    if (ratingSection) {
                        ratingSection.innerHTML = data.html;
                    }
                    // Reinitialize event listeners
                    initializeRatingHandlers();
                } else {
                    alert(data.message || 'Có lỗi xảy ra khi gửi đánh giá!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi gửi đánh giá!');
            });
        });
    }
}

function submitRating(isbn, point, comment) {
    const formData = new FormData();
    formData.append('isbn', isbn);
    formData.append('point', point);
    formData.append('comment', comment);

    fetch('rate-book.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Cập nhật UI với đánh giá mới
            document.querySelector('.review-list').innerHTML = data.html;
            alert('Đánh giá thành công!');
        } else {
            alert(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi gửi đánh giá');
    });
}

// Thêm event listener cho nút đánh giá
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('submit-rating');
    if (submitButton) {
        submitButton.addEventListener('click', function() {
            const isbn = this.closest('.your-rating-box').querySelector('.rating-star-btn').dataset.isbn;
            const point = document.querySelector('.rating-star-btn[style*="color: #ffc107"]')?.dataset.point || 5;
            const comment = document.getElementById('rating-comment').value;
            submitRating(isbn, point, comment);
        });
    }
});