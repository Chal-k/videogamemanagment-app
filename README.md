# Video Game Management API

This is a Laravel-based API for managing video games, featuring user authentication with Laravel Sanctum, role-based access control (admin and guest), and CRUD operations for games.

## Features
- User authentication (Register, Login, Logout) using Laravel Sanctum
- Role-based access control (Admin & Guest)
- CRUD operations for video games
- Filter and sort games by genre and release date

---

## Installation

### Prerequisites
Ensure you have the following installed on your system:
- PHP 8.1
- Composer 2.6
- MySQL / PostgreSQL / SQLite
- Laravel 10.2

### 1. Clone the Repository
```bash
  git clone https://github.com/Chal-k/gamemanagment-app.git
  cd gamemanagment-app
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up Environment File
Configure your database settings in file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations
```bash
php artisan migrate
```

### 7. Serve the Application
```bash
php artisan serve
```
The application will be available at `http://127.0.0.1:8000`.

---

## API Endpoints

### Authentication
#### Register User (Admin or Guest)
```http
POST /api/register
```
**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "admin"
}
```

#### Login
```http
POST /api/login
```
**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```
**Response:**
```json
{
  "user": { "id": 1, "name": "John Doe", "role": "admin" },
  "token": "your-access-token"
}
```

#### Logout
```http
POST /api/logout
```
---

### Video Game Management (Requires Authentication)

#### Get All Games
```http
GET /api/games
```
**Query Parameters:** (Optional)
- `genre`: Filter by genre
- `sort`: Sort by `release_date`

**Example:**
```http
GET /api/games?genre=Sim-racing&sort=release_date
```

#### Add a New Game
```http
POST /api/games
```
**Request Body:**
```json
{
  "title": "Gran Turismo 2",
  "description": "Is a racing simulation video game.",
  "release_date": "2000-01-28",
  "genre": "Sim-racing"
}
```

#### Update a Game (Admin Only)
```http
PUT /api/games/{id}
```
**Request Body:**
```json
{
  "title": "Updated Title",
  "description": "Updated Description"
}
```

#### Delete a Game (Admin Only)
```http
DELETE /api/games/
```
**Request Body:**
```json
{
  "id": post-id,
}
```

---

## Authentication & Authorization
- **Admins** can create and update their games, delete and view all games.
- **Guests** can create, update and delete their games, and view all games.
- Authorization is handled via Laravel Sanctum, requiring a **Bearer Token** in the `Authorization` header for all protected routes.

Example Header:
```http
Authorization: Bearer your-access-token
```

---

## Testing the API
You can test the API using **Postman**.

Replace Auth <your_token_here> with the token generated.