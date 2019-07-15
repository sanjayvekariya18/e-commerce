<option value="-1">--Select--</option>
<?php
if (isset($subcategory)) {
    foreach ($subcategory as $val) {
        ?>
        <option value="<?= $val->subcategory_id ?>"><?= $val->subcategory_name ?></option>
        <?php
    }
}
?>