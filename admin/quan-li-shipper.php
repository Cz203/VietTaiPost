<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();
$buuCucs = $admin->getTatCaBuuCuc();
?>

<div class="mb-3">
    <label for="id_buu_cuc" class="form-label">Chọn bưu cục</label>
    <select class="form-select" id="id_buu_cuc" name="id_buu_cuc">
        <?php foreach ($buuCucs as $buuCuc): ?>
            <option value="<?= htmlspecialchars($buuCuc['id']) ?>">
                <?= htmlspecialchars($buuCuc['ten_buu_cuc']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
