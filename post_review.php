<style>
    body {
        font-family: Arial, serif;
        margin: 20px;
    }

    .review-form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background-color: #fff;
    }

    .review-form h2 {
        color: #333;
    }

    .review-form label {
        font-size: 14px;
        color: #666;
    }

    .review-form textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        min-height: 100px;
    }

    .rating {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        color: white;
    }

    .rating > input {
        display: none;
    }

    .rating > label {
        cursor: pointer;
        font-size: 25px;
        color: #ccc;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input:checked ~ label {
        color: #ffc107;
    }

    .rating > label::before {
        content: "\2605";
        position: relative;
    }

    .review-form button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background-color: crimson;
        color: white;
        margin: 5px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        border: 1px solid #ccc;
        font-weight: bold;
    }

    .review-form button[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .review-form {
            margin: 20px 10px;
        }
    }
    .review {
    margin-bottom: 20px;
    padding: 1px;
    background-color: black;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flexbox;
    text-decoration: none;
    font-size: clamp(14px, 2vw, 16px);
    border: 1px solid #ddd;
    font-style: italic;
}

.review-text {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 10px;
    color: white;
    text-decoration: none;
}

.rating-stars {
    font-size: 20px;
    color: #ffc107;
}

.review-date {
    font-size: 14px;
    color: crimson;
    margin-top: 10px;
}
.agent-name{
    color:white;
}
p { margin: 5px 0; }
</style>

<h2>Leave Your Review</h2>
<div class="review-form">
    <form action="" method="post">
        <input type="hidden" name="expert_id" value="<?php echo htmlspecialchars($expertId); ?>">

        <label for="review_text">Type Here....:</label>
        <textarea name="review_text" id="review_text" required></textarea>

        <label for="rating">Rating:</label>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
        </div>

        <button type="submit">Submit Review</button>
    </form>
</div>
