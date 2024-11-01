// Fetch and display available books
function viewBooks() {
    fetch('library.php?action=viewBooks')
        .then(response => response.text())
        .then(data => {
            document.getElementById('bookList').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}

// Book a selected book
function bookABook() {
    const bookID = prompt("Enter Book ID:");
    fetch(`library.php?action=bookABook&book_id=${bookID}`)
        .then(response => response.text())
        .then(data => alert(data))
        .catch(error => console.error('Error:', error));
}

// Return a selected book
function returnBook() {
    const bookID = prompt("Enter Book ID to Return:");
    fetch(`library.php?action=returnBook&book_id=${bookID}`)
        .then(response => response.text())
        .then(data => alert(data))
        .catch(error => console.error('Error:', error));
}
