<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'config/class.php';
    $pluem = new classweb_bypluem;
    $web_config = $pluem->web_config();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($web_config['title']); ?></title>
    <link rel="icon" type="image" href="<?php echo htmlspecialchars($web_config['logo']); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
    session_start();
    require 'vendor/autoload.php';
    $router = new AltoRouter();
    include 'layouts/navbar.php';

    // Load user information
    $resultuser = $pluem->resultuser();

    // Handle routing based on user session
    if (empty($_SESSION['id'])) {
        $router->map('GET', '/', function() {
            include 'pages/account/login.php';
        });
        $router->map('GET', '/login', function() {
            include 'pages/account/login.php';
        });
        $router->map('GET', '/register', function() {
            include 'pages/account/register.php';
        });
    } else {
        $router->map('GET', '/', function() {
            include 'pages/home.php';
        });
        $router->map('GET', '/home', function() {
            include 'pages/home.php';
        });
        $router->map('GET', '/shop', function() {
            include 'pages/shop/index.php';
        });
        $router->map('GET', '/topup', function() {
            include 'pages/topup/index.php';
        });
        $router->map('GET', '/termgame', function() {
            include 'pages/termgame/index.php';
        });
        $router->map('GET', '/account', function() {
            include 'pages/account/index.php';
        });
        $router->map('GET', '/history_shop', function() {
            include 'pages/history/shop.php';
        });
        $router->map('GET', '/code', function() {
            include 'pages/code/index.php';
        });
        $router->map('GET', '/gamespin', function() {
            include 'pages/game/spin.php';
        });

        // Admin routes
        if ($resultuser['class'] == "1") {
            $admin_routes = [
                '/backend' => 'pages/admin/index.php',
                '/settings_user' => 'pages/admin/settings/user.php',
                '/settings_web' => 'pages/admin/settings/web.php',
                '/settings_product' => 'pages/admin/settings/product.php',
                '/settings_termgame' => 'pages/admin/settings/termgame.php',
                '/settings_code' => 'pages/admin/settings/code.php',
                '/history_topup' => 'pages/admin/history/topup.php',
                '/history_product' => 'pages/admin/history/product.php',
                '/history_termgame' => 'pages/admin/history/termgame.php',
                '/history_random' => 'pages/admin/history/random.php',
                '/edit_user' => 'pages/admin/edit/user.php',
                '/edit_product' => 'pages/admin/edit/product.php',
                '/add_stock_id' => 'pages/admin/add/stock_id.php',
                '/edit_stock_id' => 'pages/admin/edit/stock_id.php',
                '/add_item' => 'pages/admin/add/item.php',
                '/edit_item' => 'pages/admin/edit/item.php',
            ];

            foreach ($admin_routes as $path => $page) {
                $router->map('GET', $path, function() use ($page) {
                    include 'layouts/menu.php';
                    include $page;
                });
            }
        }
    }

    // Match the route and call the corresponding function
    $match = $router->match();
    if (is_array($match) && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        echo "<script>window.location.href = '/';</script>";
    }
    ?>

    <footer class="pb-3 d-block my-auto footer-copyright text-secondary text-center py-4 w-100">
        <small>
            <a href="https://www.facebook.com/profile.php?id=61555649612471" target="_blank">Follow us on Facebook</a>
        </small>
    </footer>
</body>
</html>
