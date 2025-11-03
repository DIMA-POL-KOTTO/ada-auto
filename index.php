<?php
require_once "lib/popular_models.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADA Auto - Автосалон №1 в Беларуси</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<?php
include "blocks/header.php";
?>
<body>

    <section class="hero">
        <div class="hero-slider">
            <!-- Слайд 1 -->
            <div class="slide active" data-slide="0">
               <div class="slide-bg" style="background-image: url('images/photos/vw.jpg')"></div>
                <div class="slide-content">
                    <h2>Volkswagen Tiguan 2024</h2>
                    <p>Совершенство в каждом километре. Новый уровень комфорта и технологий</p>
                    <div class="hero-actions">
                        <a href="#" class="btn-primary">Подробнее</a>
                        <a href="#" class="btn-outline-white">Конфигуратор</a>
                    </div>
                </div>
            </div>
            
            <!-- Слайд 2 -->
            <div class="slide" data-slide="1">
                <div class="slide-bg" style="background-image: url('images/photos/bmw.jpg')"></div>
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h2>BMW 3 Series</h2>
                    <p>Идеальное сочетание роскоши, производительности и инноваций</p>
                    <div class="hero-actions">
                        <a href="#" class="btn-primary">Подробнее</a>
                        <a href="#" class="btn-outline-white">Конфигуратор</a>
                    </div>
                </div>
            </div>
            
            <!-- Слайд 3 -->
            <div class="slide" data-slide="2">
                <div class="slide-bg" style="background-image: url('images/photos/audi.jpg')"></div>
                <div class="slide-content">
                    <h2>Audi A4 Premium</h2>
                    <p>Премиальный дизайн и передовые технологии для опытных водителей</p>
                    <div class="hero-actions">
                        <a href="#" class="btn-primary">Подробнее</a>
                        <a href="#" class="btn-outline-white">Конфигуратор</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-indicators">
            <span class="indicator active" data-slide="0"></span>
            <span class="indicator" data-slide="1"></span>
            <span class="indicator" data-slide="2"></span>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Почему выбирают ADA Auto?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Гарантия качества</h3>
                    <p>Все автомобили проходят тщательную проверку и имеют официальную гарантию</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h3>Лучшие цены</h3>
                    <p>Специальные условия кредитования и программы Trade-In для наших клиентов</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3>Сервисное обслуживание</h3>
                    <p>Профессиональный сервис и оригинальные запчасти для вашего автомобиля</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Круглосуточная поддержка</h3>
                    <p>Наша служба поддержки готова помочь вам в любое время суток</p>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-models">
        <div class="container">
            <h2 class="section-title">Популярные модели</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="carousel-wrapper">
                    <div class="carousel">
                        <?php foreach ($popular_models as $car): ?>
                        <div class="model-card">
                            <?php if($car['badge_type']): ?>
                                <div class="model-badge <?=htmlspecialchars($car["badge_type"]) ?>">
                                    <?php
                                        $badgeText = match($car['badge_type']){
                                            'hit' => 'Хит продаж',
                                            'award' => 'Лучший в классе',
                                            'new' => 'Новинка',
                                            default => 'Популярно'
                                        };
                                        echo htmlspecialchars($badgeText);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="model-image">
                                <?php if(!empty($car['image'])): ?>
                                    <img src="<?=htmlspecialchars($car["image"]) ?>" alt="<?=htmlspecialchars($car['brand'].' '.$car['model']) ?>">
                                <?php else: ?>
                                    <div class="model-image-placeholder">
                                        <?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="model-info">
                                <h3><?=htmlspecialchars($car['brand']) ?> <?=htmlspecialchars($car['model']) ?></h3>
                                <div class="model-features">
                                    <div class="model-feature">
                                        <i class="fas fa-gas-pump"></i>
                                        <span><?=htmlspecialchars($car['fuel_type'])?></span>
                                    </div>
                                    <div class="model-feature">
                                        <i class="fas fa-cog"></i>
                                        <span><?=htmlspecialchars($car['transmission'])?></span>
                                    </div>
                                    <div class="model-feature">
                                        <i class="fas fa-user"></i>
                                        <span><?=$car['seats']?> мест</span>
                                    </div>
                                </div>
                                <div class="model-price"><?=number_format($car['price'], 0, '', ' ')?>$</div>
                                <div class="model-description">
                                    <?=htmlspecialchars($car['description'])?>
                                </div>
                                <div class="model-actions">
                                    <a href="#" class="btn-primary">Подробнее</a>
                                    <a href="#" class="btn-outline">Тест-драйв</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
                
                <button class="carousel-btn next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Найдите свой идеальный автомобиль</h2>
                <p>Оставьте заявку и наш менеджер свяжется с вами для консультации</p>
                <form class="cta-form">
                    <input type="text" placeholder="Ваше имя" required>
                    <input type="tel" placeholder="Номер телефона" required>
                    <button type="submit" class="btn-primary">Отправить заявку</button>
                </form>
            </div>
        </div>
    </section>
<?php
include "blocks/footer.php";
?>
    

    <script src="scripts/script.js"></script>
</body>
</html>