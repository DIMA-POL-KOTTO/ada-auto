<?php 
require_once 'lib/db_connect.php';
require_once 'lib/_helpers.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {
        //1.получаем данные
        $brand = trim($_POST['brand']);
        $model = trim($_POST['model']);
        $year = (int)$_POST['year'];
        $engine_capacity = !empty($_POST['engine_capacity']) ? (float)$_POST['engine_capacity'] : null;
        $horse_power = !empty($_POST['horse_power']) ? (int)$_POST['horse_power'] : null;
        $fuel_type = $_POST['fuel_type'];
        $transmission = $_POST['transmission'];
        $body_type = $_POST['body_type'];
        $seats = (int)$_POST['seats'];
        $price = (float)$_POST['price'];
        $color = trim($_POST['color']);
        $vin = trim($_POST['vin']);
    
        //валидация
        if (!$brand || !$model || !$year || !$price) {
            throw new Exception("Обязательные поля не заполнены");
        }

        //2.определение папки модели
        $folder_name = getModelFolder($brand, $model);
        $folder_path = "images/models/".$folder_name;

        //3.создание папки, если не существует
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0755, true);
        }

        //4.получаем или создаём запись в car_models
        $stmt = $pdo->prepare("SELECT id FROM car_models WHERE brand = ? AND model = ?");
        $stmt->execute([$brand, $model]);
        $model_row = $stmt->fetch();

        if ($model_row) {
            $model_id = $model_row['id'];
        } else {
            $stmt = $pdo->prepare("INSERT INTO car_models (brand, model) VALUES (?, ?)");
            $stmt->execute([$brand, $model]);
            $model_id = $pdo->lastInsertId();
        }

        // 5. Вставляем авто в cars_in_stock
        $stmt = $pdo->prepare("
            INSERT INTO cars_in_stock 
            (model_id, year, engine_capacity, horse_power, fuel_type, transmission, body_type, seats, price, color, vin)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $model_id, $year, $engine_capacity, $horse_power, $fuel_type, $transmission, 
            $body_type, $seats, $price, $color, $vin
        ]);
        $car_id = $pdo->lastInsertId();

        // 6. Обрабатываем загрузку фото
        if (!empty($_FILES['car_image']['tmp_name'])) {
            $ext = strtolower(pathinfo($_FILES['car_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'jfif', 'webp'])) {
                $photo_path = $folder_path . '/' . $car_id . '.' . $ext;
                move_uploaded_file($_FILES['car_image']['tmp_name'], $photo_path);
            }
        }

        // 7. Если нет 0.jpg — создаём заглушку или копируем первое фото
        $default_image = $folder_path . '/0.jpg';
        if (!file_exists($default_image) && !empty($_FILES['car_image']['tmp_name']) && in_array($ext, ['jpg', 'jpeg'])) {
            copy($folder_path . '/' . $car_id . '.' . $ext, $default_image);
        }

        $message = "Авто успешно добавлено! ID: $car_id";
    }
    catch (Exception $e){
        $message = "Ошибка: ".$e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Админка — Добавить авто</title>
</head>
<body>
    <h2>Добавить автомобиль в наличие</h2>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Марка:</td>
                <td><input type="text" name="brand" required></td>
            </tr>
            <tr>
                <td>Модель:</td>
                <td><input type="text" name="model" required></td>
            </tr>
            <tr>
                <td>Год:</td>
                <td><input type="number" name="year" min="1900" max="2030" required></td>
            </tr>
            <tr>
                <td>Двигатель (л):</td>
                <td><input type="number" step="0.1" name="engine_capacity"></td>
            </tr>
            <tr>
                <td>Мощность (л.с.):</td>
                <td><input type="number" name="horse_power"></td>
            </tr>
            <tr>
                <td>Топливо:</td>
                <td>
                    <select name="fuel_type" required>
                        <option value="бензин">Бензин</option>
                        <option value="дизель">Дизель</option>
                        <option value="гибрид">Гибрид</option>
                        <option value="электро">Электро</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>КПП:</td>
                <td>
                    <select name="transmission" required>
                        <option value="автомат">Автомат</option>
                        <option value="механика">Механика</option>
                        <option value="вариатор">Вариатор</option>
                        <option value="робот">Робот</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Кузов:</td>
                <td>
                    <select name="body_type" required>
                        <option value="седан">Седан</option>
                        <option value="хэтчбек">Хэтчбек</option>
                        <option value="универсал">Универсал</option>
                        <option value="минивэн">Минивэн</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Мест:</td>
                <td><input type="number" name="seats" min="2" max="9" value="5" required></td>
            </tr>
            <tr>
                <td>Цена ($):</td>
                <td><input type="number" step="100" name="price" required></td>
            </tr>
            <tr>
                <td>Цвет:</td>
                <td><input type="text" name="color"></td>
            </tr>
            <tr>
                <td>VIN:</td>
                <td><input type="text" name="vin" maxlength="17"></td>
            </tr>
            <tr>
                <td>Фото авто:</td>
                <td><input type="file" name="car_image" accept="image/*"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Добавить автомобиль</button>
                </td>
            </tr>
        </table>
    </form>

    <hr>
    <h3>Как это работает:</h3>
    <ul>
        <li>Папка модели создаётся как: <code>images/models/brand_model/</code></li>
        <li>Фото модели — <code>0.jpg</code> (автоматически копируется из первого авто, если jpg)</li>
        <li>Фото экземпляра — <code>{id}.расширение</code></li>
    </ul>
</body>
</html>