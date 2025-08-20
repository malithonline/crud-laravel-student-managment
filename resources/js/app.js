import './bootstrap';

// AJAX Form Handling
document.addEventListener('DOMContentLoaded', function() {
    // Handle AJAX form submissions
    const ajaxForms = document.querySelectorAll('.ajax-form');
    ajaxForms.forEach(form => {
        form.addEventListener('submit', handleAjaxForm);
    });

    // Handle status toggle buttons
    const toggleButtons = document.querySelectorAll('.status-toggle');
    toggleButtons.forEach(button => {
        button.addEventListener('click', handleStatusToggle);
    });

    // Handle AJAX delete forms
    const deleteForms = document.querySelectorAll('.ajax-delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', handleAjaxDelete);
    });
});

async function handleAjaxForm(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Saving...';
    
    // Clear previous errors
    clearFormErrors(form);
    
    try {
        const formData = new FormData(form);
        const response = await axios.post(form.action, formData, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'multipart/form-data'
            }
        });
        
        if (response.data.ok) {
            // Show success message
            showAlert('success', response.data.message);
            
            // Redirect if needed
            if (response.data.redirect) {
                setTimeout(() => {
                    window.location.href = response.data.redirect;
                }, 1500);
            }
        }
    } catch (error) {
        if (error.response && error.response.status === 422) {
            // Validation errors
            displayFormErrors(form, error.response.data.errors);
        } else {
            showAlert('error', 'An error occurred. Please try again.');
        }
    } finally {
        // Reset button
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }
}

async function handleStatusToggle(e) {
    e.preventDefault();
    
    const button = e.target.closest('.status-toggle');
    const url = button.dataset.url;
    
    try {
        const response = await axios.patch(url, {}, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.data.ok) {
            // Update button appearance
            const badge = button.querySelector('.badge');
            if (response.data.status) {
                badge.classList.remove('badge-error');
                badge.classList.add('badge-success');
                badge.textContent = 'Active';
            } else {
                badge.classList.remove('badge-success');
                badge.classList.add('badge-error');
                badge.textContent = 'Inactive';
            }
            
            showAlert('success', 'Status updated successfully');
        }
    } catch (error) {
        showAlert('error', 'Failed to update status');
    }
}

async function handleAjaxDelete(e) {
    e.preventDefault();
    
    const form = e.target;
    const confirmMessage = form.dataset.confirm;
    const studentName = form.dataset.studentName;
    
    if (!confirm(`${confirmMessage}\n\nStudent: ${studentName}`)) {
        return;
    }
    
    const button = form.querySelector('button[type="submit"]');
    const originalHtml = button.innerHTML;
    
    // Show loading state
    button.disabled = true;
    button.innerHTML = '<span class="loading loading-spinner loading-sm"></span>';
    
    try {
        const response = await axios.post(form.action, new FormData(form), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'multipart/form-data'
            }
        });
        
        if (response.data.ok) {
            // Remove the student row with animation
            const row = form.closest('tr');
            row.style.transition = 'opacity 0.3s ease';
            row.style.opacity = '0';
            
            setTimeout(() => {
                row.remove();
                showAlert('success', 'Student deleted successfully');
                
                // Check if table is empty and reload page to show empty state
                const tbody = document.querySelector('tbody');
                if (tbody.children.length === 0) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }, 300);
        }
    } catch (error) {
        showAlert('error', 'Failed to delete student');
        button.disabled = false;
        button.innerHTML = originalHtml;
    }
}

function clearFormErrors(form) {
    // Remove error classes
    form.querySelectorAll('.input-error, .select-error, .textarea-error').forEach(el => {
        el.classList.remove('input-error', 'select-error', 'textarea-error');
    });
    
    // Remove error messages
    form.querySelectorAll('.error-message').forEach(el => el.remove());
}

function displayFormErrors(form, errors) {
    Object.keys(errors).forEach(field => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input) {
            // Add error class
            if (input.tagName === 'SELECT') {
                input.classList.add('select-error');
            } else if (input.tagName === 'TEXTAREA') {
                input.classList.add('textarea-error');
            } else {
                input.classList.add('input-error');
            }
            
            // Add error message
            const errorDiv = document.createElement('label');
            errorDiv.className = 'label error-message';
            errorDiv.innerHTML = `<span class="label-text-alt text-error">${errors[field][0]}</span>`;
            input.parentNode.appendChild(errorDiv);
        }
    });
}

function showAlert(type, message) {
    // Remove existing alerts
    document.querySelectorAll('.temp-alert').forEach(el => el.remove());
    
    const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
    const iconPath = type === 'success' 
        ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
        : 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z';
    
    const alert = document.createElement('div');
    alert.className = `alert ${alertClass} temp-alert mb-6`;
    alert.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${iconPath}" />
        </svg>
        <span>${message}</span>
    `;
    
    const main = document.querySelector('main');
    main.insertBefore(alert, main.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        alert.remove();
    }, 5000);
}
