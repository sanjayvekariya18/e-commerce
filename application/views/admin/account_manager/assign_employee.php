<?php
if (isset($employees) && is_array($employees)) {
    foreach ($employees as $val) {
        ?>
        <option value="<?= $val->employee_id ?>"><?= $val->first_name . " " . $val->last_name ?></option>
        <?php
    }
}
?>