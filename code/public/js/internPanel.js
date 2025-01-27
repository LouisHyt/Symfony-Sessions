const openActionsMenu = document.querySelectorAll(".open-actions");
const internRows = document.querySelectorAll("tr[data-intern-id]");

openActionsMenu.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.stopPropagation();
        const popover = button.closest('.actions').querySelector(".popover");
        popover.classList.toggle("visible");
        document.addEventListener('click', handleCloseClick);
    });
});

internRows.forEach((row) => {
    row.addEventListener("click", (e) => {
        const userId = row.dataset.internId;
        window.location.href = `/interns/${userId}`
    });
});

//Filters

const filterBtn = document.querySelector('.filter-btn');
const filters = document.querySelector('.filters');

filterBtn.addEventListener('click', function() {
    filters.classList.toggle('active');
});

// Close filters when clicking outside
document.addEventListener('click', function(event) {
    if (!filters.contains(event.target) && filters.classList.contains('active')) {
        filters.classList.remove('active');
    }
});

function clearActivePopover() {
    document.removeEventListener("click", handleCloseClick)
    const activePopover = document.querySelector('.popover.visible');
    if(!activePopover) return
    activePopover.classList.remove("visible");
}

function handleCloseClick(e){
    if(!e.target.closest(".popover")){
        clearActivePopover();
    }
}


