const webpack = require('./webpack.config');
const Uglify = require("uglifyjs-webpack-plugin");

webpack.mode = "production";
webpack.plugins.push(new Uglify({
    cache: true,
    parallel: true,
    sourceMap: true //https://github.com/webpack/webpack/issues/6614#issuecomment-369159984
}));
module.exports = webpack;