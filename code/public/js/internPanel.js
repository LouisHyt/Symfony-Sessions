const openActionsMenu = document.querySelectorAll(".open-actions");

openActionsMenu.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.stopPropagation();
        const userId = button.closest('tr').dataset.internId;
        const popover = button.closest('.actions').querySelector(".popover");
        popover.classList.toggle("visible");
        document.addEventListener('click', handleCloseClick);
    });
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