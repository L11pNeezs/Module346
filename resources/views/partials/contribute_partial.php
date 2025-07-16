<?php

?>

<form method="POST" action="/restaurants/contribute">
    <h1><strong>Contribute</strong></h1>
    <p><strong>Help us improve Koa-La by contributing your favorite places!</strong></p>

    <?php foreach (CONTRIBUTE_FORM_FIELDS as $field): ?>
        <label for="<?= htmlspecialchars($field['id']) ?>"><?= htmlspecialchars($field['label']) ?></label>

        <?php if ($field['element'] === 'select'): ?>
            <select id="<?= htmlspecialchars($field['id']) ?>"
                    name="<?= htmlspecialchars($field['name']) ?>" <?= !empty($field['required']) ? 'required' : '' ?>
                    class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>"
            >
                <?php
                $options = [];
                if ($field['name'] === 'concept') {
                    $options = $concepts ?? [];
                } elseif ($field['name'] === 'price_tier') {
                    $options = $priceTiers ?? [];
                } elseif ($field['name'] === 'diet') {
                    $options = $diets ?? [];
                }
                foreach ($options as $value => $label): ?>
                    <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($label) ?></option>
                <?php endforeach; ?>
            </select>
        <?php elseif ($field['element'] === 'textarea'): ?>
            <textarea id="<?= htmlspecialchars($field['id']) ?>"
                      name="<?= htmlspecialchars($field['name']) ?>" <?= !empty($field['required']) ? 'required' : '' ?>
                      class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>"
            ><?= htmlspecialchars($old[$field['name']] ?? '') ?></textarea>
        <?php else: ?>
            <input
                type="<?= htmlspecialchars($field['type']) ?>"
                id="<?= htmlspecialchars($field['id']) ?>"
                name="<?= htmlspecialchars($field['name']) ?>"
                <?= !empty($field['required']) ? 'required' : '' ?>
                value="<?= htmlspecialchars($old[$field['name']] ?? '') ?>"
                <?= !empty($field['placeholder']) ? 'placeholder="' . htmlspecialchars($field['placeholder']) . '"' : '' ?>
                class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>"
            >
        <?php endif; ?>

        <?php if (!empty($errors[$field['name']])): ?>
            <span class="error"><?= htmlspecialchars($errors[$field['name']]) ?></span>
        <?php endif; ?>

    <?php endforeach; ?>

    <div class="button-wrapper">
        <button class="modal-btn" type="submit">Submit</button>
    </div>
</form>
