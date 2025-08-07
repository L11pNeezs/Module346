document.getElementById('toggle-menu-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const menuContainer = document.getElementById('menu-table-container');
    menuContainer.style.display = menuContainer.style.display === 'none' ? 'flex' : 'none';
});
