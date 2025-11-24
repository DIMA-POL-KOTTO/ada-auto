<?php 
require_once "lib/models.php";
require_once "lib/_helpers.php"?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - ADA Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/style_base.css">
    <link rel="stylesheet" href="styles/style_layout.css">
    <link rel="stylesheet" href="styles/style_about.css">
</head>
<body>
<?php
include "blocks/header.php";
?>

<!-- Герой секция -->
<section class="about-hero">
    <div class="about-container">
        <h1>О компании ADA Auto</h1>
        <p>Более 10 лет мы предоставляем лучшие автомобили и сервис для наших клиентов</p>
    </div>
</section>

<!-- Основной контент -->
<main class="about-content">
    <div class="about-container">
        
        <!-- О компании -->
        <section class="about-section">
            <h2>Наша история</h2>
            <p>ADA Auto была основана в 2013 году с целью предоставления качественных автомобилей и премиального сервиса. За годы работы мы выросли из небольшого автосалона в крупный автомобильный центр с полным циклом услуг.</p>
            <p>Наша миссия — делать владение автомобилем простым и приятным для каждого клиента.</p>
            
            <div class="history-timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2013</div>
                    <div class="timeline-content">
                        <h3>Основание компании</h3>
                        <p>Открытие первого автосалона ADA Auto в центре города</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2016</div>
                    <div class="timeline-content">
                        <h3>Расширение ассортимента</h3>
                        <p>Добавление новых брендов и увеличение складских запасов</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2019</div>
                    <div class="timeline-content">
                        <h3>Открытие сервисного центра</h3>
                        <p>Запуск полноценного сервисного центра с современным оборудованием</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Лидер рынка</h3>
                        <p>ADA Auto становится одним из лидеров автомобильного рынка в регионе</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Команда -->
        <section class="about-section">
            <h2>Наша команда</h2>
            <p>Профессионалы с многолетним опытом работы в автомобильной индустрии</p>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="images/team/aleks_petrov.jpg" alt="Александр Петров" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="member-photo-placeholder" style="display: none;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Александр Петров</h3>
                        <div class="member-position">Генеральный директор</div>
                        <p class="member-description">Основатель компании с 15-летним опытом в автомобильном бизнесе</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">
                        <img src="images/team/devushka.jpg" alt="Мария Иванова" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="member-photo-placeholder" style="display: none;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Мария Иванова</h3>
                        <div class="member-position">Менеджер по продажам</div>
                        <p class="member-description">Эксперт по подбору автомобилей с индивидуальным подходом к каждому клиенту</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">
                        <img src="images/team/dima_sidorov.jpg" alt="Дмитрий Сидоров" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="member-photo-placeholder" style="display: none;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Дмитрий Сидоров</h3>
                        <div class="member-position">Технический специалист</div>
                        <p class="member-description">Сертифицированный специалист по диагностике и обслуживанию автомобилей</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ценности -->
        <section class="about-section">
            <h2>Наши ценности</h2>
            <div class="values-grid">
                <div class="value-item">
                    <h3>Качество</h3>
                    <p>Мы тщательно отбираем каждый автомобиль и гарантируем его техническое состояние</p>
                </div>
                <div class="value-item">
                    <h3>Честность</h3>
                    <p>Прозрачные условия сделки и полная информация о автомобиле</p>
                </div>
                <div class="value-item">
                    <h3>Клиентоориентированность</h3>
                    <p>Индивидуальный подход к каждому клиенту и забота на всех этапах</p>
                </div>
                <div class="value-item">
                    <h3>Инновации</h3>
                    <p>Постоянное развитие и внедрение новых технологий в наш сервис</p>
                </div>
            </div>
        </section>

        <!-- Контакты -->
        <section class="about-section">
            <h2>Свяжитесь с нами</h2>
            <div class="contact-info">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Адрес</h3>
                    <p>г. Москва, ул. Автозаводская, д. 15</p>
                    <p>Ежедневно с 9:00 до 21:00</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Телефон</h3>
                    <p>+7 (495) 123-45-67</p>
                    <p>+7 (800) 123-45-68</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>info@ada-auto.ru</p>
                    <p>sales@ada-auto.ru</p>
                </div>
            </div>
        </section>

    </div>
</main>

<?php include "blocks/footer.php";?>

<script src="scripts/script_models.js"></script>
</body>
</html>