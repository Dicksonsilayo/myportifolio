
document.addEventListener('DOMContentLoaded', function () {

    // MOBILE NAVIGATION
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    if (menuToggle && navLinks) {

        menuToggle.addEventListener('click', function () {

            const isOpen = navLinks.classList.toggle('show');

            menuToggle.innerHTML = isOpen
                ? '<i class="fas fa-times"></i>'
                : '<i class="fas fa-bars"></i>';

            menuToggle.setAttribute('aria-expanded', isOpen);

        });

        document.querySelectorAll('.nav-link').forEach(link => {

            link.addEventListener('click', function () {

                navLinks.classList.remove('show');

                menuToggle.innerHTML = '<i class="fas fa-bars"></i>';

                menuToggle.setAttribute('aria-expanded', 'false');

            });

        });
    }

    // NAVBAR SCROLL EFFECT
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function () {

        if (navbar) {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        }

    });

    // ACTIVE NAVIGATION LINK
    const sections = document.querySelectorAll('main section[id]');
    const links = document.querySelectorAll('.nav-link');

    const observer = new IntersectionObserver(entries => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {

                links.forEach(link => {

                    link.classList.toggle(
                        'active',
                        link.getAttribute('href') === '#' + entry.target.id
                    );

                });

            }

        });

    }, {
        rootMargin: '-30% 0px -60% 0px'
    });

    sections.forEach(section => observer.observe(section));

});
