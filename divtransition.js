
    document.addEventListener("DOMContentLoaded", () => {
        const divs = document.querySelectorAll('div');

        const observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: 0.1
        };

        const revealOnScroll = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target); 
                }
            });
        };

        const observer = new IntersectionObserver(revealOnScroll, observerOptions);

        divs.forEach(div => {
            div.style.opacity = '0';
            div.style.transform = 'translateY(40px)';
            div.style.transition = 'opacity 0.7s ease-out, transform 0.7s ease-out';
            observer.observe(div);
        });
    });

