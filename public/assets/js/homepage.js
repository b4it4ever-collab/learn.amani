document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const counters = document.querySelectorAll('.counter');
    const themeToggle = document.querySelector('[data-theme-toggle]');

    if (navbar) {
        const setNavbarState = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 24);
        };

        setNavbarState();
        window.addEventListener('scroll', setNavbarState, { passive: true });
    }

    if (themeToggle) {
        const icon = themeToggle.querySelector('i');
        const applyTheme = (dark) => {
            document.body.classList.toggle('dark', dark);
            if (icon) {
                icon.className = dark ? 'bi bi-sun-fill' : 'bi bi-moon-stars';
            }
            localStorage.setItem('learn-amani-theme', dark ? 'dark' : 'light');
        };

        const savedTheme = localStorage.getItem('learn-amani-theme');
        applyTheme(savedTheme === 'dark');

        themeToggle.addEventListener('click', () => {
            applyTheme(!document.body.classList.contains('dark'));
        });
    }

    counters.forEach((counter) => {
        const target = Number(counter.dataset.target || 0);
        const duration = 1200;
        const startTime = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);
            const value = Math.floor(progress * target);
            counter.textContent = value.toLocaleString();
            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    requestAnimationFrame(tick);
                    observer.disconnect();
                }
            });
        }, { threshold: 0.6 });

        observer.observe(counter);
    });
});
