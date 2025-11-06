<?php 
require_once "lib/models.php";
require_once "lib/_helpers.php"?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Модельный ряд - ADA Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/style_base.css">
    <link rel="stylesheet" href="styles/style_layout.css">
    <link rel="stylesheet" href="styles/style_models.css">
</head>
<body>
<?php
include "blocks/header.php";
?>
<section class="models-hero">
    <div class="container">
        <h1>Модельный ряд</h1>
        <p>Выберите подходящий автомобиль по параметрам или воспользуйтесь поиском</p>
    </div>
</section>

<section class="models-filters">
    <div class="container">
        <div class="filters-container">
            <div class="filter-group">
                <label for="search">Поиск по модели:</label>
                <input type="text" id="search" class="filter-input" placeholder="Название...">
            </div>
            <div class="filter-group">
                <label for="brand">Марка:</label>
                <select id="brand" class="filter-select">
                    <option value="all">Все марки</option>
                    <?php
                    $brands = $pdo->query("SELECT DISTINCT brand FROM car_models ORDER BY brand")->fetchAll(PDO::FETCH_COLUMN);
                    foreach ($brands as $brand): ?>
                        <option value="<?=htmlspecialchars(strtolower($brand))?>"><?=htmlspecialchars($brand)?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="model">Модель:</label>
                <select id="model" class="filter-select">
                    <option value="all">Все модели</option>
                </select>
            </div>
            
            <button class="btn-outline reset-filters" id="reset-filters">Сбросить фильтры</button>
        </div>
    </div>
</section>

 <section class="models-grid">
    <div class="container">
        <div class="models-list" id="models-list">
            <!-- Модельные карточки -->
            <?php foreach ($models as $index => $car): ?>
                <?php
                $folder = getModelFolder($car['brand'], $car['model']);
                $imgPath = findModelImage($folder)
                ?>
                <div class="model-item"
                    data-brand="<?= htmlspecialchars(strtolower($car['brand'])) ?>"
                    data-model="<?= htmlspecialchars(strtolower($car['model'])) ?>">
                    <a href="/models_stock.php?brand=<?= urlencode($car['brand'])?>&model=<?=urlencode($car['model']) ?>">
                    <div class="model-image">
                        <?php if ($imgPath):?>
                            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($car['brand'].' '.$car['model'])?>">
                        <?php else: ?>
                            <div class="model-image-placeholder"><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></div>
                        <?php endif;?>
                    </div>
                    
                    </a>
                    <div class="model-title" style="text-align: center;"><strong><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></strong></div>
                </div>
            
            <?php endforeach;?>
        </div>
    </div>
</section>
<?php include "blocks/footer.php";?>

<script src="scripts/script_models.js"></script>
</body>
</html>