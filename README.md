
# Brypto

**Brypto** is a Laravel-based web application focused on encryption and decryption of user data. It allows users to securely store passwords, credit card information, and private notes in a local database. The stored data is encrypted using the `aes-256-gcm` algorithm provided by OpenSSL, with a base64-encoded key defined by the user.

## Features

- **Encryption:**  
  Users can encrypt their sensitive data (like passwords, credit card information, and private notes) using a base64-encoded key of their choice. The encrypted data is displayed on the "Encryption" page and can optionally be stored in the database for future use.

- **Vault:**  
  The encrypted data stored in the database can be decrypted using the same key on the "Vault" page. This allows users to retrieve and view their sensitive information securely.

- **Decryption:**  
  The "Decryption" page allows users to input any encrypted data and decrypt it using the appropriate key.

- **User Authentication:**  
  Brypto includes a secure login system where user passwords are hashed before being stored in the database.

- **User Interface:**  
  The application interface is designed with Tailwind CSS, prioritizing a user-friendly experience.

## Screenshots

Here are some screenshots of the application:

![Ekran görüntüsü 2024-08-17 175548](https://github.com/user-attachments/assets/90a53b9d-799e-49c9-8fb8-8f8c4627bf01)
![Ekran görüntüsü 2024-08-17 175849](https://github.com/user-attachments/assets/cceb456e-fa56-45ec-aadb-bbc054ad5245)
![Ekran görüntüsü 2024-08-18 171755](https://github.com/user-attachments/assets/3fa2aa91-892f-4523-9a8d-a309ea261f05)
![Ekran görüntüsü 2024-08-18 171842](https://github.com/user-attachments/assets/7b81ad09-c49b-4462-b027-13e4a122b57e)
![Ekran görüntüsü 2024-08-18 171859](https://github.com/user-attachments/assets/29be930d-4cbb-4b87-b94e-e1f65caddd4c)
![Ekran görüntüsü 2024-08-18 171937](https://github.com/user-attachments/assets/267c17ad-2f87-47ad-a90a-86ded7642c11)



## Installation

1. Clone the repository:

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Create a copy of `.env.example` as `.env` and update the necessary environment variables, such as database connection details and encyrption key.

4. Generate an application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations to create the necessary database tables:
   ```bash
   php artisan migrate
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000`.
- Register an account and log in to start encrypting and decrypting data.
- Use the "Encryption" page to encrypt your data and save it securely.
- Retrieve and decrypt your data on the "Vault" page.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

