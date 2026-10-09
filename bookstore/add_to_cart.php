<?php
session_start();
require_once 'db.php';

// If not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = (int)$_POST['book_id']; 
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    // Check if the book is already in the user's cart
    $check_cart = $conn->query("SELECT id, quantity FROM cart WHERE user_id=$user_id AND book_id=$book_id");

    if ($check_cart->num_rows > 0) {
        // Book already in cart, update quantity
        $cart_item = $check_cart->fetch_assoc();
        $new_quantity = $cart_item['quantity'] + $quantity;
        $cart_id = $cart_item['id'];
        $conn->query("UPDATE cart SET quantity=$new_quantity WHERE id=$cart_id");
    } else {
        // Add new item to cart
        $conn->query("INSERT INTO cart (user_id, book_id, quantity) VALUES ($user_id, $book_id, $quantity)");
    }
}

// Redirect back to cart page
header("Location: cart.php");
exit();
?>
