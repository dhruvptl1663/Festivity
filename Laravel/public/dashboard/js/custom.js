// Custom JavaScript for Festivity Dashboard

// Function to initialize all event handlers
function initializeEventHandlers() {
    console.log('Initializing event handlers');
    
    // Click handler for sidebar toggle
    document.querySelectorAll('.button-show-hide').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.layout-wrap').classList.toggle('full-width');
            console.log('Sidebar toggle clicked');
        });
    });
    
    // Click handler for menu items with children - using delegated events
    document.addEventListener('click', function(e) {
        // Find if the click target is a menu-item-button or its parent is a menu-item-button
        const menuItemButton = e.target.closest('.menu-item-button');
        if (!menuItemButton) return;
        
        // Find the parent menu-item
        const menuItem = menuItemButton.closest('.menu-item.has-children');
        if (!menuItem) return;
        
        console.log('Menu item with children clicked');
        e.preventDefault();
        
        const subMenu = menuItem.querySelector('.sub-menu');
        
        if (menuItem.classList.contains('active')) {
            menuItem.classList.remove('active');
            if (subMenu) {
                subMenu.style.display = 'none';
            }
        } else {
            // Close all other open menus
            document.querySelectorAll('.menu-item.has-children.active').forEach(function(active) {
                active.classList.remove('active');
                const activeSubMenu = active.querySelector('.sub-menu');
                if (activeSubMenu) {
                    activeSubMenu.style.display = 'none';
                }
            });
            
            // Open this menu
            menuItem.classList.add('active');
            if (subMenu) {
                subMenu.style.display = 'block';
            }
        }
    });
    
    // Prevent sub-menu-item clicks from propagating to parent
    document.addEventListener('click', function(e) {
        if (e.target.closest('.sub-menu-item')) {
            e.stopPropagation();
        }
    });
    
    // Initialize Bootstrap dropdowns
    if (typeof bootstrap !== 'undefined') {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        dropdownElementList.forEach(function(dropdownToggleEl) {
            new bootstrap.Dropdown(dropdownToggleEl);
        });
    }
    
    console.log("Custom script initialized successfully");
}

// Initialize when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded');
    initializeEventHandlers();
});

// Also initialize when jQuery is ready (as a backup)
if (typeof jQuery !== 'undefined') {
    jQuery(document).ready(function() {
        console.log('jQuery ready');
        initializeEventHandlers();
    });
}
