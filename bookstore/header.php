<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($conn) && file_exists('db.php')) {
    require_once 'db.php';
}

$cart_count = 0;
if (isset($_SESSION['user_id']) && isset($conn)) {
    $uid = (int)$_SESSION['user_id'];
    $c_res = $conn->query("SELECT SUM(quantity) as count FROM cart WHERE user_id=$uid");
    if ($c_res && $row = $c_res->fetch_assoc()) {
        $cart_count = (int)($row['count'] ?? 0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Lumina Books | Premium Store'; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- External Custom & Fallback CSS -->
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="antialiased min-h-screen flex flex-col relative bg-slate-50">

    <!-- Gradient Header -->
    <header class="lumina-header text-white flex flex-col relative z-50">
        <!-- Main Nav Bar -->
        <div class="max-w-[1600px] mx-auto w-full px-4 md:px-6 py-3 flex flex-wrap items-center justify-between gap-3 md:gap-6">
            
            <!-- Left Group: Mobile Menu Button & Brand Logo -->
            <div class="flex items-center gap-3">
                <!-- Mobile Menu Toggle Button -->
                <button type="button" onclick="toggleMobileMenu()" class="md:hidden text-white p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors focus:outline-none" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

                <!-- Logo -->
                <a href="index.php" class="flex items-center group transition-transform hover:scale-105">
                    <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md mr-2.5 shadow-lg border border-white/20 group-hover:bg-white/30 transition-colors">
                        <i class="fa-solid fa-book-open text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white">Lumina<span class="text-pink-300">Books</span></span>
                </a>
            </div>

            <!-- Deliver To Location Pill (Hidden on Mobile) -->
            <div class="hidden lg:flex flex-col items-start px-3 py-1 cursor-pointer hover:bg-white/10 rounded-lg transition-colors border border-transparent hover:border-white/20">
                <span class="text-[10px] text-indigo-100 font-bold tracking-wide uppercase">Deliver to</span>
                <span class="text-sm font-bold flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-pink-300"></i> Select address</span>
            </div>

            <!-- Search Bar (Flexible Width) -->
            <div class="order-3 md:order-none w-full md:w-auto flex-grow flex focus-within:ring-4 focus-within:ring-white/40 rounded-xl h-11 bg-white shadow-md transition-all">
                <select class="bg-slate-50 text-slate-700 text-xs md:text-sm font-bold px-3 md:px-4 border-r border-slate-200 rounded-l-xl outline-none cursor-pointer hover:bg-slate-100 w-auto">
                    <option>All</option>
                    <option>Books</option>
                    <option>E-Books</option>
                    <option>Audiobooks</option>
                </select>
                <input type="text" placeholder="Search millions of books, authors, genres..." class="flex-grow px-3 md:px-4 text-slate-800 text-sm outline-none w-full placeholder-slate-400 font-medium">
                <button class="lumina-search-btn text-white w-12 md:w-14 flex items-center justify-center text-base rounded-r-xl transition-all">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <!-- Right Group: User Account & Cart -->
            <div class="flex items-center gap-2 md:gap-4">
                <!-- User Account Links -->
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="flex flex-col items-start px-2.5 py-1 cursor-pointer hover:bg-white/10 border border-transparent hover:border-white/20 rounded-lg transition-colors">
                        <span class="text-[11px] text-indigo-100 font-medium">Hello, <?php echo isset($_SESSION['name']) ? htmlspecialchars(explode(' ', $_SESSION['name'])[0]) : 'Reader'; ?></span>
                        <span class="text-xs md:text-sm font-bold flex items-center gap-1">My Account <i class="fa-solid fa-chevron-down text-[9px] text-white/70"></i></span>
                    </a>
                    <a href="logout.php" class="p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors" title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-base"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="flex flex-col items-start px-2.5 py-1 cursor-pointer hover:bg-white/10 border border-transparent hover:border-white/20 rounded-lg transition-colors">
                        <span class="text-[11px] text-indigo-100 font-medium">Hello, sign in</span>
                        <span class="text-xs md:text-sm font-bold flex items-center gap-1">My Account <i class="fa-solid fa-chevron-down text-[9px] text-white/70"></i></span>
                    </a>
                <?php endif; ?>

                <!-- Cart Button with Dynamic Badge -->
                <a href="cart.php" class="flex items-center gap-2 px-3 py-1.5 cursor-pointer relative hover:bg-white/10 border border-transparent hover:border-white/20 rounded-xl transition-colors">
                    <div class="relative bg-white/20 p-2 rounded-lg shadow-inner">
                        <i class="fa-solid fa-bag-shopping text-white text-lg"></i>
                        <span class="absolute -top-2 -right-2 bg-gradient-to-r from-orange-400 to-pink-500 text-white font-black text-[11px] h-5 w-5 flex items-center justify-center rounded-full shadow-md border-2 border-indigo-600">
                            <?php echo $cart_count; ?>
                        </span>
                    </div>
                    <span class="text-sm font-bold hidden xl:block">Cart</span>
                </a>
            </div>

        </div>

        <!-- Sub Nav Bar (Scrollable on Mobile) -->
        <div class="lumina-subnav w-full">
            <div class="max-w-[1600px] mx-auto px-4 md:px-6 py-2.5 flex items-center text-xs md:text-sm font-bold gap-4 md:gap-6 overflow-x-auto whitespace-nowrap text-white no-scrollbar">
                <a href="index.php" class="flex items-center gap-2 hover:text-pink-200 transition-colors">
                    <i class="fa-solid fa-bars"></i> All Categories
                </a>
                <div class="w-px h-4 bg-white/30 shrink-0"></div>
                <a href="index.php" class="hover:text-pink-200 transition-colors">Best Sellers</a>
                <a href="index.php" class="hover:text-pink-200 transition-colors">New Releases</a>
                <a href="index.php" class="hover:text-pink-200 transition-colors">Award Winners</a>
                <a href="index.php" class="hover:text-pink-200 transition-colors flex items-center gap-1">
                    <i class="fa-solid fa-bolt text-yellow-300"></i> Flash Deals
                </a>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <div class="w-px h-4 bg-white/30 shrink-0"></div>
                    <a href="admin/index.php" class="text-yellow-300 hover:text-yellow-200 transition-colors font-extrabold flex items-center gap-1">
                        <i class="fa-solid fa-shield-halved"></i> Admin Panel
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenu" class="hidden md:hidden bg-indigo-950/95 border-b border-white/10 px-4 py-4 space-y-3 backdrop-blur-lg">
            <a href="index.php" class="block py-2 text-white font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-house mr-2 text-pink-300"></i> Home</a>
            <a href="cart.php" class="block py-2 text-white font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-bag-shopping mr-2 text-pink-300"></i> Your Cart (<?php echo $cart_count; ?>)</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="block py-2 text-white font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-user mr-2 text-pink-300"></i> My Profile</a>
                <a href="login_security.php" class="block py-2 text-white font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-shield-halved mr-2 text-pink-300"></i> Security Settings</a>
                <a href="logout.php" class="block py-2 text-pink-400 font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-right-from-bracket mr-2"></i> Logout</a>
            <?php else: ?>
                <a href="login.php" class="block py-2 text-white font-bold hover:text-pink-300 transition-colors"><i class="fa-solid fa-right-to-bracket mr-2 text-pink-300"></i> Sign In</a>
                <a href="register.php" class="block py-2 text-yellow-300 font-bold hover:text-yellow-200 transition-colors"><i class="fa-solid fa-user-plus mr-2"></i> Create Account</a>
            <?php endif; ?>
        </div>
    </header>

    <script>
    function toggleMobileMenu() {
        var menu = document.getElementById('mobileMenu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }
    </script>
