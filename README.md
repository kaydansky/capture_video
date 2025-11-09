# Video Capture Application

A PHP-based web application for capturing and saving video content through the browser using RecordRTC.

## Features

- Browser-based video recording
- Real-time video capture using RecordRTC
- Database storage for video metadata
- Responsive UI using Bootstrap
- Form validation using jQuery Validate
- Input masking functionality

## Project Structure

```
├── application/
│   ├── controllers/      # Application controllers
│   ├── database/         # Database schemas and queries
│   ├── helpers/          # Helper functions
│   ├── models/           # Database and application models
│   └── views/            # Frontend assets and templates
├── config/              # Application configuration
├── index.php           # Application entry point
└── video_save.php      # Video processing endpoint
```

## Dependencies

- PHP (with PDO MySQL support)
- MySQL/MariaDB
- Web browser with camera support
- Frontend libraries:
  - jQuery 3.2.1
  - jQuery Mask
  - jQuery Validate
  - RecordRTC.js
  - Bootstrap

## Setup

1. Configure your web server (Apache/Nginx) to point to the project directory
2. Set up the database:
   - Use the schema in `application/database/create_tables.sql`
   - Configure database connection in `config/database/database.php`

3. Ensure proper permissions for video file uploads
4. Access the application through your web browser
5. Make sure to open the website with SSL, otherwise the browser blocks the camera access.

## Frontend Templates

The application uses multiple template files located in `application/views/templates/`:
- Header templates for different sections
- Main content templates (1.html through 4.html)
- Common footer template

## Security

- Input sanitization implemented through `application/helpers/sanitizer.php`
- PDO prepared statements for database queries
- Frontend form validation

## Development

This application uses:
- MVC architecture pattern
- PDO for database operations
- Bootstrap for responsive design
- jQuery plugins for enhanced functionality

## License

⚠️ **NO LICENSE — CODE IS NOT OPEN SOURCE** ⚠️
Viewing and forking for review only. All other use prohibited without written permission.