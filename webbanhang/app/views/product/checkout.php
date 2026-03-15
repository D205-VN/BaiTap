<?php include 'app/views/shares/header.php'; ?>

<style>
.checkout-wrap {
    max-width: 720px;
    margin: 0 auto;
}

.checkout-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
}

.checkout-header {
    padding: 24px 28px;
    background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.04));
    border-bottom: 1px solid var(--card-border);
    display: flex;
    align-items: center;
    gap: 14px;
}

.checkout-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--success), #059669);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: white;
    box-shadow: 0 4px 12px rgba(16,185,129,0.4);
}

.checkout-body { padding: 28px; }

.step-indicator {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 32px;
}

.step-item {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.step-item:last-child { flex: 0; }

.step-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    flex-shrink: 0;
}

.step-active .step-circle {
    background: var(--primary);
    color: white;
    box-shadow: 0 0 0 4px rgba(108,60,227,0.2);
}

.step-done .step-circle {
    background: var(--success);
    color: white;
}

.step-pending .step-circle {
    background: var(--dark-3);
    color: var(--text-muted);
    border: 1px solid var(--card-border);
}

.step-label {
    font-size: 12px;
    font-weight: 600;
}

.step-active .step-label { color: var(--primary-light); }
.step-done .step-label { color: var(--success); }
.step-pending .step-label { color: var(--text-muted); }

.step-line {
    flex: 1;
    height: 1px;
    background: var(--card-border);
    margin: 0 8px;
}

.field-group { margin-bottom: 20px; }

.field-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 7px;
}

.field-icon-wrap {
    position: relative;
}

.field-icon-wrap .fi-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 14px;
    pointer-events: none;
}

.field-icon-wrap input,
.field-icon-wrap textarea {
    padding-left: 40px;
}

.field-icon-wrap.textarea-wrap .fi-icon {
    top: 14px;
    transform: none;
}

.checkout-actions {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid rgba(108,60,227,0.1);
}

.btn-pay {
    flex: 1;
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    padding: 14px 0;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-pay:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16,185,129,0.4);
}
</style>

<!-- Breadcrumb -->
<nav style="margin-bottom:20px;font-size:13px;color:var(--text-muted);">
    <a href="/Product/" style="color:var(--primary-light);">Trang chủ</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <a href="/Product/cart" style="color:var(--primary-light);">Giỏ hàng</a>
    <span style="margin:0 8px;color:rgba(255,255,255,0.2);">/</span>
    <span>Thanh toán</span>
</nav>

<div class="checkout-wrap fade-up">
<div class="checkout-card">

    <div class="checkout-header">
        <div class="checkout-icon">
            <i class="fa fa-credit-card"></i>
        </div>
        <div>
            <h2 style="font-size:20px;font-weight:700;color:var(--text);margin:0;">Thanh toán đơn hàng</h2>
            <p style="font-size:12px;color:var(--text-muted);margin:2px 0 0;">Vui lòng điền đầy đủ thông tin giao hàng</p>
        </div>
    </div>

    <div class="checkout-body">

        <!-- Steps -->
        <div class="step-indicator">
            <div class="step-item step-done">
                <div class="step-circle"><i class="fa fa-check" style="font-size:11px;"></i></div>
                <span class="step-label">Giỏ hàng</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item step-active">
                <div class="step-circle">2</div>
                <span class="step-label">Thông tin</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item step-pending">
                <div class="step-circle">3</div>
                <span class="step-label">Xác nhận</span>
            </div>
        </div>

        <form method="POST" action="/Product/processCheckout">

            <!-- Full Name -->
            <div class="field-group">
                <label class="field-label">
                    <i class="fa fa-user" style="color:var(--primary-light);margin-right:4px;"></i> Họ và tên
                </label>
                <div class="field-icon-wrap">
                    <i class="fi-icon fa fa-user"></i>
                    <input type="text" name="name" class="form-control"
                        placeholder="Nguyễn Văn A" required>
                </div>
            </div>

            <!-- Phone -->
            <div class="field-group">
                <label class="field-label">
                    <i class="fa fa-phone" style="color:var(--success);margin-right:4px;"></i> Số điện thoại
                </label>
                <div class="field-icon-wrap">
                    <i class="fi-icon fa fa-phone"></i>
                    <input type="text" name="phone" class="form-control"
                        placeholder="0901 234 567" required>
                </div>
            </div>

            <!-- Address -->
            <div class="field-group">
                <label class="field-label">
                    <i class="fa fa-map-marker-alt" style="color:var(--accent);margin-right:4px;"></i> Địa chỉ giao hàng
                </label>
                <div class="field-icon-wrap textarea-wrap">
                    <i class="fi-icon fa fa-map-marker-alt"></i>
                    <textarea name="address" class="form-control" rows="3"
                        placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required></textarea>
                </div>
            </div>

            <!-- Shipping note -->
            <div style="background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.2);border-radius:var(--radius-sm);padding:14px 18px;font-size:13px;color:var(--text-muted);display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                <i class="fa fa-truck" style="color:var(--success);font-size:18px;flex-shrink:0;"></i>
                <span>Giao hàng miễn phí toàn quốc · Dự kiến nhận hàng trong <strong style="color:var(--text);">2–4 ngày làm việc</strong></span>
            </div>

            <div class="checkout-actions">
                <a href="/Product/cart" class="btn-ghost-custom">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn-pay">
                    <i class="fa fa-circle-check"></i> Xác nhận thanh toán
                </button>
            </div>

        </form>
    </div>
</div>
</div>

<?php include 'app/views/shares/footer.php'; ?>