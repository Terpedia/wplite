# WPLite - WordPress with SQLite and BuddyPress for Replit

A lightweight WordPress setup using SQLite as the database backend, specifically designed for Replit. Perfect for development, testing, or small deployments without needing Docker or MySQL.

## Features

- 🚀 WordPress with SQLite database (no MySQL required!)
- 👥 BuddyPress ready for social features
- 🐳 Replit-optimized setup
- 📦 Self-contained installation
- 🪶 Lightweight - uses SQLite instead of MySQL
- ⚡ Fast setup with automated installer

## Prerequisites

- A Replit account
- No additional software required - everything runs in the browser!

## Quick Start

1. **Fork this repository** on Replit:
   - Click the "Fork" button on this repository
   - Or create a new Replit project and import this code

2. **Run the project**:
   - Click the "Run" button in Replit
   - The setup wizard will automatically start

3. **Follow the setup wizard**:
   - Complete the WordPress installation
   - Configure your site settings
   - Install BuddyPress

## Installation Process

### 1. Automatic Setup

When you first run the project, you'll see a welcome page with:
- System requirements check
- Installation wizard
- Step-by-step guidance

### 2. WordPress Installation

The setup script will:
1. Download WordPress from wordpress.org
2. Extract and configure files
3. Set up SQLite database integration
4. Create your admin account
5. Configure WordPress for Replit

### 3. Post-Installation

After installation:
1. **Activate SQLite Integration**: Go to Plugins → Installed Plugins → Activate "SQLite Database Integration"
2. **Install BuddyPress**: Go to Plugins → Add New → Search "BuddyPress" → Install and Activate
3. **Configure BuddyPress**: Follow the setup wizard for social features

## Project Structure

```
wplite/
├── index.php              # Main entry point and welcome page
├── setup.php              # Installation wizard
├── replit.nix             # Replit environment configuration
├── .replit                # Replit project settings
├── scripts/               # Setup scripts and configuration
│   ├── wp-config.php      # WordPress configuration template
│   ├── db.php             # SQLite database adapter
│   └── sqlite-database-integration/  # SQLite plugin files
├── data/                  # SQLite database files (created during setup)
├── wp-content/           # WordPress content (created during setup)
└── README.md             # This file
```

## How It Works

### Replit Integration

- **PHP 8.1**: Configured in `replit.nix`
- **SQLite3**: Built-in database support
- **Built-in Server**: PHP's built-in web server runs on port 8080
- **Persistent Storage**: Data persists between Replit sessions

### SQLite Database

- **No MySQL Required**: Uses SQLite for simplicity
- **File-based**: Database stored in `data/` directory
- **Automatic Setup**: Database created during installation
- **Backup Friendly**: Easy to backup by copying the `data/` folder

## Managing Your Site

### Accessing WordPress

- **Frontend**: Your Replit URL (e.g., `https://your-project.your-username.repl.co`)
- **Admin**: Add `/wp-admin` to your URL
- **Login**: Use the credentials you set during installation

### File Management

- **Themes**: Upload to `wp-content/themes/`
- **Plugins**: Upload to `wp-content/plugins/` or install via admin
- **Uploads**: Automatically stored in `wp-content/uploads/`

### Backup and Restore

Your data is stored in:
- `data/` - SQLite database files
- `wp-content/` - All your WordPress content

To backup, download these directories from Replit. To restore, upload them back.

## BuddyPress Features

Once activated, BuddyPress adds:
- **Activity Streams** - Facebook-like activity updates
- **User Profiles** - Extended user profiles
- **User Groups** - Create and manage user groups
- **Private Messaging** - Send private messages between users
- **Friend Connections** - Users can connect as friends
- **Notifications** - Real-time notifications

## Customization

### Adding Themes

1. Download WordPress themes
2. Upload to `wp-content/themes/` via Replit file manager
3. Activate in WordPress admin → Appearance → Themes

### Adding Plugins

1. Upload plugins to `wp-content/plugins/` via Replit file manager
2. Or install directly from WordPress admin → Plugins → Add New

### Configuration

- WordPress configuration: Automatically generated during setup
- Replit settings: Edit `.replit` file
- Environment: Edit `replit.nix` for additional packages

## Troubleshooting

### Setup Issues

- **Download fails**: Check internet connection in Replit
- **Permission errors**: Ensure write permissions in project directory
- **PHP errors**: Check that all required extensions are loaded

### WordPress Issues

- **Database errors**: Ensure SQLite Database Integration plugin is activated
- **Plugin conflicts**: Deactivate plugins one by one to identify conflicts
- **Theme issues**: Switch to default theme temporarily

### Replit-Specific

- **Session timeout**: Replit sessions may timeout - just restart the project
- **Storage limits**: Be mindful of Replit's storage limits
- **Performance**: Consider using Replit's paid plans for better performance

## Performance Notes

SQLite is perfect for:
- Development environments
- Small to medium websites
- Sites with moderate traffic
- Testing and staging

For high-traffic production sites, consider migrating to a traditional hosting provider with MySQL.

## Security

For production use:
1. Change default passwords
2. Keep WordPress, themes, and plugins updated
3. Use strong admin passwords
4. Regular backups
5. Consider HTTPS (available on Replit Pro)

## License

This setup is provided as-is. WordPress and BuddyPress are licensed under GPL v2.

## Support

- WordPress: https://wordpress.org/support/
- BuddyPress: https://buddypress.org/support/
- SQLite Integration: https://github.com/WordPress/sqlite-database-integration
- Replit: https://docs.replit.com/

---

Made with ❤️ for lightweight WordPress deployments on Replit 