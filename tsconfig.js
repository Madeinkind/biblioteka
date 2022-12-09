{
	"compilerOptions": {
	"target": "es5",
	"module": "es2015",
	"moduleResolution": "node",
	"strict": true,
	"noImplicitAny": true,
	"noImplicitThis": true,
	"noImplicitReturns": true,
	"experimentalDecorators": true,
	"esModuleInterop": true,
	"sourceMap": true,
	// "rootDir": ".",
	"baseUrl": ".",
	"paths": {
		"@/*": [ "src/*" ]
	},
	"types": [
		"webpack-env",
		"jest"
	],
	"lib": [
		"esnext",
		"dom",
		"dom.iterable",
		"scripthost"
	],
	},
	"include": [
		"src",
		"./src/*.js",
		"./src/*.ts",
		"./src/*.vue",
		"./src/**/*.js",
		"./src/**/*.ts",
		"./src/**/*.vue",
		"./app/**/**/*.js",
		"./src/**/**/*.ts",
		"./src/**/**/*.vue",
	],
	"exclude": [
		"node_modules",
		"build"
	]
}