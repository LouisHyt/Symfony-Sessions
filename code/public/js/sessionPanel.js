const filteredElements = document.querySelectorAll(".session-card");
const displayType = "flex";



// Gestion des menus contextuels
const dropdowns = document.querySelectorAll('.dropdown-toggle');
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = this.nextElementSibling;
        const openDropdown = document.querySelector('.dropdown-menu.show');
        if (openDropdown && openDropdown !== menu) {
            openDropdown.classList.remove('show');
        }
        menu.classList.toggle('show');
    });
});

// Fermer le menu si on clique en dehors
document.addEventListener('click', function(e) {
    const openDropdown = document.querySelector('.dropdown-menu.show');
    if (openDropdown && !openDropdown.parentNode.contains(e.target)) {
        openDropdown.classList.remove('show');
    }
});

