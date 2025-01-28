const searchInput = document.querySelector(".search-bar > input");
const filterBtn = document.querySelector('.filter-btn');
const filters = document.querySelector('.filters');
const statusFilter = document.querySelector('#status-filter');
const genreFilter = document.querySelector('#genre-filter');

const handleSearchInput = debounce((e) => {
    const inputValue = e.target.value.toLowerCase().trim();
    updateTransition(() => {
        filteredElements.forEach((element) => {
            const name = element.dataset.name.toLowerCase().trim();
            if (name.includes(inputValue)) {
                element.style.display = displayType;
            } else {
                element.style.display = "none";
            }
        });
    });

}, 250);

searchInput.addEventListener('input', handleSearchInput)



//Filters
filterBtn.addEventListener('click', function() {
    filters.classList.toggle('active');
});

// statusFilter.addEventListener('change', () => {

//     const selectedStatus = statusFilter.value;
//     updateTransition(() => {
//         filteredElements.forEach((row) => {
//             const status = row.dataset.status;
//             if (selectedStatus === "all" || status === selectedStatus) {
//                 row.style.display = "table-row";
//             } else {
//                 row.style.display = "none";
//             }
//         });
//     })
// });


document.addEventListener('click', (e)  => {

    if (!filters.contains(e.target) && filters.classList.contains('active')) {
        filters.classList.remove('active');
    }

});

