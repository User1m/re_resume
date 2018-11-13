const webpack = require('webpack');

module.exports = {
    target: "node",
    mode: "development",
    entry: "./release/index.js",
    devtool: 'source-map',
    output: {
        path: __dirname,
        filename: "bundle.js",
        library: "",
        libraryTarget: "commonjs-module",
    },
    node: {
        __dirname: false,
        __filename: false
    },
    plugins: [
        new webpack.DefinePlugin({
            "global.GENTLY": false
        }),
        new webpack.BannerPlugin({ // https://decembersoft.com/posts/how-to-fix-your-server-side-typescript-call-stack-with-webpack-bannerplugin/
            banner: 'require("source-map-support").install();',
            raw: true,
            entryOnly: false
        })
    ],
};