<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Books | Premium Store</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
        <!-- Main Nav -->
        <div class="flex items-center px-4 py-3 gap-6">
            <!-- Logo -->
            <a href="index.php" class="flex items-center group transition-transform hover:scale-105">
                <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md mr-3 shadow-lg border border-white/20 group-hover:bg-white/30 transition-colors">
                    <i class="fa-solid fa-book-open text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight">Lumina<span class="text-pink-300">Books</span></span>
            </a>
            
            <!-- Deliver to -->
            <div class="hidden md:flex flex-col items-start px-2 py-1 cursor-pointer hover:bg-white/10 rounded-lg transition-colors border border-transparent hover:border-white/20">
                <span class="text-[10px] text-indigo-100 ml-4 font-bold tracking-wide uppercase">Deliver to</span>
                <span class="text-sm font-bold flex items-center gap-1"><i class="fa-solid fa-location-dot text-pink-300"></i> Select your address</span>
            </div>

            <!-- Search Bar -->
            <div class="flex-grow flex focus-within:ring-4 focus-within:ring-white/40 rounded-xl h-12 bg-white ml-2 shadow-lg transition-shadow">
                <select class="bg-slate-50 text-slate-700 text-sm font-bold px-4 border-r border-slate-200 lumina-search-input outline-none cursor-pointer hover:bg-slate-100 w-auto">
                    <option>All Departments</option>
                    <option>Books</option>
                    <option>E-Books</option>
                    <option>Audiobooks</option>
                </select>
                <input type="text" placeholder="Search millions of books..." class="flex-grow px-4 text-slate-800 text-sm outline-none w-full placeholder-slate-400 font-medium">
                <button class="lumina-search-btn text-white w-16 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <!-- Account & Lists -->
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="flex items-center">
                    <a href="profile.php" class="flex flex-col items-start px-3 py-1 cursor-pointer hover:bg-white/10 border border-transparent hover:border-white/20 rounded-lg transition-colors ml-4">
                        <span class="text-xs text-indigo-100 font-medium">Hello, <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Reader'; ?></span>
                        <span class="text-sm font-bold flex items-center gap-1">My Account <i class="fa-solid fa-chevron-down text-[10px] text-white/70"></i></span>
                    </a>
                    <a href="logout.php" class="text-sm font-bold text-white hover:text-pink-200 ml-2 transition-colors flex items-center" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            <?php else: ?>
                <a href="login.php" class="flex flex-col items-start px-3 py-1 cursor-pointer hover:bg-white/10 border border-transparent hover:border-white/20 rounded-lg transition-colors ml-4">
                    <span class="text-xs text-indigo-100 font-medium">Hello, sign in</span>
                    <span class="text-sm font-bold flex items-center gap-1">My Account <i class="fa-solid fa-chevron-down text-[10px] text-white/70"></i></span>
                </a>
            <?php endif; ?>

            <!-- Returns & Orders -->
            <div class="hidden lg:flex flex-col items-start px-3 py-1 cursor-pointer hover:bg-white/10 border border-transparent hover:border-white/20 rounded-lg transition-colors">
                <span class="text-xs text-indigo-100 font-medium">Returns</span>
                <span class="text-sm font-bold">& Orders</span>
            </div>

            <!-- Cart -->
            <a href="cart.php" class="flex items-center gap-2 px-3 py-2 cursor-pointer relative hover:bg-white/10 border border-transparent hover:border-white/20 rounded-xl transition-colors">
                <div class="relative bg-white/20 p-2.5 rounded-lg shadow-inner">
                    <i class="fa-solid fa-bag-shopping text-white text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-gradient-to-r from-orange-400 to-pink-500 text-white font-bold text-xs h-5 w-5 flex items-center justify-center rounded-full shadow-lg border-2 border-indigo-600">0</span>
                </div>
                <span class="text-sm font-bold hidden md:block">Cart</span>
            </a>
        </div>

        <!-- Sub Nav -->
        <div class="lumina-subnav flex items-center px-6 py-2.5 text-sm font-bold gap-6 overflow-x-auto whitespace-nowrap text-white shadow-sm">
            <a href="#" class="flex items-center gap-2 hover:text-pink-200 transition-colors">
                <i class="fa-solid fa-bars"></i> All Categories
            </a>
            <div class="w-px h-4 bg-white/30"></div>
            <a href="#" class="hover:text-pink-200 transition-colors">Best Sellers</a>
            <a href="#" class="hover:text-pink-200 transition-colors">New Releases</a>
            <a href="#" class="hover:text-pink-200 transition-colors">Award Winners</a>
            <a href="#" class="hover:text-pink-200 transition-colors flex items-center gap-1"><i class="fa-solid fa-bolt text-yellow-300"></i> Flash Deals</a>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div class="w-px h-4 bg-white/30"></div>
                <a href="admin/index.php" class="text-yellow-300 hover:text-yellow-200 transition-colors font-extrabold"><i class="fa-solid fa-shield-halved mr-1"></i> Admin Panel</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Hero / Main Content -->
    <main class="flex-grow relative mx-auto w-full max-w-full overflow-x-hidden">
        <!-- Hero Background Banner (Soft Light version) -->
        <div class="relative h-[450px] md:h-[500px] w-full overflow-hidden bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-b-[3rem] shadow-sm border-b border-indigo-100/50">
            <div class="hero-glow"></div>
            <div class="hero-glow-2"></div>
            
            <!-- Animated Floating Books & Magical Elements -->
            <div class="animated-bg-container">
                <i class="fa-solid fa-book-open floating-book-icon lg" style="top: 15%; left: 8%; animation-delay: 0s;"></i>
                <i class="fa-solid fa-book floating-book-icon pink sm" style="top: 60%; left: 18%; animation-delay: -2s;"></i>
                <i class="fa-solid fa-feather floating-book-icon amber" style="top: 25%; left: 45%; animation-delay: -5s;"></i>
                <i class="fa-solid fa-bookmark floating-book-icon cyan sm" style="top: 70%; left: 48%; animation-delay: -3s;"></i>
                <i class="fa-solid fa-wand-magic-sparkles floating-book-icon pink" style="top: 18%; right: 28%; animation-delay: -7s;"></i>
                <i class="fa-solid fa-graduation-cap floating-book-icon amber lg" style="top: 65%; right: 12%; animation-delay: -4s;"></i>
                <i class="fa-solid fa-book-journal-whills floating-book-icon cyan" style="top: 35%; right: 6%; animation-delay: -1s;"></i>
            </div>
            
            <!-- Overlay Text -->
            <div class="absolute top-1/4 left-8 md:left-16 z-20 max-w-2xl">
                <span class="inline-block py-1.5 px-4 rounded-full bg-indigo-100 border border-indigo-200 text-indigo-700 text-xs font-black tracking-wider uppercase mb-5 shadow-sm">New Collection Available</span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-800 mb-6 leading-tight tracking-tight">
                    Read outside <br/> the <span class="text-gradient">lines.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-10 font-medium leading-relaxed max-w-xl">Curated collections of the world's most captivating stories, delivered right to your door with Lumina Premium.</p>
                <div class="flex gap-4">
                    <a href="shop.php" class="btn-lumina px-8 py-4 text-base font-bold flex items-center gap-2 hover:no-underline">
                        Explore Catalog <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <!-- Decorative Book Image in Hero (Right side) -->
            <div class="hidden lg:block absolute right-16 bottom-0 w-[450px] h-[400px] z-10">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Books" class="w-full h-full object-cover rounded-tl-3xl shadow-2xl border-t-8 border-l-8 border-white transform rotate-3 translate-y-12">
            </div>
        </div>

        <!-- Content Area -->
        <div class="relative z-20 -mt-16 md:-mt-24 px-4 sm:px-8 mb-12 w-full">
            
            <!-- Category Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Card 1 -->
                <div class="lumina-card p-6 z-20 h-full flex flex-col">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Trending Genres</h2>
                        <div class="h-8 w-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 border border-indigo-100"><i class="fa-solid fa-fire-flame-curved"></i></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4 flex-grow">
                        <div class="flex flex-col gap-2 group cursor-pointer">
                            <div class="rounded-xl overflow-hidden bg-slate-50 p-2 border border-slate-100 group-hover:border-indigo-100 transition-colors">
                                <img src="https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg" class="h-32 w-full object-contain group-hover:scale-105 transition-transform duration-500" alt="Fiction">
                            </div>
                            <span class="text-sm text-slate-600 font-bold text-center group-hover:text-indigo-600 transition-colors">Fiction</span>
                        </div>
                        <div class="flex flex-col gap-2 group cursor-pointer">
                            <div class="rounded-xl overflow-hidden bg-slate-50 p-2 border border-slate-100 group-hover:border-indigo-100 transition-colors">
                                <img src="https://covers.openlibrary.org/b/isbn/9780441013593-L.jpg" class="h-32 w-full object-contain group-hover:scale-105 transition-transform duration-500" alt="Sci-Fi">
                            </div>
                            <span class="text-sm text-slate-600 font-bold text-center group-hover:text-indigo-600 transition-colors">Sci-Fi</span>
                        </div>
                    </div>
                    <a href="shop.php" class="text-indigo-600 text-sm mt-4 font-bold hover:text-indigo-800 flex items-center gap-1 group">
                        Browse all genres <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="lumina-card p-6 z-20 h-full flex flex-col relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-50 to-transparent rounded-bl-full -z-10"></div>
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Lumina Digital</h2>
                        <div class="h-8 w-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 border border-purple-100"><i class="fa-solid fa-tablet-screen-button"></i></div>
                    </div>
                    <div class="flex-grow mb-4 flex flex-col items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1544716305-66a16dda9f91?w=400&h=300&fit=crop" class="w-full h-48 object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500" alt="E-Reader">
                        <p class="text-slate-500 text-sm text-center mt-4 font-medium">Read anywhere, anytime with our premium e-readers.</p>
                    </div>
                    <a href="#" class="text-purple-600 text-sm mt-auto font-bold hover:text-purple-800 flex items-center gap-1 group-hover:gap-2 transition-all">
                        Shop digital devices <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="lumina-card p-6 z-20 h-full flex flex-col">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Staff Picks</h2>
                        <div class="h-8 w-8 rounded-full bg-pink-50 flex items-center justify-center text-pink-500 border border-pink-100"><i class="fa-solid fa-heart"></i></div>
                    </div>
                    <div class="bg-gradient-to-br from-pink-50/50 to-white rounded-xl p-4 flex-grow mb-4 flex items-center gap-4 group cursor-pointer shadow-sm border border-pink-100/50">
                        <div class="w-1/2">
                            <img src="https://covers.openlibrary.org/b/isbn/9781649374042-L.jpg" class="h-40 object-contain drop-shadow-lg group-hover:scale-105 group-hover:rotate-3 transition-transform duration-500" alt="Book">
                        </div>
                        <div class="w-1/2">
                            <h3 class="font-bold text-slate-800 leading-tight mb-1">Fourth Wing</h3>
                            <p class="text-[11px] text-slate-500 mb-2 font-medium uppercase tracking-wide">Rebecca Yarros</p>
                            <div class="flex text-yellow-400 text-[10px] mb-2"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <span class="inline-block px-2 py-1 bg-white text-pink-600 text-[10px] font-bold rounded-md shadow-sm border border-pink-100">Must Read</span>
                        </div>
                    </div>
                    <a href="shop.php" class="text-pink-600 text-sm mt-auto font-bold hover:text-pink-800 flex items-center gap-1 group">
                        See all picks <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Card 4 - Auth Section -->
                <div class="lumina-card p-6 z-20 h-full flex flex-col border-2 border-transparent hover:border-indigo-100 bg-gradient-to-b from-white to-indigo-50/50">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <div class="flex items-center justify-center mb-6 mt-4">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-md border border-indigo-100 relative">
                                <div class="absolute inset-0 rounded-full border-2 border-indigo-200 border-dashed animate-[spin_10s_linear_infinite]"></div>
                                <i class="fa-solid fa-user-lock text-3xl text-indigo-400"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-extrabold mb-2 text-center text-slate-800">Unlock the Full Experience</h2>
                        <p class="text-sm text-center text-slate-500 mb-6 font-medium">Personalized recommendations, fast checkout, and exclusive perks.</p>
                        
                        <a href="login.php" class="btn-lumina text-center py-3 px-4 font-bold w-full mb-3">Sign In Securely</a>
                        <p class="text-sm text-center text-slate-500 font-medium">New here? <a href="register.php" class="text-indigo-600 hover:text-indigo-800 font-bold border-b border-indigo-200 hover:border-indigo-600 transition-colors">Create an account</a></p>
                    <?php else: ?>
                        <h2 class="text-xl font-extrabold mb-4 text-slate-800">Welcome back, <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Friend'; ?>!</h2>
                        <div class="bg-white rounded-xl border border-indigo-100 p-6 flex-grow mb-4 flex flex-col items-center justify-center shadow-sm hover:shadow-md transition-shadow cursor-pointer group">
                            <div class="bg-indigo-50 w-16 h-16 rounded-full flex items-center justify-center mb-3 group-hover:bg-indigo-100 transition-colors">
                                <i class="fa-solid fa-box-open text-3xl text-indigo-500 group-hover:scale-110 transition-transform"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-700 text-center">Track your latest orders</p>
                        </div>
                        <a href="#" class="btn-lumina text-center py-2.5 px-4 font-bold w-full">Your Account</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Row Carousel -->
            <div class="lumina-card p-8 mb-12 border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center gap-3">
                            Top Rated Books <i class="fa-solid fa-ranking-star text-yellow-400"></i>
                        </h2>
                        <p class="text-slate-500 font-medium mt-1">Discover the highest-rated reads by the Lumina community.</p>
                    </div>
                    <a href="shop.php" class="text-indigo-600 text-sm font-bold hover:text-indigo-800 flex items-center gap-1 px-4 py-2 bg-indigo-50 rounded-full hover:bg-indigo-100 transition-colors">
                        View all <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="product-row gap-6">
                    <!-- Products -->
                    <?php
                    $products = [
                        ['title' => 'Atomic Habits', 'author' => 'James Clear', 'price' => '11', 'cents' => '98', 'img' => 'https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg', 'rating' => 4.8, 'reviews' => '124k'],
                        ['title' => 'The Women: A Novel', 'author' => 'Kristin Hannah', 'price' => '14', 'cents' => '99', 'img' => 'https://covers.openlibrary.org/b/isbn/9781250178305-L.jpg', 'rating' => 4.9, 'reviews' => '34k'],
                        ['title' => 'Iron Flame', 'author' => 'Rebecca Yarros', 'price' => '18', 'cents' => '45', 'img' => 'https://covers.openlibrary.org/b/isbn/9781649374172-L.jpg', 'rating' => 4.6, 'reviews' => '45k'],
                        ['title' => 'The Psychology of Money', 'author' => 'Morgan Housel', 'price' => '12', 'cents' => '54', 'img' => 'https://covers.openlibrary.org/b/isbn/9780857197689-L.jpg', 'rating' => 4.8, 'reviews' => '65k'],
                        ['title' => 'Lessons in Chemistry', 'author' => 'Bonnie Garmus', 'price' => '13', 'cents' => '48', 'img' => 'https://covers.openlibrary.org/b/isbn/9780385547345-L.jpg', 'rating' => 4.7, 'reviews' => '112k'],
                        ['title' => 'A Court of Thorns and Roses', 'author' => 'Sarah J. Maas', 'price' => '9', 'cents' => '99', 'img' => 'https://covers.openlibrary.org/b/isbn/9781635575569-L.jpg', 'rating' => 4.6, 'reviews' => '156k']
                    ];

                    foreach($products as $p):
                    ?>
                    <div class="flex-none w-48 md:w-56 flex flex-col group/card cursor-pointer bg-white p-4 rounded-2xl transition-all duration-300 hover:shadow-lg border border-slate-100 hover:border-indigo-200 relative overflow-hidden">
                        
                        <!-- Hover Glow Background -->
                        <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/0 to-indigo-50/60 opacity-0 group-hover/card:opacity-100 transition-opacity z-0 pointer-events-none"></div>

                        <div class="h-60 mb-4 flex items-center justify-center bg-slate-50 rounded-xl p-3 relative z-10 overflow-visible group-hover/card:bg-white transition-colors border border-slate-100 group-hover/card:border-transparent">
                            <img src="<?=$p['img']?>" class="max-h-full max-w-full object-contain drop-shadow-md group-hover/card:drop-shadow-xl group-hover/card:scale-110 group-hover/card:-translate-y-2 transition-all duration-500 ease-out" alt="<?=$p['title']?>">
                            
                            <!-- LuminaPlus Floating Badge -->
                            <div class="absolute -bottom-3 right-2 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg border-2 border-white flex items-center gap-1 opacity-0 group-hover/card:opacity-100 translate-y-2 group-hover/card:translate-y-0 transition-all duration-300">
                                <i class="fa-solid fa-bolt"></i> Plus
                            </div>
                        </div>
                        
                        <div class="relative z-10 flex flex-col flex-grow">
                            <h3 class="text-base font-extrabold text-slate-800 line-clamp-1 group-hover/card:text-indigo-600 transition-colors mb-1"><?=$p['title']?></h3>
                            <p class="text-[11px] uppercase tracking-wide text-slate-500 mb-3 font-bold"><?=$p['author']?></p>
                            
                            <div class="flex items-center justify-between mt-auto mb-4">
                                <div class="text-2xl font-black text-slate-900 tracking-tight flex items-start">
                                    <span class="text-sm mt-1 text-slate-500 mr-0.5">$</span><?=$p['price']?><span class="price-fraction text-sm mt-1 text-slate-500"><?=$p['cents']?></span>
                                </div>
                                <div class="flex items-center gap-1 bg-yellow-50 border border-yellow-100 px-2 py-1 rounded-md">
                                    <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                                    <span class="text-[11px] font-bold text-yellow-700"><?=$p['rating']?></span>
                                </div>
                            </div>
                            
                            <!-- Add to Cart -->
                            <button class="btn-lumina py-2.5 px-4 text-sm font-bold w-full flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Discounted Books Carousel -->
            <div class="lumina-card p-8 mb-12 border border-slate-200 bg-white shadow-sm relative overflow-hidden">
                <!-- Decorative background accent for deals -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-pink-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
                
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 border-b border-slate-100 pb-4 relative z-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center gap-3">
                            Limited Time Deals <i class="fa-solid fa-tags text-pink-500"></i>
                        </h2>
                        <p class="text-slate-500 font-medium mt-1">Grab these amazing books at unbeatable prices before they're gone.</p>
                    </div>
                    <a href="shop.php" class="text-pink-600 text-sm font-bold hover:text-pink-800 flex items-center gap-1 px-4 py-2 bg-pink-50 rounded-full hover:bg-pink-100 transition-colors">
                        View all deals <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="product-row gap-6 relative z-10">
                    <!-- Discounted Products -->
                    <?php
                    $discount_products = [
                        ['title' => 'Project Hail Mary', 'author' => 'Andy Weir', 'price' => '14', 'cents' => '00', 'old_price' => '28.00', 'discount' => '50%', 'img' => 'https://covers.openlibrary.org/b/isbn/9780593135204-L.jpg', 'rating' => 4.9],
                        ['title' => 'The Midnight Library', 'author' => 'Matt Haig', 'price' => '12', 'cents' => '50', 'old_price' => '25.00', 'discount' => '50%', 'img' => 'https://covers.openlibrary.org/b/isbn/9780525559474-L.jpg', 'rating' => 4.7],
                        ['title' => 'Dune', 'author' => 'Frank Herbert', 'price' => '10', 'cents' => '99', 'old_price' => '18.99', 'discount' => '42%', 'img' => 'https://covers.openlibrary.org/b/isbn/9780441013593-L.jpg', 'rating' => 4.8],
                        ['title' => 'Where the Crawdads Sing', 'author' => 'Delia Owens', 'price' => '9', 'cents' => '45', 'old_price' => '16.00', 'discount' => '40%', 'img' => 'https://covers.openlibrary.org/b/isbn/9780735219106-L.jpg', 'rating' => 4.8],
                        ['title' => 'Sapiens: A Brief History', 'author' => 'Yuval Noah Harari', 'price' => '15', 'cents' => '20', 'old_price' => '24.99', 'discount' => '39%', 'img' => 'https://covers.openlibrary.org/b/isbn/9780062316097-L.jpg', 'rating' => 4.7],
                    ];

                    foreach($discount_products as $p):
                    ?>
                    <div class="flex-none w-48 md:w-56 flex flex-col group/card cursor-pointer bg-white p-4 rounded-2xl transition-all duration-300 hover:shadow-lg border border-pink-100 hover:border-pink-300 relative overflow-hidden">
                        
                        <!-- Hover Glow Background -->
                        <div class="absolute inset-0 bg-gradient-to-b from-pink-50/0 to-pink-50/60 opacity-0 group-hover/card:opacity-100 transition-opacity z-0 pointer-events-none"></div>

                        <!-- Discount Badge -->
                        <div class="absolute top-4 left-4 bg-pink-600 text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow-md z-20 flex items-center gap-1 transform -rotate-2">
                            <i class="fa-solid fa-arrow-down text-[8px]"></i> <?=$p['discount']?>
                        </div>

                        <div class="h-60 mb-4 flex items-center justify-center bg-slate-50 rounded-xl p-3 relative z-10 overflow-visible group-hover/card:bg-white transition-colors border border-slate-100 group-hover/card:border-transparent">
                            <img src="<?=$p['img']?>" class="max-h-full max-w-full object-contain drop-shadow-md group-hover/card:drop-shadow-xl group-hover/card:scale-110 group-hover/card:-translate-y-2 transition-all duration-500 ease-out" alt="<?=$p['title']?>">
                        </div>
                        
                        <div class="relative z-10 flex flex-col flex-grow">
                            <h3 class="text-base font-extrabold text-slate-800 line-clamp-1 group-hover/card:text-pink-600 transition-colors mb-1"><?=$p['title']?></h3>
                            <p class="text-[11px] uppercase tracking-wide text-slate-500 mb-2 font-bold"><?=$p['author']?></p>
                            
                            <div class="flex items-end gap-2 mb-1">
                                <div class="text-xl font-black text-pink-600 tracking-tight flex items-start leading-none">
                                    <span class="text-xs mt-1 mr-0.5">$</span><?=$p['price']?><span class="price-fraction text-xs mt-0.5"><?=$p['cents']?></span>
                                </div>
                                <div class="text-xs text-slate-400 line-through font-semibold mb-0.5">$<?=$p['old_price']?></div>
                            </div>
                            
                            <div class="flex items-center gap-1 bg-yellow-50 border border-yellow-100 px-2 py-1 rounded-md mt-auto mb-4 w-max">
                                <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                                <span class="text-[11px] font-bold text-yellow-700"><?=$p['rating']?></span>
                            </div>
                            
                            <!-- Add to Cart -->
                            <button class="btn-lumina py-2.5 px-4 text-sm font-bold w-full flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </main>



    <?php include 'footer.php'; ?>
</body>
</html>
