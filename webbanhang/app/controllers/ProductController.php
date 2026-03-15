<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
class ProductController
{
private $productModel;
private $db;
public function __construct()
{
$this->db = (new Database())->getConnection();
$this->productModel = new ProductModel($this->db);


}
public function index()
{
// Lấy danh sách danh mục để hiển thị dropdown
    $categoryModel = new CategoryModel($this->db);
    $categories = $categoryModel->getCategories();

    // Kiểm tra có lọc theo danh mục không
    $category_id = $_GET['category_id'] ?? null;

    if ($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
    } else {
        $products = $this->productModel->getProducts();
    }

    include 'app/views/product/list.php';
}
public function show($id)
{
$product = $this->productModel->getProductById($id);
if ($product) {
include 'app/views/product/show.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function add()
{
$categories = (new CategoryModel($this->db))->getCategories();
include_once 'app/views/product/add.php';
}
public function save()
{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$category_id = $_POST['category_id'] ?? null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = "";
}
$result = $this->productModel->addProduct($name, $description, $price,

$category_id, $image);

if (is_array($result)) {
$errors = $result;
$categories = (new CategoryModel($this->db))->getCategories();
include 'app/views/product/add.php';
} else {

header('Location: /Product');
}
}
}
public function edit($id)
{
$product = $this->productModel->getProductById($id);
$categories = (new CategoryModel($this->db))->getCategories();
if ($product) {
include 'app/views/product/edit.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function update()
{
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = $_POST['existing_image'];
}
$edit = $this->productModel->updateProduct($id, $name, $description,

$price, $category_id, $image);
if ($edit) {
header('Location: /Product');
} else {
echo "Đã xảy ra lỗi khi lưu sản phẩm.";
}
}
}
public function delete($id)
{
if ($this->productModel->deleteProduct($id)) {
header('Location: /Product');
} else {


echo "Đã xảy ra lỗi khi xóa sản phẩm.";
}
}
private function uploadImage($file)
{
$target_dir = "uploads/";
// Kiểm tra và tạo thư mục nếu chưa tồn tại
if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($file["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Kiểm tra xem file có phải là hình ảnh không
$check = getimagesize($file["tmp_name"]);
if ($check === false) {
throw new Exception("File không phải là hình ảnh.");
}
// Kiểm tra kích thước file (10 MB = 10 * 1024 * 1024 bytes)
if ($file["size"] > 10 * 1024 * 1024) {
throw new Exception("Hình ảnh có kích thước quá lớn.");
}
// Chỉ cho phép một số định dạng hình ảnh nhất định
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=
"jpeg" && $imageFileType != "gif") {

throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
}
// Lưu file
if (!move_uploaded_file($file["tmp_name"], $target_file)) {
throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
}
return $target_file;
}
public function addToCart($id)
{
    $product = $this->productModel->getProductById($id);

    if (!$product) {
        if ($this->isAjax()) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
        return;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'quantity' => 1,
            'image'    => $product->image
        ];
    }

    if ($this->isAjax()) {
        header('Content-Type: application/json');
        echo json_encode([
            'success'   => true,
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'productName' => $product->name,
            'productPrice' => number_format($product->price, 0, ',', '.'),
            'productImage' => $product->image,
        ]);
        exit();
    }

    header('Location: /Product');
    exit();
}
public function applyVoucher()
{
    $voucher = $_POST['voucher'];

    switch($voucher){
        case "GIAM10":
            $_SESSION['discount'] = 10000;
            break;

        case "SALE20":
            $_SESSION['discount'] = 20000;
            break;

        case "FREESHIP":
            $_SESSION['discount'] = 15000;
            break;

        case "VIP50":
            $_SESSION['discount'] = 50000;
            break;

        default:
            $_SESSION['discount'] = 0;
    }

    header("Location: /Product/cart");
}
public function removeFromCart($id)
{
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    if ($this->isAjax()) {
        header('Content-Type: application/json');
        echo json_encode([
            'success'   => true,
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'cartItems' => $this->getCartItems(),
        ]);
        exit();
    }

    header('Location: /Product/cart');
    exit();
}

public function increaseQuantity($id)
{
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    }

    if ($this->isAjax()) {
        header('Content-Type: application/json');
        $qty = $_SESSION['cart'][$id]['quantity'] ?? 0;
        $price = $_SESSION['cart'][$id]['price'] ?? 0;
        echo json_encode([
            'success'   => true,
            'quantity'  => $qty,
            'subtotal'  => number_format($qty * $price, 0, ',', '.'),
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'cartItems' => $this->getCartItems(),
        ]);
        exit();
    }

    header('Location: /Product/cart');
    exit();
}

public function decreaseQuantity($id)
{
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']--;
        if ($_SESSION['cart'][$id]['quantity'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }

    if ($this->isAjax()) {
        header('Content-Type: application/json');
        $qty   = $_SESSION['cart'][$id]['quantity'] ?? 0;
        $price = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id]['price'] : 0;
        echo json_encode([
            'success'   => true,
            'quantity'  => $qty,
            'removed'   => $qty <= 0,
            'subtotal'  => number_format($qty * $price, 0, ',', '.'),
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'cartItems' => $this->getCartItems(),
        ]);
        exit();
    }

    header('Location: /Product/cart');
    exit();
}

public function cartData()
{
    header('Content-Type: application/json');
    echo json_encode([
        'cartCount' => $this->getCartCount(),
        'cartTotal' => $this->getCartTotal(),
        'cartItems' => $this->getCartItems(),
    ]);
    exit();
}

public function searchSuggest()
{
    header('Content-Type: application/json');
    $q = trim($_GET['q'] ?? '');
    if (strlen($q) < 2) {
        echo json_encode([]);
        exit();
    }
    $products = $this->productModel->searchProducts($q);
    $result = [];
    foreach ($products as $p) {
        $result[] = [
            'id'    => $p->id,
            'name'  => $p->name,
            'price' => number_format($p->price, 0, ',', '.'),
            'image' => $p->image,
        ];
    }
    echo json_encode($result);
    exit();
}

private function isAjax()
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

private function getCartCount()
{
    $cart = $_SESSION['cart'] ?? [];
    return array_sum(array_column($cart, 'quantity'));
}

private function getCartTotal()
{
    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return number_format($total, 0, ',', '.');
}

private function getCartItems()
{
    $cart = $_SESSION['cart'] ?? [];
    $items = [];
    foreach ($cart as $id => $item) {
        $items[] = [
            'id'       => $id,
            'name'     => $item['name'],
            'price'    => number_format($item['price'], 0, ',', '.'),
            'quantity' => $item['quantity'],
            'subtotal' => number_format($item['price'] * $item['quantity'], 0, ',', '.'),
            'image'    => $item['image'],
        ];
    }
    return $items;
}
public function cart()
{
    $cart = $_SESSION['cart'] ?? [];

    include 'app/views/product/cart.php';
}
public function orderHistory()
{
    $query = "SELECT * FROM orders ORDER BY id DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    $orders = $stmt->fetchAll(PDO::FETCH_OBJ);

    include 'app/views/product/orderHistory.php';
}

public function checkout()
{
include 'app/views/product/checkout.php';
}
public function processCheckout()
{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
// Kiểm tra giỏ hàng
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
echo "Giỏ hàng trống.";
return;
}
// Bắt đầu giao dịch
$this->db->beginTransaction();
try {
// Lưu thông tin đơn hàng vào bảng orders

$query = "INSERT INTO orders (name, phone, address) VALUES (:name,

:phone, :address)";

$stmt = $this->db->prepare($query);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':address', $address);
$stmt->execute();
$order_id = $this->db->lastInsertId();
// Lưu chi tiết đơn hàng vào bảng order_details
$cart = $_SESSION['cart'];
foreach ($cart as $product_id => $item) {
$query = "INSERT INTO order_details (order_id, product_id,

quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";

$stmt = $this->db->prepare($query);
$stmt->bindParam(':order_id', $order_id);
$stmt->bindParam(':product_id', $product_id);
$stmt->bindParam(':quantity', $item['quantity']);
$stmt->bindParam(':price', $item['price']);
$stmt->execute();
}
// Xóa giỏ hàng sau khi đặt hàng thành công
unset($_SESSION['cart']);
// Commit giao dịch
$this->db->commit();
// Chuyển hướng đến trang xác nhận đơn hàng
header('Location: /Product/orderConfirmation');
} catch (Exception $e) {
// Rollback giao dịch nếu có lỗi
$this->db->rollBack();
echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
}
}
}
public function orderConfirmation()
{
include 'app/views/product/orderConfirmation.php';
}
}
?>