<?php
require_once 'lib/model_details_data.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?> - Детали модели - ADA Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/style_base.css">
    <link rel="stylesheet" href="styles/style_layout.css">
    <link rel="stylesheet" href="styles/style_details.css">
</head>
<body>
<?php include "blocks/header.php"; ?>

<section class="model-details-hero">
    <div class="container">
        <nav class="breadcrumbs">
            <a href="/">Главная</a>
            <span class="separator">/</span>
            <a href="models.php">Модельный ряд</a>
            <span class="separator">/</span>
            <span class="current"><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></span>
        </nav>
        
        <h1><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></h1>
        <p class="hero-subtitle">Подробная информация о модели</p>
    </div>
</section>

<section class="model-content">
    <div class="container">
        <div class="model-layout">
            <!-- Галерея изображений -->
            <div class="model-gallery">
                <div class="main-image">
                    <?php if ($mainImage): ?>
                        <img src="<?= htmlspecialchars($mainImage) ?>" 
                             alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>"
                             id="mainImage">
                    <?php else: ?>
                        <div class="image-placeholder <?= strtolower($car['brand']) ?>">
                            <i class="fas fa-car"></i>
                            <span><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($additionalImages)): ?>
                <div class="image-thumbnails">
                    <?php foreach ($additionalImages as $thumb): ?>
                        <div class="thumbnail">
                            <img src="<?= htmlspecialchars($thumb) ?>" 
                                 alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>"
                                 onclick="changeMainImage('<?= htmlspecialchars($thumb) ?>')">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Основная информация -->
            <div class="model-info">
                <div class="price-section">
                    <div class="price">$<?= number_format($car['price'], 0, '', ' ') ?></div>
                    <div class="availability in-stock">В наличии</div>
                </div>

                <!-- Краткие характеристики -->
                <div class="quick-specs">
                    <div class="spec-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Год выпуска: <strong><?= htmlspecialchars($car['year']) ?></strong></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-gas-pump"></i>
                        <span>Двигатель: <strong><?= htmlspecialchars($car['engine_capacity']) ?>L</strong></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-horse-head"></i>
                        <span>Мощность: <strong><?= htmlspecialchars($car['horse_power']) ?> л.с.</strong></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cog"></i>
                        <span>КПП: <strong><?= htmlspecialchars(ucfirst($car['transmission'])) ?></strong></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-car"></i>
                        <span>Кузов: <strong><?= htmlspecialchars(ucfirst($car['body_type'])) ?></strong></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-users"></i>
                        <span>Мест: <strong><?= htmlspecialchars($car['seats']) ?></strong></span>
                    </div>
                </div>

                <!-- Кнопки действий -->
                <div class="action-buttons">
                    <a href="/test-drive.php?brand=<?= urlencode($car['brand']) ?>&model=<?= urlencode($car['model']) ?>" class="btn-primary">
                        <i class="fas fa-car-side"></i> Записаться на тест-драйв
                    </a>
                    <a href="/models_stock.php?brand=<?= urlencode($car['brand']) ?>&model=<?= urlencode($car['model']) ?>" class="btn-outline">
                        <i class="fas fa-list"></i> Посмотреть в наличии
                    </a>
                </div>

                <!-- Полные технические характеристики -->
                <div class="specs-section">
                    <h3><i class="fas fa-cogs"></i> Технические характеристики</h3>
                    <div class="specs-grid">
                        <div class="spec-category">
                            <h4>Двигатель</h4>
                            <div class="spec-row">
                                <span class="spec-label">Тип топлива</span>
                                <span class="spec-value"><?= htmlspecialchars(ucfirst($car['fuel_type'])) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Объем двигателя</span>
                                <span class="spec-value"><?= htmlspecialchars($car['engine_capacity']) ?> л</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Мощность</span>
                                <span class="spec-value"><?= htmlspecialchars($car['horse_power']) ?> л.с.</span>
                            </div>
                        </div>

                        <div class="spec-category">
                            <h4>Трансмиссия</h4>
                            <div class="spec-row">
                                <span class="spec-label">Тип КПП</span>
                                <span class="spec-value"><?= htmlspecialchars(ucfirst($car['transmission'])) ?></span>
                            </div>
                        </div>

                        <div class="spec-category">
                            <h4>Кузов</h4>
                            <div class="spec-row">
                                <span class="spec-label">Тип кузова</span>
                                <span class="spec-value"><?= htmlspecialchars(ucfirst($car['body_type'])) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Количество мест</span>
                                <span class="spec-value"><?= htmlspecialchars($car['seats']) ?></span>
                            </div>
                        </div>

                        <div class="spec-category">
                            <h4>Общая информация</h4>
                            <div class="spec-row">
                                <span class="spec-label">Марка</span>
                                <span class="spec-value"><?= htmlspecialchars($car['brand']) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Модель</span>
                                <span class="spec-value"><?= htmlspecialchars($car['model']) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Год выпуска</span>
                                <span class="spec-value"><?= htmlspecialchars($car['year']) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Цвет</span>
                                <span class="spec-value"><?= htmlspecialchars(ucfirst($car['color'])) ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">VIN код</span>
                                <span class="spec-value"><?= htmlspecialchars($car['vin']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Похожие модели -->
        <?php if (!empty($similarModels)): ?>
        <div class="similar-models">
            <h3>Похожие модели</h3>
            <div class="similar-grid">
                <?php foreach ($similarModels as $similar): ?>
                <div class="similar-item">
                    <div class="similar-info">
                        <h4><?= htmlspecialchars($similar['brand']) ?> <?= htmlspecialchars($similar['model']) ?></h4>
                        <p>Год: <?= htmlspecialchars($similar['year']) ?></p>
                        <div class="similar-price">$<?= number_format($similar['price'], 0, '', ' ') ?></div>
                        <a href="model_details.php?brand=<?= urlencode($similar['brand']) ?>&model=<?= urlencode($similar['model']) ?>" class="btn-outline btn-sm">Подробнее</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include "blocks/footer.php"; ?>

<script>
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
    
    // Обновляем активную миниатюру
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    // Активируем первую миниатюру
    const firstThumb = document.querySelector('.thumbnail');
    if (firstThumb) {
        firstThumb.classList.add('active');
    }
});
</script>
</body>
</html>