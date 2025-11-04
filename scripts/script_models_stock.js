document.addEventListener('DOMContentLoaded', function () {
    const modelItems = document.querySelectorAll('.model-item');
    const searchInput = document.getElementById('search');
    const brandSelect = document.getElementById('brand');
    const modelSelect = document.getElementById('model');
    const fuelSelect = document.getElementById('fuel');
    const transmissionSelect = document.getElementById('transmission');
    const bodyTypeSelect = document.getElementById('body-type');
    const priceSelect = document.getElementById('price');
    const resetBtn = document.getElementById('reset-filters');

    // Группировка моделей по маркам — читаем из DOM
    const modelsByBrand = {};
    modelItems.forEach(item => {
        const brand = item.dataset.brand;
        const model = item.dataset.model;
        if (!modelsByBrand[brand]) {
            modelsByBrand[brand] = new Set();
        }
        modelsByBrand[brand].add(model);
    });

    function updateModelOptions() {
        const selectedBrand = brandSelect.value;
        modelSelect.innerHTML = '<option value="all">Все модели</option>';
        if (selectedBrand !== "all" && modelsByBrand[selectedBrand]) {
            modelsByBrand[selectedBrand].forEach(modelName => {
                const opt = document.createElement('option');
                opt.value = modelName;
                // Красивое название: rav4 → Rav4, bmw x3 → Bmw X3
                opt.textContent = modelName
                    .split(' ')
                    .map(w => w.charAt(0).toUpperCase() + w.slice(1))
                    .join(' ');
                modelSelect.appendChild(opt);
            });
        }
        filterModels();
    }

    function filterModels() {
        const query = searchInput.value.toLowerCase().trim();
        const brand = brandSelect.value;
        const model = modelSelect.value;
        const fuel = fuelSelect.value;
        const transmission = transmissionSelect.value;
        const body = bodyTypeSelect.value;
        const maxPrice = priceSelect.value === 'all' ? Infinity : parseInt(priceSelect.value);

        modelItems.forEach(item => {
            const carBrand = item.dataset.brand;
            const carModel = item.dataset.model;
            const carFuel = item.dataset.fuel;
            const carTransmission = item.dataset.transmission;
            const carBody = item.dataset.body; 
            const carPrice = parseFloat(item.dataset.price) || 0;

            const matchesSearch = !query || 
                carModel.includes(query) || 
                carBrand.includes(query);
            const matchesBrand = brand === 'all' || carBrand === brand;
            const matchesModel = model === 'all' || carModel === model;
            const matchesFuel = fuel === 'all' || carFuel === fuel;
            const matchesTrans = transmission === 'all' || carTransmission === transmission;
            const matchesBody = body === 'all' || carBody === body;
            const matchesPrice = carPrice <= maxPrice;

            const show = matchesSearch && matchesBrand && matchesModel && 
                         matchesFuel && matchesTrans && matchesPrice && matchesBody;
            item.style.display = show ? 'block' : 'none';
        });
    }

    // Слушатели
    searchInput.addEventListener('input', filterModels);
    brandSelect.addEventListener('change', updateModelOptions);
    modelSelect.addEventListener('change', filterModels);
    fuelSelect.addEventListener('change', filterModels);
    transmissionSelect.addEventListener('change', filterModels);
    bodyTypeSelect.addEventListener('change', filterModels); 
    priceSelect.addEventListener('change', filterModels);

    resetBtn.addEventListener('click', function() {
        searchInput.value = '';
        brandSelect.value = 'all';
        modelSelect.innerHTML = '<option value="all">Все модели</option>';
        fuelSelect.value = 'all';
        transmissionSelect.value = 'all';
        bodyTypeSelect.value = 'all'; 
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