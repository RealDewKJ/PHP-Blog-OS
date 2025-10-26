# PHP Blog CRUD Application

A modern blog application built with PHP using the Model-View-Controller (MVC) pattern, styled with Tailwind CSS and DaisyUI components, with Docker Compose for database management.

## Features

- **CRUD Operations**: Create, Read, Update, Delete blog posts
- **MVC Architecture**: Clean separation of concerns
- **Modern UI**: Beautiful, responsive design with Tailwind CSS and DaisyUI
- **Docker Integration**: Easy database setup with Docker Compose
- **Input Validation**: Server-side validation for all forms
- **Clean URLs**: SEO-friendly routing
- **Responsive Design**: Mobile-first approach with modern components

## Project Structure

```
php-project/
├── app/
│   ├── Controllers/
│   │   └── BlogController.php
│   ├── Models/
│   │   ├── Blog.php
│   │   └── Database.php
│   └── Views/
│       └── blog/
│           ├── index.php
│           ├── show.php
│           ├── create.php
│           └── edit.php
├── assets/
│   ├── css/
│   │   ├── input.css
│   │   └── style.css
│   └── images/
│       └── icon.png
├── config/
│   └── database.php
├── database/
│   └── init.sql
├── .gitignore
├── .htaccess
├── index.php
├── package.json
├── package-lock.json
├── README.md
└── tailwind.config.js
```

## Git Repository

This project is version controlled with Git. The `.gitignore` file is configured to exclude:

- `node_modules/` - npm dependencies
- `assets/css/style.css` - Generated Tailwind CSS output (build files)
- `vendor/` - Composer dependencies (if used)
- Environment files (`.env`, `.env.local`, etc.)
- IDE configuration files (VSCode, PhpStorm, NetBeans)
- OS-specific files (macOS, Windows, Linux)
- Build artifacts and temporary files

## Requirements

- PHP 7.4 or higher
- Node.js and npm (for Tailwind CSS)
- Docker and Docker Compose
- Web server (Apache/Nginx) with mod_rewrite enabled
- Git (for version control)

## Installation

1. **Clone or download the project**

   ```bash
   # If cloning from a remote repository
   git clone <repository-url>
   cd php-project

   # Or if working with existing project
   cd php-project
   ```

2. **Install Node.js dependencies**

   ```bash
   npm install
   ```

3. **Build Tailwind CSS**

   ```bash
   npm run build-css-prod
   ```

4. **Start the database with Docker Compose**

   ```bash
   docker-compose up -d
   ```

5. **Configure your web server**

   - Point your document root to the project directory
   - Ensure mod_rewrite is enabled for Apache
   - For Nginx, configure URL rewriting

6. **Access the application**
   - Open your browser and navigate to `http://localhost` (or your configured domain)
   - The database will be automatically initialized with sample data

## Database Configuration

The application uses the following default database settings:

- **Host**: localhost
- **Database**: blog_db
- **Username**: blog_user
- **Password**: blog_password

These can be modified in the `config/database.php` file or by setting environment variables.

## Usage

### Available Routes

- `/` - List all blog posts
- `/create` - Create a new blog post
- `/show/{id}` - View a specific blog post
- `/edit/{id}` - Edit a specific blog post
- `/delete/{id}` - Delete a specific blog post (POST request)

### Features

1. **Blog List**: View all blog posts in a responsive grid layout with modern card design
2. **Create Post**: Add new blog posts with intuitive form design and validation
3. **View Post**: Read individual blog posts with clean typography and metadata
4. **Edit Post**: Modify existing blog posts with pre-filled forms
5. **Delete Post**: Remove blog posts with confirmation dialogs
6. **Responsive Design**: Mobile-first approach with Tailwind CSS utilities
7. **Modern Components**: DaisyUI components for consistent, beautiful UI

## Database Schema

The `blogs` table includes the following fields:

- `id` - Primary key (auto-increment)
- `title` - Blog post title (VARCHAR 255)
- `content` - Blog post content (TEXT)
- `author` - Author name (VARCHAR 100)
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

## Development

### Adding New Features

1. **Models**: Add new model classes in `app/Models/`
2. **Controllers**: Create controllers in `app/Controllers/`
3. **Views**: Add view templates in `app/Views/`
4. **Routes**: Update routing logic in `index.php`

### Styling

The application uses Tailwind CSS with DaisyUI components for modern, responsive design:

- **Tailwind CSS**: Utility-first CSS framework for rapid UI development
- **DaisyUI**: Beautiful component library built on top of Tailwind CSS
- **Responsive Design**: Mobile-first approach with responsive breakpoints
- **Modern Components**: Cards, buttons, forms, alerts, and navigation components
- **Theme Support**: Built-in light/dark theme support
- **Accessibility**: WCAG compliant components and interactions

#### Available Themes

The application supports multiple DaisyUI themes:

- `light` (default)
- `dark`
- `cupcake`

You can change themes by modifying the `data-theme` attribute in the HTML.

## Development Commands

### Git Commands

```bash
# Check status of your files
git status

# Add changes to staging area
git add .

# Add specific files
git add <filename>

# Commit changes
git commit -m "Your commit message"

# View commit history
git log

# Check which files are ignored
git status --ignored
```

### CSS Development

```bash
# Watch for changes and rebuild CSS automatically
npm run build-css

# Build CSS for production (minified)
npm run build-css-prod
```

### Docker Commands

```bash
# Start the database
docker-compose up -d

# Stop the database
docker-compose down

# View logs
docker-compose logs mysql

# Restart the database
docker-compose restart mysql
```

## Security Considerations

- All user inputs are sanitized using `htmlspecialchars()`
- SQL injection protection via prepared statements
- CSRF protection recommended for production
- Input validation on both client and server side

## Production Deployment

1. **Environment Variables**: Set up proper environment variables for database credentials
2. **Error Handling**: Configure proper error reporting and logging
3. **Security**: Implement CSRF protection and input sanitization
4. **Performance**: Consider caching and database optimization
5. **SSL**: Enable HTTPS for secure communication

## License

This project is open source and available under the MIT License.

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Support

For questions or issues, please create an issue in the repository or contact the development team.
