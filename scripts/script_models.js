document.addEventListener('DOMContentLoaded', function () {
    const modelItems = document.querySelectorAll('.model-item');
    const searchInput = document.getElementById('search');
    const brandSelect = document.getElementById('brand');
    

    // Группировка по брендам (для селекта моделей — опционально)
    const modelsByBrand = {};
    modelItems.forEach(item => {
        const brand = item.dataset.brand;
        const model = item.dataset.model;
        if (!modelsByBrand[brand]) modelsByBrand[brand] = new Set();
        modelsByBrand[brand].add(model);
    });

    // 🔥 Прокрутка к бренду при выборе
    brandSelect.addEventListener('change', function() {
        const brand = this.value;
        if (brand && brand !== 'all') {
            // Генерируем якорь: "bmw" → "#bmw"
            const anchor = '#' + brand;
            const element = document.querySelector(anchor);
            if (element) {
                // Плавная прокрутка
                element.scrollIntoView({ behavior: 'smooth', block: 'start'});
            }
        } else {
            // Если "Все марки" — прокручиваем наверх
            window.scrollTo({ top: 0, behavior: 'smooth' });
            filterModels();
        }
    });

    searchInput.addEventListener('input', filterModels);


    // Мобильное меню (без изменений)
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const nav = document.querySelector('.nav');
    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', function() {
            const isVisible = nav.style.display === 'flex';
            nav.style.display = isVisible ? 'none' : 'flex';
            if (!isVisible) {
                nav.style.flexDirection = 'column';
                nav.style.position = 'absolute';
                nav.style.top = '100%';
                nav.style.left = '0';
                nav.style.right = '0';
                nav.style.background = 'white';
                nav.style.padding = '20px';
                nav.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
            }
        });
    }
});