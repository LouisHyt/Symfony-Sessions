const navButtons = document.querySelectorAll('.nav-button');

for(const navButton of navButtons) {
    navButton.addEventListener('click', () => {
        const dataTarget = navButton.getAttribute('data-target');
        const activeSection = document.querySelector(`[data-trigger='${dataTarget}']`);
        const previousActiveSection = document.querySelector(`.visible[data-trigger]`);
        previousActiveSection.classList.remove('visible');
        activeSection.classList.add('visible');
        document.querySelector('.nav-button.active')?.classList.remove('active');
        navButton.classList.add('active');
    });
}