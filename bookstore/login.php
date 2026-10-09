<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lumina Books</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <!-- Background elements -->
    <div class="glow-orb glow-orb-1"></div>
    <div class="glow-orb glow-orb-2"></div>

    <!-- Animated Floating Books Background -->
    <div class="animated-bg-container">
        <i class="fa-solid fa-book-open floating-book-icon lg" style="top: 10%; left: 5%; animation-delay: 0s;"></i>
        <i class="fa-solid fa-bookmark floating-book-icon pink sm" style="top: 75%; left: 12%; animation-delay: -3s;"></i>
        <i class="fa-solid fa-feather floating-book-icon amber" style="top: 20%; right: 15%; animation-delay: -5s;"></i>
        <i class="fa-solid fa-book floating-book-icon cyan lg" style="top: 65%; right: 8%; animation-delay: -2s;"></i>
    </div>

    <div class="w-full max-w-md p-4 relative z-10">
        <div class="text-center mb-8">
            <a href="index.php" class="inline-flex items-center gap-2 mb-4">
                <i class="fa-solid fa-book-open text-2xl text-indigo-500"></i>
                <span class="text-2xl font-bold tracking-tight text-white">Lumina<span class="text-indigo-500">Books</span></span>
            </a>
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-gray-400">Sign in to continue your reading journey.</p>
        </div>

        <div class="glass-panel p-8">
            <?php if ($error): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i><?= $error ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input type="email" name="email" required class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition-all outline-none" placeholder="john@example.com">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-gray-300">Password</label>
                        <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" required class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition-all outline-none" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 rounded border-slate-600 bg-slate-700 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-slate-900">
                    <label for="remember" class="ml-2 block text-sm text-gray-400">Remember me for 30 days</label>
                </div>

                <button type="submit" class="btn-glow w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-all mt-6 shadow-lg shadow-indigo-500/30">
                    Sign In
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-400">
                Don't have an account? <a href="register.php" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Sign up now</a>
            </p>
        </div>
    </div>
</body>
</html>
