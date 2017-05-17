var webpack = require("webpack");
var ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
  entry: {
    cart: './js/app/cart/index.jsx',
    tracking: './js/app/tracking/index.jsx',
    homepage: './js/app/homepage/index.js',
    'order-payment': './js/app/order/payment.js',
    'order-tracking': ['whatwg-fetch', './js/app/order/tracking.jsx'],
    'profile-deliveries': './js/app/profile/deliveries.js',
    'restaurant-form': './js/app/restaurant/form.jsx',
    'delivery-form': './js/app/delivery/form.jsx',

    'styles': [
      './assets/css/antd.min.css',
      './assets/css/circle.css',
      './assets/css/font-awesome.min.css',
      './assets/css/leaflet-beautify-marker.css',
      './assets/css/styles.css',
    ]
  },
  output: {
    publicPath: "/",
    path: __dirname + '/web',
    filename: "js/[name].js",
  },
  module: {
    loaders: [
      // Extract css files
      {
          test: /\.css$/,
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })
      },
      {
          test: /\.(eot|ttf|woff|woff2)$/,
          loader: 'file-loader?name=web/fonts/[name].[ext]'
      },
      {
          test: /\.(svg)$/,
          loader: 'file-loader?name=web/[name].[ext]'
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
      new ExtractTextPlugin({filename: "css/styles.css", allChunks: true})
  ],
  devServer: {
      headers: { "Access-Control-Allow-Origin": "http://192.168.99.100" },
      contentBase: __dirname + '/web',
      stats: 'minimal',
      compress: true,
      public: '192.168.99.100:8080'
  }
};
