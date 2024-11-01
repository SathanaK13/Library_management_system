# Library_management_system
This is a simple library system for students with 3 simple options, they are view, booking and returning a book.

Project Description: Student Library Management System

The Student Library Management System is a simple yet functional project created to help students efficiently manage library books. Built using PHP, this system incorporates essential features like user registration, book viewing, booking, and returning, while automatically tracking book availability in the library’s collection.

System Workflow:

1. Login & Registration

Registration: New users can register through a dedicated page. They are prompted to enter essential details like name and roll number, creating a unique user profile within the system.

Login: Once registered, users can log in to access the library’s dashboard.

2. Dashboard Features
After logging in, users are presented with a dashboard where they can navigate through three core options:

View Books: This option displays a list of all books available in the library’s collection. The list includes each book’s title, ID, and availability status, allowing users to quickly assess what’s currently offered.

Book a Book: Users can select a book to borrow by its unique ID number. When a user books a book:
The system reduces the available quantity for that book by one.
A confirmation pop-up notifies the user that the book has been successfully booked, along with the return date.

Return a Book: Users can return a previously borrowed book by entering its ID. Once returned:
The system increases the availability count for that book, ensuring accurate tracking of library inventory.
