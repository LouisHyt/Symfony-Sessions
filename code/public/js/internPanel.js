const openActionsMenu = document.querySelectorAll(".open-actions");

openActionsMenu.forEach((button) => {
    button.addEventListener("click", () => {
        const userId = icon.closest('tr').dataset.internId;
        console.log(userId);
    });
});