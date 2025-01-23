const openPopoverIcon = document.querySelectorAll(".open-popover");

openPopoverIcon.forEach((icon) => {
    icon.addEventListener("click", () => {
        const userId = icon.closest('tr').dataset.internId;
        console.log(userId);
    });
});