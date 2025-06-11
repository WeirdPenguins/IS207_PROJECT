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
        newSubmitRatingBtn.addEventListener('click', async function() {
            if (!selectedPoint) {
                alert('Vui lòng chọn số sao đánh giá!');
                return;
            }

            const comment = document.getElementById('rating-comment').value;
            const isbn = newRatingStarBtns[0].dataset.isbn;

            try {
                // Create form data
                const formData = new FormData();
                formData.append('isbn', isbn);
                formData.append('point', selectedPoint);
                formData.append('comment', comment);

                console.log('Sending rating data:', {
                    isbn: isbn,
                    point: selectedPoint,
                    comment: comment
                });

                // Send POST request
                const response = await fetch('rate-book.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                console.log('Response status:', response.status);
                console.log('Response headers:', Object.fromEntries(response.headers.entries()));

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Server response:', errorText);
                    throw new Error(`Server error: ${response.status} - ${errorText}`);
                }

                const data = await response.json();
                console.log('Response data:', data);
                
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
            } catch (error) {
                console.error('Error details:', error);
                alert('Có lỗi xảy ra khi gửi đánh giá: ' + error.message);
            }
        });
    }
}