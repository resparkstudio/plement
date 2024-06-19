// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			fontFamily: {
				dm: ['DM Sans', 'sans-serif'],
			},
			colors: {
				textBlack: '#272727',
				textGray: '#575757',
				textDarkGray: '#4D4D4D',
				accent: '#ED5623',
				accentHover: '#ef6739',
				lightGray: '#E9E9E9',
				lightGrayBg: '#F8F8FA',
			},
			animation: {
				'loop-scroll': 'loop-scroll 50s linear infinite',
			},
			keyframes: {
				'loop-scroll': {
					from: { transform: 'translateX(0)' },
					to: { transform: 'translateX(-100%)' },
				},
			},
		},
		container: {
			default: '1.25rem',
			sm: '2rem',
			lg: '4rem',
		},
		screens: {
			sm: '600px',
			md: '768px',
			lg: '984px',
			xl: '1312px',
			'2xl': '1440px',
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
