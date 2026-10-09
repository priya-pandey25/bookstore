<?php
session_start();
require_once 'db.php';

// If not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Customer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account | Lumina Books</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-slate-800 antialiased min-h-screen flex flex-col">
    
    <!-- Header -->
    <header class="lumina-header text-white flex items-center justify-between px-6 py-4 shadow-md relative z-50">
        <a href="index.php" class="flex items-center gap-2 group transition-transform hover:scale-105">
            <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md shadow-lg border border-white/20">
                <i class="fa-solid fa-book-open text-white text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tight">Lumina<span class="text-pink-300">Books</span></span>
        </a>
        <div class="flex items-center gap-4">
            <a href="cart.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-bag-shopping mr-1"></i> Cart</a>
            <a href="logout.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-5xl">
        <h1 class="text-3xl md:text-4xl font-black mb-8 text-slate-800 tracking-tight">Your Account</h1>
        
        <!-- Dashboard Grid (Amazon Style) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Orders Card -->
            <a href="orders.php" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Your Orders</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Track, return, or buy things again</p>
                    </div>
                </div>
            </a>
            
            <!-- Login & Security Card -->
            <a href="login_security.php" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Login & security</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Edit login, name, and password</p>
                    </div>
                </div>
            </a>
            
            <!-- Prime/Premium Card -->
            <a href="#" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 text-indigo-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Premium</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">View benefits and subscription settings</p>
                    </div>
                </div>
            </a>
            
            <!-- Addresses Card -->
            <a href="#" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-green-100 text-green-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Your Addresses</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Edit addresses for orders and gifts</p>
                    </div>
                </div>
            </a>
            
            <!-- Payment Options Card -->
            <a href="#" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-purple-100 text-purple-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Payment options</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Edit or add payment methods</p>
                    </div>
                </div>
            </a>
            
            <!-- Contact Us Card -->
            <a href="#" class="block bg-white rounded-xl border border-slate-200 p-6 hover:bg-slate-50 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer group">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-full bg-teal-100 text-teal-500 flex items-center justify-center text-3xl shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">Contact Us</h2>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Contact our customer service via phone or chat</p>
                    </div>
                </div>
            </a>
            
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
