import {VueLoaderPlugin} from "vue-loader";

const path = require('path');

module.exports = {
    mode: 'development',
    entry: './vue/app.js',
    output: {
        path: path.join(__dirname, 'web').join(__dirname, 'js'),
        filename: 'vue.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
            {
                test: /\.js$/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.scss$/,
                use: [
                    'style-loader',
                    'css-loader',
                    'sass-loader'
                ]
            }
        ],
    },
    plugins: [
        new VueLoaderPlugin()
    ]
};