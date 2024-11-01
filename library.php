<?php
session_start();
$conn = new mysqli("localhost", "root", "", "library_management");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == "register") {
    registerUser($conn);
} elseif ($action == "login") {
    loginUser($conn);
} elseif ($action == "viewBooks") {
    viewBooks($conn);
} elseif ($action == "bookABook") {
    bookABook($conn);
} elseif ($action == "returnBook") {
    returnBook($conn);
}

// Register a new user
function registerUser($conn) {
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $conn->query("INSERT INTO students (name, rollno, dob, email, password) VALUES ('$name', '$rollno', '$dob', '$email', '$password')");
    echo "<script>alert('Registration successful!'); window.location.href='index.html';</script>";
}

// Login an existing user  
function loginUser($conn) {
    $rollno = $_POST['rollno'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM students WHERE rollno='$rollno'");
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['student_id'] = $user['id'];
        header("Location: dashboard.html");
        exit();
    } else {
        echo "<script>alert('Invalid credentials'); window.history.back();</script>";
    }
}

// Display available books
function viewBooks($conn) {
    $result = $conn->query("SELECT * FROM books WHERE available_count > 0");
    while ($book = $result->fetch_assoc()) {
        echo "<p>{$book['title']} by {$book['author']} - {$book['available_count']} available</p>";
    }
}

// Book a book
function bookABook($conn) {
    $book_id = $_GET['book_id'];
    $student_id = $_SESSION['student_id'];
    $today = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime("+14 days"));
    $conn->query("INSERT INTO rentals (student_id, book_id, rental_date, return_date) VALUES ('$student_id', '$book_id', '$today', '$return_date')");
    $conn->query("UPDATE books SET available_count = available_count - 1 WHERE book_id = '$book_id'");
    echo "Book booked! Return by $return_date";
}

// Return a book
function returnBook($conn) {
    $book_id = $_GET['book_id'];
    $student_id = $_SESSION['student_id'];
    $conn->query("DELETE FROM rentals WHERE student_id = '$student_id' AND book_id = '$book_id' LIMIT 1");
    $conn->query("UPDATE books SET available_count = available_count + 1 WHERE book_id = '$book_id'");
    echo "Book returned!";
}
?>
