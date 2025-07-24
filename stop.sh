#!/bin/bash

# WPLite - WordPress with SQLite Stop Script
echo "🛑 Stopping WordPress containers..."

# Stop Docker containers
docker-compose down

echo "✅ WordPress containers stopped successfully!"
echo ""
echo "💡 Your data is preserved in the 'data' and 'wp-content' directories"
echo "💡 To start again, run: ./start.sh"
echo "" 