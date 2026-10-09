<!-- Vibrant Gradient Footer (Reduced Height) -->
    <footer class="lumina-header text-white mt-auto w-full relative border-t border-white/20 shadow-2xl">
        <!-- Subtle Top Glow Bar -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
        
        <div class="max-w-[1600px] mx-auto px-6 md:px-12 py-8 w-full relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <!-- Brand Column -->
                <div class="lg:col-span-2">
                    <a href="index.php" class="flex items-center gap-3 mb-3 group">
                        <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md shadow-lg border border-white/20 group-hover:bg-white/30 transition-colors">
                            <i class="fa-solid fa-book-open text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white">Lumina<span class="text-pink-300">Books</span></span>
                    </a>
                    <p class="text-indigo-100/90 mb-4 max-w-sm leading-relaxed font-medium text-xs md:text-sm">Elevating your reading experience. Discover millions of books with premium delivery, exclusive formats, and curated collections.</p>
                    <div class="flex gap-2.5">
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-white/25 hover:border-white/40 transition-all shadow-sm"><i class="fa-brands fa-twitter text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-white/25 hover:border-white/40 transition-all shadow-sm"><i class="fa-brands fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-white/25 hover:border-white/40 transition-all shadow-sm"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                    </div>
                </div>

                <!-- Links Columns -->
                <div>
                    <h3 class="font-bold mb-3 text-sm md:text-base text-white tracking-wide uppercase">Shop</h3>
                    <ul class="space-y-2 text-xs md:text-sm text-indigo-100/80 font-medium">
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">New Releases</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Lumina Devices</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Gift Cards</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Award Winners</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-3 text-sm md:text-base text-white tracking-wide uppercase">Support</h3>
                    <ul class="space-y-2 text-xs md:text-sm text-indigo-100/80 font-medium">
                        <li><a href="profile.php" class="hover:text-pink-300 transition-colors">Your Account</a></li>
                        <li><a href="orders.php" class="hover:text-pink-300 transition-colors">Order Tracking</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Shipping Rates</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Returns & Refunds</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Help Center</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-3 text-sm md:text-base text-white tracking-wide uppercase">LuminaPlus</h3>
                    <ul class="space-y-2 text-xs md:text-sm text-indigo-100/80 font-medium">
                        <li><a href="#" class="text-yellow-300 hover:text-yellow-200 transition-colors flex items-center gap-1.5 font-bold"><i class="fa-solid fa-bolt"></i> Join Premium</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Member Benefits</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Manage Subscription</a></li>
                        <li><a href="#" class="hover:text-pink-300 transition-colors">Lumina Rewards</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Bottom Footer -->
        <div class="border-t border-white/15 bg-black/15 text-white relative z-10 backdrop-blur-md">
            <div class="max-w-[1600px] mx-auto px-6 md:px-12 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-indigo-100/80 text-xs font-medium">© <?=date('Y')?> Lumina Books, Inc. All rights reserved.</p>
                
                <div class="flex flex-wrap items-center gap-5 text-xs font-medium text-indigo-100/80">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Accessibility</a>
                    
                    <!-- Language/Currency Pill -->
                    <div class="flex items-center bg-white/10 border border-white/20 rounded-full px-3 py-1 gap-2.5 ml-2 shadow-inner text-white">
                        <span class="flex items-center gap-1.5 font-bold text-xs"><i class="fa-solid fa-globe text-pink-300"></i> EN</span>
                        <div class="w-px h-3 bg-white/30"></div>
                        <span class="font-bold text-xs">USD</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button with Mouse Scroll Indicator -->
    <div id="backToTopBtn" class="back-to-top-btn" title="Back to Top">
        <div class="mouse-scroll-indicator">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="5" y="2" width="14" height="20" rx="7"></rect>
                <path d="M12 6v4" class="mouse-wheel-path"></path>
            </svg>
            <i class="fas fa-chevron-up scroll-arrow"></i>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var backToTopBtn = document.getElementById('backToTopBtn');
        if (backToTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 250) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
    </script>
