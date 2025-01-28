const navButtons = document.querySelectorAll('.nav-button');

for(const navButton of navButtons) {
    navButton.addEventListener('click', () => {
        document.querySelector('.nav-button.active')?.classList.remove('active');
        navButton.classList.add('active');
    });
}