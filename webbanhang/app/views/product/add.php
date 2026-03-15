<?php include 'app/views/shares/header.php'; ?>

<style>
.form-page-wrap {
    max-width: 720px;
    margin: 0 auto;
}

.form-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
}

.form-card-header {
    padding: 24px 28px;
    background: linear-gradient(135deg, rgba(108,60,227,0.15), rgba(108,60,227,0.05));
    border-bottom: 1px solid var(--card-border);
    display: flex;
    align-items: center;
    gap: 14px;
}

.form-card-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: white;
    box-shadow: 0 4px 12px rgba(108,60,227,0.4);
}

.form-card-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--text);
    margin: 0;
}

.form-card-subtitle {
    font-size: 12px;
    color: var(--text-muted);
    margin: 2px 0 0;
}

.form-card-body {
    padding: 28px;
}

.form-label-custom {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 7px;
}

.form-group-custom {
    margin-bottom: 22px;
}

.form-hint {
    font-size: 11px;
    color: var(--text-muted);
    margin-top: 5px;
}

.upload-area {
    border: 2px dashed var(--card-border);
    border-radius: var(--radius-sm);
    padding: 28px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    background: var(--dark-3);
    position: relative;
}

.upload-area:hover, .upload-area.dragover {
    border-color: var(--primary);
    background: rgba(108,60,227,0.05);
}

.upload-area input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.upload-icon {
    font-size: 36px;
    color: rgba(108,60,227,0.4);
    margin-bottom: 10px;
}

.upload-text { font-size: 13px; color: var(--text-muted); }
.upload-text strong { color: var(--primary-light); }

.price-input-wrap {
    position: relative;
}

.price-input-wrap .currency {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    font-weight: 700;
    font-size: 14px;
    pointer-events: none;
}

.price-input-wrap input { padding-right: 36px; }

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(108,60,227,0.1);
}
</style>

<!-- Breadcrumb -->
<nav style="margin-bottom:20px;font-size:13px;color:var(--text-muted);">
    <a href="/Product/" style="color:var(--primary-light);">Trang chủ</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <span>Thêm sản phẩm</span>
</nav>

<div class="form-page-wrap fade-up">
<div class="form-card">

    <!-- Header -->
    <div class="form-card-header">
        <div class="form-card-icon">
            <i class="fa fa-plus"></i>
        </div>
        <div>
            <h2 class="form-card-title">Thêm sản phẩm mới</h2>
            <p class="form-card-subtitle">Điền đầy đủ thông tin để thêm sản phẩm vào cửa hàng</p>
        </div>
    </div>

    <!-- Body -->
    <div class="form-card-body">

        <?php if (!empty($errors)): ?>
        <div class="alert-custom-danger mb-4">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;font-weight:600;">
                <i class="fa fa-circle-exclamation"></i> Có lỗi xảy ra:
            </div>
            <ul style="margin:0;padding-left:20px;">
                <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="POST" action="/Product/save" enctype="multipart/form-data">

            <!-- Product Name -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-tag" style="color:var(--primary);margin-right:6px;"></i> Tên sản phẩm *
                </label>
                <input type="text" name="name" class="form-control"
                    placeholder="VD: iPhone 16 Pro Max 256GB" required>
            </div>

            <!-- Description -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-align-left" style="color:var(--primary);margin-right:6px;"></i> Mô tả sản phẩm *
                </label>
                <textarea name="description" class="form-control" rows="4"
                    placeholder="Mô tả chi tiết về sản phẩm..." required></textarea>
            </div>

            <!-- Price & Category -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label-custom">
                        <i class="fa fa-dollar-sign" style="color:var(--accent);margin-right:6px;"></i> Giá bán *
                    </label>
                    <div class="price-input-wrap">
                        <input type="number" name="price" class="form-control"
                            placeholder="0" min="0" required>
                        <span class="currency">₫</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">
                        <i class="fa fa-folder" style="color:var(--primary-light);margin-right:6px;"></i> Danh mục *
                    </label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>">
                            <?php echo htmlspecialchars($category->name); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fa fa-image" style="color:var(--success);margin-right:6px;"></i> Hình ảnh sản phẩm
                </label>
                <div class="upload-area">
                    <input type="file" name="image" accept="image/*"
                        onchange="previewImage(this)">
                    <div id="upload-content">
                        <div class="upload-icon"><i class="fa fa-cloud-arrow-up"></i></div>
                        <div class="upload-text">
                            <strong>Nhấp để tải ảnh lên</strong> hoặc kéo thả vào đây<br>
                            <span style="font-size:11px;margin-top:4px;display:block;">PNG, JPG, WEBP – Tối đa 5MB</span>
                        </div>
                    </div>
                    <img id="image-preview" style="display:none;max-height:200px;border-radius:8px;margin-top:10px;">
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="/Product" class="btn-ghost-custom">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn-primary-custom">
                    <i class="fa fa-floppy-disk"></i> Lưu sản phẩm
                </button>
            </div>

        </form>
    </div>
</div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('image-preview');
            const content = document.getElementById('upload-content');
            preview.src = e.target.result;
            preview.style.display = 'block';
            content.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include 'app/views/shares/footer.php'; ?>