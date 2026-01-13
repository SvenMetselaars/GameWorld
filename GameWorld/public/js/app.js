const itemsPerPage = 7;
let currentPage = 0;

const categories = document.querySelectorAll('.category-btn');
const totalPages = Math.ceil(categories.length / itemsPerPage);

function updateView() {
    const start = currentPage * itemsPerPage;
    const end = start + itemsPerPage;

    categories.forEach((cat, index) => {
        if (index >= start && index < end) {
            cat.classList.remove('hidden');
        } else {
            cat.classList.add('hidden');
        }
    });
}

document.getElementById('nextBtn').onclick = () => {
    if (currentPage < totalPages - 1) {
        currentPage++;
        updateView();
    }
};

document.getElementById('prevBtn').onclick = () => {
    if (currentPage > 0) {
        currentPage--;
        updateView();
    }
};

// initial load → 1 t/m 8
updateView();
