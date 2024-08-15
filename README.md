
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

### Encryption Page
![1](https://github.com/user-attachments/assets/f4f72f10-5f4e-4860-ae59-bb06aca1092b)
![2](https://github.com/user-attachments/assets/ee15f7dd-326c-47f1-8699-2964cff4f21c)
![3](https://github.com/user-attachments/assets/5c301688-2ce1-4757-b947-d983e32bab84)
![4](https://github.com/user-attachments/assets/6a3d11e2-015d-43eb-b3ae-79a8da5a621d)
![5](https://github.com/user-attachments/assets/6ddc3a20-c3d8-479c-89a3-57390d2f1e83)
![6](https://github.com/user-attachments/assets/fc0be103-bff3-40f6-a4fc-fdfa57dfbd66)
![7](https://github.com/user-attachments/assets/7bcad77f-28c0-47b4-8d69-2d35423ab801)


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

