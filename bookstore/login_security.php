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
$error = '';

// Handle form submission for profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Check if email is already taken by another user
    $check_email = $conn->query("SELECT id FROM users WHERE email='$email' AND id != $user_id");
    if ($check_email->num_rows > 0) {
        $error = "This email is already in use by another account.";
    } else {
        $update_query = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
        
        // If password is provided, update it as well
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $update_query = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$user_id";
        }
        
        if ($conn->query($update_query) === TRUE) {
            $message = "Profile updated successfully!";
            $_SESSION['name'] = $name; // Update session variable
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }
}

// Fetch current user details
$result = $conn->query("SELECT name, email, created_at FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Security | Lumina Books</title>
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
            <a href="profile.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-user mr-1"></i> Your Account</a>
            <a href="cart.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-bag-shopping mr-1"></i> Cart</a>
            <a href="logout.php" class="text-white hover:text-pink-200 transition-colors font-bold"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-2xl">
        
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="profile.php" class="text-indigo-600 hover:underline text-sm font-medium">Your Account</a> 
            <span class="text-slate-400 mx-2">›</span> 
            <span class="text-slate-600 text-sm font-medium">Login & security</span>
        </div>

        <h1 class="text-3xl font-black mb-8 text-slate-800 tracking-tight">Login & security</h1>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Profile Form -->
            <div class="p-8">
                
                <?php if ($message): ?>
                    <div class="bg-green-50 text-green-600 px-4 py-3 rounded-lg mb-6 text-sm border border-green-200 font-medium">
                        <i class="fa-solid fa-check-circle mr-2"></i><?= $message ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm border border-red-200 font-medium">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i><?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-6">
                    <div>
                        <div class="flex justify-between mb-1">
                            <label class="block text-sm font-bold text-slate-700">Name</label>
                        </div>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800 transition-all outline-none">
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-1">
                            <label class="block text-sm font-bold text-slate-700">Email Address</label>
                        </div>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800 transition-all outline-none">
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-1">
                            <label class="block text-sm font-bold text-slate-700">Password</label>
                        </div>
                        <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800 transition-all outline-none" placeholder="•••••••• (leave blank to keep current)">
                    </div>
                    
                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-lg transition-all shadow-md shadow-indigo-200">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
