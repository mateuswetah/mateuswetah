# wp-scripts Build System for MateusWetah FSE Theme

This WordPress FSE (Full Site Editing) theme now includes a modern build system using `@wordpress/scripts` (wp-scripts) for optimizing and minifying assets.

## 🚀 Quick Start

### Prerequisites
- Node.js (version 18 or higher recommended)
- npm (comes with Node.js)

### Security Status
- **Current wp-scripts version**: 30.22.0 (latest stable)
- **Vulnerabilities**: 7 moderate (development dependencies only)
- **Production safety**: ✅ Safe for production use

### First Time Setup
```bash
npm install
npm run build
```

## 📦 Available Scripts

### Core Build Commands
- **`npm run build`** - Build optimized assets for production
- **`npm run start`** - Development mode with hot reloading
- **`npm run dev`** - Development mode with PHP file copying

### Code Quality & Linting
- **`npm run lint:js`** - Check JavaScript code quality
- **`npm run lint:css`** - Check CSS code quality
- **`npm run lint:md`** - Check Markdown files
- **`npm run lint:pkg-json`** - Validate package.json
- **`npm run format`** - Format code with Prettier

### Theme Distribution
- **`npm run theme-zip`** - Generate theme zip file for distribution
- **`npm run clean`** - Clean build directory
- **`npm run build:analyze`** - Build with bundle analysis

### WordPress Theme Update Compatibility
- **Zip structure**: Theme files are at the root level (not nested)
- **Zip filename**: `mateuswetah.zip` (clean, version-free naming)
- **WordPress admin**: Can properly update themes via Appearance > Themes
- **File structure**: Matches WordPress theme requirements exactly

## 🔄 Recent Upgrades

### Security Update (August 2024)
- **Upgraded from**: @wordpress/scripts@27.9.0
- **Upgraded to**: @wordpress/scripts@30.22.0
- **Security improvements**: Fixed 4 high-severity vulnerabilities
- **Breaking changes**: None affecting this theme's build process
- **Status**: ✅ All builds and theme packaging working correctly

## 🏗️ Build System Features

### What wp-scripts Provides
- **Zero-config setup** - Works out of the box
- **Modern JavaScript support** - ES6+ with Babel transpilation
- **CSS processing** - PostCSS with autoprefixer
- **Asset optimization** - Minification and tree shaking
- **Hot reloading** - Instant feedback during development
- **Built-in testing** - Jest integration
- **Code quality tools** - ESLint and Prettier

### Asset Processing
- **CSS**: PostCSS processing, autoprefixing, minification
- **JavaScript**: Babel transpilation, tree shaking, minification
- **Fonts**: Copied as-is (no processing needed)

## 📁 Build Output Structure

After building, your assets will be organized in the `build/` directory:

```
build/
├── style.css          # Main theme styles (minified, 10.6KB)
├── style-rtl.css      # RTL version for right-to-left languages
├── dev.css            # Portfolio/Development styles (minified, 679B)
├── dev-rtl.css        # RTL version of development styles
├── alt.css            # Blog/Alternative styles (minified, 687B)
├── alt-rtl.css        # RTL version of alternative styles
└── js/
    ├── main.js        # Main JavaScript (minified, 783B)
    ├── alt.js         # Alternative styles JS
    ├── dev.js         # Development styles JS
    └── style.js       # Main styles JS
```

**Note**: Each CSS file is processed separately and minified for optimal performance. The conditional styles (`dev.css`, `alt.css`) are only loaded on specific pages.

## 🔧 WordPress Integration

### Smart Asset Loading
The theme automatically detects whether built assets exist and falls back to source files if needed:

- **Production sites** use optimized assets from `build/` directory
- **Development environments** can work without building
- **Smooth deployment** without breaking functionality

### WordPress Asset Integration
The theme now properly utilizes wp-scripts generated `.asset.php` files for:
- **Automatic versioning** - Cache busting when files change
- **Dependency management** - Proper script loading order
- **WordPress best practices** - Native wp_enqueue_script/style integration

### Conditional CSS Loading
- **`style.css`** - Always loaded (main theme styles)
- **`dev.css`** - Only loaded on portfolio/development pages
- **`alt.css`** - Only loaded on blog/alternative pages

### Editor Support
- Gutenberg editor uses minified styles when available
- Conditional styles are loaded based on post type
- Maintains all existing functionality

## 🎯 Development Workflow

### During Development
```bash
npm run dev          # Watch mode with PHP copying
npm run start        # Standard development mode
```

### Before Deployment
```bash
npm run build        # Production build
npm run theme-zip    # Generate distribution zip
```

## 📦 Theme Distribution

### Using npm run theme-zip
```bash
npm run theme-zip
```

This command will:
1. Build all assets using wp-scripts
2. Copy all theme files to a distribution directory
3. Create a complete theme zip file ready for distribution
4. Include all necessary theme files (PHP, templates, assets, etc.)
5. Exclude source maps and development files

### What's Included in the Zip
- All theme PHP files (`functions.php`, `inc/`, etc.)
- Template parts and templates
- Theme configuration (`theme.json`, `style.css`)
- Built and optimized assets
- Font files
- Screenshot and readme

## 🔍 Performance Benefits

### Asset Optimization
- **CSS minification**: Reduces file sizes significantly
  - `style.css`: 13.5KB → 10.6KB (21% reduction)
  - `dev.css`: 736B → 679B (8% reduction)
  - `alt.css`: 744B → 687B (8% reduction)
- **JavaScript minification**: Optimizes script loading
- **Tree shaking**: Removes unused code
- **Autoprefixer**: Ensures cross-browser compatibility

### WordPress-Specific Optimizations
- **Conditional loading**: Only loads styles needed for current page
- **Efficient enqueuing**: Uses WordPress best practices
- **Cache-friendly**: Versioned assets for better caching

## 🛠️ Configuration Files

### webpack.config.js
Extends wp-scripts default configuration with:
- Custom entry points for your assets
- Output directory configuration
- CSS optimization settings
- Explicit CSS minification using css-minimizer-webpack-plugin

### postcss.config.js
Configures CSS processing with:
- PostCSS preset-env for modern CSS features
- Autoprefixer for browser compatibility

### .gitignore
Excludes build artifacts and dependencies from version control

## 🚨 Important Notes

### Build Requirements
- Always run `npm run build` before deployment
- Include the `build/` directory in your deployment
- Source files remain unchanged - build system is additive

### Fallback System
- Theme gracefully falls back to source files if build fails
- Ensures theme works even without building
- Perfect for development and testing environments

### FSE Theme Considerations
- Build system respects FSE theme structure
- Maintains compatibility with block editor
- Supports theme.json and template parts

### Why Custom Theme-Zip Script?
While wp-scripts provides `plugin-zip`, it's designed specifically for plugins and doesn't include all the necessary theme files. Our custom `theme-zip` script ensures all theme components are properly packaged.

## 🔮 Advanced Features

### Bundle Analysis
```bash
npm run build:analyze
```
Analyzes your bundle to identify optimization opportunities.

### Custom Webpack Configuration
The `webpack.config.js` file extends wp-scripts defaults, allowing you to:
- Add custom loaders
- Configure additional plugins
- Optimize for specific use cases

### Development vs Production
- **Development**: Source maps, unminified code, hot reloading
- **Production**: Minified assets, optimized bundles, no source maps

## 📚 References

- [wp-scripts Development Guide](https://kinsta.com/blog/wp-scripts-development/)
- [WordPress Theme Build Process](https://developer.wordpress.org/themes/advanced-topics/build-process/)
- [@wordpress/scripts Documentation](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/)

## 🎉 Benefits Summary

1. **Modern Development**: Use latest CSS and JavaScript features
2. **Performance**: Optimized assets for faster loading
3. **Workflow**: Streamlined development and deployment process
4. **Standards**: Follows WordPress development best practices
5. **Maintainability**: Consistent build process across projects
6. **FSE Ready**: Optimized for Full Site Editing themes
7. **Complete Packaging**: Full theme distribution with custom zip script
8. **Proper Minification**: CSS and JS are properly minified for production
9. **Conditional Loading**: CSS files load only when needed

---

**Your FSE theme is now production-ready with enterprise-grade asset optimization powered by wp-scripts! 🎯**
