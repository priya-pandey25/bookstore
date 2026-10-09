<?php
session_start();
require_once 'db.php';

// If not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handle cart actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $cart_id = (int)$_POST['cart_id'];
        
        // Verify cart item belongs to user
        $verify = $conn->query("SELECT id FROM cart WHERE id=$cart_id AND user_id=$user_id");
        if ($verify->num_rows > 0) {
            if ($_POST['action'] === 'update') {
                $quantity = max(1, (int)$_POST['quantity']); // at least 1
                $conn->query("UPDATE cart SET quantity=$quantity WHERE id=$cart_id");
                $message = "Cart updated.";
            } elseif ($_POST['action'] === 'remove') {
                $conn->query("DELETE FROM cart WHERE id=$cart_id");
                $message = "Item removed from cart.";
            }
        }
    }
}

// Fetch cart items
$cart_query = "SELECT c.id as cart_id, c.quantity, b.id as book_id, b.title, b.author, b.price, b.image_url, b.stock 
               FROM cart c 
               JOIN books b ON c.book_id = b.id 
               WHERE c.user_id = $user_id";
$cart_items = $conn->query($cart_query);

$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Lumina Books</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">
    
    <!-- Header -->
    <header class="lumina-header text-white flex items-center justify-between px-6 py-4 shadow-md relative z-50">
        <a href="index.php" class="flex items-center gap-2 group transition-transform hover:scale-105">
            <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md shadow-lg border border-white/20">
                <i class="fa-solid fa-book-open text-white text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tight">Lumina<span class="text-pink-300">Books</span></span>
        </a>
        <div class="flex items-center gap-4">
            <a href="profile.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-user mr-1"></i> Profile</a>
            <a href="logout.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Shopping Cart</h1>
            <a href="index.php" class="text-indigo-600 font-bold hover:text-indigo-800 transition-colors"><i class="fa-solid fa-arrow-left mr-2"></i> Continue Shopping</a>
        </div>

        <?php if ($message): ?>
            <div class="bg-indigo-50 text-indigo-700 px-4 py-3 rounded-lg mb-6 text-sm border border-indigo-200 font-bold">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if ($cart_items->num_rows > 0): ?>
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items List -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <?php while ($item = $cart_items->fetch_assoc()): 
                            $item_total = $item['price'] * $item['quantity'];
                            $total_price += $item_total;
                        ?>
                        <div class="flex flex-col sm:flex-row items-center gap-6 p-6 border-b border-slate-100 last:border-b-0 hover:bg-slate-50 transition-colors">
                            <div class="w-24 h-32 flex-shrink-0 rounded-lg overflow-hidden bg-slate-200 shadow-inner">
                                <?php if($item['image_url']): ?>
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="Book cover" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fa-solid fa-image text-3xl"></i></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="flex-grow text-center sm:text-left">
                                <h3 class="text-lg font-bold text-slate-800 mb-1"><?= htmlspecialchars($item['title']) ?></h3>
                                <p class="text-sm text-slate-500 font-medium mb-3">By <?= htmlspecialchars($item['author']) ?></p>
                                <p class="text-indigo-600 font-black text-xl">$<?= number_format($item['price'], 2) ?></p>
                            </div>

                            <div class="flex items-center gap-4">
                                <form action="cart.php" method="POST" class="flex items-center bg-slate-100 rounded-lg border border-slate-200 p-1 shadow-inner">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock'] > 0 ? $item['stock'] : 99 ?>" class="w-12 text-center bg-transparent outline-none font-bold text-slate-700" onchange="this.form.submit()">
                                </form>
                                
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <button type="submit" class="text-red-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition-colors tooltip" title="Remove item">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-8 sticky top-6">
                        <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-4">Order Summary</h2>
                        
                        <div class="space-y-3 mb-6 text-slate-600 font-medium">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>$<?= number_format($total_price, 2) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span class="text-green-600 font-bold">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tax</span>
                                <span>Calculated at checkout</span>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4 mb-8">
                            <div class="flex justify-between items-end">
                                <span class="text-slate-800 font-bold">Total</span>
                                <span class="text-3xl font-black text-slate-900">$<?= number_format($total_price, 2) ?></span>
                            </div>
                        </div>
                        
                        <a href="checkout.php" class="w-full block text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5">
                            Proceed to Checkout
                        </a>
                        
                        <div class="mt-6 flex justify-center gap-4 text-slate-400 text-xl">
                            <i class="fa-brands fa-cc-visa hover:text-slate-600 transition-colors"></i>
                            <i class="fa-brands fa-cc-mastercard hover:text-slate-600 transition-colors"></i>
                            <i class="fa-brands fa-cc-paypal hover:text-slate-600 transition-colors"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-16 text-center">
                <div class="w-24 h-24 bg-indigo-50 text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-cart-shopping text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Your cart is empty</h2>
                <p class="text-slate-500 mb-8 max-w-md mx-auto">Looks like you haven't added any books to your cart yet. Explore our collection to find your next great read.</p>
                <a href="index.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md shadow-indigo-200">
                    Start Shopping
                </a>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
