document.addEventListener('DOMContentLoaded', function () {
    // Данные моделей
    const modelItems = document.querySelectorAll('.model-item');
    const searchInput = document.getElementById('search');
    const brandSelect = document.getElementById('brand');
    const modelSelect = document.getElementById('model');
    const fuelSelect = document.getElementById('fuel');
    const transmissionSelect = document.getElementById('transmission');
    const priceSelect = document.getElementById('price');
    const resetBtn = document.getElementById('reset-filters');

    // Группировка моделей по маркам
    const modelsByBrand = {};
    models.forEach(m => {
        if (!modelsByBrand[m.brand]) modelsByBrand[m.brand] = new Set();
        modelsByBrand[m.brand].add(m.model);
    });

    // Обновление моделей при выборе марки
    function updateModelOptions() {
        const selectedBrand = brandSelect.value;
        modelSelect.innerHTML = '<option value="all">Все модели</option>';
        if (selectedBrand !== "all" && modelsByBrand[selectedBrand]) {
            modelsByBrand[selectedBrand].forEach(modelName => {
                const opt = document.createElement('option');
                opt.value = modelName;
                opt.textContent = modelName.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
                modelSelect.appendChild(opt);
            });
        }
        filterModels(); // Автофильтрация после обновления
    }

    // Фильтрация
    function filterModels() {
        const query = searchInput.value.toLowerCase().trim();
        const brand = brandSelect.value;
        const model = modelSelect.value;
        const fuel = fuelSelect.value;
        const transmission = transmissionSelect.value;
        const maxPrice = priceSelect.value === 'all' ? Infinity : parseInt(priceSelect.value);

        modelItems.forEach((item, index) => {
            const m = models[index];
            const carBrand = m.brand.toLowerCase();
            const carModel = m.brand.toLowerCase();

            const matchesSearch = !query || carModel.includes(query) || carBrand.includes(query);
            const matchesBrand = brand === 'all' || m.brand === brand;
            const matchesModel = model === 'all' || m.model === model;
            const matchesFuel = fuel === 'all' || m.fuel_type === fuel;
            const matchesTrans = transmission === 'all' || m.transmission === transmission;
            const matchesPrice = (parseInt(m.price) || 0) <= maxPrice;

            const show = matchesSearch && matchesBrand && matchesModel && matchesFuel && matchesTrans && matchesPrice;
            item.style.display = show ? 'block' : 'none';
        });
    }

    // Добавление слушателей
    searchInput.addEventListener('input', filterModels);
    brandSelect.addEventListener('change', updateModelOptions);
    modelSelect.addEventListener('change', filterModels);
    fuelSelect.addEventListener('change', filterModels);
    transmissionSelect.addEventListener('change', filterModels);
    priceSelect.addEventListener('change', filterModels);

    // Сброс фильтров
    resetBtn.addEventListener('click', function() {
        searchInput.value = '';
        brandSelect.value = 'all';
        modelSelect.innerHTML = '<option value="all">Все модели</option>';
        fuelSelect.value = 'all';
        transmissionSelect.value = 'all';
        priceSelect.value = 'all';
        filterModels();
    });

    // Мобильное меню
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