#!/bin/bash

# Build script for MateusWetah WordPress FSE theme
# This script builds the theme and creates a zip file for distribution

set -e

# Theme version - update this single variable to change version
THEME_VERSION="1.1.1"

echo "🚀 Starting MateusWetah FSE theme build process..."

# Check if node_modules exists, if not install dependencies
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
fi

# Clean previous builds
echo "🧹 Cleaning previous builds..."
npm run clean

# Build for production
echo "🔨 Building theme assets..."
npm run build

# Create theme directory for zip with correct structure
echo "📁 Preparing theme files for distribution..."
mkdir -p mateuswetah-theme

# Copy theme files to distribution directory
cp -r functions.php mateuswetah-theme/
cp -r inc/ mateuswetah-theme/
cp -r parts/ mateuswetah-theme/
cp -r templates/ mateuswetah-theme/
cp -r theme.json mateuswetah-theme/
cp -r readme.txt mateuswetah-theme/
cp -r screenshot.png mateuswetah-theme/
cp -r style.css mateuswetah-theme/

# Copy built assets
cp -r build/ mateuswetah-theme/

# Copy fonts (they don't need processing)
echo "📁 Copying fonts..."
if [ -d "assets/fonts" ]; then
    mkdir -p mateuswetah-theme/assets/fonts
    cp -r assets/fonts/* mateuswetah-theme/assets/fonts/
fi

# Create theme zip file - zip from within the theme directory to get flat structure
echo "📦 Creating theme zip file..."
cd mateuswetah-theme
zip -r "../mateuswetah.zip" . -x "*.map" "*.js.map" "*.css.map"
cd ..

# Clean up temporary directory
rm -rf mateuswetah-theme

echo "✅ Theme build completed successfully!"
echo "📁 Build directory: build/"
echo "📦 Theme zip: mateuswetah.zip"
echo "🎯 Files generated:"
ls -la build/
echo ""
echo "📦 Theme zip file:"
ls -la "mateuswetah.zip"
