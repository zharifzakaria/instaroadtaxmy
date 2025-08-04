# InstaRoadTax - Road Tax Renewal System

A PHP-based web application for Malaysian road tax renewal services.

## Features

- Online road tax renewal application
- Payment integration with Billplz
- Admin dashboard for managing applications
- Email notifications
- Quote generation and management

## Setup Instructions

### Prerequisites

- PHP 7.4 or higher
- MySQL/MariaDB database
- Web server (Apache/Nginx)
- Composer for dependency management

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/instaroadtax.git
   cd instaroadtax
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   
   Edit `.env` file with your actual credentials:
   ```env
   # Database Configuration
   DB_HOST=your_database_host
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   DB_DATABASE=your_database_name
   
   # Admin Access
   ADMIN_EMAIL=your_admin@example.com
   ADMIN_PASSWORD=your_secure_password
   
   # Payment Gateway (Billplz)
   BILLPLZAPI=your_billplz_api_key
   BILLPLZCOLLID=your_collection_id
   BILLPLZSIGNATURE=your_signature_key
   ```

4. **Database Setup**
   - Create a MySQL database
   - Import the database schema (if available)
   - Update database credentials in `.env`

5. **Web Server Configuration**
   - Point your web server document root to the project directory
   - Ensure PHP has read/write permissions
   - Update URLs in `configuration.php` for production

### Security Notes

- Never commit `.env` files to version control
- Use strong passwords for admin access
- Regularly rotate API keys and credentials
- Enable HTTPS in production
- Keep dependencies updated

### Development

For local development:
1. Uncomment development URLs in `configuration.php`
2. Set `$is_sandbox = true` for payment testing
3. Use appropriate local database credentials

### Support

For questions or issues, please contact the development team.

## License

This project is proprietary software. All rights reserved.