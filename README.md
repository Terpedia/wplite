# WPLite - WordPress with SQLite and BuddyPress

A lightweight WordPress setup using SQLite as the database backend, perfect for development, testing, or small deployments. This setup includes BuddyPress for social networking features.

## Features

- 🚀 WordPress with SQLite database (no MySQL required!)
- 👥 BuddyPress ready for social features
- 🐳 Docker-based setup for easy deployment
- 📦 Persistent data storage
- 🪶 Lightweight - uses SQLite instead of MySQL

## Prerequisites

- Docker and Docker Compose installed on your system
- Git (for cloning this repository)

## Quick Start

1. **Clone or download this repository**:
   ```bash
   git clone https://github.com/yourusername/wplite.git
   cd wplite
   ```

2. **Start the WordPress container**:
   ```bash
   ./start.sh
   ```

3. **Access WordPress**:
   - WordPress: http://localhost:8080

## Initial Setup

### 1. WordPress Installation

1. Visit http://localhost:8080
2. Follow the WordPress installation wizard:
   - Choose your language
   - Set site title
   - Create admin username and password
   - Enter your email
   - Click "Install WordPress"

### 2. Activate SQLite Integration

1. Log in to WordPress admin dashboard
2. Go to **Plugins** → **Installed Plugins**
3. Find **SQLite Database Integration** and click **Activate**

### 3. Install BuddyPress

1. In WordPress admin, go to **Plugins** → **Add New**
2. Search for "BuddyPress"
3. Click **Install Now** on the official BuddyPress plugin
4. After installation, click **Activate**
5. Follow the BuddyPress setup wizard to configure:
   - Components (Activity Streams, User Groups, etc.)
   - Pages (Members directory, Activity streams, etc.)
   - Settings

## Project Structure

```
wplite/
├── data/                    # SQLite database files
├── wp-content/             # WordPress content (plugins, themes, uploads)
│   ├── plugins/            # WordPress plugins
│   ├── themes/             # WordPress themes
│   └── uploads/            # Media uploads
├── scripts/                # Setup scripts and configuration
│   ├── wp-config.php       # WordPress configuration
│   ├── db.php              # SQLite database adapter
│   └── sqlite-database-integration/  # SQLite plugin files
├── docker-compose.yml      # Docker configuration
├── start.sh               # Start script
├── stop.sh                # Stop script
└── README.md              # This file
```

## Managing Your Site

### Starting and Stopping

**Start the containers**:
```bash
./start.sh
```

**Stop the containers**:
```bash
./stop.sh
```

**View logs**:
```bash
docker-compose logs -f
```

### Backup and Restore

Your data is stored in:
- `data/` - SQLite database files
- `wp-content/` - All your WordPress content

To backup, simply copy these directories. To restore, replace them with your backup.

### BuddyPress Features

Once activated, BuddyPress adds:
- **Activity Streams** - Facebook-like activity updates
- **User Profiles** - Extended user profiles
- **User Groups** - Create and manage user groups
- **Private Messaging** - Send private messages between users
- **Friend Connections** - Users can connect as friends
- **Notifications** - Real-time notifications

## Customization

### Adding Themes

1. Download or purchase WordPress themes
2. Extract them to `wp-content/themes/`
3. Activate in WordPress admin → Appearance → Themes

### Adding Plugins

1. Download plugins to `wp-content/plugins/`
2. Or install directly from WordPress admin → Plugins → Add New

### Configuration

- WordPress configuration: Edit `scripts/wp-config.php`
- Docker settings: Edit `docker-compose.yml`

## Troubleshooting

### Container won't start
- Ensure Docker is running
- Check if port 8080 is available
- Run `docker-compose logs` to see error messages

### Can't access WordPress
- Wait 10-15 seconds after starting containers
- Check if containers are running: `docker ps`
- Try accessing http://127.0.0.1:8080 instead

### Database errors
- Ensure SQLite Database Integration plugin is activated
- Check `data/` directory permissions
- Review logs: `docker-compose logs wordpress`

## Performance Notes

SQLite is perfect for:
- Development environments
- Small to medium websites
- Sites with moderate traffic
- Testing and staging

For high-traffic production sites, consider migrating to MySQL/MariaDB.

## Security

For production use:
1. Change default passwords
2. Update WordPress security keys in `wp-config.php`
3. Keep WordPress, themes, and plugins updated
4. Use HTTPS (configure reverse proxy)
5. Regular backups

## License

This setup is provided as-is. WordPress and BuddyPress are licensed under GPL v2.

## Support

- WordPress: https://wordpress.org/support/
- BuddyPress: https://buddypress.org/support/
- SQLite Integration: https://github.com/WordPress/sqlite-database-integration

---

Made with ❤️ for lightweight WordPress deployments 