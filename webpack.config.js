var webpack = require("webpack");
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var ManifestPlugin = require('webpack-manifest-plugin');

module.exports = {
  entry: {
    cart: './js/app/cart/index.jsx',
    tracking: './js/app/tracking/index.jsx',
    homepage: './js/app/homepage/index.js',
    'order-payment': './js/app/order/payment.js',
    'order-tracking': ['whatwg-fetch', './js/app/order/tracking.jsx'],
    'profile-deliveries': './js/app/profile/deliveries.js',
    'profile-restaurant': './js/app/profile/restaurant.js',
  },
  output: {
    publicPath: "/js",
    path: __dirname + '/web/js',
    filename: "[name].[hash].js",
  },
  module: {
    loaders: [
      // Extract css files
      {
          test: /\.css$/,
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })
      },
      // Optionally extract less files
      // or any other compile-to-css language
      {
          test: /\.less$/,
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader!less-loader' })
      },
      {
        test: /\.json$/,
        loader: "json-loader"
      },
      {
        test: /\.jsx?/,
        include: __dirname + '/js',
        loader: "babel-loader"
      }
    ]
  },
  // Use the plugin to specify the resulting filename (and add needed behavior to the compiler)
  plugins: [
      new ExtractTextPlugin("[name].[hash].css"),
      new ManifestPlugin({ basePath: 'js/' })
  ],
  devServer: {
      contentBase: __dirname + '/web',
      stats: 'minimal',
      compress: true
  }
};