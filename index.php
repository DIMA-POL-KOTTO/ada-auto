<!DOCTYPE html>
<html lang="ru">
<?php include 'blocks/head.php';?>
<body>
    <?php include 'blocks/header.php'; ?>
    <section class="hero">
        <div class="hero-image">
            <img src="images/peugeot 508.jpg" alt="PEUGEOT 508">
            <div class="car-model">
                    PEUGEOT 508
                </div>
            <div class="hero-content">
                
                <div class="hero-text">
                    Лифтбэк бизнес-класса с выразительным дизайном,<br>
                    технологичным салоном на основе <a style="font-family: 'Orbitron';">Peugeot i-Cockpit</a><br>
                    и широким набором систем безопасности и комфорта.
                </div>
                <div class="line"></div>
                <button class="details-btn">ПОДРОБНЕЕ</button>
            </div>
        </div>
    </section>
    <section class="purchase-help">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ПОМОЩЬ В ПОКУПКЕ</h2>
                <div class="section-line"></div>
                <p class="section-subtitle">для покупки нового автомобиля воспользуйтесь помощью наших финансовых программ</p>
            </div>
            
            <div class="help-items">
                <div class="help-item">
                    <div class="help-icon">
                        <!-- Замените на свою иконку -->
                        <i class="fas fa-landmark" style="font-size: 78px;"></i>
                    </div>
                    <p class="help-text">Кредит</p>
                </div>
                
                <div class="vertical-line"></div>
                
                <div class="help-item">
                    <div class="help-icon">
                        <!-- Замените на свою иконку -->
                        <i class="fas fa-car" style="font-size: 78px;"></i>
                    </div>
                    <p class="help-text">Лизинг</p>
                </div>
                
                <div class="vertical-line"></div>
                
                <div class="help-item">
                    <div class="help-icon">
                        <!-- Замените на свою иконку -->
                        <i class="fas fa-exchange-alt" style="font-size: 78px;"></i>
                    </div>
                    <p class="help-text">Трейд-ин</p>
                </div>
            </div>
        </div>
    </section>
    <section class="model-range">
        <div class="section-header">
            <h2 class="section-title">ЛУЧШИЕ ПРЕДЛОЖЕНИЯ</h2>
            <div class="section-line"></div>
        </div>
        
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <div class="carousel-track" id="carouselTrack">
                    <?php
                    include 'config.php';
                    
                    try {
                        $stmt = $pdo->query("SELECT * FROM cars WHERE image_path != '' ORDER BY created_at DESC");
                        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (count($cars) > 0) {
                            foreach ($cars as $car) {
                                echo '
                                <div class="car-item">
                                    <div class="car-image">
                                        <img src="' . htmlspecialchars($car['image_path']) . '" alt="' . htmlspecialchars($car['name']) . '">
                                    </div>
                                    <h3 class="car-name">' . htmlspecialchars($car['name']) . '</h3>
                                    <button class="details-btn-car">
                                        Подробнее
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>';
                            }
                        } else {
                            // Запасной вариант - статические данные
                            echo '
                            <div class="car-item">
                                <div class="car-image">
                                    <img src="images/renault_megane_4.png" alt="Renault Megane 4">
                                </div>
                                <h3 class="car-name">Renault Megane 4</h3>
                                <button class="details-btn-car">
                                    Подробнее
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>';
                        }
                    } catch (Exception $e) {
                        // В случае ошибки показываем статические данные
                        echo '<p>Загрузка данных...</p>';
                    }
                    ?>
                </div>
            </div>
            
            <!-- Кнопки навигации -->
            <button class="carousel-btn prev-btn" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-btn next-btn" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>
    <?php include "blocks/footer.php";?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('carouselTrack');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const carItems = document.querySelectorAll('.car-item');
            
            let currentPosition = 0;
            const itemWidth = carItems[0].offsetWidth + 30; // width + gap
            
            function updateButtons() {
                prevBtn.style.opacity = currentPosition === 0 ? '0.5' : '1';
                prevBtn.style.cursor = currentPosition === 0 ? 'not-allowed' : 'pointer';
            }
            
            nextBtn.addEventListener('click', function() {
                const maxPosition = -(carItems.length - 3) * itemWidth;
                
                if (currentPosition > maxPosition) {
                    currentPosition -= itemWidth;
                    track.style.transform = `translateX(${currentPosition}px)`;
                    updateButtons();
                }
            });
            
            prevBtn.addEventListener('click', function() {
                if (currentPosition < 0) {
                    currentPosition += itemWidth;
                    track.style.transform = `translateX(${currentPosition}px)`;
                    updateButtons();
                }
            });
            
            // Инициализация кнопок
            updateButtons();
        });
    </script>
</body>

</html>