// Sample data with associated actions (menu or page navigation)
const suggestions = [
    { name: "لیست گزارشات", action: () => window.location.href = './dashboardpages/ShowEmployeeReport.php' },
    { name: "لیست کارمندان", action: () => window.location.href = './dashboardpages/ShowEmployee.php' },
    { name: "ثبت گزارش", action: () => window.location.href = './dashboardpages/EmployeeReport.php' },
    { name: "ثبت کارمند", action: () => window.location.href = './dashboardpages/EmployeeRegister.php' }
];

const searchInput = document.getElementById('searchInput');
const autocompleteList = document.getElementById('autocompleteList');
let currentIndex = -1;  // Keeps track of the currently selected item in the autocomplete list

// Function to update the suggestion list
function updateSuggestions(input) {
    autocompleteList.innerHTML = '';  // Clear previous suggestions
    currentIndex = -1;  // Reset index when new suggestions are displayed
    const filteredSuggestions = suggestions.filter(item => item.name.includes(input));

    filteredSuggestions.forEach((suggestion, index) => {
        const suggestionItem = document.createElement('button');
        suggestionItem.classList.add('list-group-item', 'list-group-item-action');
        suggestionItem.textContent = suggestion.name;
        suggestionItem.onclick = function () {
            searchInput.value = suggestion.name;
            suggestion.action();  // Execute the corresponding action
            autocompleteList.innerHTML = '';  // Hide the list after selection
        };
        autocompleteList.appendChild(suggestionItem);
    });
}

// Handle input in the search box
searchInput.addEventListener('input', function () {
    const inputValue = this.value;
    if (inputValue) {
        updateSuggestions(inputValue);
    } else {
        autocompleteList.innerHTML = '';
    }
});

// Listen for keypress events to handle "Enter" and arrow key navigation
searchInput.addEventListener('keydown', function (e) {
    const items = autocompleteList.getElementsByTagName('button');
    if (e.key === 'ArrowDown') {
        currentIndex = (currentIndex + 1) % items.length;  // Move down in the list
        highlightItem(items);
    } else if (e.key === 'ArrowUp') {
        currentIndex = (currentIndex - 1 + items.length) % items.length;  // Move up in the list
        highlightItem(items);
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (currentIndex >= 0 && items[currentIndex]) {
            items[currentIndex].click();  // Trigger the action for the highlighted item
        }
    }
});

// Function to highlight the currently selected item
function highlightItem(items) {
    Array.from(items).forEach(item => item.classList.remove('active'));  // Remove highlight from all items
    if (items[currentIndex]) {
        items[currentIndex].classList.add('active');  // Add highlight to the current item
    }
}

// Hide suggestion list when clicking outside
document.addEventListener('click', function (event) {
    if (!searchInput.contains(event.target) && !autocompleteList.contains(event.target)) {
        autocompleteList.innerHTML = '';
    }
});