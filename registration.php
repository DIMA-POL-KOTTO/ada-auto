<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--???-->
    <title>Регистрация</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style_reg.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration-container">
        <div class="registration-header">
            <h1>РЕГИСТРАЦИЯ</h1>
            <p>Создайте аккаунт для доступа ко всем услугам ADA Auto</p>
        </div>
        
        <form method="POST" class="registration-form" action="/lib/registration.php" >  
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Логин *</label>
                    <input type="text" name="login" class="form-control" required>
                </div>
                
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <div class="input-with-icon">
                    <input type="email" id="email" name="email" class="form-control" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="phone">Телефон *</label>
                <div class="input-with-icon">
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="+375 (XX) XXX-XX-XX" required>
                    <i class="fas fa-phone input-icon"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль *</label>
                <div class="input-with-icon">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirmPassword">Подтвердите пароль *</label>
                <div class="input-with-icon">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>
            
            
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-user-plus"></i>
                ЗАРЕГИСТРИРОВАТЬСЯ
            </button>
            
            <div class="login-link">
                Уже есть аккаунт? <a href="auth.php">Войдите здесь</a>
            </div>
        </form>
    </div>

    <script>
        // Валидация пароля
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Пароли не совпадают!');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Пароль должен содержать минимум 6 символов!');
                return false;
            }
        });

        // Маска для телефона
        document.getElementById('phone').addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,2})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = '+375 (' + (x[2] ? x[2] : '') + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });
    </script>
    <?php include 'blocks/footer.php';?>
</body>
