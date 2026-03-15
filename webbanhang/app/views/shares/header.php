<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MyShop – Điện Thoại Chính Hãng</title>
<meta name="description" content="Website bán điện thoại chính hãng, giá tốt nhất thị trường.">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ===== DESIGN SYSTEM ===== */
:root {
    --primary:       #6C3CE3;
    --primary-dark:  #4F28C2;
    --primary-light: #8B5CF6;
    --accent:        #F59E0B;
    --accent-dark:   #D97706;
    --danger:        #EF4444;
    --success:       #10B981;
    --dark:          #0F0F1A;
    --dark-2:        #1A1A2E;
    --dark-3:        #16213E;
    --card-bg:       #1E1E32;
    --card-border:   rgba(108,60,227,0.2);
    --text:          #E2E2F0;
    --text-muted:    #9090B0;
    --glass-bg:      rgba(30,30,50,0.85);
    --glass-border:  rgba(108,60,227,0.3);
    --radius:        14px;
    --radius-sm:     8px;
    --shadow:        0 8px 32px rgba(108,60,227,0.25);
    --transition:    all 0.3s cubic-bezier(0.4,0,0.2,1);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

body {
    font-family: 'Inter', sans-serif;
    background: var(--dark);
    color: var(--text);
    min-height: 100vh;
    line-height: 1.6;
}

body::before {
    content:'';position:fixed;inset:0;
    background-image: linear-gradient(rgba(108,60,227,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(108,60,227,0.03) 1px,transparent 1px);
    background-size:40px 40px;pointer-events:none;z-index:0;
}

/* ===== TOPBAR ===== */
.topbar{background:var(--dark-2);border-bottom:1px solid rgba(108,60,227,0.15);font-size:12px;padding:6px 0;position:relative;z-index:100;}
.topbar a{color:var(--text-muted);text-decoration:none;margin-left:18px;transition:var(--transition);display:inline-flex;align-items:center;gap:5px;}
.topbar a:hover{color:var(--primary-light);}
.topbar-badge{background:var(--primary);color:white;border-radius:20px;padding:1px 7px;font-size:10px;font-weight:600;}

/* ===== MAIN HEADER ===== */
.main-header{background:var(--dark-2);border-bottom:1px solid var(--glass-border);padding:14px 0;position:sticky;top:0;z-index:999;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 4px 20px rgba(0,0,0,0.4);}

/* ===== LOGO ===== */
.logo{display:inline-flex;align-items:center;gap:10px;text-decoration:none;font-size:22px;font-weight:800;background:linear-gradient(135deg,var(--primary-light),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;transition:var(--transition);letter-spacing:-0.5px;}
.logo-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;-webkit-text-fill-color:white;box-shadow:0 4px 15px rgba(108,60,227,0.5);flex-shrink:0;}
.logo:hover{opacity:0.85;}

/* ===== SEARCH BOX ===== */
.search-wrapper{position:relative;flex:1;}
.search-box{display:flex;background:var(--dark-3);border:1px solid var(--card-border);border-radius:12px;overflow:visible;transition:var(--transition);}
.search-box:focus-within{border-color:var(--primary);box-shadow:0 0 0 3px rgba(108,60,227,0.2);}
.search-box input{flex:1;background:transparent;border:none;outline:none;padding:10px 16px;color:var(--text);font-size:14px;font-family:'Inter',sans-serif;border-radius:12px 0 0 12px;}
.search-box input::placeholder{color:var(--text-muted);}
.search-box button{background:linear-gradient(135deg,var(--primary),var(--primary-dark));border:none;color:white;padding:10px 20px;cursor:pointer;font-size:14px;transition:var(--transition);border-radius:0 12px 12px 0;}
.search-box button:hover{opacity:0.85;}

/* ===== SEARCH DROPDOWN ===== */
#search-dropdown{
    display:none;
    position:absolute;
    top:calc(100% + 8px);
    left:0;right:0;
    background:var(--card-bg);
    border:1px solid var(--card-border);
    border-radius:var(--radius);
    box-shadow:0 16px 40px rgba(0,0,0,0.5);
    z-index:9999;
    max-height:400px;
    overflow-y:auto;
}
#search-dropdown.active{display:block;}
.search-result-item{display:flex;align-items:center;gap:12px;padding:12px 16px;border-bottom:1px solid rgba(108,60,227,0.08);text-decoration:none;color:var(--text);transition:background 0.2s;cursor:pointer;}
.search-result-item:last-child{border-bottom:none;}
.search-result-item:hover{background:rgba(108,60,227,0.1);}
.search-result-img{width:44px;height:44px;object-fit:contain;background:var(--dark-3);border-radius:8px;padding:4px;flex-shrink:0;}
.search-result-name{font-size:13px;font-weight:600;color:var(--text);}
.search-result-price{font-size:12px;color:var(--accent);font-weight:700;margin-top:2px;}
.search-no-result{padding:20px;text-align:center;color:var(--text-muted);font-size:13px;}
#search-dropdown::-webkit-scrollbar{width:4px;}
#search-dropdown::-webkit-scrollbar-thumb{background:var(--primary);border-radius:2px;}

/* ===== HEADER ACTIONS ===== */
.header-actions{display:flex;align-items:center;gap:12px;}
.action-btn{position:relative;width:42px;height:42px;background:var(--dark-3);border:1px solid var(--card-border);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:18px;transition:var(--transition);cursor:pointer;}
.action-btn:hover{background:var(--primary);border-color:var(--primary);color:white;transform:translateY(-2px);box-shadow:0 4px 15px rgba(108,60,227,0.4);}
.action-btn .badge-count{position:absolute;top:-6px;right:-6px;background:var(--danger);color:white;font-size:10px;font-weight:700;min-width:18px;height:18px;border-radius:9px;display:flex;align-items:center;justify-content:center;border:2px solid var(--dark-2);padding:0 3px;transition:var(--transition);}

/* ===== NAV MENU ===== */
.nav-menu{background:var(--dark-3);border-bottom:1px solid rgba(108,60,227,0.12);padding:0;position:relative;z-index:99;}
.nav-menu .container{display:flex;align-items:center;gap:0;}
.nav-link-custom{color:var(--text-muted);text-decoration:none;font-size:13px;font-weight:500;padding:12px 18px;display:flex;align-items:center;gap:7px;position:relative;transition:var(--transition);white-space:nowrap;}
.nav-link-custom::after{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:0;height:2px;background:linear-gradient(90deg,var(--primary),var(--primary-light));border-radius:2px 2px 0 0;transition:var(--transition);}
.nav-link-custom:hover{color:var(--text);}
.nav-link-custom:hover::after{width:80%;}
.nav-badge{background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:var(--dark);font-size:10px;font-weight:700;padding:1px 6px;border-radius:20px;}

/* ===== MINI CART DRAWER ===== */
.cart-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:9998;opacity:0;pointer-events:none;transition:opacity 0.3s;}
.cart-overlay.active{opacity:1;pointer-events:all;}

.mini-cart{position:fixed;top:0;right:0;width:380px;max-width:95vw;height:100vh;background:var(--dark-2);border-left:1px solid var(--card-border);z-index:9999;transform:translateX(100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);display:flex;flex-direction:column;box-shadow:-8px 0 40px rgba(0,0,0,0.5);}
.mini-cart.open{transform:translateX(0);}

.mini-cart-header{padding:20px 20px 16px;border-bottom:1px solid var(--card-border);display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
.mini-cart-title{font-size:16px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:8px;}
.mini-cart-close{width:34px;height:34px;background:rgba(108,60,227,0.1);border:1px solid var(--card-border);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--text-muted);cursor:pointer;transition:var(--transition);}
.mini-cart-close:hover{background:var(--danger);color:white;border-color:var(--danger);}

.mini-cart-body{flex:1;overflow-y:auto;padding:12px;}
.mini-cart-body::-webkit-scrollbar{width:4px;}
.mini-cart-body::-webkit-scrollbar-thumb{background:var(--primary);border-radius:2px;}

.mini-cart-item{display:flex;align-items:center;gap:12px;padding:12px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius-sm);margin-bottom:8px;transition:var(--transition);}
.mini-cart-item:hover{border-color:rgba(108,60,227,0.4);}
.mini-cart-item-img{width:56px;height:56px;object-fit:contain;background:var(--dark-3);border-radius:8px;padding:4px;flex-shrink:0;}
.mini-cart-item-info{flex:1;min-width:0;}
.mini-cart-item-name{font-size:12px;font-weight:600;color:var(--text);line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.mini-cart-item-price{font-size:12px;color:var(--accent);font-weight:700;margin-top:3px;}
.mini-cart-item-qty{display:flex;align-items:center;gap:4px;margin-top:6px;}
.mc-qty-btn{width:24px;height:24px;background:var(--dark-3);border:1px solid var(--card-border);border-radius:5px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-muted);font-size:12px;transition:var(--transition);}
.mc-qty-btn:hover{background:var(--primary);color:white;border-color:var(--primary);}
.mc-qty-num{font-size:13px;font-weight:700;color:var(--text);min-width:24px;text-align:center;}
.mini-cart-item-remove{width:26px;height:26px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:6px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#F87171;font-size:11px;transition:var(--transition);flex-shrink:0;}
.mini-cart-item-remove:hover{background:var(--danger);color:white;border-color:var(--danger);}

.mini-cart-empty{text-align:center;padding:60px 20px;color:var(--text-muted);}
.mini-cart-empty i{font-size:52px;color:rgba(108,60,227,0.2);margin-bottom:16px;display:block;}

.mini-cart-footer{padding:16px 20px;border-top:1px solid var(--card-border);flex-shrink:0;}
.mini-cart-total{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;}
.mini-cart-total .label{font-size:14px;color:var(--text-muted);}
.mini-cart-total .amount{font-size:20px;font-weight:800;color:var(--accent);}
.mc-checkout-btn{display:flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;border:none;border-radius:var(--radius-sm);padding:13px 0;width:100%;font-size:15px;font-weight:700;cursor:pointer;transition:var(--transition);text-decoration:none;}
.mc-checkout-btn:hover{opacity:0.9;transform:translateY(-1px);box-shadow:0 6px 20px rgba(108,60,227,0.4);color:white;}
.mc-continue-btn{display:block;text-align:center;color:var(--text-muted);font-size:13px;margin-top:10px;text-decoration:none;transition:var(--transition);}
.mc-continue-btn:hover{color:var(--primary-light);}

/* ===== TOAST NOTIFICATION ===== */
.toast-container{position:fixed;bottom:24px;right:24px;z-index:99999;display:flex;flex-direction:column;gap:10px;pointer-events:none;}
.toast-item{background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);padding:14px 18px;min-width:300px;max-width:360px;box-shadow:0 8px 32px rgba(0,0,0,0.4);display:flex;align-items:center;gap:12px;animation:slideInToast 0.35s ease forwards;pointer-events:all;position:relative;overflow:hidden;}
.toast-item::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;background:linear-gradient(135deg,var(--primary),var(--primary-light));}
.toast-item.toast-success::before{background:linear-gradient(135deg,var(--success),#059669);}
.toast-item.toast-error::before{background:linear-gradient(135deg,var(--danger),#DC2626);}
@keyframes slideInToast{from{transform:translateX(120%);opacity:0;}to{transform:translateX(0);opacity:1;}}
@keyframes slideOutToast{from{transform:translateX(0);opacity:1;}to{transform:translateX(120%);opacity:0;}}
.toast-icon{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.toast-success .toast-icon{background:rgba(16,185,129,0.15);color:var(--success);}
.toast-error .toast-icon{background:rgba(239,68,68,0.15);color:var(--danger);}
.toast-primary .toast-icon{background:rgba(108,60,227,0.15);color:var(--primary-light);}
.toast-body{flex:1;}
.toast-msg{font-size:13px;font-weight:600;color:var(--text);}
.toast-sub{font-size:11px;color:var(--text-muted);margin-top:2px;}
.toast-close-btn{color:var(--text-muted);cursor:pointer;font-size:12px;transition:var(--transition);}
.toast-close-btn:hover{color:var(--text);}

/* ===== PAGE WRAPPER ===== */
.page-wrapper{position:relative;z-index:1;min-height:calc(100vh - 200px);padding-bottom:60px;}

/* ===== BUTTONS ===== */
.btn-primary-custom{background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:white;border:none;padding:10px 24px;border-radius:var(--radius-sm);font-weight:600;font-size:14px;cursor:pointer;transition:var(--transition);display:inline-flex;align-items:center;gap:8px;text-decoration:none;}
.btn-primary-custom:hover{opacity:0.9;transform:translateY(-2px);box-shadow:0 6px 20px rgba(108,60,227,0.4);color:white;}
.btn-accent-custom{background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:var(--dark);border:none;padding:10px 24px;border-radius:var(--radius-sm);font-weight:700;font-size:14px;cursor:pointer;transition:var(--transition);display:inline-flex;align-items:center;gap:8px;text-decoration:none;}
.btn-accent-custom:hover{opacity:0.9;transform:translateY(-2px);box-shadow:0 6px 20px rgba(245,158,11,0.4);color:var(--dark);}
.btn-ghost-custom{background:transparent;color:var(--text-muted);border:1px solid var(--card-border);padding:10px 24px;border-radius:var(--radius-sm);font-weight:500;font-size:14px;cursor:pointer;transition:var(--transition);display:inline-flex;align-items:center;gap:8px;text-decoration:none;}
.btn-ghost-custom:hover{border-color:var(--primary);color:var(--primary-light);background:rgba(108,60,227,0.1);}

/* ===== CARDS ===== */
.card-custom{background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;transition:var(--transition);}
.card-custom:hover{border-color:rgba(108,60,227,0.5);box-shadow:var(--shadow);transform:translateY(-4px);}

/* ===== FORM CONTROLS ===== */
.form-control,.form-select{background-color:var(--dark-3)!important;border:1px solid var(--card-border)!important;color:var(--text)!important;border-radius:var(--radius-sm)!important;font-family:'Inter',sans-serif;}
.form-control:focus,.form-select:focus{background-color:var(--dark-3)!important;border-color:var(--primary)!important;box-shadow:0 0 0 3px rgba(108,60,227,0.2)!important;color:var(--text)!important;}
.form-select option{background:var(--dark-2);color:var(--text);}

/* ===== ALERTS ===== */
.alert-custom-danger{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#FCA5A5;border-radius:var(--radius-sm);padding:14px 18px;}
.alert-custom-success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);color:#6EE7B7;border-radius:var(--radius-sm);padding:14px 18px;}
.alert-custom-info{background:rgba(108,60,227,0.1);border:1px solid rgba(108,60,227,0.3);color:var(--primary-light);border-radius:var(--radius-sm);padding:14px 18px;}

/* ===== TABLE ===== */
.table-custom{width:100%;border-collapse:separate;border-spacing:0;}
.table-custom th{background:rgba(108,60,227,0.1);color:var(--text-muted);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;padding:12px 16px;border-bottom:1px solid var(--card-border);}
.table-custom td{padding:14px 16px;border-bottom:1px solid rgba(108,60,227,0.08);vertical-align:middle;color:var(--text);font-size:14px;}
.table-custom tbody tr:hover{background:rgba(108,60,227,0.05);}
.table-custom tbody tr:last-child td{border-bottom:none;}

/* ===== PRICE ===== */
.price-text{color:var(--accent);font-weight:700;font-size:1.05em;}

/* ===== BADGE ===== */
.badge-custom{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;}
.badge-primary-custom{background:rgba(108,60,227,0.2);color:var(--primary-light);border:1px solid rgba(108,60,227,0.3);}
.badge-accent-custom{background:rgba(245,158,11,0.2);color:var(--accent);border:1px solid rgba(245,158,11,0.3);}

/* ===== SECTION TITLE ===== */
.section-title{font-size:22px;font-weight:800;color:var(--text);display:flex;align-items:center;gap:10px;margin-bottom:24px;}
.section-title span.dot{width:4px;height:24px;background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:4px;display:inline-block;}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
.fade-up{animation:fadeInUp 0.5s ease forwards;}
@keyframes cartBounce{0%,100%{transform:scale(1);}40%{transform:scale(1.4);}70%{transform:scale(0.85);}}
.cart-bounce{animation:cartBounce 0.5s ease!important;}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar{width:6px;}
::-webkit-scrollbar-track{background:var(--dark-2);}
::-webkit-scrollbar-thumb{background:var(--primary);border-radius:3px;}

/* ===== MISC ===== */
a{color:inherit;text-decoration:none;}
img{max-width:100%;height:auto;}
.divider{border:none;border-top:1px solid rgba(108,60,227,0.15);margin:24px 0;}
</style>
</head>
<body>

<!-- ===== CART OVERLAY ===== -->
<div class="cart-overlay" id="cart-overlay" onclick="closeMiniCart()"></div>

<!-- ===== MINI CART DRAWER ===== -->
<div class="mini-cart" id="mini-cart">
    <div class="mini-cart-header">
        <div class="mini-cart-title">
            <i class="fa fa-cart-shopping" style="color:var(--primary-light);"></i>
            Giỏ hàng
            <span id="mc-count-badge" class="badge-custom badge-primary-custom" style="font-size:11px;">0</span>
        </div>
        <div class="mini-cart-close" onclick="closeMiniCart()">
            <i class="fa fa-xmark"></i>
        </div>
    </div>
    <div class="mini-cart-body" id="mini-cart-body">
        <div class="mini-cart-empty">
            <i class="fa fa-cart-shopping"></i>
            <p>Giỏ hàng đang trống</p>
        </div>
    </div>
    <div class="mini-cart-footer" id="mini-cart-footer" style="display:none;">
        <div class="mini-cart-total">
            <span class="label">Tổng cộng:</span>
            <span class="amount" id="mc-total">₫0</span>
        </div>
        <a href="/Product/cart" class="mc-checkout-btn">
            <i class="fa fa-credit-card"></i> Xem giỏ hàng & Thanh toán
        </a>
        <a href="#" class="mc-continue-btn" onclick="closeMiniCart();return false;">
            Tiếp tục mua sắm
        </a>
    </div>
</div>

<!-- ===== TOAST CONTAINER ===== -->
<div class="toast-container" id="toast-container"></div>

<!-- ===== TOPBAR ===== -->
<div class="topbar">
<div class="container d-flex justify-content-between align-items-center">
    <div style="display:flex;align-items:center;gap:6px;">
        <span class="topbar-badge">HOT</span>
        <span style="color:var(--text-muted);">Flash sale hôm nay – Giảm đến 40%</span>
    </div>
    <div style="display:flex;align-items:center;">
        <a href="#"><i class="fa fa-bell"></i> Thông báo</a>
        <a href="#"><i class="fa fa-question-circle"></i> Hỗ trợ</a>
        <a href="#"><i class="fa fa-user"></i> Đăng nhập</a>
        <a href="#"><i class="fa fa-user-plus"></i> Đăng ký</a>
    </div>
</div>
</div>

<!-- ===== MAIN HEADER ===== -->
<div class="main-header">
<div class="container">
<div class="row align-items-center g-3">

    <!-- LOGO -->
    <div class="col-auto">
        <a href="/Product/" class="logo">
            <div class="logo-icon"><i class="fa fa-bolt"></i></div>
            MyShop
        </a>
    </div>

    <!-- SEARCH -->
    <div class="col">
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" id="search-input" placeholder="Tìm kiếm iPhone, Samsung, Xiaomi..." autocomplete="off">
                <button type="button" onclick="doSearch()"><i class="fa fa-search"></i> Tìm</button>
            </div>
            <div id="search-dropdown"></div>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="col-auto">
        <div class="header-actions">
            <div class="action-btn" id="cart-btn" onclick="openMiniCart()" title="Giỏ hàng">
                <i class="fa fa-shopping-cart"></i>
                <span class="badge-count" id="cart-count-badge">0</span>
            </div>
            <a href="/Product/orderHistory" class="action-btn" title="Lịch sử đơn hàng">
                <i class="fa fa-clock-rotate-left"></i>
            </a>
        </div>
    </div>

</div>
</div>
</div>

<!-- ===== NAV MENU ===== -->
<div class="nav-menu">
<div class="container">
    <a href="/Product/" class="nav-link-custom">
        <i class="fa fa-house" style="font-size:12px;"></i> Trang chủ
    </a>
    <a href="/Product/" class="nav-link-custom">
        <i class="fa fa-mobile-screen" style="font-size:12px;"></i> Điện thoại
    </a>
    <a href="/Product/add" class="nav-link-custom">
        <i class="fa fa-plus" style="font-size:12px;"></i> Thêm sản phẩm
    </a>
    <a href="#" class="nav-link-custom">
        <i class="fa fa-tag" style="font-size:12px;"></i> Khuyến mãi
        <span class="nav-badge">SALE</span>
    </a>
    <a href="#" class="nav-link-custom">
        <i class="fa fa-headset" style="font-size:12px;"></i> Liên hệ
    </a>
</div>
</div>

<!-- PAGE WRAPPER -->
<div class="page-wrapper">
<div class="container mt-4">

<!-- ============================================================ -->
<!-- GLOBAL AJAX CART + SEARCH JAVASCRIPT                         -->
<!-- ============================================================ -->
<script>
// ===== TOAST =====
function showToast(msg, sub, type='toast-primary', duration=3000) {
    const icons = { 'toast-success':'fa-circle-check', 'toast-error':'fa-circle-xmark', 'toast-primary':'fa-cart-shopping' };
    const icon = icons[type] || 'fa-circle-info';
    const id = 'toast-' + Date.now();
    const html = `
    <div class="toast-item ${type}" id="${id}">
        <div class="toast-icon"><i class="fa ${icon}"></i></div>
        <div class="toast-body">
            <div class="toast-msg">${msg}</div>
            ${sub ? `<div class="toast-sub">${sub}</div>` : ''}
        </div>
        <i class="fa fa-xmark toast-close-btn" onclick="removeToast('${id}')"></i>
    </div>`;
    document.getElementById('toast-container').insertAdjacentHTML('beforeend', html);
    setTimeout(() => removeToast(id), duration);
}
function removeToast(id) {
    const el = document.getElementById(id);
    if (el) { el.style.animation = 'slideOutToast 0.3s ease forwards'; setTimeout(()=>el.remove(), 300); }
}

// ===== CART BADGE =====
function updateCartBadge(count) {
    const badge = document.getElementById('cart-count-badge');
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
    const btn = document.getElementById('cart-btn');
    if (btn) { btn.classList.remove('cart-bounce'); void btn.offsetWidth; btn.classList.add('cart-bounce'); }
}

// ===== ADD TO CART (AJAX) =====
function addToCart(productId, btn) {
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang thêm...';
    }
    fetch('/Product/addToCart/' + productId, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.cartCount);
            showToast('Đã thêm vào giỏ hàng!', data.productName, 'toast-success');
            refreshMiniCart();
        } else {
            showToast('Lỗi!', data.message || 'Không thể thêm sản phẩm.', 'toast-error');
        }
    })
    .catch(() => showToast('Lỗi kết nối!', '', 'toast-error'))
    .finally(() => {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-cart-plus"></i> Thêm vào giỏ';
        }
    });
}

// ===== MINI CART =====
function openMiniCart() {
    document.getElementById('mini-cart').classList.add('open');
    document.getElementById('cart-overlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    refreshMiniCart();
}
function closeMiniCart() {
    document.getElementById('mini-cart').classList.remove('open');
    document.getElementById('cart-overlay').classList.remove('active');
    document.body.style.overflow = '';
}

function refreshMiniCart() {
    fetch('/Product/cartData', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(data => {
        renderMiniCart(data);
        updateCartBadge(data.cartCount);
    });
}

function renderMiniCart(data) {
    const body = document.getElementById('mini-cart-body');
    const footer = document.getElementById('mini-cart-footer');
    const badge = document.getElementById('mc-count-badge');
    const total = document.getElementById('mc-total');

    if (badge) badge.textContent = data.cartCount;

    if (!data.cartItems || data.cartItems.length === 0) {
        body.innerHTML = `<div class="mini-cart-empty"><i class="fa fa-cart-shopping"></i><p>Giỏ hàng đang trống</p></div>`;
        if (footer) footer.style.display = 'none';
        return;
    }

    if (footer) {
        footer.style.display = 'block';
        if (total) total.textContent = '₫' + data.cartTotal;
    }

    body.innerHTML = data.cartItems.map(item => `
    <div class="mini-cart-item" id="mc-item-${item.id}">
        <img class="mini-cart-item-img"
             src="${item.image ? '/' + item.image : '/public/images/no-image.png'}"
             onerror="this.src='/public/images/no-image.png'">
        <div class="mini-cart-item-info">
            <div class="mini-cart-item-name">${item.name}</div>
            <div class="mini-cart-item-price">₫${item.price}</div>
            <div class="mini-cart-item-qty">
                <div class="mc-qty-btn" onclick="mcQty('decrease', ${item.id})"><i class="fa fa-minus" style="font-size:9px;"></i></div>
                <span class="mc-qty-num" id="mc-qty-${item.id}">${item.quantity}</span>
                <div class="mc-qty-btn" onclick="mcQty('increase', ${item.id})"><i class="fa fa-plus" style="font-size:9px;"></i></div>
            </div>
        </div>
        <div class="mini-cart-item-remove" onclick="mcRemove(${item.id})" title="Xóa">
            <i class="fa fa-trash"></i>
        </div>
    </div>`).join('');
}

function mcQty(action, id) {
    fetch('/Product/' + (action === 'increase' ? 'increaseQuantity' : 'decreaseQuantity') + '/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        if (data.removed || data.quantity <= 0) {
            const el = document.getElementById('mc-item-' + id);
            if (el) { el.style.animation = 'slideOutToast 0.3s ease forwards'; setTimeout(() => el.remove(), 300); }
        } else {
            const qtyEl = document.getElementById('mc-qty-' + id);
            if (qtyEl) qtyEl.textContent = data.quantity;
        }
        updateCartBadge(data.cartCount);
        const total = document.getElementById('mc-total');
        if (total) total.textContent = '₫' + data.cartTotal;
        if (data.cartCount == 0 && document.getElementById('mini-cart-footer'))
            document.getElementById('mini-cart-footer').style.display = 'none';
        // Also update cart page if open
        if (typeof updateCartPage === 'function') updateCartPage(data);
    });
}

function mcRemove(id) {
    fetch('/Product/removeFromCart/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        const el = document.getElementById('mc-item-' + id);
        if (el) { el.style.opacity = '0'; setTimeout(() => el.remove(), 300); }
        updateCartBadge(data.cartCount);
        const total = document.getElementById('mc-total');
        if (total) total.textContent = '₫' + data.cartTotal;
        if (data.cartCount == 0) {
            document.getElementById('mini-cart-body').innerHTML = `<div class="mini-cart-empty"><i class="fa fa-cart-shopping"></i><p>Giỏ hàng đang trống</p></div>`;
            if (document.getElementById('mini-cart-footer')) document.getElementById('mini-cart-footer').style.display = 'none';
        }
        if (typeof updateCartPage === 'function') updateCartPage(data);
    });
}

// ===== LIVE SEARCH =====
let searchTimer;
const searchInput   = document.getElementById('search-input');
const searchDropdown = document.getElementById('search-dropdown');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimer);
        const q = this.value.trim();
        if (q.length < 2) { searchDropdown.classList.remove('active'); return; }
        searchTimer = setTimeout(() => doLiveSearch(q), 280);
    });

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { doSearch(); }
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-wrapper')) { searchDropdown.classList.remove('active'); }
    });
}

function doLiveSearch(q) {
    fetch('/Product/searchSuggest?q=' + encodeURIComponent(q), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(results => {
        if (results.length === 0) {
            searchDropdown.innerHTML = `<div class="search-no-result"><i class="fa fa-magnifying-glass" style="margin-right:6px;color:var(--primary-light);"></i>Không tìm thấy sản phẩm</div>`;
        } else {
            searchDropdown.innerHTML = results.map(p => `
            <a href="/Product/show/${p.id}" class="search-result-item">
                <img class="search-result-img"
                     src="${p.image ? '/' + p.image : '/public/images/no-image.png'}"
                     onerror="this.src='/public/images/no-image.png'">
                <div>
                    <div class="search-result-name">${p.name}</div>
                    <div class="search-result-price">₫${p.price}</div>
                </div>
            </a>`).join('');
        }
        searchDropdown.classList.add('active');
    });
}

function doSearch() {
    const q = searchInput ? searchInput.value.trim() : '';
    if (q) window.location.href = '/Product/?q=' + encodeURIComponent(q);
    searchDropdown.classList.remove('active');
}

// ===== INIT: load cart count on page load =====
document.addEventListener('DOMContentLoaded', function() {
    fetch('/Product/cartData', { headers:{ 'X-Requested-With':'XMLHttpRequest' } })
    .then(r=>r.json()).then(data=>{ updateCartBadge(data.cartCount); });
});
</script>