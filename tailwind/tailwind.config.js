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
		tooltipArrows: () => ({
			'gray-arrow': {
				borderColor: '#E9E9E9',
				borderWidth: 1,
				backgroundColor: '#E9E9E9',
				size: 15,
				offset: 50,
			},
		}),
		// Extend the default Tailwind theme.
		extend: {
			fontFamily: {
				dm: ['DM Sans', 'sans-serif'],
			},
			backgroundImage: {
				services: 'url("../theme/assets/bg-services.png")',
				gradientLeft:
					'linear-gradient(90deg, #FFFFFF 20%, rgba(255, 255, 255, 0) 100%)',
				gradientRight:
					'linear-gradient(270deg, #FFFFFF 20%, rgba(255, 255, 255, 0) 100%)',
				gradientBottom:
					'linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, #FFFFFF 100%)',
			},
			colors: {
				mainBlack: '#111F24',
				textBlack: '#272727',
				textGray: '#575757',
				textLightGray: '#A5A5A5',
				textSecondary: '#B2B2B2',
				textDarkGray: '#4D4D4D',
				accent: '#ED5623',
				accentHover: '#ef6739',
				lightGray: '#E9E9E9',
				lightGrayBg: '#F8F8FA',
				lightGrayBorder: '#D8D8D8',
				darkGray: '#646464',
				grayBorder: '#D6D6D6',
				inputGray: '#F3F4F4',
				chipGray: '#243135',
			},
			boxShadow: {
				testimonial: '5px 5px 30px -5px #012D191A',
				bestValuePackage: '0px 0px 20px 0px #00000026',
				whiteShadowTop: '1px -26px 62px 0px rgba(255,255,255,0.79)',
			},
			animation: {
				'loop-scroll': 'loop-scroll 50s linear infinite',
				marquee: 'marquee 80s linear infinite',
				marquee2: 'marquee2 80s linear infinite',
			},
			keyframes: {
				'loop-scroll': {
					from: { transform: 'translateX(0)' },
					to: { transform: 'translateX(-100%)' },
				},
				marquee: {
					'0%': { transform: 'translateX(0%)' },
					'100%': { transform: 'translateX(-100%)' },
				},
				marquee2: {
					'0%': { transform: 'translateX(-100%)' },
					'100%': { transform: 'translateX(0)' },
				},
			},
			fontSize: {
				button: ['1rem', { lineHeight: '1rem', fontWeight: '700' }],
				displayLarge: ['4.25rem', { lineHeight: '4.25rem', fontWeight: '900' }],
				title: ['1.125rem', { lineHeight: '1.4625rem', fontWeight: '500' }],
				bodySmall: ['0.875rem', { lineHeight: '1.05rem', fontWeight: '400' }],
				bodyBold: ['1rem', { lineHeight: '1.2rem', fontWeight: '700' }],
				bodyRegular: ['1rem', { lineHeight: '1.3rem', fontWeight: '400' }],
				h1: ['3.375rem', { lineHeight: '3.375rem', fontWeight: '800' }],
				h1Mobile: ['2.5rem', { lineHeight: '2.5rem', fontWeight: '800' }],
				h2: ['3rem', { lineHeight: '3.3rem', fontWeight: '800' }],
				h3: ['2.75rem', { lineHeight: '2.75rem', fontWeight: '800' }],
				h4Regular: ['2rem', { lineHeight: '2.4rem', fontWeight: '400' }],
				h4Bold: ['2rem', { lineHeight: '2rem', fontWeight: '700' }],
				h5Regular: ['1.25rem', { lineHeight: '1.875rem', fontWeight: '400' }],
				h5Bold: ['1.25rem', { lineHeight: '1.5rem', fontWeight: '700' }],
			},
			transitionDuration: {
				800: '800ms',
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
			'3xl': '1921px',
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
		require('tailwindcss-tooltip-arrow-after')(),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
