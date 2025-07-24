<?php
/**
 * WPLite - WordPress with SQLite for Replit
 * Main entry point that redirects to WordPress
 */

// Check if WordPress is already installed
if (file_exists('wp-config.php')) {
    // WordPress is installed, redirect to it
    header('Location: wp-load.php');
    exit;
}

// WordPress not installed, show setup page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WPLite - WordPress Setup</title>
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
        .setup-button {
            display: inline-block;
            background: #0073aa;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .setup-button:hover {
            background: #005a87;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .feature {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .feature h3 {
            color: #0073aa;
            margin-top: 0;
        }
        .status {
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
        <h1>🚀 WPLite - WordPress with SQLite</h1>
        
        <div class="status">
            ✅ Ready to install WordPress with SQLite database
        </div>
        
        <p>This is a lightweight WordPress setup designed to run on Replit with SQLite as the database backend. Perfect for development, testing, or small deployments.</p>
        
        <div class="features">
            <div class="feature">
                <h3>🪶 Lightweight</h3>
                <p>Uses SQLite instead of MySQL - no database server required!</p>
            </div>
            <div class="feature">
                <h3>👥 BuddyPress Ready</h3>
                <p>Pre-configured for social networking features</p>
            </div>
            <div class="feature">
                <h3>🐳 Replit Optimized</h3>
                <p>Designed specifically for Replit's environment</p>
            </div>
            <div class="feature">
                <h3>📦 Self-Contained</h3>
                <p>Everything you need in one place</p>
            </div>
        </div>
        
        <div style="text-align: center;">
            <a href="setup.php" class="setup-button">🚀 Install WordPress Now</a>
        </div>
        
        <hr style="margin: 40px 0;">
        
        <h2>What's Included:</h2>
        <ul>
            <li>WordPress 6.8.2 with latest security updates</li>
            <li>SQLite Database Integration plugin</li>
            <li>BuddyPress plugin (ready to install)</li>
            <li>Optimized for Replit's PHP environment</li>
            <li>Simple setup process</li>
        </ul>
        
        <h2>System Requirements:</h2>
        <ul>
            <li>PHP 8.1+ (✅ Available)</li>
            <li>SQLite3 extension (✅ Available)</li>
            <li>GD extension for images (✅ Available)</li>
            <li>cURL extension (✅ Available)</li>
        </ul>
    </div>
</body>
</html> 