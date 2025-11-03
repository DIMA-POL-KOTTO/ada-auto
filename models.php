<?php

require_once "/OpenServer/OSPanel/home/ada-auto.local/public/lib/models.php";

?>

<!DOCTYPE html>
<html lang="ru">
<?php include 'blocks/head.php';?>
<style>
        
        h1 { text-align: center; }
        .car-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .car-card { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .car-card h3 { margin: 0 0 10px; }
        .car-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 4px; }
    </style>
<body>
    <?php include 'blocks/header.php'; ?>
    <?php if (!empty($models)): ?>
        <div class="car-list">
            <?php foreach ($models as $car): ?>
                <div class="car-card">
                    <?php if (!empty($car['image'])): ?>
                        <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?></h3>
                    <p><strong>Год:</strong> <?= $car['year'] ?></p>
                    <p><strong>Двигатель:</strong> <?= $car['engine_capacity'] ?> л, <?= $car['horse_power'] ?> л.с.</p>
                    <p><strong>Цена:</strong> <?= number_format($car['price'], 0, '', ' ') ?> ₽</p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center; color: #888;">Нет автомобилей в наличии.</p>
    <?php endif; ?>
</body>

</html>