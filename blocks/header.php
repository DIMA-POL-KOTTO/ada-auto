<?php
$is_logged_in = isset($_COOKIE['login']) && !empty($_COOKIE['login']);
$login = $is_logged_in ? htmlspecialchars($_COOKIE['login']) : '';

//текущая страница по URL
$current_page = basename($_SERVER['REQUEST_URI'], '.php');
// Обработка случая с параметрами: /model.php?id=5 → всё равно "model"
if (strpos($current_page, '?') !== false) {
    $current_page = substr($current_page, 0, strpos($current_page, '?')); // для страниц "подробнее"
}
?>




<header class="header">
    <div class="container">
        <div class="header-content">
                <div class="logo">
                    <img src="images/photos/passat_logo.png" alt="ADA Auto" class="logo-image">
                </div>
            <nav class="nav">
                <ul>
                    <li><a href="index.php" class="<?=$current_page === '' || $current_page==='index' ? 'active':''?>">Главная</a></li>
                    <li><a href="models.php" class="<?=$current_page === '' || $current_page==='models' ? 'active':''?>">Модельный ряд</a></li>
                    <li><a href="models_stock.php" class="<?=$current_page === '' || $current_page==='models_stock' ? 'active':''?>">Авто в наличии</a></li>
                    <li><a href="#">Акции</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <?php if ($is_logged_in):?>
                    <div class="user-greeting">
                        Привет, <strong><?=$login?></strong>!
                    </div>
                    <a href="/profile.php" class="btn-outline">Профиль</a>
                    <a href="lib/logout.php" class="btn-primary">Выйти</a>
                <?php else:?>
                    <a href="auth.php" class="btn-outline">Войти</a>
                    <a href="registration.php" class="btn-primary">Регистрация</a>
                <?php endif; ?>
            </div>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>