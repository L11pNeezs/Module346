<?php
?>



<form method="POST" action="">
    <h1>Contribute</h1>
    <p>Help us improve Koa-La by contributing your favorite places!</p>

    <label for="place-name">Place Name:</label>
    <input type="text" id="place-name" name="place_name" required>

    <label for="place-location">Location:</label>
    <input type="text" id="place-location" name="place_location" required>

    <label for="place-description">Description:</label>
    <textarea id="place-description" name="place_description" required></textarea>

    <label for="place-image">Image URL:</label>
    <input type="url" id="place-image" name="place_image" placeholder="https://example.com/image.jpg">

    <label for="price-tier">Price Tier:</label>
    <select id="price-tier" name="price_tier">
        <option value="$">1 - Budget</option>
        <option value="$$">2 - Moderate</option>
        <option value="$$$">3 - Expensive</option>
    </select>
    <label for="concept>">Concept:</label>
    <input type="text" id="concept" name="concept" placeholder="e.g., Italian, Vegan, etc.">

    <label for="veggie-friendly">Vegetarian Friendly:</label>
    <input type="checkbox" id="veggie-friendly" name="veggie_friendly">

    <button type="submit">Submit</button>
</form>
