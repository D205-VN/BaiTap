<?php include 'app/views/shares/header.php'; ?>

<style>
/* ===== BANNER ===== */
.hero-banner{position:relative;border-radius:var(--radius);overflow:hidden;margin-bottom:28px;height:260px;background:linear-gradient(135deg,#1a0a3e 0%,#0d1b2a 40%,#0f1923 100%);display:flex;align-items:center;border:1px solid var(--card-border);}
.hero-banner::before{content:'';position:absolute;top:-40%;right:-10%;width:500px;height:500px;background:radial-gradient(circle,rgba(108,60,227,0.35) 0%,transparent 60%);pointer-events:none;}
.hero-banner::after{content:'';position:absolute;bottom:-30%;left:10%;width:300px;height:300px;background:radial-gradient(circle,rgba(245,158,11,0.15) 0%,transparent 60%);pointer-events:none;}
.hero-content{position:relative;z-index:2;padding:36px 40px;}
.hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.35);color:var(--accent);padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;margin-bottom:14px;letter-spacing:.5px;}
.hero-title{font-size:32px;font-weight:800;color:white;margin-bottom:10px;line-height:1.2;letter-spacing:-1px;}
.hero-title span{background:linear-gradient(135deg,var(--primary-light),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.hero-sub{color:var(--text-muted);font-size:14px;margin-bottom:20px;}
.hero-img{position:absolute;right:0;top:0;height:100%;width:50%;object-fit:cover;opacity:.45;mix-blend-mode:luminosity;}

/* ===== BRAND FILTER TABS ===== */
.brand-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;align-items:center;}
.brand-tab{display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:24px;font-size:13px;font-weight:600;cursor:pointer;border:1.5px solid var(--card-border);background:var(--card-bg);color:var(--text-muted);transition:var(--transition);text-decoration:none;white-space:nowrap;}
.brand-tab:hover{border-color:var(--primary);color:var(--primary-light);background:rgba(108,60,227,0.07);}
.brand-tab.active{background:linear-gradient(135deg,var(--primary),var(--primary-dark));border-color:var(--primary);color:white;box-shadow:0 4px 14px rgba(108,60,227,0.35);}
.brand-tab img{width:20px;height:20px;object-fit:contain;filter:grayscale(1)brightness(2);}
.brand-tab.active img{filter:none brightness(10);}

/* ===== TOOLBAR ===== */
.toolbar{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:20px;padding:12px 18px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);}
.sort-tabs{display:flex;gap:6px;flex-wrap:wrap;}
.sort-tab{padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;cursor:pointer;border:1px solid var(--card-border);background:transparent;color:var(--text-muted);transition:var(--transition);white-space:nowrap;}
.sort-tab.active,.sort-tab:hover{background:var(--primary);border-color:var(--primary);color:white;}
.toolbar-right{display:flex;align-items:center;gap:10px;}
.filter-select{background:var(--dark-3);border:1px solid var(--card-border);color:var(--text);border-radius:var(--radius-sm);padding:7px 12px;font-size:13px;font-family:'Inter',sans-serif;outline:none;cursor:pointer;transition:var(--transition);}
.filter-select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(108,60,227,0.2);}
.result-count{font-size:13px;color:var(--text-muted);}

/* ===== PRODUCT GRID ===== */
.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;}

/* ===== PRODUCT CARD – CellphoneS Style ===== */
.product-card{background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;transition:var(--transition);position:relative;display:flex;flex-direction:column;cursor:pointer;}
.product-card:hover{border-color:rgba(108,60,227,0.5);box-shadow:0 12px 40px rgba(108,60,227,0.22);transform:translateY(-5px);}

/* Image area */
.pc-img-wrap{position:relative;background:var(--dark-3);height:200px;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.pc-img-wrap img{width:100%;height:100%;object-fit:contain;padding:16px;transition:transform 0.4s ease;}
.product-card:hover .pc-img-wrap img{transform:scale(1.06);}
.pc-img-placeholder{font-size:52px;color:rgba(108,60,227,0.25);}

/* Badges on image */
.pc-badge-wrap{position:absolute;top:10px;left:10px;display:flex;flex-direction:column;gap:5px;z-index:2;}
.pc-badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:3px 8px;border-radius:5px;letter-spacing:.3px;}
.pc-badge-hot{background:#EF4444;color:white;}
.pc-badge-deal{background:var(--primary);color:white;}
.pc-badge-new{background:var(--success);color:white;}
.pc-badge-sale{background:var(--accent);color:var(--dark);}

/* Discount percent bubble */
.pc-discount-bubble{position:absolute;top:10px;right:10px;width:42px;height:42px;background:linear-gradient(135deg,#EF4444,#DC2626);border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;color:white;font-size:11px;font-weight:800;line-height:1.1;z-index:2;box-shadow:0 2px 8px rgba(239,68,68,0.4);}
.pc-discount-bubble span{font-size:9px;font-weight:500;}

/* Wishlist btn */
.pc-wishlist{position:absolute;bottom:10px;right:10px;width:30px;height:30px;background:rgba(30,30,50,0.75);border:1px solid rgba(108,60,227,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:13px;opacity:0;transition:var(--transition);cursor:pointer;z-index:3;backdrop-filter:blur(6px);}
.product-card:hover .pc-wishlist{opacity:1;}
.pc-wishlist:hover{background:var(--danger);color:white;border-color:var(--danger);}

/* Body */
.pc-body{padding:14px 14px 12px;flex:1;display:flex;flex-direction:column;}

.pc-name{font-size:13px;font-weight:600;color:var(--text);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:36px;margin-bottom:8px;}
.pc-name a{color:inherit;text-decoration:none;transition:color .2s;}
.pc-name a:hover{color:var(--primary-light);}

/* Promo tags */
.pc-promo-tags{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:9px;}
.pc-promo-tag{font-size:10px;font-weight:600;padding:2px 7px;border-radius:4px;border:1px solid;}
.pc-promo-tag.blue{background:rgba(108,60,227,0.1);border-color:rgba(108,60,227,0.25);color:var(--primary-light);}
.pc-promo-tag.green{background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.25);color:var(--success);}
.pc-promo-tag.orange{background:rgba(245,158,11,0.1);border-color:rgba(245,158,11,0.25);color:var(--accent);}
.pc-promo-tag.red{background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.25);color:#F87171;}

/* Price */
.pc-price-wrap{margin-bottom:8px;}
.pc-price{font-size:16px;font-weight:800;color:var(--accent);display:block;line-height:1.2;}
.pc-original-price{font-size:11px;color:var(--text-muted);text-decoration:line-through;margin-top:1px;display:block;}

/* Stars */
.pc-stars{display:flex;align-items:center;gap:4px;margin-bottom:10px;}
.pc-stars .stars{color:#FBBF24;font-size:11px;letter-spacing:.5px;}
.pc-stars .count{font-size:11px;color:var(--text-muted);}

/* Add to cart btn */
.pc-cart-btn{display:flex;align-items:center;justify-content:center;gap:6px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;border:none;border-radius:var(--radius-sm);padding:9px 0;width:100%;font-size:12px;font-weight:700;cursor:pointer;transition:var(--transition);margin-top:auto;position:relative;overflow:hidden;}
.pc-cart-btn::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.1),transparent);transition:left .45s ease;}
.product-card:hover .pc-cart-btn::before{left:100%;}
.pc-cart-btn:hover{opacity:.9;box-shadow:0 4px 14px rgba(108,60,227,0.45);transform:translateY(-1px);color:white;}
.pc-cart-btn:disabled{opacity:.6;cursor:not-allowed;transform:none;}

/* Admin quick actions (top of image on hover) */
.pc-admin-bar{position:absolute;top:0;left:0;right:0;background:rgba(15,15,26,0.88);backdrop-filter:blur(8px);padding:7px 10px;display:flex;gap:7px;justify-content:flex-end;transform:translateY(-100%);transition:transform .25s ease;z-index:5;border-bottom:1px solid rgba(108,60,227,0.2);border-radius:var(--radius) var(--radius) 0 0;}
.product-card:hover .pc-admin-bar{transform:translateY(0);}
.pc-admin-btn{width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:12px;text-decoration:none;border:none;cursor:pointer;transition:var(--transition);}
.pc-edit-btn{background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);color:var(--accent);}
.pc-edit-btn:hover{background:var(--accent);color:var(--dark);}
.pc-delete-btn{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#F87171;}
.pc-delete-btn:hover{background:var(--danger);color:white;border-color:var(--danger);}
.pc-view-btn{background:rgba(108,60,227,0.1);border:1px solid rgba(108,60,227,0.25);color:var(--primary-light);}
.pc-view-btn:hover{background:var(--primary);color:white;}

/* Empty state */
.empty-state{text-align:center;padding:80px 20px;color:var(--text-muted);}
.empty-state i{font-size:64px;color:rgba(108,60,227,0.3);margin-bottom:20px;display:block;}

/* Installment highlight */
.pc-installment{font-size:10px;color:var(--success);font-weight:600;display:flex;align-items:center;gap:4px;margin-bottom:6px;}
</style>

<!-- HERO BANNER -->
<div class="hero-banner fade-up">
    <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/public/images/BannerSmartphone.png')): ?>
    <img src="/public/images/BannerSmartphone.png" class="hero-img" alt="Banner">
    <?php endif; ?>
    <div class="hero-content">
        <div class="hero-badge"><i class="fa fa-bolt"></i> FLASH SALE HÔM NAY</div>
        <h1 class="hero-title">Điện thoại <span>chính hãng</span><br>giá siêu tốt 2026</h1>
        <p class="hero-sub"><i class="fa fa-shield-halved" style="color:var(--success);margin-right:4px;"></i>Bảo hành 12 tháng &nbsp;·&nbsp; <i class="fa fa-truck" style="color:var(--primary-light);margin-right:4px;"></i>Giao hàng 2h &nbsp;·&nbsp; <i class="fa fa-rotate-left" style="color:var(--accent);margin-right:4px;"></i>Đổi trả 30 ngày</p>
        <a href="#products" class="btn-primary-custom"><i class="fa fa-fire"></i> Mua ngay</a>
    </div>
</div>

<!-- BRAND FILTER TABS -->
<div class="brand-tabs" id="products">
    <a href="/Product/" class="brand-tab <?php echo !isset($_GET['category_id']) ? 'active' : ''; ?>">
        <i class="fa fa-border-all" style="font-size:13px;"></i> Tất cả
    </a>
    <?php foreach ($categories as $category): ?>
    <a href="/Product/?category_id=<?php echo $category->id; ?>"
       class="brand-tab <?php echo (isset($_GET['category_id']) && $_GET['category_id']==$category->id) ? 'active' : ''; ?>">
        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
    </a>
    <?php endforeach; ?>
</div>

<!-- TOOLBAR -->
<div class="toolbar">
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
        <span class="section-title" style="font-size:16px;margin-bottom:0;"><span class="dot"></span> Sản phẩm nổi bật</span>
        <div class="sort-tabs">
            <button class="sort-tab active" onclick="sortProducts('default',this)">Phổ biến</button>
            <button class="sort-tab" onclick="sortProducts('price-asc',this)">Giá thấp</button>
            <button class="sort-tab" onclick="sortProducts('price-desc',this)">Giá cao</button>
            <button class="sort-tab" onclick="sortProducts('name',this)">A → Z</button>
        </div>
    </div>
    <div class="toolbar-right">
        <span class="result-count">
            <i class="fa fa-box" style="color:var(--primary-light);margin-right:4px;"></i>
            <?php echo count($products); ?> sản phẩm
        </span>
        <a href="/Product/add" class="btn-accent-custom" style="padding:7px 14px;font-size:12px;">
            <i class="fa fa-plus"></i> Thêm mới
        </a>
    </div>
</div>

<!-- PRODUCTS GRID -->
<?php if (!empty($products)): ?>
<div class="product-grid fade-up" id="product-grid">

<?php
// Assign pseudo-random badges and ratings for display variation
$badgeTypes  = [['hot','HOT'], ['deal','DEAL'], ['new','MỚI'], ['sale','SALE']];
$promoSets = [
    [['blue','Trả góp 0%'], ['green','Tặng tai nghe']],
    [['blue','Trả góp 0%'], ['orange','Giảm thêm 5%']],
    [['green','Bảo hành 1 năm'], ['red','Hết hàng sớm']],
    [['blue','Online Deal'], ['green','Ship nhanh 2h']],
];
$i = 0;
foreach ($products as $product):
    $rating = rand(42, 50) / 10;           // e.g. 4.5
    $reviewCount = rand(12, 340);
    $discountPct = [0, 0, 5, 7, 10, 12, 15][$i % 7];
    $originalPrice = $discountPct > 0 ? round($product->price / (1 - $discountPct/100) / 1000) * 1000 : 0;
    $badge = $badgeTypes[$i % count($badgeTypes)];
    $promos = $promoSets[$i % count($promoSets)];
    $i++;
?>
<div class="product-card" data-price="<?php echo $product->price; ?>" data-name="<?php echo htmlspecialchars($product->name); ?>">

    <!-- Image area -->
    <div class="pc-img-wrap">

        <!-- Admin action bar at TOP of image -->
        <div class="pc-admin-bar">
            <a href="/Product/show/<?php echo $product->id; ?>" class="pc-admin-btn pc-view-btn" title="Xem chi tiết" onclick="event.stopPropagation();">
                <i class="fa fa-eye"></i>
            </a>
            <a href="/Product/edit/<?php echo $product->id; ?>" class="pc-admin-btn pc-edit-btn" title="Chỉnh sửa" onclick="event.stopPropagation();">
                <i class="fa fa-pen"></i>
            </a>
            <a href="/Product/delete/<?php echo $product->id; ?>" class="pc-admin-btn pc-delete-btn" title="Xóa"
               onclick="return confirm('Xóa sản phẩm này?');">
                <i class="fa fa-trash"></i>
            </a>
        </div>

        <?php if ($product->image): ?>
        <img src="/<?php echo $product->image; ?>" alt="<?php echo htmlspecialchars($product->name); ?>" loading="lazy">
        <?php else: ?>
        <div class="pc-img-placeholder"><i class="fa fa-mobile-screen-button"></i></div>
        <?php endif; ?>

        <!-- Badge top-left -->
        <div class="pc-badge-wrap">
            <span class="pc-badge pc-badge-<?php echo $badge[0]; ?>"><?php echo $badge[1]; ?></span>
        </div>

        <!-- Discount bubble top-right -->
        <?php if ($discountPct > 0): ?>
        <div class="pc-discount-bubble">-<?php echo $discountPct; ?>%<span>OFF</span></div>
        <?php endif; ?>

        <!-- Wishlist -->
        <div class="pc-wishlist" title="Yêu thích" onclick="event.stopPropagation();">
            <i class="fa fa-heart"></i>
        </div>
    </div>

    <!-- Card body -->
    <div class="pc-body">

        <!-- Name -->
        <div class="pc-name">
            <a href="/Product/show/<?php echo $product->id; ?>">
                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </div>

        <!-- Promo tags -->
        <div class="pc-promo-tags">
            <?php foreach ($promos as $promo): ?>
            <span class="pc-promo-tag <?php echo $promo[0]; ?>"><?php echo $promo[1]; ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Stars -->
        <div class="pc-stars">
            <span class="stars">
                <?php
                $fullStars  = floor($rating);
                $halfStar   = ($rating - $fullStars) >= 0.5;
                for ($s = 1; $s <= 5; $s++):
                    if ($s <= $fullStars): ?><i class="fas fa-star"></i><?php
                    elseif ($s == $fullStars + 1 && $halfStar): ?><i class="fas fa-star-half-stroke"></i><?php
                    else: ?><i class="far fa-star" style="opacity:.4;"></i><?php
                    endif;
                endfor;
                ?>
            </span>
            <span class="count"><?php echo number_format($rating, 1); ?> (<?php echo $reviewCount; ?>)</span>
        </div>

        <!-- Installment -->
        <div class="pc-installment">
            <i class="fa fa-credit-card" style="color:var(--success);"></i>
            Trả góp 0% · từ <?php echo number_format(round($product->price / 12), 0, ',', '.'); ?>₫/tháng
        </div>

        <!-- Price -->
        <div class="pc-price-wrap">
            <span class="pc-price">₫<?php echo number_format($product->price, 0, ',', '.'); ?></span>
            <?php if ($originalPrice > 0): ?>
            <span class="pc-original-price">₫<?php echo number_format($originalPrice, 0, ',', '.'); ?></span>
            <?php endif; ?>
        </div>

        <!-- Add to cart -->
        <button class="pc-cart-btn" onclick="addToCart(<?php echo $product->id; ?>, this)">
            <i class="fa fa-cart-plus"></i> Thêm vào giỏ
        </button>

    </div>

</div>
<?php endforeach; ?>
</div>

<?php else: ?>
<div class="empty-state">
    <i class="fa fa-box-open"></i>
    <h4 style="color:var(--text);margin-bottom:8px;">Chưa có sản phẩm nào</h4>
    <p>Hãy thêm sản phẩm đầu tiên để bắt đầu</p>
    <a href="/Product/add" class="btn-primary-custom mt-3"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
</div>
<?php endif; ?>

<script>
// ===== Client-side sort =====
function sortProducts(mode, btn) {
    // Update active tab
    document.querySelectorAll('.sort-tab').forEach(t => t.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const grid = document.getElementById('product-grid');
    if (!grid) return;
    const cards = Array.from(grid.querySelectorAll('.product-card'));

    cards.sort((a, b) => {
        if (mode === 'price-asc')  return parseInt(a.dataset.price) - parseInt(b.dataset.price);
        if (mode === 'price-desc') return parseInt(b.dataset.price) - parseInt(a.dataset.price);
        if (mode === 'name')       return a.dataset.name.localeCompare(b.dataset.name, 'vi');
        return 0; // default: keep original
    });

    // Re-append in sorted order with fade
    cards.forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(10px)';
        grid.appendChild(card);
        setTimeout(() => {
            card.style.transition = 'opacity .3s ease, transform .3s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, i * 30);
    });
}

// Wishlist toggle
document.querySelectorAll('.pc-wishlist').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const icon = this.querySelector('i');
        if (icon.classList.contains('fas')) {
            icon.classList.replace('fas', 'far');
            this.style.background = 'rgba(30,30,50,0.75)';
            this.style.color = 'var(--text-muted)';
        } else {
            icon.classList.replace('far', 'fas');
            this.style.background = 'var(--danger)';
            this.style.color = 'white';
            this.style.borderColor = 'var(--danger)';
        }
    });
});
</script>

<?php include 'app/views/shares/footer.php'; ?>