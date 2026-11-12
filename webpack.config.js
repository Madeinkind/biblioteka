const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')
const webpack = require('webpack')

module.exports = {
	entry: [
		'./src/main.js',
	],
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, 'public'),
		libraryExport: 'default',
		publicPath: "auto",
	},
	devtool: 'source-map',
	mode: 'production',
	watch: false,
	watchOptions: {
		ignored: /node_modules/,
		aggregateTimeout: 200,
		poll: 1000,
	},
	resolve: {
		alias: {
			'@': path.resolve(__dirname, 'src'),
			//vue$: 'vue/dist/vue.runtime.esm-bundler.js',
		},
		extensions: ['.ts', '.js', '.css', '.scss', '.sass', '.vue'],
		fallback: {
			"stream": require.resolve("stream-browserify"),
			"buffer": require.resolve("buffer"),
		},
		modules: [
			path.join(__dirname, 'node_modules'),
		],
	},
	module: {
		rules: [
			{
				test: /\.js$/i,
				loader: 'babel-loader',
			},
			{
				test: /\.tsx?$/i,
				use: {
					loader: 'ts-loader',
					options: {
						appendTsSuffixTo: [/\.vue$/],
					},
				},
				exclude: /node_modules/,
			},
			{
				test: /\.vue$/i,
				loader: 'vue-loader',
				options: {
					loaders: {
						ts: 'ts-loader',
					},
					esModule: true,
				}
			},
			{
				test: /\.css$/i,
				use: [
					'vue-style-loader',
					'css-loader',
				],
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					// Creates `style` nodes from JS strings
					"style-loader",
					// Translates CSS into CommonJS
					"css-loader",
					// Compiles Sass to CSS
					"sass-loader",
				],
			},
			{
				test: /\.styl/,
				use: [
					{
						loader: "style-loader",
					},
					{
						loader: "css-loader",
					},
					{
						loader: "stylus-loader",
						options: {},
					},
				],
			},
			{
				test: /\.(png|svg|jpg|jpeg|gif|ico)$/i,
				type: "asset/resource",
			},
			{
				test: /\.(png|jpg|gif)$/i,
				loader: 'file-loader',
				options: {
					publicPath: 'auto',
					postTransformPublicPath: (p) => `__webpack_public_path__ + ${p}`,
				},
			},
		],
	},
	plugins: [
		new VueLoaderPlugin(),
		new webpack.DefinePlugin({
			__VUE_OPTIONS_API__: true,
			__VUE_PROD_DEVTOOLS__: false,
		}),
		new webpack.ProvidePlugin({
			Buffer: ['buffer', 'Buffer'],
		}),
		new webpack.ProvidePlugin({
			process: 'process/browser',
		}),
	],
};