<?php
?>

<form class="contribute-form" method="POST" action="/restaurants/contribute">
    <h1><strong>Contribute</strong></h1>
    <p><strong>Help us improve Koa-La by contributing your favorite places!</strong></p>

    <?php foreach (CONTRIBUTE_FORM_FIELDS as $field): ?>
        <label for="<?= htmlspecialchars($field['id']) ?>"><?= htmlspecialchars($field['label']) ?></label>

        <?php if ($field['element'] === 'select'): ?>
            <select id="<?= htmlspecialchars($field['id']) ?>"
                    name="<?= htmlspecialchars($field['name']) ?>"
                <?= !empty($field['required']) ? 'required' : '' ?>
                    class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>"
                    onchange="<?php if ($field['name'] === 'concept' || $field['name'] === 'diet'): ?>
                        toggleOtherInput('<?= htmlspecialchars($field['name']) ?>', this.value)
                    <?php endif; ?>"
            >
                <?php
                $options = [];
                if ($field['name'] === 'concept') {
                    $options = $concepts ?? [];
                } elseif ($field['name'] === 'price_tier') {
                    $options = $priceTiers ?? [];
                } elseif ($field['name'] === 'diet') {
                    $options = $diets ?? [];
                } ?>
                <option value="" disabled <?= empty($old[$field['name']]) ? 'selected' : '' ?>>Select an option</option>
                <?php foreach ($options as $value => $label): ?>
                    <option value="<?= htmlspecialchars($value) ?>"
                        <?php if (($old[$field['name']] ?? '') == $value) echo 'selected'; ?>>
                        <?= htmlspecialchars($label) ?>
                    </option>
                <?php endforeach; ?>
                <?php if ($field['name'] === 'concept' || $field['name'] === 'diet'): ?>
                    <option value="__other__"
                        <?php if (($old[$field['name']] ?? '') == '__other__') echo 'selected'; ?>>
                        Other
                    </option>
                <?php endif; ?>
            </select>
            <?php if ($field['name'] === 'concept' || $field['name'] === 'diet'): ?>
                <input
                    type="text"
                    id="<?= htmlspecialchars($field['name']) ?>_other"
                    name="<?= htmlspecialchars($field['name']) ?>_other"
                    placeholder="Please specify"
                    style="display:<?= (($old[$field['name']] ?? '') == '__other__') ? 'block' : 'none' ?>; margin-top:5px;"
                    value="<?= htmlspecialchars($old[$field['name'].'_other'] ?? '') ?>"
                >
            <?php endif; ?>
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

    <div>
        <button class="btn" type="submit">Submit</button>
    </div>
</form>
<script>
    function toggleOtherInput(field, value) {
        var input = document.getElementById(field + '_other');
        if (input) {
            input.style.display = (value === '__other__') ? 'block' : 'none';
        }
    }
</script>
