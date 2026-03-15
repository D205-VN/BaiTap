<?php include 'app/views/shares/header.php'; ?>
<?php $orders = $orders ?? []; ?>

<style>
.order-history-wrap { animation: fadeInUp 0.5s ease forwards; }

.oh-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
}

.oh-card-header {
    padding: 20px 24px;
    background: rgba(108,60,227,0.06);
    border-bottom: 1px solid var(--card-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.oh-empty {
    text-align: center;
    padding: 80px 20px;
    color: var(--text-muted);
}

.oh-empty i {
    font-size: 64px;
    color: rgba(108,60,227,0.2);
    margin-bottom: 20px;
    display: block;
}

/* Order rows */
.order-row {
    display: grid;
    grid-template-columns: 80px 1fr 120px 1fr 140px;
    align-items: center;
    gap: 16px;
    padding: 16px 24px;
    border-bottom: 1px solid rgba(108,60,227,0.07);
    transition: background 0.2s;
}

.order-row:last-child { border-bottom: none; }
.order-row:hover { background: rgba(108,60,227,0.04); }

.order-id {
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-light);
}

.order-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}

.order-phone {
    font-size: 13px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 5px;
}

.order-address {
    font-size: 12px;
    color: var(--text-muted);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.order-date {
    font-size: 12px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}

.order-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    background: rgba(16,185,129,0.15);
    color: var(--success);
    border: 1px solid rgba(16,185,129,0.25);
}

/* Table header */
.oh-header-row {
    display: grid;
    grid-template-columns: 80px 1fr 120px 1fr 140px;
    gap: 16px;
    padding: 12px 24px;
    background: rgba(108,60,227,0.05);
    border-bottom: 1px solid var(--card-border);
}

.oh-header-row span {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 768px) {
    .order-row, .oh-header-row {
        grid-template-columns: 1fr 1fr;
    }
}
</style>

<!-- Page Header -->
<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div class="section-title" style="margin-bottom:0;">
        <span class="dot"></span> Lịch sử đơn hàng
    </div>
    <a href="/Product" class="btn-ghost-custom" style="font-size:13px;padding:8px 16px;">
        <i class="fa fa-arrow-left"></i> Quay lại shop
    </a>
</div>

<div class="order-history-wrap">
<div class="oh-card">

<?php if (!empty($orders)): ?>

    <div class="oh-card-header">
        <span style="font-size:15px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:8px;">
            <i class="fa fa-clock-rotate-left" style="color:var(--primary-light);"></i>
            Tất cả đơn hàng
        </span>
        <span class="badge-custom badge-primary-custom"><?php echo count($orders); ?> đơn</span>
    </div>

    <div class="oh-header-row">
        <span>Mã đơn</span>
        <span>Khách hàng</span>
        <span>Điện thoại</span>
        <span>Địa chỉ giao</span>
        <span>Ngày đặt</span>
    </div>

    <?php foreach ($orders as $order): ?>
    <div class="order-row">
        <div>
            <div class="order-id">#<?php echo $order->id; ?></div>
            <div class="order-status-badge mt-1">
                <i class="fa fa-circle-check" style="font-size:9px;"></i> Đã nhận
            </div>
        </div>
        <div class="order-name"><?php echo htmlspecialchars($order->name); ?></div>
        <div class="order-phone">
            <i class="fa fa-phone" style="font-size:10px;color:var(--success);"></i>
            <?php echo htmlspecialchars($order->phone); ?>
        </div>
        <div class="order-address">
            <i class="fa fa-map-marker-alt" style="font-size:10px;color:var(--accent);"></i>
            <?php echo htmlspecialchars($order->address); ?>
        </div>
        <div class="order-date">
            <i class="fa fa-calendar" style="font-size:10px;color:var(--primary-light);"></i>
            <?php echo isset($order->created_at) ? date('d/m/Y H:i', strtotime($order->created_at)) : '–'; ?>
        </div>
    </div>
    <?php endforeach; ?>

<?php else: ?>

    <div class="oh-empty">
        <i class="fa fa-box-open"></i>
        <h4 style="color:var(--text);margin-bottom:8px;">Chưa có đơn hàng nào</h4>
        <p style="margin-bottom:24px;">Hãy bắt đầu mua sắm để xem lịch sử đơn hàng</p>
        <a href="/Product" class="btn-primary-custom">
            <i class="fa fa-shopping-bag"></i> Mua hàng ngay
        </a>
    </div>

<?php endif; ?>

</div>
</div>

<?php include 'app/views/shares/footer.php'; ?>