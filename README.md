# Personal Accounting API Application

This project is a personal accounting API application built with Laravel 11. It allows authorized users to create records of receipts and expenses, retrieve lists of these records, and get the total amount for expenses, receipts, and everything. No web interface is included, as the focus is on creating a robust and maintainable backend API.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [Covering Letter](#covering-letter)

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/waheedup74/personal_accounting_test.git
   cd personal_accounting_test
    ```
   
2. Install dependencies:
    ```sh
   composer install
    ```
3. Set up the environment:
    ```sh
   cp .env.example .env
   php artisan key:generate
    ```
   
4. Configure the database in the .env file and run migrations:
    ```sh
   php artisan migrate
    ```
   
5. Start the server:
    ```sh
   php artisan serve
    ```

## Usage
To use the API, you'll need to authenticate using Sanctum. Register a new user and obtain an API token to include in your requests.

## API Documentation
API documentation is provided via Postman. Access the documentation at https://documenter.getpostman.com/view/26625343/2sA3dxDXAf.

## Covering Letter

1. Single Responsibility Principle (SRP): Each class has a single responsibility. For example, the TransactionService handles all transaction-related business logic.
2. Open/Closed Principle (OCP): Classes are open for extension but closed for modification. For example, the TransactionService can be extended with new methods without altering its existing code.
3. Modular Architecture: The application is divided into distinct modules, each responsible for a specific part of the functionality (e.g., transaction management, user authentication). 
4. Service Layer: Business logic is encapsulated within services (TransactionService), separating it from controllers and models, making the codebase more maintainable and testable.
5. Event-Driven Design: The application uses
Laravel events and listeners to handle tasks like sending notifications and logging, ensuring loose coupling between components.

## Proper Use of PHPDoc

Proper use of PHPDoc involves documenting classes, methods, and properties to provide clear descriptions of their functionality and usage.

## 3. What Did You Like or Dislike About PHP 7+?
### Likes:

1. Scalar Type Declarations: Improved type safety by allowing developers to specify the expected data types for function arguments and return values. 
2. Anonymous Classes: Useful for simple one-off objects that do not need a full class declaration. 
3. Null Coalescing Operator (??): Simplifies the common pattern of checking if a variable is set before using it. 
4. Return Type Declarations: Provides clarity and helps catch errors by specifying the return type of functions.

### Dislikes
1. Backward Compatibility: While PHP 7 introduced many improvements, some of the changes required significant updates to existing codebases, which could be time-consuming. 
2. Strict Typing: The introduction of strict typing is optional and can lead to inconsistencies in codebases where it is not uniformly applied.

## How Do You Feel About Typing in PHP 7+?
Typing in PHP 7+ is a valuable feature that enhances code reliability and maintainability. It helps catch errors early in the development process and makes the code more self-documenting. However, it should be used judiciously:

### When to Use Typing:
1. Public APIs: Ensures that consumers of the API know what types to expect. 
2. Complex Logic: Increases confidence in the correctness of the code by ensuring type consistency.

### When Not to Use Typing:
1. Prototyping/Experimentation: May slow down the development process when quickly iterating on ideas. 
2. Performance-Critical Code: In some rare cases, typing may introduce a slight performance overhead.