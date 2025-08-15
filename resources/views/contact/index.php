<?php
?>
<section>
    <div id ="form-container">
    <?php if (!empty($formError)): ?>
        <div class="error"><?= htmlspecialchars($formError) ?></div>
    <?php endif; ?>

    <?php if (!empty($LoginError)): ?>
        <div class="error"><?= htmlspecialchars($LoginError) ?></div>
    <?php endif; ?>

    <?php if (!empty($sendError)): ?>
        <div class="error"><?= htmlspecialchars($sendError) ?></div>
    <?php endif; ?>

    <div  class="text-center">
        <h1>Contact Us</h1>
        <p>Get in touch with us</p>
    </div>
    <div class="container">
            <form method="POST" class="contribute-form" action="/contact">
                <label for="contact_name">Name *</label>
                <input type="text" id="contact_name" name="name" placeholder="Name" required class="form-input">
                <label for="contact_email">Email *</label>
                <input type="email" id="contact_email" name="email" placeholder="Email" required class="form-input">
                <label for="contact_subject">Subject *</label>
                <input type="text" id="contact_subject" name="subject" placeholder="Subject" required class="form-input">
                <label for="contact_message">Message *</label>
                <textarea id="contact_message" name="message" placeholder="Message" required class="form-input"></textarea>
                <p>* Required Fields</p>

                <div>
                    <button class="btn" type="submit">Send</button>
                </div>
            </form>


        </div>
</section>
