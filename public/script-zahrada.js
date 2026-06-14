document.addEventListener('DOMContentLoaded', function() {
    // ===================================================
    // 1. Navigácia: Hamburger menu
    // ===================================================
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    navLinks.classList.remove('active');
                }
            });
        });
    }

    // ===================================================
    // 2. Formulár: Validácia a Redirect
    // ===================================================
    const form = document.getElementById('contact-form');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let isValid = true;
            document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const privacy = document.getElementById('privacy');

            const displayError = (id, message) => {
                document.getElementById(id + '-error').textContent = message;
                document.getElementById(id + '-error').style.display = 'block';
                isValid = false;
            };

            if (name && name.value.trim() === '') {
                displayError('name', 'Meno je povinné.');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email.value)) {
                displayError('email', 'Prosím, zadajte platnú emailovú adresu.');
            }

            if (privacy && !privacy.checked) {
                displayError('privacy', 'Musíte súhlasiť so spracovaním osobných údajov.');
            }

            if (isValid) {
                showAlert('Požiadavka bola úspešne odoslaná! Prebieha presmerovanie...');

                setTimeout(() => {
                    this.submit();
                }, 1500);
            }
        });
    }


    // ===================================================
    // 3. Slideshow (Carousel)
    // ===================================================
    const slides = document.getElementsByClassName("slide");
    if (slides.length > 0) {
        let slideIndex = 1;
        showSlides(slideIndex);

        window.plusSlides = function(n) {
            showSlides(slideIndex += n);
        }

        window.currentSlide = function(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active-dot", "");
            }
            if (slides[slideIndex-1]) {
                 slides[slideIndex-1].style.display = "block";
            }
            if (dots[slideIndex-1]) {
                dots[slideIndex-1].className += " active-dot";
            }
        }
        setInterval(() => plusSlides(1), 5000);
    }

    // ===================================================
    // 4. Akordeón
    // ===================================================
    const accHeaders = document.querySelectorAll('.accordion-header');

    if (accHeaders.length > 0) {
        accHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const content = this.nextElementSibling;

                document.querySelectorAll('.accordion-content').forEach(c => {
                     if (c !== content && c.style.maxHeight) {
                         c.style.maxHeight = null;
                     }
                });

                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    }

    // ===================================================
    // 5. Alert
    // ===================================================
    window.showAlert = function(message) {
        const alert = document.getElementById('custom-alert');
        if (alert) {
            alert.textContent = message;
            alert.classList.add('show');

            setTimeout(() => {
                alert.classList.remove('show');
            }, 3000);
        }
    }

    const closeAlert = document.querySelector('#custom-alert .closebtn');
    if (closeAlert) {
        closeAlert.onclick = function() {
            this.parentElement.classList.remove('show');
        }
    }


    // ===================================================
    // 6. Popup/Modal
    // ===================================================
    const popup = document.getElementById('welcome-popup');
    const closePopup = document.querySelector('.close-popup');

    if (popup) {
        if (!sessionStorage.getItem('popupShown-zahrada')) {
            setTimeout(() => {
                popup.style.display = 'block';
            }, 1000);
        }

        closePopup.onclick = function() {
            popup.style.display = 'none';
            sessionStorage.setItem('popupShown-zahrada', 'true');
        }

        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = 'none';
                sessionStorage.setItem('popupShown-zahrada', 'true');
            }
        }
    }
});