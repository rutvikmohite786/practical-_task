# User Management System

A professional Laravel 12 application with Bootstrap authentication and AJAX-based CRUD operations for managing users with profile pictures, categories, and hobbies.

## Features

- **Authentication System**: Secure login/logout (no registration)
- **User Management**: Complete CRUD operations without page reload
- **Inline Editing**: Edit user data directly in the table
- **Profile Pictures**: Upload and manage user profile images
- **Categories & Hobbies**: Organize users with categories and multiple hobbies
- **Bulk Operations**: Select multiple users for bulk deletion
- **Real-time Validation**: Both client-side and server-side validation
- **Professional UI**: Clean, realistic design with Bootstrap and SweetAlert
- **Responsive Design**: Works seamlessly on all devices

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5, jQuery, SweetAlert2
- **Database**: MySQL
- **Icons**: Bootstrap Icons
- **Authentication**: Laravel UI with Bootstrap

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database
- Web Server (Apache/Nginx) or Laravel's built-in server

## Installation Steps

### 1. Clone or Download the Project

```bash
cd C:\wamp64\www\practicle
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Build Frontend Assets

```bash
npm run build
```

### 5. Environment Configuration

Copy the example environment file:

```bash
copy .env.example .env
```

Update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Create Database

Create a new MySQL database with the name you specified in the `.env` file.

### 8. Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

This will create all necessary tables and seed them with:
- 5 Categories (Technology, Sports, Arts, Music, Science)
- 8 Hobbies (Reading, Gaming, Cooking, Traveling, Photography, Painting, Dancing, Singing)
- 1 Admin User for testing

### 9. Create Storage Link (for profile pictures)

```bash
php artisan storage:link
```

### 10. Set Directory Permissions

Ensure the `public/uploads/profiles` directory has write permissions:

```bash
mkdir -p public/uploads/profiles
chmod -R 775 public/uploads/profiles
```

For Windows (run in PowerShell as Administrator):
```powershell
icacls "public\uploads\profiles" /grant Everyone:F
```

### 11. Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://127.0.0.1:8000**

## Default Login Credentials

```
Email: admin@example.com
Password: password
```

## Project Structure

```
practicle/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/          # Authentication controllers
│   │   │   └── UserDataController.php
│   │   └── Requests/          # Form request validation
│   └── Models/
│       ├── Category.php
│       ├── Hobby.php
│       └── UserData.php
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/              # Database seeders
├── public/
│   └── uploads/
│       └── profiles/         # Profile picture uploads
├── resources/
│   └── views/
│       ├── auth/             # Login views
│       ├── layouts/          # Layout templates
│       └── users/            # User management views
└── routes/
    └── web.php              # Application routes
```

## Usage Guide

### Adding a New User

1. Click the **"Add New"** button
2. Fill in the required fields:
   - Name (minimum 3 characters)
   - Profile Picture (optional, max 2MB)
   - Phone (10-20 digits)
   - Category (select one)
   - Hobbies (select at least one)
3. Click **"Save"**

### Editing a User (Inline Edit)

1. Click the **"Edit"** button on any user row
2. The row becomes editable with input fields
3. Modify the desired fields
4. Click **"Save"** to update or **"Cancel"** to discard changes

### Deleting a User

1. Click the **"Delete"** button on any user row
2. Confirm the deletion in the popup dialog
3. The user and their profile picture will be removed

### Bulk Delete

1. Select multiple users using the checkboxes
2. Click the **"Bulk Delete"** button
3. Confirm the deletion
4. All selected users will be removed

## API Endpoints

All operations use AJAX requests:

- `GET /home` - Display user management interface
- `GET /users/data` - Fetch all users (JSON)
- `POST /users` - Create new user
- `PUT /users/{id}` - Update user
- `DELETE /users/{id}` - Delete user
- `POST /users/bulk-delete` - Delete multiple users
- `GET /categories` - Fetch categories (JSON)
- `GET /hobbies` - Fetch hobbies (JSON)

## Validation Rules

### Server-Side Validation

- **Name**: Required, 3-255 characters
- **Profile Picture**: Optional, image (jpeg/png/jpg/gif), max 2MB
- **Phone**: Required, 10-20 characters, numbers/+/-/spaces/parentheses only
- **Category**: Required, must exist in database
- **Hobbies**: Required, minimum 1 hobby, must exist in database

### Client-Side Validation

Real-time validation with SweetAlert error messages for better user experience.

## Features in Detail

### AJAX Operations
All CRUD operations are performed via AJAX without page reload for seamless user experience.

### Inline Editing
Users can edit records directly in the table without navigating to a separate form.

### Profile Picture Management
- Automatic file validation
- Old images automatically deleted on update
- Fallback to avatar with first letter if no image
- Cache-busted URLs for immediate updates

### Bulk Operations
Select multiple records and perform bulk deletions with confirmation dialogs.

### SweetAlert Integration
Professional alert/confirmation dialogs for all user interactions.

### Authentication
Secure authentication with Laravel's built-in system, register and password reset disabled.

## Troubleshooting

### Issue: Images not uploading
**Solution**: Ensure the `public/uploads/profiles` directory exists and has write permissions.

### Issue: Database connection error
**Solution**: Verify your `.env` database credentials are correct and the database exists.

### Issue: 404 on routes
**Solution**: Run `php artisan route:clear` and `php artisan optimize:clear`

### Issue: Permission denied on Windows
**Solution**: Run your terminal/command prompt as Administrator.

### Issue: Cached old data
**Solution**: Clear all caches:
```bash
php artisan optimize:clear
php artisan view:clear
```

## Browser Support

- Chrome (recommended)
- Firefox
- Safari
- Edge
- Opera

## Security Features

- CSRF Protection
- SQL Injection Prevention (Eloquent ORM)
- XSS Protection (Laravel's built-in escaping)
- File Upload Validation
- Server-side Input Validation
- Authentication Middleware

## Development Commands

```bash
# Clear all caches
php artisan optimize:clear

# Clear specific caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reset database
php artisan migrate:fresh --seed

# Run development server
php artisan serve

# Build frontend assets for production
npm run build
```

## License

This project is open-source software.

## Support

For issues and questions, please check the troubleshooting section above.

---

**Built with Laravel 12 & Bootstrap 5**
