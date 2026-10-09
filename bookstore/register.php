<?php
session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check_email = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($check_email->num_rows > 0) {
            $error = "Email already exists. Please log in.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $insert = $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')");
            if ($insert) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lumina Books</title>
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
        <i class="fa-solid fa-book-open floating-book-icon lg" style="top: 12%; left: 6%; animation-delay: -1s;"></i>
        <i class="fa-solid fa-graduation-cap floating-book-icon pink sm" style="top: 70%; left: 10%; animation-delay: -4s;"></i>
        <i class="fa-solid fa-feather floating-book-icon amber" style="top: 22%; right: 12%; animation-delay: -2s;"></i>
        <i class="fa-solid fa-bookmark floating-book-icon cyan lg" style="top: 68%; right: 7%; animation-delay: -5s;"></i>
    </div>

    <div class="w-full max-w-md p-4 relative z-10">
        <div class="text-center mb-8">
            <a href="index.php" class="inline-flex items-center gap-2 mb-4">
                <i class="fa-solid fa-book-open text-2xl text-indigo-500"></i>
                <span class="text-2xl font-bold tracking-tight text-white">Lumina<span class="text-indigo-500">Books</span></span>
            </a>
            <h2 class="text-3xl font-bold text-white mb-2">Create an Account</h2>
            <p class="text-gray-400">Join us to explore the best books.</p>
        </div>

        <div class="glass-panel p-8">
            <?php if ($error): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i><?= $error ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fa-solid fa-circle-check mr-2"></i><?= $success ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input type="text" name="name" required class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition-all outline-none" placeholder="John Doe">
                    </div>
                </div>
                
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
                    <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" required class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition-all outline-none" placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="confirm_password" required class="w-full pl-10 pr-4 py-2.5 bg-slate-800/50 border border-slate-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition-all outline-none" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn-glow w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-all mt-6 shadow-lg shadow-indigo-500/30">
                    Create Account
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-400">
                Already have an account? <a href="login.php" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
