const menuBtn = document.getElementById('menu_btn');
const menu = document.getElementById('navbar');
const menuCloseBtn = document.getElementById('menu-close');
let navLinks = document.querySelectorAll('.menu_btn');


menuBtn.addEventListener('click', () => {
    menu.classList.toggle('active');
});

menuCloseBtn.addEventListener('click', () => {
    menu.classList.remove('active');
});

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        menu.classList.remove('active');
    });
});

// ==================== BOOK CATEGORY MANAGEMENT ====================

// Regular Expression for Category ID validation (C followed by digits, e.g., C001)
const categoryIdRegex = /^C\d+$/;

// Get current date and time in format: YYYY-MM-DD HH:MM:SS
function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

// Validate Category ID format
function isValidCategoryId(categoryId) {
    return categoryIdRegex.test(categoryId);
}

// Load categories from localStorage
function loadCategories() {
    const stored = localStorage.getItem('bookCategories');
    return stored ? JSON.parse(stored) : [];
}

// Save categories to localStorage
function saveCategories(categories) {
    localStorage.setItem('bookCategories', JSON.stringify(categories));
}

// Display all categories in table
function displayCategories() {
    const categories = loadCategories();
    const tableBody = document.getElementById('categoriesTableBody');
    const emptyMessage = document.getElementById('emptyMessage');
    
    if (categories.length === 0) {
        tableBody.innerHTML = '';
        emptyMessage.style.display = 'block';
        return;
    }
    
    emptyMessage.style.display = 'none';
    tableBody.innerHTML = categories.map((category, index) => `
        <tr>
            <td><strong>${category.categoryId}</strong></td>
            <td>${category.categoryName}</td>
            <td>${category.dateModified}</td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="editCategory(${index})">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteCategory(${index})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </td>
        </tr>
    `).join('');
}

// Add or Update Category
function addOrUpdateCategory() {
    const categoryId = document.getElementById('category_id').value.trim();
    const categoryName = document.getElementById('category_name').value.trim();
    const errorElement = document.getElementById('categoryIdError');

    // Validate Category ID format
    if (!isValidCategoryId(categoryId)) {
        errorElement.style.display = 'block';
        errorElement.textContent = 'Format must be C followed by numbers (e.g., C001)';
        return;
    }

    errorElement.style.display = 'none';

    // Validate Category Name
    if (!categoryName) {
        alert('Please enter Category Name');
        return;
    }

    const categories = loadCategories();
    const dateModified = getCurrentDateTime();

    // Check if category already exists (for adding new)
    const existingIndex = categories.findIndex(cat => cat.categoryId === categoryId);
    if (existingIndex !== -1 && !document.getElementById('category_id').readOnly) {
        alert('Category ID already exists! Use a different ID.');
        return;
    }

    const newCategory = {
        categoryId: categoryId,
        categoryName: categoryName,
        dateModified: dateModified
    };

    categories.push(newCategory);
    saveCategories(categories);
    
    // Clear form
    document.getElementById('categoryForm').reset();
    
    // Refresh table
    displayCategories();
    
    alert('Category added successfully!');
}

// Edit Category
function editCategory(index) {
    const categories = loadCategories();
    const category = categories[index];
    
    // Populate modal fields
    document.getElementById('edit_category_id').value = category.categoryId;
    document.getElementById('edit_category_name').value = category.categoryName;
    
    // Store index for save operation
    document.getElementById('saveEditCategoryBtn').setAttribute('data-index', index);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
    modal.show();
}

// Save edited category
function saveEditedCategory() {
    const index = document.getElementById('saveEditCategoryBtn').getAttribute('data-index');
    const categoryName = document.getElementById('edit_category_name').value.trim();
    const editError = document.getElementById('editCategoryIdError');

    if (!categoryName) {
        alert('Please enter Category Name');
        return;
    }

    const categories = loadCategories();
    categories[index].categoryName = categoryName;
    categories[index].dateModified = getCurrentDateTime();
    
    saveCategories(categories);
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('editCategoryModal'));
    modal.hide();
    
    // Refresh table
    displayCategories();
    
    alert('Category updated successfully!');
}

// Delete Category
function deleteCategory(index) {
    if (confirm('Are you sure you want to delete this category?')) {
        const categories = loadCategories();
        categories.splice(index, 1);
        saveCategories(categories);
        displayCategories();
        alert('Category deleted successfully!');
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Load and display categories when page loads
    displayCategories();
    
    // Add category button
    if (document.getElementById('submitCategoryBtn')) {
        document.getElementById('submitCategoryBtn').addEventListener('click', (e) => {
            e.preventDefault();
            addOrUpdateCategory();
        });
    }
    
    // Save edited category button
    if (document.getElementById('saveEditCategoryBtn')) {
        document.getElementById('saveEditCategoryBtn').addEventListener('click', () => {
            saveEditedCategory();
        });
    }

    // Clear error message on input
    if (document.getElementById('category_id')) {
        document.getElementById('category_id').addEventListener('input', () => {
            document.getElementById('categoryIdError').style.display = 'none';
        });
    }
});