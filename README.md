
# Laravel Project Family Details

Welcome to the Laravel Project! This README will guide you through the steps required to set up the project and start development.

---

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Database Migration](#database-migration)
5. [Running the Application](#running-the-application)
6. [Testing](#testing)
7. [Contributing](#contributing)
8. [License](#license)

---

## Requirements

Before setting up the project, ensure you have the following installed:

- PHP >= 8.1
- Composer
- Laravel 11.x
- MySQL or any other database
- NPM

---

## Installation

Follow these steps to install and set up the Laravel project:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/njamdhade/family-info/tree/master
   cd laravel-project
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Generate the application key**:
   ```bash
   php artisan key:generate

   ```

5. **link storage to public folder**:
   ```bash
   php artisan storage:link
   ```
---

## Configuration

1. **Create the `.env` file**:
   Copy the example `.env` file to create your environment configuration:
   ```bash
   cp .env.example .env
   ```

2. **Set environment variables**:
   Update the following variables in the `.env` file as needed:
   ```env
   APP_NAME="Laravel Project"
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

---

## Database Migration

1. **Run database migrations**:
   Set up the database schema by running:
   ```bash
   php artisan migrate
   ```
---

## Running the Application

1. **Start the local development server**:
   ```bash
   php artisan serve
   ```
   The application will be available at [http://localhost:8000](http://localhost:8000).

2. **Compile frontend assets**:
   In a separate terminal, run:
   ```bash
   npm run dev
   ```

---

## Testing

1. **Run PHPUnit tests**:
   ```bash
   php artisan test
   ``` 
--- 
## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details
