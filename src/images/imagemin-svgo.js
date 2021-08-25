const imageminSvgo = require('imagemin-svgo');

async function main() {
	const imagemin = (await import('imagemin')).default;
	const files = await imagemin(['./icons/*.svg'], {
		destination: '../../build/images',
		plugins: [
			imageminSvgo({
				plugins: [
					{ cleanupNumericValues: { floatPrecision: 2 } },
					{ removeViewBox: false },
					{ removeStyleElement: true },
					{ removeUselessStrokeAndFill: true },
					{ removeTitle: true }
				],
				multipass: true
			})
		]
	});

	console.log(files);
}

main();