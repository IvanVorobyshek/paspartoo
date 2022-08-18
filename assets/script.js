function showAddPost() {
    document.querySelector('.comment_form').style.display = 'none';
    document.querySelector('.post_form').style.display = 'block';
    const emailInput = document.getElementById('post_author_name');
    emailInput.focus();
}

function showAddComment(id) {
    document.querySelector('.post_form').style.display = 'none';
    document.querySelector('.comment_form').style.display = 'block';
    document.getElementById('post_id').value = id;
    const emailInput = document.getElementById('comment_author_name');
    emailInput.focus();
}

/* start of star rating */
const ratings = document.querySelectorAll('.rating');
if (ratings.length > 0) {
    initRatings();
}

function initRatings() {
    let ratingActive, ratingValue;
    for (let index = 0; index < ratings.length; index++) {
        const rating = ratings[index];
        initRating(rating);
    }

    function initRating(rating) {
        initRatingVars(rating);

        setRatingActiveWidth();

        if (rating.classList.contains('rating_set')) {
            setRating(rating);
        }

    }

    function initRatingVars(rating) {
        ratingActive = rating.querySelector('.rating__active');
        ratingValue = rating.querySelector('.rating__value');
    }

    function setRatingActiveWidth(index = ratingValue.innerHTML) {
        const ratingActiveWidth = index / 0.05;
        ratingActive.style.width = `${ratingActiveWidth}%`;
    }

    function setRating(rating) {
        const ratingItems = rating.querySelectorAll('.rating__item');
        for (let index = 0; index < ratingItems.length; index++) {
            const ratingItem = ratingItems[index];
            ratingItem.addEventListener("mouseenter", function (e) {
                initRatingVars(rating);
                setRatingActiveWidth(ratingItem.value);
            });
            ratingItem.addEventListener("mouseleave", function (e) {
                setRatingActiveWidth();
            });
            ratingItem.addEventListener("click", function (e) {
                initRatingVars(rating);

                if (rating.dataset.ajax) {
                    setRatingValue(ratingItem.value, rating);
                    for (let ind = 0; ind < ratingItems.length; ind++) {
                        ratingItems[ind].disabled = true;
                    }
                } else {
                    ratingValue.innerHTML = index + 1;
                    setRatingActiveWidth();
                }
            });

        }
    }

    async function setRatingValue(value, rating) {
        let hid_id = rating.querySelector('.hidden_id').value;
        if ((!rating.classList.contains('rating_sending')) & (!rating.classList.contains('rating_send'))) {
            rating.classList.add('rating_sending');
            $.post(
                '/addrating',
                {
                    'hid_id': hid_id,
                    'rating': value
                },
                function (response) { // response from the server
                    result = $.parseJSON(response);
                    if (result.good) {//all is fine, let's change rating
                        document.querySelector('.allposts').innerHTML = result.all_posts;
                        document.querySelector('.negativeposts').innerHTML = result.negative_posts;
                        document.querySelector('.positiveposts').innerHTML = result.positive_posts;
                        ratingValue.innerHTML = result.newRating;
                        setRatingActiveWidth();
                        rating.classList.remove('rating_sending');
                        rating.classList.add('rating_send');
                    } else {
                        alert(result.error);
                        window.location.href = '/';
                    }
                }
            );
        }
    }
}
/* end of star rating */