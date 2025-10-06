<header>
    <div class="top-bar">
        <div class="logo">
            ADA | Auto
        </div>
        <div class="header-right">
            <div class="work-time">
                <i class="fas fa-clock" style="font-size: 44px;"></i>
                пн-вс<br> 08.00 - 20.00
            </div>
            <?php
                if(isset($_COOKIE['login']))
                    echo '<p>Привет, ' . htmlspecialchars($_COOKIE["login"]).'</p>
                            <a href="/lib/logout.php" class="reg-btn">Выйти</a>';

                else
                    echo '<a href="/registration.php" class="reg-btn">
                                РЕГИСТРАЦИЯ
                            </a>
                            <a href="/auth.php" class="reg-btn">
                                ВХОД
                            </a>'
            ?>
            
            
        </div>
    </div>
    <nav>
        <ul class="menu">
            <li><a href="#">ГЛАВНАЯ</a></li>
            <li><a href="#">НОВОСТИ</a></li>
            <li><a href="#">МОДЕЛИ</a></li>
            <li><a href="#">КЛИЕНТАМ</a></li>
            <li><a href="#">СЕРВИС</a></li>
            <li><a href="#">КОНТАКТЫ</a></li>
            <li class="test-drive"><a href="#">ТЕСТ-ДРАЙВ</a></li>
        </ul>
    </nav>
</header>