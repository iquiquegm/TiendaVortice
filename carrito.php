<?php
session_start();

// Check if the cart is not empty
if (!empty($_SESSION['carrito'])) {
    echo '<h2>Shopping Cart</h2>';
    echo '<ul>';
    foreach ($_SESSION['carrito'] as $product) {
        echo '<li>' . $product['modelo'] . ' - $' . $product['precio'] . '</li>';
    }
    echo '</ul>';
    echo "Artículos: ". count($_SESSION['carrito']);
} else {
    echo '<p>Your shopping cart is empty.</p>';
}
