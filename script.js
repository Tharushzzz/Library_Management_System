const menuBtn = document.getElementById('menu_btn');
const menu = document.getElementById('navbar');
const menuCloseBtn = document.getElementById('menu-close');
const navLinks = document.querySelectorAll('.menu_btn');

if (menuBtn && menu) {
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
}

if (menuCloseBtn && menu) {
    menuCloseBtn.addEventListener('click', () => {
        menu.classList.remove('active');
    });
}

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (menu) {
            menu.classList.remove('active');
        }
    });
});



// Login/Register Form Toggle

const loginButton = document.getElementById('LoginBtn');
const registerButton = document.getElementById('RegisterBtn');
const loginForm = document.getElementById('logIn_form');
const registerForm = document.getElementById('register_form');

if (loginButton && registerButton && loginForm && registerForm) {
    loginButton.classList.add('active');

    function showLoginForm() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        loginButton.classList.add('active');
        registerButton.classList.remove('active');
    }

    function showRegisterForm() {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        registerButton.classList.add('active');
        loginButton.classList.remove('active');
    }

    loginButton.addEventListener('click', showLoginForm);
    registerButton.addEventListener('click', showRegisterForm);
}


// Book category toggle

// Expose a safe global function for inline `onclick` handlers
function toggleCategoriesForm(mode = 'toggle') {
    const form = document.getElementById('book_categories_form');
    if (!form) return;

    const addButton = document.getElementById('categories_submit_add_btn');
    const updateButton = document.querySelector('button[name="edit_category"]');

    const setAddMode = () => {
        if (addButton) addButton.style.display = 'inline-block';
        if (updateButton) updateButton.style.display = 'none';
    };

    const setEditMode = () => {
        if (addButton) addButton.style.display = 'none';
        if (updateButton) updateButton.style.display = 'inline-block';
    };

    if (mode === 'add') {
        form.classList.add('active');
        setAddMode();
        return;
    }

    if (mode === 'edit') {
        form.classList.add('active');
        setEditMode();
        return;
    }

    form.classList.toggle('active');
    setAddMode();
}
window.toggleCategoriesForm = toggleCategoriesForm;

const categoriestab = document.getElementById('v-pills-categories');

// Initialize button listeners after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const categoriesAddBtn = document.querySelector('.categories_add_btn');
    const categoriesEditBtns = document.querySelectorAll('.category_edit_btn');
    const categoriesUpdateButton = document.querySelector('button[name="edit_category"]');
    const categoriesAddSubmit = document.getElementById('categories_submit_add_btn');
    if (categoriesUpdateButton) {
        categoriesUpdateButton.style.display = 'none';
    }
    if (categoriesAddSubmit) {
        categoriesAddSubmit.style.display = 'inline-block';
    }
    if (categoriesAddBtn) {
        categoriesAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleCategoriesForm('add');
        });
    }
    if (categoriesEditBtns) {
        categoriesEditBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = btn.getAttribute('data-edit-url');
                if (url) {
                    window.location.href = url;
                    return;
                }
                e.preventDefault();
                toggleCategoriesForm('edit');
            });
        });
    }
});





// Book registration toggle

// Expose a safe global function for inline `onclick` handlers
function toggleBookForm(mode = 'toggle') {
    const form = document.getElementById('book_form');
    if (!form) return;

    const addButton = document.getElementById('book_submit_add_btn');
    const updateButton = document.querySelector('button[name="edit_book"]');
    const actionInput = document.getElementById('book_action');
    const bookIdInput = document.getElementById('book_id');

    const setAddMode = () => {
        if (addButton) addButton.style.display = 'inline-block';
        if (updateButton) updateButton.style.display = 'none';
        if (actionInput) actionInput.value = 'add';
        if (bookIdInput) bookIdInput.removeAttribute('readonly');
    };

    const setEditMode = () => {
        if (addButton) addButton.style.display = 'none';
        if (updateButton) updateButton.style.display = 'inline-block';
        if (actionInput) actionInput.value = 'edit';
        if (bookIdInput) bookIdInput.setAttribute('readonly', 'readonly');
    };

    if (mode === 'add') {
        form.classList.add('active');
        setAddMode();
        return;
    }

    if (mode === 'edit') {
        form.classList.add('active');
        setEditMode();
        return;
    }

    const isOpen = form.classList.contains('active');
    form.classList.toggle('active');
    if (isOpen) {
        setAddMode();
    } else {
        setAddMode();
    }
}
window.toggleBookForm = toggleBookForm;

const booktab = document.getElementById('v-pills-books');

// Initialize button listeners after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const bookAddBtn = document.querySelector('.book_add_btn');
    const bookEditBtns = document.querySelectorAll('.book_edit_btn');
    const updateButton = document.querySelector('button[name="edit_book"]');
    const addButton = document.getElementById('book_submit_add_btn');
    if (updateButton) {
        updateButton.style.display = 'none';
    }
    if (addButton) {
        addButton.style.display = 'inline-block';
    }
    if (bookAddBtn) {
        bookAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleBookForm('add');
        });
    }
    if (bookEditBtns) {
        bookEditBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = btn.getAttribute('data-edit-url');
                if (url) {
                    // navigate to server to load the selected book and let server open the form
                    window.location.href = url;
                    return;
                }
                e.preventDefault();
                toggleBookForm('edit');
            });
        });
    }
});


// Member form toggle

// Expose a safe global function for inline `onclick` handlers
function toggleMemberForm(mode = 'toggle') {
    const form = document.getElementById('member_form');
    if (!form) return;

    const addButton = document.getElementById('member_submit_add_btn');
    const updateButton = document.querySelector('button[name="edit_member"]');

    const setAddMode = () => {
        if (addButton) addButton.style.display = 'inline-block';
        if (updateButton) updateButton.style.display = 'none';
    };

    const setEditMode = () => {
        if (addButton) addButton.style.display = 'none';
        if (updateButton) updateButton.style.display = 'inline-block';
    };

    if (mode === 'add') {
        form.classList.add('active');
        setAddMode();
        return;
    }

    if (mode === 'edit') {
        form.classList.add('active');
        setEditMode();
        return;
    }

    form.classList.toggle('active');
    setAddMode();
}
window.toggleMemberForm = toggleMemberForm;

const memberstab = document.getElementById('v-pills-Members');

// Initialize button listeners after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const memberAddBtn = document.querySelector('.member_add_btn');
    const memberEditBtns = document.querySelectorAll('.member_edit_btn');
    const memberUpdateButton = document.querySelector('button[name="edit_member"]');
    const memberAddSubmit = document.getElementById('member_submit_add_btn');
    if (memberUpdateButton) {
        memberUpdateButton.style.display = 'none';
    }
    if (memberAddSubmit) {
        memberAddSubmit.style.display = 'inline-block';
    }
    if (memberAddBtn) {
        memberAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMemberForm('add');
        });
    }
    if (memberEditBtns) {
        memberEditBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = btn.getAttribute('data-edit-url');
                if (url) {
                    window.location.href = url;
                    return;
                }
                e.preventDefault();
                toggleMemberForm('edit');
            });
        });
    }
});




// Book borrow toggle

// Expose a safe global function for inline `onclick` handlers
function toggleBorrowForm(mode = 'toggle') {
    const form = document.getElementById('borrow_form');
    if (!form) return;

    const addButton = document.getElementById('borrow_submit_add_btn');
    const updateButton = document.querySelector('button[name="edit_borrow"]');

    const setAddMode = () => {
        if (addButton) addButton.style.display = 'inline-block';
        if (updateButton) updateButton.style.display = 'none';
    };

    const setEditMode = () => {
        if (addButton) addButton.style.display = 'none';
        if (updateButton) updateButton.style.display = 'inline-block';
    };

    if (mode === 'add') {
        form.classList.add('active');
        setAddMode();
        return;
    }

    if (mode === 'edit') {
        form.classList.add('active');
        setEditMode();
        return;
    }

    form.classList.toggle('active');
    setAddMode();
}
window.toggleBorrowForm = toggleBorrowForm;

const borrowtab = document.getElementById('v-pills-borrow');

// Initialize button listeners after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const borrowAddBtn = document.querySelector('.borrow_add_btn');
    const borrowEditBtns = document.querySelectorAll('.borrow_edit_btn');
    const borrowUpdateButton = document.querySelector('button[name="edit_borrow"]');
    const borrowAddSubmit = document.getElementById('borrow_submit_add_btn');
    if (borrowUpdateButton) {
        borrowUpdateButton.style.display = 'none';
    }
    if (borrowAddSubmit) {
        borrowAddSubmit.style.display = 'inline-block';
    }
    if (borrowAddBtn) {
        borrowAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleBorrowForm('add');
        });
    }
    if (borrowEditBtns) {
        borrowEditBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = btn.getAttribute('data-edit-url');
                if (url) {
                    window.location.href = url;
                    return;
                }
                e.preventDefault();
                toggleBorrowForm('edit');
            });
        });
    }
});










// Fine form toggle

// Expose a safe global function for inline `onclick` handlers
function toggleFineForm(mode = 'toggle') {
    const form = document.getElementById('fine_form');
    if (!form) return;

    const addButton = document.getElementById('fine_submit_add_btn');
    const updateButton = document.querySelector('button[name="edit_fine"]');

    const setAddMode = () => {
        if (addButton) addButton.style.display = 'inline-block';
        if (updateButton) updateButton.style.display = 'none';
    };

    const setEditMode = () => {
        if (addButton) addButton.style.display = 'none';
        if (updateButton) updateButton.style.display = 'inline-block';
    };

    if (mode === 'add') {
        form.classList.add('active');
        setAddMode();
        return;
    }

    if (mode === 'edit') {
        form.classList.add('active');
        setEditMode();
        return;
    }

    form.classList.toggle('active');
    setAddMode();
}
window.toggleFineForm = toggleFineForm;

const finetab = document.getElementById('v-pills-fine');

// Initialize button listeners after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const fineAddBtn = document.querySelector('.fine_add_btn');
    const fineEditBtns = document.querySelectorAll('.fine_edit_btn');
    const fineUpdateButton = document.querySelector('button[name="edit_fine"]');
    const fineAddSubmit = document.getElementById('fine_submit_add_btn');
    if (fineUpdateButton) {
        fineUpdateButton.style.display = 'none';
    }
    if (fineAddSubmit) {
        fineAddSubmit.style.display = 'inline-block';
    }
    if (fineAddBtn) {
        fineAddBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleFineForm('add');
        });
    }
    if (fineEditBtns) {
        fineEditBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = btn.getAttribute('data-edit-url');
                if (url) {
                    window.location.href = url;
                    return;
                }
                e.preventDefault();
                toggleFineForm('edit');
            });
        });
    }
});