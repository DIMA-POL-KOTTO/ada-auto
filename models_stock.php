<?php 
require_once 'lib/models_stock.php';
require_once 'lib/_helpers.php';
$brands = $pdo->query("SELECT DISTINCT brand FROM car_in_stock ORDER BY brand")->fetchAll(PDO::FETCH_COLUMN);
?>

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
<?php include "blocks/header.php"?>

<section class="models-hero">
    <div class="container">
        <h1>Авто в наличии6666666666666666</h1>
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
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= htmlspecialchars(strtolower($brand)) ?>"><?= htmlspecialchars($brand) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="model">Модель:</label>
                <select id="model" class="filter-select">
                    <option value="all">Все модели</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="fuel">Тип топлива:</label>
                <select id="fuel" class="filter-select">
                    <option value="all">Любой</option>
                    <?php
                    $fuel_types = ['бензин', 'дизель', 'гибрид', 'электро'];
                    foreach ($fuel_types as $fuel): ?>
                        <option value="<?= htmlspecialchars($fuel) ?>"><?= htmlspecialchars(ucfirst($fuel)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="transmission">Трансмиссия:</label>
                <select id="transmission" class="filter-select">
                    <option value="all">Любая</option>
                    <?php
                    $transmissions = ['автомат', 'механика', 'вариатор', 'робот'];
                    foreach ($transmissions as $trans): ?>
                        <option value="<?= htmlspecialchars($trans) ?>"><?= htmlspecialchars(ucfirst($trans)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="body-type">Тип кузова:</label>
                <select id="body-type" class="filter-select">
                    <option value="all">Любой</option>
                    <?php
                    $body_types = ['седан', 'универсал', 'хэтчбек', 'минивэн'];
                    foreach ($body_types as $body): ?>
                        <option value="<?= htmlspecialchars($body) ?>"><?= htmlspecialchars(ucfirst($body)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="price">Цена до:</label>
                <select id="price" class="filter-select">
                    <option value="all">Любая</option>
                    <option value="60000">60 000 $</option>
                    <option value="70000">70 000 $</option>
                    <option value="80000">80 000 $</option>
                    <option value="100000">100 000+ $</option>
                </select>
            </div>
            <button class="btn-outline reset-filters" id="reset-filters">Сбросить фильтры</button>
        </div>
    </div>
</section>

<section class="models-grid">
    <div class="container">
        <div class="models-list" id="models-list">
            <?php foreach ($cars as $car): ?>
            <?php
            $folder = getModelFolder($car['brand'], $car['model']);
            $imgPath = findModelImage($folder, $car['id'])
            ?>
            <div class="model-item"
                 data-brand="<?= htmlspecialchars(strtolower($car['brand'])) ?>"
                 data-model="<?= htmlspecialchars(strtolower($car['model'])) ?>"
                 data-fuel="<?= htmlspecialchars($car['fuel_type']) ?>"
                 data-transmission="<?= htmlspecialchars($car['transmission']) ?>"
                 data-body="<?= htmlspecialchars($car['body_type'] ?? 'suv') ?>"
                 data-price="<?= (int)$car['price'] ?>">
                <div class="model-image">
                    <?php if ($imgPath): ?>
                        <img src="<?= htmlspecialchars($imgPath) ?>" 
                             alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>">
                    <?php else: ?>
                        <div class="model-image-placeholder">
                            <?= htmlspecialchars($car['brand']) ?><br><?= htmlspecialchars($car['model']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="model-details">
                    <div class="model-header">
                        <div class="model-title"><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></div>
                        <span class="model-price">~<?= number_format($car['price'], 0, '', ' ') ?> $</span>
                    </div>
                    <div class="model-specs">
                        <div class="spec-item">
                            <i class="fas fa-gas-pump"></i> 
                            <span><?= htmlspecialchars(ucfirst($car['fuel_type'])) ?></span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-cog"></i> 
                            <span><?= htmlspecialchars(ucfirst($car['transmission'])) ?></span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-user"></i> 
                            <span><?= $car['seats'] ?> мест</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-tachometer-alt"></i> 
                            <span><?= $car['horse_power'] ?> л.с.</span>
                        </div>
                    </div>
                    <div class="model-actions">
                        <a href="/test-drive.php?car_id=<?= $car['id'] ?>" class="btn-primary">Тест-драйв</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include "blocks/footer.php"?>


<script src="/scripts/script_models_stock.js"></script>
</body>
</html>