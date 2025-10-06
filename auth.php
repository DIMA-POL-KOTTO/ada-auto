<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--???-->
    <title>Вход</title>
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
            <h1>ВХОД</h1>
            <p>Войдите в аккаунт для доступа ко всем услугам ADA Auto</p>
        </div>
        
        <form method="POST" class="registration-form" action="/lib/auth.php" >  
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Логин *</label>
                    <input type="text" name="login" class="form-control" required>
                </div>
                
            </div>
            
            <div class="form-group">
                <label for="password">Пароль *</label>
                <div class="input-with-icon">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-user"></i>
                ВОЙТИ
            </button>
            
            <div class="login-link">
                Нет аккаунта? <a href="registration.php">Зарегистрируйтесь здесь</a>
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

    </script>
    <?php include 'blocks/footer.php';?>
</body>
