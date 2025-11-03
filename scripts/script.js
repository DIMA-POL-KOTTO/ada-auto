document.addEventListener('DOMContentLoaded', function() {
    // Слайдер 
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    const slideInterval = 5000;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
        currentSlide = index;
    }

    function nextSlide() {
        let next = currentSlide + 1;
        if (next >= slides.length) next = 0;
        showSlide(next);
    }

    let slideTimer = setInterval(nextSlide, slideInterval);

    slides.forEach(slide => {
        slide.addEventListener('click', nextSlide);
    });

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            clearInterval(slideTimer);
            showSlide(index);
            slideTimer = setInterval(nextSlide, slideInterval);
        });
    });

    const carousel = document.querySelector('.carousel');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const cards = document.querySelectorAll('.model-card');
    const totalCards = cards.length;
    
    let currentPosition = 0;
    const cardsPerSet = 3; // Показываем по 3 карточки за раз
    let cardsPerView = 3;

    function updateCardsPerView() {
        const width = window.innerWidth;
        if (width < 768) {
            cardsPerView = 1;
        } else if (width < 992) {
            cardsPerView = 2;
        } else {
            cardsPerView = 3;
        }
    }

    // Функция для расчета ширины карточки с учетом gap
    function getCardWidth() {
        if (cards.length === 0) return 0;
        
        const cardStyle = window.getComputedStyle(cards[0]);
        const cardWidth = cards[0].offsetWidth;
        const gap = parseInt(window.getComputedStyle(carousel).gap) || 30;
        
        return cardWidth + gap;
    }

    // Функция для обновления позиции карусели
    function updateCarousel() {
        const cardWidth = getCardWidth();
        const translateX = -currentPosition * cardWidth * cardsPerSet;
        carousel.style.transform = `translateX(${translateX}px)`;
    }

    // Функция для перехода к следующему набору из 3 карточек
    function nextSet() {
        currentPosition++;
        
        // Если дошли до конца (всего 6 карточек, показываем по 3), переходим к началу
        if (currentPosition * cardsPerSet >= totalCards) {
            currentPosition = 0;
        }
        
        updateCarousel();
    }

    // Функция для перехода к предыдущему набору из 3 карточек
    function prevSet() {
        currentPosition--;
        
        if (currentPosition < 0) {
            currentPosition = Math.floor((totalCards - 1) / cardsPerSet);
        }
        
        updateCarousel();
    }

    // Инициализация карусели
    function initCarousel() {
        updateCardsPerView();
        updateCarousel();
    }
    
    prevBtn.addEventListener('click', prevSet);
    nextBtn.addEventListener('click', nextSet);

    initCarousel();

    window.addEventListener('resize', function() {
        const oldCardsPerView = cardsPerView;
        updateCardsPerView();
        
        if (oldCardsPerView !== cardsPerView) {
            currentPosition = 0;
            updateCarousel();
        }
    });

    const ctaForm = document.querySelector('.cta-form');
    if (ctaForm) {
        ctaForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.');
            this.reset();
        });
    }
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
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