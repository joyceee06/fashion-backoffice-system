<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit();
}

// Optional: function to check user level
function isAdmin() {
    return isset($_SESSION['user_level']) && $_SESSION['user_level'] === 'admin';
}

function isNonAdmin() {
    return isset($_SESSION['user_level']) && $_SESSION['user_level'] === 'non-admin';
}

// Page access control function
function checkAccess($page, $action = 'read') {
    $accessMatrix = [ 
        'products' => [
            'admin' => ['create', 'read', 'update', 'delete'],
            'non-admin' => ['read'] // Read only
        ],
        'product_details' => [
            'admin' => ['read'],
            'non-admin' => ['read']
        ],
        'staffs' => [
            'admin' => ['create', 'read', 'update', 'delete'],
            'non-admin' => [] // No access allowed
        ],
        'customers' => [
            'admin' => ['create', 'read', 'update', 'delete'],
            'non-admin' => []
        ],
        'orders' => [
            'admin' => ['create', 'read', 'update', 'delete'],
            'non-admin' => ['create','read']
        ],
        'order_details' => [
            'admin' => ['create', 'read', 'update', 'delete'],
            'non-admin' => ['create', 'read', 'update', 'delete']
        ],
        'invoice' => [
            'admin' => ['read'],
            'non-admin' => ['read']
        ]
    ];
    
    $userLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : '';
    
    // If page not in matrix, deny access
    if (!isset($accessMatrix[$page])) {
        return false;
    }
    
    // If user level not in matrix, deny access
    if (!isset($accessMatrix[$page][$userLevel])) {
        return false;
    }
    
    // Check if action is allowed
    return in_array($action, $accessMatrix[$page][$userLevel]);
}

// Quick access check function (returns true if allowed, false if not)
function canAccess($page, $action = 'read') {
    return checkAccess($page, $action);
}

// Redirect if no access
function redirectIfNoAccess($page, $action = 'read', $redirectTo = 'index.php') {
    if (!checkAccess($page, $action)) {
        echo "<script>alert('Access denied'); window.location='$redirectTo';</script>";
        exit();
    }
}
?>

