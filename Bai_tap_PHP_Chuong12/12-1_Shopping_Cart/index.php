\
<?php
// EXERCISE 12-1 - Modify the Shopping Cart application
// Persistent session cookie: 3 years

$three_years = 60 * 60 * 24 * 365 * 3;

session_set_cookie_params([
    'lifetime' => $three_years,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$products = [
    'P001' => ['name' => 'Keyboard', 'price' => 350000],
    'P002' => ['name' => 'Mouse', 'price' => 200000],
    'P003' => ['name' => 'Headphone', 'price' => 450000],
    'P004' => ['name' => 'USB 32GB', 'price' => 180000]
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'add') {
    $product_id = $_POST['product_id'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);

    if (isset($products[$product_id]) && $quantity > 0) {
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = 0;
        }
        $_SESSION['cart'][$product_id] += $quantity;
    }

    header('Location: index.php');
    exit;
}

if ($action === 'remove') {
    $product_id = $_GET['product_id'] ?? '';

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    header('Location: index.php');
    exit;
}

// Empty Cart: xóa sản phẩm nhưng giữ nguyên session ID
if ($action === 'empty') {
    $_SESSION['cart'] = [];

    header('Location: index.php');
    exit;
}

// End Session and Delete Cookie:
// xóa dữ liệu session, hủy session, xóa cookie
if ($action === 'end_session') {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 12-1 - Shopping Cart</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="container">
    <h1>Shopping Cart</h1>

    <div class="session-info">
        <strong>Session ID:</strong>
        <?= htmlspecialchars(session_id()) ?>
    </div>

    <h2>Products</h2>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th></th>
        </tr>

        <?php foreach ($products as $id => $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                <td>
                    <form method="post" class="inline-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit">Add</button>
                    </form>
                </td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            <?php
            $total = 0;

            foreach ($_SESSION['cart'] as $id => $quantity):
                if (!isset($products[$id])) {
                    continue;
                }

                $subtotal = $products[$id]['price'] * $quantity;
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($products[$id]['name']) ?></td>
                    <td><?= (int)$quantity ?></td>
                    <td><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
                    <td>
                        <a href="?action=remove&product_id=<?= urlencode($id) ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td colspan="2"><strong><?= number_format($total, 0, ',', '.') ?> VND</strong></td>
            </tr>
        </table>
    <?php endif; ?>

    <div class="links">
        <a href="?action=empty">Empty Cart</a>
        <a href="?action=end_session" class="danger">End Session and Delete Cookie</a>
    </div>

    <div class="note">
        <p><strong>Exercise 12-1 requirements implemented:</strong></p>
        <ul>
            <li>Session cookie lasts for 3 years.</li>
            <li>Session ID is displayed on the page.</li>
            <li>Empty Cart removes items but keeps the session ID.</li>
            <li>End Session and Delete Cookie clears the session and deletes the cookie.</li>
        </ul>
    </div>
</div>
</body>
</html>
