<?php include 'app/views/shares/header.php'; ?>

<style>
.success-wrap {
    max-width: 560px;
    margin: 40px auto;
}

.success-card {
    background: var(--card-bg);
    border: 1px solid rgba(16,185,129,0.25);
    border-radius: var(--radius);
    overflow: hidden;
    text-align: center;
}

.success-top {
    padding: 50px 40px 30px;
    background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02));
}

.success-icon-ring {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: rgba(16,185,129,0.12);
    border: 2px solid rgba(16,185,129,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes popIn {
    0% { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

.success-icon-ring i {
    font-size: 40px;
    color: var(--success);
}

.success-title {
    font-size: 26px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 10px;
}

.success-sub {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.6;
}

.success-divider {
    height: 1px;
    background: rgba(16,185,129,0.15);
    margin: 0;
}

.success-info {
    padding: 24px 40px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: var(--dark-3);
    border-radius: var(--radius-sm);
    border: 1px solid rgba(108,60,227,0.08);
    text-align: left;
}

.info-item i {
    width: 32px;
    height: 32px;
    background: rgba(108,60,227,0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: var(--primary-light);
    flex-shrink: 0;
}

.info-item-text { font-size: 13px; color: var(--text-muted); }
.info-item-text strong { color: var(--text); display: block; font-size: 13px; }

.success-actions {
    padding: 0 40px 40px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>

<div class="success-wrap fade-up">
<div class="success-card">

    <div class="success-top">
        <div class="success-icon-ring">
            <i class="fa fa-circle-check"></i>
        </div>
        <h2 class="success-title">Đặt hàng thành công! 🎉</h2>
        <p class="success-sub">
            Cảm ơn bạn đã mua sắm tại MyShop.<br>
            Đơn hàng đã được tiếp nhận và đang được xử lý.
        </p>
    </div>

    <div class="success-divider"></div>

    <div class="success-info">
        <div class="info-item">
            <i class="fa fa-truck"></i>
            <div class="info-item-text">
                <strong>Thời gian giao hàng</strong>
                Dự kiến 2–4 ngày làm việc
            </div>
        </div>
        <div class="info-item">
            <i class="fa fa-headset"></i>
            <div class="info-item-text">
                <strong>Hỗ trợ khách hàng</strong>
                Hotline: 1800 1234 (Miễn phí, 8h–22h)
            </div>
        </div>
        <div class="info-item">
            <i class="fa fa-rotate-left"></i>
            <div class="info-item-text">
                <strong>Đổi trả hàng</strong>
                30 ngày miễn phí nếu sản phẩm lỗi
            </div>
        </div>
    </div>

    <div class="success-actions">
        <a href="/Product" class="btn-primary-custom justify-content-center" style="padding:14px 0;">
            <i class="fa fa-shopping-bag"></i> Tiếp tục mua sắm
        </a>
        <a href="/Product/orderHistory" class="btn-ghost-custom justify-content-center" style="padding:12px 0;">
            <i class="fa fa-clock-rotate-left"></i> Xem lịch sử đơn hàng
        </a>
    </div>

</div>
</div>

<?php include 'app/views/shares/footer.php'; ?>