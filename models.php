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
        </div>
    </div>
</section>

<section class="models-grid">
    <div class="container">
        <?php 
        $current_brand = null;
        foreach ($models as $car): 
            if ($current_brand !== $car['brand']):
                if ($current_brand !== null):
                    echo '</div>';
                endif;
                $current_brand = $car['brand'];
                $brand_anchor = strtolower($car['brand']);
                ?>
                
                <?php
                $brand_name = $car['brand'];
                $brand_slug = strtolower($brand_name);
                $logo_path = "assets/brand-logos/{$brand_slug}.svg";

                // Проверяем, существует ли SVG-логотип; если нет — пробуем PNG
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $logo_path)) {
                    $logo_path = "images/logos/{$brand_slug}.svg";
                    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $logo_path)) {
                        $logo_path = null; // логотип не найден
                    }
                }
                ?>

                <div class="brand-section-header">
                    <?php if ($logo_path): ?>
                        <div class="brand-logo-wrapper">
                            <img src="<?= htmlspecialchars($logo_path) ?>" 
                                alt="<?= htmlspecialchars($brand_name) ?>" 
                                class="brand-logo"
                                loading="lazy">
                        </div>
                    <?php endif; ?>
                    <h2 id="<?= $brand_anchor ?>" class="brand-section-title">
                        <?= htmlspecialchars($brand_name) ?>
                    </h2>
                </div>
                <div class="brand-models-grid">
            <?php endif;?>
            
            <?php
            $folder = getModelFolder($car['brand'], $car['model']);
            $imgPath = findModelImage($folder);
            ?>
            
            <div class="model-item"
                data-brand="<?= htmlspecialchars(strtolower($car['brand'])) ?>"
                data-model="<?= htmlspecialchars(strtolower($car['model'])) ?>">
                <a href="/model_details.php?brand=<?= urlencode($car['brand']) ?>&model=<?= urlencode($car['model']) ?>" class="model-link">
                    <div class="model-image">
                        <?php if ($imgPath): ?>
                            <img src="<?= htmlspecialchars($imgPath) ?>" 
                                 alt="<?= htmlspecialchars($car['brand'].' '.$car['model'])?>">
                        <?php else: ?>
                            <div class="model-image-placeholder <?= strtolower($car['brand']) ?>">
                                <?= htmlspecialchars($car['brand']) ?><br><?= htmlspecialchars($car['model']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="model-details">
                        <div class="model-header">
                            <div class="model-title"><?= htmlspecialchars($car['model']) ?></div>
                        </div>
                        <div class="model-actions">
                            <button type="button" class="btn-primary btn-details">Подробнее</button>
                        </div>
                    </div>
                </a>
            </div>
        
        <?php endforeach;?>
        <?php if ($current_brand !== null): echo '</div>'; endif; ?>
    </div>
</section>

<?php include "blocks/footer.php";?>

<script src="scripts/script_models.js"></script>
</body>
</html>