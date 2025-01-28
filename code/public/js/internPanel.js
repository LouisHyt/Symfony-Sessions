const internRows = document.querySelectorAll("tr[data-intern-id]");
const searchInput = document.querySelector(".search-bar > input");

//Filters Inport
const filterBtn = document.querySelector('.filter-btn');
const filters = document.querySelector('.filters');
const statusFilter = document.querySelector('#status-filter');
const genreFilter = document.querySelector('#genre-filter');

const handleSearchInput = debounce((e) => {
    const inputValue = e.target.value.toLowerCase().trim();
    updateTransition(() => {
        internRows.forEach((row) => {
            const name = row.dataset.fullname.toLowerCase().trim();
            if (name.includes(inputValue)) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    });

}, 250);

searchInput.addEventListener('input', handleSearchInput)



//Filters
filterBtn.addEventListener('click', function() {
    filters.classList.toggle('active');
});

statusFilter.addEventListener('change', () => {

    const selectedStatus = statusFilter.value;
    updateTransition(() => {
        internRows.forEach((row) => {
            const status = row.dataset.status;
            if (selectedStatus === "all" || status === selectedStatus) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    })
});


genreFilter.addEventListener('change', () => {
    const selectedGenre = genreFilter.value;
    updateTransition(() => {
        internRows.forEach((row) => {
            const status = row.dataset.genre;
            if (selectedGenre === "all" || status === selectedGenre) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    })
});



document.addEventListener('click', (e)  => {

    if (!filters.contains(e.target) && filters.classList.contains('active')) {
        filters.classList.remove('active');
    }

});

