<?php include 'app/views/shares/header.php'; ?>

<style>
.product-detail-wrap {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

@media (max-width: 768px) {
    .product-detail-wrap { grid-template-columns: 1fr; gap: 24px; }
}

.product-img-box {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 380px;
    position: relative;
    overflow: hidden;
}

.product-img-box::before {
    content: '';
    position: absolute;
    top: -40%;
    left: -40%;
    width: 180%;
    height: 180%;
    background: radial-gradient(circle at center, rgba(108,60,227,0.08) 0%, transparent 60%);
    pointer-events: none;
}

.product-img-box img {
    max-height: 320px;
    object-fit: contain;
    position: relative;
    z-index: 1;
    transition: transform 0.4s ease;
}

.product-img-box:hover img { transform: scale(1.04); }

.product-info-box {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 32px;
}

.product-name {
    font-size: 24px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 10px;
    line-height: 1.3;
    letter-spacing: -0.5px;
}

.product-price {
    font-size: 32px;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 20px;
}

.product-description {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 20px;
    padding: 16px;
    background: var(--dark-3);
    border-radius: var(--radius-sm);
    border-left: 3px solid var(--primary);
}

.feature-row {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(108,60,227,0.08);
    font-size: 13px;
}

.feature-row:last-child { border-bottom: none; }

.feature-row .label { color: var(--text-muted); width: 120px; flex-shrink: 0; }
.feature-row .value { color: var(--text); font-weight: 500; }

.action-btns {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    flex-wrap: wrap;
}

.btn-cart-main {
    flex: 1;
    background: linear-gradient(135deg, var(--accent), var(--accent-dark));
    color: var(--dark);
    border: none;
    border-radius: var(--radius-sm);
    padding: 14px 0;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 180px;
}

.btn-cart-main:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245,158,11,0.4);
    color: var(--dark);
}

.trust-row {
    display: flex;
    gap: 12px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--text-muted);
}

.trust-item i { color: var(--success); }
</style>

<!-- Breadcrumb -->
<nav style="margin-bottom:20px;font-size:13px;color:var(--text-muted);">
    <a href="/Product/" style="color:var(--primary-light);">Trang chủ</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <a href="/Product/" style="color:var(--primary-light);">Sản phẩm</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <span><?php echo isset($product) ? htmlspecialchars($product->name) : 'Chi tiết'; ?></span>
</nav>

<?php if ($product): ?>
<div class="product-detail-wrap fade-up">

    <!-- Image -->
    <div class="product-img-box">
        <?php if ($product->image): ?>
        <img src="/<?php echo $product->image; ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
        <?php else: ?>
        <div style="text-align:center;color:var(--text-muted);">
            <i class="fa fa-mobile-screen-button" style="font-size:80px;color:rgba(108,60,227,0.3);"></i>
            <p style="margin-top:12px;font-size:13px;">Chưa có hình ảnh</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="product-info-box">
        <div class="product-name"><?php echo htmlspecialchars($product->name); ?></div>

        <div style="margin-bottom:16px;">
            <span class="badge-custom badge-primary-custom">
                <i class="fa fa-tag"></i>
                <?php echo $product->category_name ?? 'Chưa phân loại'; ?>
            </span>
            <span class="badge-custom badge-accent-custom ms-2">
                <i class="fa fa-shield"></i> Chính hãng
            </span>
        </div>

        <div class="product-price">
            ₫<?php echo number_format($product->price, 0, ',', '.'); ?>
        </div>

        <div class="product-description">
            <?php echo nl2br(htmlspecialchars($product->description)); ?>
        </div>

        <div class="feature-row">
            <span class="label"><i class="fa fa-truck" style="color:var(--primary-light);width:16px;"></i> Giao hàng</span>
            <span class="value">Miễn phí toàn quốc</span>
        </div>
        <div class="feature-row">
            <span class="label"><i class="fa fa-rotate-left" style="color:var(--accent);width:16px;"></i> Đổi trả</span>
            <span class="value">30 ngày miễn phí</span>
        </div>
        <div class="feature-row">
            <span class="label"><i class="fa fa-wrench" style="color:var(--success);width:16px;"></i> Bảo hành</span>
            <span class="value">12 tháng chính hãng</span>
        </div>

        <div class="action-btns">
            <button onclick="addToCart(<?php echo $product->id; ?>, this)" class="btn-cart-main" style="border:none;cursor:pointer;">
                <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
            </button>
            <a href="/Product" class="btn-ghost-custom">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="trust-row">
            <span class="trust-item"><i class="fa fa-shield-halved"></i> An toàn 100%</span>
            <span class="trust-item"><i class="fa fa-circle-check"></i> Chính hãng</span>
            <span class="trust-item"><i class="fa fa-headset"></i> Hỗ trợ 24/7</span>
        </div>
    </div>

</div>
<?php else: ?>
<div class="alert-custom-danger text-center">
    <i class="fa fa-circle-exclamation fa-2x mb-3" style="display:block;"></i>
    <strong>Không tìm thấy sản phẩm</strong>
    <p class="mb-0 mt-1">Sản phẩm không tồn tại hoặc đã bị xóa.</p>
</div>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>