#!/bin/bash

# WPLite - WordPress with SQLite Startup Script
echo "🚀 Starting WordPress with SQLite and BuddyPress..."

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    echo "Visit https://docs.docker.com/get-docker/ for installation instructions."
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose first."
    echo "Visit https://docs.docker.com/compose/install/ for installation instructions."
    exit 1
fi

# Create necessary directories if they don't exist
echo "📁 Creating necessary directories..."
mkdir -p wp-content/{plugins,themes,uploads}
mkdir -p data
mkdir -p scripts

# Copy SQLite integration files to wp-content
echo "📦 Setting up SQLite integration..."
if [ -d "scripts/sqlite-database-integration" ]; then
    cp -r scripts/sqlite-database-integration wp-content/plugins/
    echo "✅ SQLite integration plugin copied to wp-content/plugins/"
fi

# Start Docker containers
echo "🐳 Starting Docker containers..."
docker-compose up -d

# Wait for WordPress to be ready
echo "⏳ Waiting for WordPress to be ready..."
sleep 10

# Display access information
echo ""
echo "✅ WordPress with SQLite is now running!"
echo ""
echo "🌐 WordPress URL: http://localhost:8080"
echo ""
echo "📝 Setup Instructions:"
echo "1. Visit http://localhost:8080 to complete WordPress installation"
echo "2. After setup, go to Plugins and activate 'SQLite Database Integration'"
echo "3. Install BuddyPress from the WordPress plugin repository"
echo ""
echo "💡 To stop the containers, run: ./stop.sh"
echo "💡 To view logs, run: docker-compose logs -f"
echo "" 