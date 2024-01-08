'use strict';

const replaceInFile = require('replace-in-file');

const {VERSION} = process.env;

const replaceInFileWithLog = async (options) => {
	const results = await replaceInFile(options);
	console.log('Replacement results:', results, 'options: ', options);
};

const run = async () => {
	try {
		await replaceInFileWithLog( {
			files: './assets/scss/style.scss',
			from: /Version:.*$/m,
			to: `Version: ${ VERSION }`,
		} );

		await replaceInFileWithLog( {
			files: './functions.php',
			from: /WPKIT_ELEMENTOR_VERSION', '(.*?)'/m,
			to: `WPKIT_ELEMENTOR_VERSION', '${ VERSION }'`,
		} );

	} catch (err) {
		console.error('Error occurred:', err);
		process.exit(1);
	}
}

run();
