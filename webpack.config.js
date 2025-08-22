const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

module.exports = {
  ...defaultConfig,
  entry: {
    main: './assets/js/scroll.js',
    style: './style.css',
    dev: './assets/css/dev.css',
    alt: './assets/css/alt.css'
  },
  output: {
    ...defaultConfig.output,
    path: path.resolve(__dirname, 'build'),
    filename: 'js/[name].js',
    clean: true
  },
  optimization: {
    ...defaultConfig.optimization,
    // Remove the splitChunks optimization that was bundling all CSS together
    splitChunks: false,
    // Ensure CSS minification is enabled
    minimize: true,
    minimizer: [
      // Add CSS minifier
      new CssMinimizerPlugin(),
      // Keep existing minimizers
      ...defaultConfig.optimization.minimizer || []
    ]
  },
  // Ensure we're in production mode for proper minification
  mode: 'production'
};
