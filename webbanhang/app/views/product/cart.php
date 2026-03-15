<?php include 'app/views/shares/header.php'; ?>

<style>
.cart-layout{display:grid;grid-template-columns:1fr 360px;gap:24px;align-items:start;}
@media(max-width:900px){.cart-layout{grid-template-columns:1fr;}}
.cart-card{background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;}
.cart-card-header{padding:18px 24px;background:rgba(108,60,227,0.06);border-bottom:1px solid var(--card-border);display:flex;align-items:center;justify-content:space-between;}
.cart-card-title{font-size:16px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:8px;}
.cart-item-row{display:grid;grid-template-columns:80px 1fr auto auto auto;align-items:center;gap:16px;padding:16px 24px;border-bottom:1px solid rgba(108,60,227,0.07);transition:background 0.2s;}
.cart-item-row:last-child{border-bottom:none;}
.cart-item-row:hover{background:rgba(108,60,227,0.04);}
.cart-img{width:80px;height:80px;object-fit:contain;background:var(--dark-3);border-radius:var(--radius-sm);padding:8px;}
.cart-item-name{font-size:14px;font-weight:600;color:var(--text);margin-bottom:4px;}
.cart-item-price{font-size:13px;color:var(--text-muted);}
.qty-control{display:flex;align-items:center;gap:0;background:var(--dark-3);border:1px solid var(--card-border);border-radius:var(--radius-sm);overflow:hidden;}
.qty-btn{width:34px;height:34px;background:transparent;border:none;color:var(--text-muted);font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:var(--transition);}
.qty-btn:hover{background:var(--primary);color:white;}
.qty-num{width:38px;text-align:center;font-size:14px;font-weight:700;color:var(--text);border-left:1px solid var(--card-border);border-right:1px solid var(--card-border);height:34px;display:flex;align-items:center;justify-content:center;}
.cart-subtotal{font-size:14px;font-weight:700;color:var(--accent);white-space:nowrap;min-width:110px;text-align:right;}
.btn-remove{width:34px;height:34px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:#F87171;font-size:13px;cursor:pointer;transition:var(--transition);flex-shrink:0;}
.btn-remove:hover{background:var(--danger);border-color:var(--danger);color:white;}
.summary-card{background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;position:sticky;top:140px;}
.summary-header{padding:18px 24px;background:rgba(108,60,227,0.06);border-bottom:1px solid var(--card-border);font-size:16px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:8px;}
.summary-body{padding:20px 24px;}
.summary-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid rgba(108,60,227,0.07);font-size:14px;}
.summary-row:last-child{border-bottom:none;}
.summary-row .label{color:var(--text-muted);}
.summary-row .value{color:var(--text);font-weight:600;}
.summary-total{padding:16px 24px;background:rgba(108,60,227,0.06);border-top:1px solid var(--card-border);display:flex;justify-content:space-between;align-items:center;}
.summary-total .label{color:var(--text);font-weight:700;font-size:15px;}
.summary-total .amount{font-size:22px;font-weight:800;color:var(--accent);}
.summary-footer{padding:16px 24px;display:flex;flex-direction:column;gap:10px;}
.voucher-select{background:var(--dark-3);border:1px solid var(--card-border);color:var(--text);border-radius:var(--radius-sm);padding:10px 14px;font-size:13px;font-family:'Inter',sans-serif;width:100%;outline:none;cursor:pointer;transition:var(--transition);}
.voucher-select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(108,60,227,0.2);}
.voucher-btn{background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;border:none;border-radius:var(--radius-sm);padding:10px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:var(--transition);white-space:nowrap;}
.voucher-btn:hover{opacity:0.9;}
.empty-cart{text-align:center;padding:80px 20px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);color:var(--text-muted);}
.empty-cart-icon{font-size:72px;color:rgba(108,60,227,0.25);margin-bottom:20px;display:block;}

/* Removing animation */
@keyframes fadeOutRow{from{opacity:1;transform:scaleY(1);}to{opacity:0;transform:scaleY(0);transform-origin:top;}}
.removing{animation:fadeOutRow 0.3s ease forwards;}
</style>

<div style="margin-bottom:24px;">
    <div class="section-title">
        <span class="dot"></span> Giỏ hàng của bạn
    </div>
</div>

<?php if (!empty($cart)): ?>
<div class="cart-layout fade-up" id="cart-page-wrap">

    <!-- LEFT: Cart Items -->
    <div>
        <div class="cart-card">
            <div class="cart-card-header">
                <div class="cart-card-title">
                    <i class="fa fa-cart-shopping" style="color:var(--primary-light);"></i>
                    Sản phẩm
                    <span id="cart-item-count" style="font-size:13px;color:var(--text-muted);font-weight:400;">
                        (<?php echo count($cart); ?> mục)
                    </span>
                </div>
            </div>
            <div id="cart-items-body">
            <?php
            $total = 0;
            foreach ($cart as $id => $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <div class="cart-item-row" id="cart-row-<?php echo $id; ?>">
                <!-- Image -->
                <div>
                    <?php if ($item['image']): ?>
                    <img src="/<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-img">
                    <?php else: ?>
                    <div class="cart-img" style="display:flex;align-items:center;justify-content:center;">
                        <i class="fa fa-mobile-screen-button" style="font-size:28px;color:var(--primary);opacity:0.4;"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- Name & Price -->
                <div>
                    <div class="cart-item-name"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="cart-item-price">₫<?php echo number_format($item['price'], 0, ',', '.'); ?> / mục</div>
                </div>
                <!-- Quantity -->
                <div class="qty-control">
                    <button class="qty-btn" onclick="cartQty('decrease', <?php echo $id; ?>)">
                        <i class="fa fa-minus" style="font-size:10px;"></i>
                    </button>
                    <span class="qty-num" id="qty-<?php echo $id; ?>"><?php echo $item['quantity']; ?></span>
                    <button class="qty-btn" onclick="cartQty('increase', <?php echo $id; ?>)">
                        <i class="fa fa-plus" style="font-size:10px;"></i>
                    </button>
                </div>
                <!-- Subtotal -->
                <div class="cart-subtotal" id="subtotal-<?php echo $id; ?>">
                    ₫<?php echo number_format($subtotal, 0, ',', '.'); ?>
                </div>
                <!-- Remove -->
                <div class="btn-remove" onclick="cartRemove(<?php echo $id; ?>)" title="Xóa">
                    <i class="fa fa-trash"></i>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>

        <div style="margin-top:16px;">
            <a href="/Product" class="btn-ghost-custom">
                <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
            </a>
        </div>
    </div>

    <!-- RIGHT: Summary -->
    <div>
        <div class="summary-card">
            <div class="summary-header">
                <i class="fa fa-receipt" style="color:var(--primary-light);"></i> Tóm tắt đơn hàng
            </div>
            <!-- Voucher -->
            <div style="padding:16px 24px;border-bottom:1px solid rgba(108,60,227,0.1);">
                <form method="POST" action="/Product/applyVoucher">
                    <label style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:8px;">
                        <i class="fa fa-ticket" style="color:var(--accent);"></i> Voucher giảm giá
                    </label>
                    <div style="display:flex;gap:8px;">
                        <select name="voucher" class="voucher-select">
                            <option value="">🎟️ Chọn voucher...</option>
                            <option value="GIAM10">🎟️ GIAM10 – Giảm 10.000₫</option>
                            <option value="SALE20">🎟️ SALE20 – Giảm 20.000₫</option>
                            <option value="FREESHIP">🚚 FREESHIP – Giảm 15.000₫</option>
                            <option value="VIP50">💎 VIP50 – Giảm 50.000₫</option>
                        </select>
                        <button type="submit" class="voucher-btn">Áp dụng</button>
                    </div>
                </form>
            </div>
            <div class="summary-body">
                <div class="summary-row">
                    <span class="label">Tổng sản phẩm</span>
                    <span class="value" id="summary-count"><?php echo count($cart); ?> mục</span>
                </div>
                <div class="summary-row">
                    <span class="label">Tạm tính</span>
                    <span class="value" id="summary-subtotal">₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                </div>
                <div class="summary-row">
                    <span class="label">Giảm giá voucher</span>
                    <span class="value" style="color:var(--success);">
                        -₫<?php echo number_format($_SESSION['discount'] ?? 0, 0, ',', '.'); ?>
                    </span>
                </div>
                <div class="summary-row">
                    <span class="label">Phí vận chuyển</span>
                    <span class="value" style="color:var(--success);">Miễn phí</span>
                </div>
            </div>
            <div class="summary-total">
                <span class="label">Tổng thanh toán</span>
                <?php
                $discount = $_SESSION['discount'] ?? 0;
                $final = max(0, $total - $discount);
                ?>
                <span class="amount" id="summary-total">₫<?php echo number_format($final, 0, ',', '.'); ?></span>
            </div>
            <div class="summary-footer">
                <a href="/Product/checkout" class="btn-primary-custom justify-content-center w-100" style="padding:14px 0;font-size:15px;">
                    <i class="fa fa-credit-card"></i> Tiến hành thanh toán
                </a>
            </div>
        </div>
    </div>

</div>

<?php else: ?>
<div class="empty-cart fade-up" id="empty-cart-state">
    <i class="fa fa-cart-shopping empty-cart-icon"></i>
    <h3 style="color:var(--text);margin-bottom:10px;">Giỏ hàng đang trống</h3>
    <p style="margin-bottom:24px;">Khám phá hàng ngàn sản phẩm và thêm vào giỏ hàng!</p>
    <a href="/Product" class="btn-primary-custom">
        <i class="fa fa-shopping-bag"></i> Xem sản phẩm
    </a>
</div>
<?php endif; ?>

<script>
// Cart page AJAX – qty and remove
var serverDiscount = <?php echo intval($_SESSION['discount'] ?? 0); ?>;

function cartQty(action, id) {
    const url = action === 'increase'
        ? '/Product/increaseQuantity/' + id
        : '/Product/decreaseQuantity/' + id;

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
        if (data.removed || data.quantity <= 0) {
            removeRow(id, data);
        } else {
            // Update qty display
            const qtyEl = document.getElementById('qty-' + id);
            if (qtyEl) qtyEl.textContent = data.quantity;
            // Update subtotal
            const subEl = document.getElementById('subtotal-' + id);
            if (subEl) subEl.textContent = '₫' + data.subtotal;
            // Update summary
            updateSummaryFromData(data);
        }
        updateCartBadge(data.cartCount);
    });
}

function cartRemove(id) {
    fetch('/Product/removeFromCart/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        removeRow(id, data);
        updateCartBadge(data.cartCount);
    });
}

function removeRow(id, data) {
    const row = document.getElementById('cart-row-' + id);
    if (row) {
        row.classList.add('removing');
        setTimeout(() => {
            row.remove();
            updateSummaryFromData(data);
            // If no items left, show empty state
            if (data.cartCount === 0 || data.cartItems.length === 0) {
                const wrap = document.getElementById('cart-page-wrap');
                if (wrap) {
                    wrap.innerHTML = `<div class="empty-cart fade-up" style="grid-column:1/-1;">
                        <i class="fa fa-cart-shopping empty-cart-icon"></i>
                        <h3 style="color:var(--text);margin-bottom:10px;">Giỏ hàng đang trống</h3>
                        <p style="margin-bottom:24px;">Hãy thêm sản phẩm để mua sắm nhé!</p>
                        <a href="/Product" class="btn-primary-custom"><i class="fa fa-shopping-bag"></i> Xem sản phẩm</a>
                    </div>`;
                }
            }
        }, 320);
    }
}

function updateSummaryFromData(data) {
    // Re-calculate from items
    if (!data.cartItems) return;
    var total = 0;
    data.cartItems.forEach(i => {
        const qty = parseInt(i.quantity);
        const price = parseInt(i.price.replace(/\./g,''));
        total += qty * price;
    });
    const finalTotal = Math.max(0, total - serverDiscount);
    const fmt = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    const sc = document.getElementById('summary-count');
    const ss = document.getElementById('summary-subtotal');
    const st = document.getElementById('summary-total');
    const ci = document.getElementById('cart-item-count');
    if (sc) sc.textContent = data.cartItems.length + ' mục';
    if (ci) ci.textContent = '(' + data.cartItems.length + ' mục)';
    if (ss) ss.textContent = '₫' + fmt(total);
    if (st) st.textContent = '₫' + fmt(finalTotal);
}

// Allow global cart page updates from header mini-cart
function updateCartPage(data) {
    if (!data.cartItems) return;
    updateSummaryFromData(data);
}
</script>

<?php include 'app/views/shares/footer.php'; ?>