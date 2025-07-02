<?php
?>


<section>
    <div class="form-container">
        <form method="POST" action="/restaurants/contribute">
            <h1><strong>Contribute</strong></h1>
            <p><strong>Help us improve Koa-La by contributing your favorite places!</strong></p>

            <label for="place-name">Place Name:</label>
            <input type="text" id="place-name" name="name" required>

            <label for="place-location">Location:</label>
            <input type="text" id="place-location" name="address" required>

            <label for="place-description">Description:</label>
            <textarea id="place-description" name="description" required></textarea>

            <label for="place-image">Image URL:</label>
            <input type="url" id="place-image" name="image" placeholder="https://example.com/image.jpg">

            <label for="price-tier">Price Tier:</label>
            <select id="price-tier" name="price_tier">
                <option value="$">1 - Budget</option>
                <option value="$$">2 - Moderate</option>
                <option value="$$$">3 - Expensive</option>
            </select>

            <label for="concept>">Concept:</label>
            <select id="concept" name="concept">
                <option value="Italian">Italian</option>
                <option value="Vegan">Vegan</option>
                <option value="Japanese">Japanese</option>
                <option value="Mexican">Mexican</option>
                <option value="American">American</option>
                <option value="Other">Other</option>
            </select>

            <label for="veggie-friendly">Vegetarian Friendly:</label>
            <div class="checkbox">
                <p>Yessss</p>
                <input type="checkbox" id="veggie-friendly" name="veggie_option" value="1">
            </div>
            <button class="modal-btn" type="submit">Submit</button> <!-- Change police or font size -->
        </form>
    </div>
</section>
