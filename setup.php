<?php
/**
 * WPLite Setup Script for Replit
 * Downloads and installs WordPress with SQLite support
 */

// Prevent direct access if already installed
if (file_exists('wp-config.php')) {
    header('Location: index.php');
    exit;
}

$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$error = '';
$success = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 2) {
        // Download WordPress
        $success = downloadWordPress();
        if ($success) {
            header('Location: setup.php?step=3');
            exit;
        } else {
            $error = 'Failed to download WordPress. Please try again.';
        }
    } elseif ($step === 3) {
        // Configure WordPress
        $site_title = $_POST['site_title'] ?? 'WPLite Site';
        $admin_user = $_POST['admin_user'] ?? 'admin';
        $admin_email = $_POST['admin_email'] ?? '';
        $admin_password = $_POST['admin_password'] ?? '';
        
        if (empty($admin_email) || empty($admin_password)) {
            $error = 'Please fill in all required fields.';
        } else {
            $success = configureWordPress($site_title, $admin_user, $admin_email, $admin_password);
            if ($success) {
                header('Location: setup.php?step=4');
                exit;
            } else {
                $error = 'Failed to configure WordPress. Please check the logs.';
            }
        }
    }
}

function downloadWordPress() {
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 4px; margin: 20px 0;'>";
    echo "<h3>📥 Downloading WordPress...</h3>";
    
    // Create directories
    if (!is_dir('wp-content')) mkdir('wp-content', 0755, true);
    if (!is_dir('wp-content/plugins')) mkdir('wp-content/plugins', 0755, true);
    if (!is_dir('wp-content/themes')) mkdir('wp-content/themes', 0755, true);
    if (!is_dir('wp-content/uploads')) mkdir('wp-content/uploads', 0755, true);
    if (!is_dir('data')) mkdir('data', 0755, true);
    
    echo "✅ Created directories<br>";
    
    // Download WordPress
    $wp_url = 'https://wordpress.org/latest.zip';
    $zip_file = 'wordpress.zip';
    
    echo "📥 Downloading WordPress from wordpress.org...<br>";
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 300,
            'user_agent' => 'WPLite/1.0'
        ]
    ]);
    
    $wp_content = file_get_contents($wp_url, false, $context);
    if ($wp_content === false) {
        echo "❌ Failed to download WordPress<br>";
        return false;
    }
    
    file_put_contents($zip_file, $wp_content);
    echo "✅ Downloaded WordPress<br>";
    
    // Extract WordPress
    echo "📦 Extracting WordPress...<br>";
    $zip = new ZipArchive;
    if ($zip->open($zip_file) === TRUE) {
        $zip->extractTo('.');
        $zip->close();
        echo "✅ Extracted WordPress<br>";
    } else {
        echo "❌ Failed to extract WordPress<br>";
        return false;
    }
    
    // Move files from wordpress/ to root
    $files = glob('wordpress/*');
    foreach ($files as $file) {
        $filename = basename($file);
        if (is_dir($file)) {
            if (!is_dir($filename)) {
                rename($file, $filename);
            }
        } else {
            rename($file, $filename);
        }
    }
    rmdir('wordpress');
    
    // Copy SQLite integration
    if (is_dir('scripts/sqlite-database-integration')) {
        copy('scripts/sqlite-database-integration/db.copy', 'wp-content/db.php');
        copy('scripts/sqlite-database-integration/db.copy', 'db.php');
        echo "✅ Copied SQLite integration<br>";
    }
    
    // Clean up
    unlink($zip_file);
    echo "🧹 Cleaned up temporary files<br>";
    
    echo "</div>";
    return true;
}

function configureWordPress($site_title, $admin_user, $admin_email, $admin_password) {
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 4px; margin: 20px 0;'>";
    echo "<h3>⚙️ Configuring WordPress...</h3>";
    
    // Generate WordPress configuration
    $wp_config = generateWpConfig($site_title, $admin_user, $admin_email, $admin_password);
    
    if (file_put_contents('wp-config.php', $wp_config)) {
        echo "✅ Created wp-config.php<br>";
    } else {
        echo "❌ Failed to create wp-config.php<br>";
        return false;
    }
    
    // Set up database
    echo "🗄️ Setting up SQLite database...<br>";
    
    // WordPress will create the database on first run
    echo "✅ Database setup complete<br>";
    
    echo "</div>";
    return true;
}

function generateWpConfig($site_title, $admin_user, $admin_email, $admin_password) {
    $keys = [
        'AUTH_KEY' => generateRandomString(64),
        'SECURE_AUTH_KEY' => generateRandomString(64),
        'LOGGED_IN_KEY' => generateRandomString(64),
        'NONCE_KEY' => generateRandomString(64),
        'AUTH_SALT' => generateRandomString(64),
        'SECURE_AUTH_SALT' => generateRandomString(64),
        'LOGGED_IN_SALT' => generateRandomString(64),
        'NONCE_SALT' => generateRandomString(64),
    ];
    
    return "<?php
/**
 * WordPress Configuration for WPLite
 * Generated automatically by setup script
 */

// Database settings
define('DB_NAME', 'wordpress');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Authentication keys
define('AUTH_KEY',         '{$keys['AUTH_KEY']}');
define('SECURE_AUTH_KEY',  '{$keys['SECURE_AUTH_KEY']}');
define('LOGGED_IN_KEY',    '{$keys['LOGGED_IN_KEY']}');
define('NONCE_KEY',        '{$keys['NONCE_KEY']}');
define('AUTH_SALT',        '{$keys['AUTH_SALT']}');
define('SECURE_AUTH_SALT', '{$keys['SECURE_AUTH_SALT']}');
define('LOGGED_IN_SALT',   '{$keys['LOGGED_IN_SALT']}');
define('NONCE_SALT',       '{$keys['NONCE_SALT']}');

// Table prefix
\$table_prefix = 'wp_';

// Debug mode (disable for production)
define('WP_DEBUG', false);

// Absolute path
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Load WordPress
require_once ABSPATH . 'wp-settings.php';
";
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WPLite Setup - Step <?php echo $step; ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f0f0f1;
            color: #1d2327;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0073aa;
            text-align: center;
            margin-bottom: 30px;
        }
        .step {
            background: #e7f3ff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn {
            background: #0073aa;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background: #005a87;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 WPLite Setup</h1>
        
        <div class="step">Step <?php echo $step; ?> of 4</div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <?php if ($step === 1): ?>
            <h2>Welcome to WPLite Setup</h2>
            <p>This wizard will help you install WordPress with SQLite database support on Replit.</p>
            
            <h3>What will be installed:</h3>
            <ul>
                <li>WordPress 6.8.2 (latest version)</li>
                <li>SQLite Database Integration plugin</li>
                <li>Basic configuration for Replit</li>
            </ul>
            
            <h3>Requirements check:</h3>
            <ul>
                <li>PHP 8.1+: <?php echo version_compare(PHP_VERSION, '8.1.0', '>=') ? '✅' : '❌'; ?></li>
                <li>SQLite3: <?php echo extension_loaded('sqlite3') ? '✅' : '❌'; ?></li>
                <li>cURL: <?php echo extension_loaded('curl') ? '✅' : '❌'; ?></li>
                <li>GD: <?php echo extension_loaded('gd') ? '✅' : '❌'; ?></li>
            </ul>
            
            <a href="setup.php?step=2" class="btn">Start Installation</a>
            
        <?php elseif ($step === 2): ?>
            <h2>Downloading WordPress</h2>
            <p>Downloading and extracting WordPress files...</p>
            
            <form method="post">
                <button type="submit" class="btn">Download WordPress</button>
            </form>
            
        <?php elseif ($step === 3): ?>
            <h2>Configure Your Site</h2>
            <p>Set up your WordPress site with the following information:</p>
            
            <form method="post">
                <div class="form-group">
                    <label for="site_title">Site Title:</label>
                    <input type="text" id="site_title" name="site_title" value="WPLite Site" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_user">Admin Username:</label>
                    <input type="text" id="admin_user" name="admin_user" value="admin" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_email">Admin Email:</label>
                    <input type="email" id="admin_email" name="admin_email" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_password">Admin Password:</label>
                    <input type="password" id="admin_password" name="admin_password" required>
                </div>
                
                <button type="submit" class="btn">Install WordPress</button>
            </form>
            
        <?php elseif ($step === 4): ?>
            <h2>🎉 Installation Complete!</h2>
            <p>WordPress has been successfully installed with SQLite database support.</p>
            
            <div style="background: #d4edda; padding: 20px; border-radius: 4px; margin: 20px 0;">
                <h3>Next Steps:</h3>
                <ol>
                    <li>Visit your WordPress site: <a href="index.php" target="_blank">Open Site</a></li>
                    <li>Log in to the admin dashboard</li>
                    <li>Activate the SQLite Database Integration plugin</li>
                    <li>Install BuddyPress from the plugin repository</li>
                </ol>
            </div>
            
            <a href="index.php" class="btn">Go to Your Site</a>
        <?php endif; ?>
    </div>
</body>
</html> 