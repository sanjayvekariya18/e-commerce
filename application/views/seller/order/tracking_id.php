<?php
if (isset($trackinglist)) {
    foreach ($trackinglist as $val) {
        ?>
        <option value="<?= $val->tracking_id ?>"><?= $val->tracking_id ?></option>
        <?php
    }
}
?>