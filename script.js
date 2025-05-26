const themeToggleButton = document.getElementById('theme-toggle-button');
const bodyElement = document.body;

// Check for saved theme preference in local storage
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
    bodyElement.classList.add('dark-theme');
}

// Add event listener to the toggle button
themeToggleButton.addEventListener('click', () => {
    bodyElement.classList.toggle('dark-theme');

    // Save current theme preference to local storage
    if (bodyElement.classList.contains('dark-theme')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
        // Alternatively, remove the item if the default is light:
        // localStorage.removeItem('theme');
    }
});
