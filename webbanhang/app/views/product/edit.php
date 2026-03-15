<?php include 'app/views/shares/header.php'; ?>

<style>
.form-page-wrap { max-width: 720px; margin: 0 auto; }
.form-card { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius); overflow: hidden; }
.form-card-header { padding: 24px 28px; background: linear-gradient(135deg, rgba(245,158,11,0.12), rgba(245,158,11,0.04)); border-bottom: 1px solid var(--card-border); display: flex; align-items: center; gap: 14px; }
.form-card-icon { width: 44px; height: 44px; background: linear-gradient(135deg, var(--accent), var(--accent-dark)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--dark); box-shadow: 0 4px 12px rgba(245,158,11,0.35); }
.form-card-title { font-size: 20px; font-weight: 700; color: var(--text); margin: 0; }
.form-card-subtitle { font-size: 12px; color: var(--text-muted); margin: 2px 0 0; }
.form-card-body { padding: 28px; }
.form-label-custom { display: block; font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 7px; }
.form-group-custom { margin-bottom: 22px; }
.price-input-wrap { position: relative; }
.price-input-wrap .currency { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--accent); font-weight: 700; font-size: 14px; pointer-events: none; }
.price-input-wrap input { padding-right: 36px; }
.form-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(108,60,227,0.1); }
.current-image { background: var(--dark-3); border: 1px solid var(--card-border); border-radius: var(--radius-sm); padding: 16px; display: flex; align-items: center; gap: 14px; margin-top: 10px; }
</style>

<!-- Breadcrumb -->
<nav style="margin-bottom:20px;font-size:13px;color:var(--text-muted);">
    <a href="/Product/" style="color:var(--primary-light);">Trang chủ</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <a href="/Product/" style="color:var(--primary-light);">Sản phẩm</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <span>Chỉnh sửa</span>
</nav>

<div class="form-page-wrap fade-up">
<div class="form-card">

    <div class="form-card-header">
        <div class="form-card-icon">
            <i class="fa fa-pen"></i>
        </div>
        <div>
            <h2 class="form-card-title">Chỉnh sửa sản phẩm</h2>
            <p class="form-card-subtitle">Cập nhật thông tin sản phẩm trong cửa hàng</p>
        </div>
    </div>

    <div class="form-card-body">
        <form method="POST" action="/Product/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">
            <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">

            <!-- Name -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-tag" style="color:var(--primary);margin-right:6px;"></i> Tên sản phẩm *
                </label>
                <input type="text" name="name" class="form-control"
                    value="<?php echo htmlspecialchars($product->name); ?>" required>
            </div>

            <!-- Description -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-align-left" style="color:var(--primary);margin-right:6px;"></i> Mô tả sản phẩm *
                </label>
                <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product->description); ?></textarea>
            </div>

            <!-- Price & Category -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">
                        <i class="fa fa-dollar-sign" style="color:var(--accent);margin-right:6px;"></i> Giá bán *
                    </label>
                    <div class="price-input-wrap">
                        <input type="number" name="price" class="form-control"
                            value="<?php echo $product->price; ?>" min="0" required>
                        <span class="currency">₫</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">
                        <i class="fa fa-folder" style="color:var(--primary-light);margin-right:6px;"></i> Danh mục *
                    </label>
                    <select name="category_id" class="form-select">
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>"
                            <?php if($category->id == $product->category_id) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($category->name); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Image -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-image" style="color:var(--success);margin-right:6px;"></i> Hình ảnh mới
                </label>
                <input type="file" name="image" class="form-control" accept="image/*"
                    onchange="previewEdit(this)">

                <?php if ($product->image): ?>
                <div class="current-image" id="current-image-wrap">
                    <img id="edit-preview" src="/<?php echo $product->image; ?>"
                        style="width:80px;height:80px;object-fit:contain;background:var(--dark);border-radius:8px;padding:6px;">
                    <div>
                        <div style="font-size:13px;font-weight:600;color:var(--text);">Ảnh hiện tại</div>
                        <div style="font-size:11px;color:var(--text-muted);">Tải ảnh mới để thay thế</div>
                    </div>
                </div>
                <?php else: ?>
                <img id="edit-preview" style="display:none;max-height:200px;border-radius:8px;margin-top:10px;">
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <a href="/Product" class="btn-ghost-custom">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn-accent-custom">
                    <i class="fa fa-floppy-disk"></i> Cập nhật
                </button>
            </div>

        </form>
    </div>
</div>
</div>

<script>
function previewEdit(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('edit-preview').src = e.target.result;
            document.getElementById('edit-preview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include 'app/views/shares/footer.php'; ?>