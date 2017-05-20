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

    'styles': './assets/css/main.scss',
    'tracking': './assets/css/tracking.scss'
  },
  output: {
    publicPath: "/",
    path: __dirname + '/web',
    filename: "js/[name].js",
  },
  module: {
    loaders: [
      {
          test: /\.scss$/,
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader!sass-loader' })
      },
      {
          test: /\.css$/,
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })
      },
      {
          test: /\.(eot|ttf|woff|woff2)$/,
          loader: 'file-loader?name=fonts/[name].[ext]'
      },
      {
          test: /\.(svg|png)$/,
          loader: 'file-loader?name=css/images/[name].[ext]'
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
      new ExtractTextPlugin({filename: "css/[name].css", allChunks: true})
  ],
  devServer: {
      headers: { "Access-Control-Allow-Origin": "http://192.168.99.100,http://127.0.0.1" },
      contentBase: __dirname + '/web',
      stats: 'minimal',
      compress: true,
      public: '192.168.99.100:8080'
  }
};
