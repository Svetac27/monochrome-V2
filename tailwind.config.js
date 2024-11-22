const remSizes = {}
const pxSizes = {}
const percentSizes = {}
const fontSizes = {}
const vhSizes = {}
const vwSizes = {}
const twoCol = {}
const threeCol = {}
const fourCol = {}
const fiveCol = {}
const sixCol = {}
const sevenCol = {}
const eightCol = {}
const nineCol = {}
const tenCol = {}
const elevenCol = {}
const twelveCol = {}
for (let i = 1; i <= 200; i++) {
  remSizes[i] = `${i * 0.25}rem`

  if (i <= 70) {
    pxSizes[`${i}px`] = `${i}px`
  }

  if (i <= 30) {
    fontSizes[i] = `${i * 0.25}rem`
  }

  if (i <= 10) {
    percentSizes[`${i * 10}%`] = `${i * 10}%`

    // viewport sizes
    vhSizes[`${i * 10}vh`] = `${i * 10}vh`
    vwSizes[`${i * 10}vw`] = `${i * 10}vw`
  }

  // grid system
  if (i < 12) {
    if (i < 2) {
      twoCol[`${i}/2`] = `${(i / 2) * 100}%`
    }
    if (i < 3) {
      threeCol[`${i}/3`] = `${(i / 3) * 100}%`
    }
    if (i < 4) {
      fourCol[`${i}/4`] = `${(i / 4) * 100}%`
    }
    if (i < 5) {
      fiveCol[`${i}/5`] = `${(i / 5) * 100}%`
    }
    if (i < 6) {
      sixCol[`${i}/6`] = `${(i / 6) * 100}%`
    }
    if (i < 7) {
      sevenCol[`${i}/7`] = `${(i / 7) * 100}%`
    }
    if (i < 8) {
      eightCol[`${i}/8`] = `${(i / 8) * 100}%`
    }
    if (i < 9) {
      nineCol[`${i}/9`] = `${(i / 9) * 100}%`
    }
    if (i < 10) {
      tenCol[`${i}/10`] = `${(i / 10) * 100}%`
    }
    if (i < 11) {
      elevenCol[`${i}/11`] = `${(i / 11) * 100}%`
    }
    if (i < 12) {
      twelveCol[`${i}/12`] = `${(i / 12) * 100}%`
    }
  }
}

const gridColumns = {
  ...twoCol,
  ...threeCol,
  ...fourCol,
  ...fiveCol,
  ...sixCol,
  ...sevenCol,
  ...eightCol,
  ...nineCol,
  ...tenCol,
  ...elevenCol,
  ...twelveCol
}

module.exports = {
experimental: {
    optimizeUniversalDefaults: false
},
  safelist: [
    'items-start',
    'rounded-20px',
    'rounded-30px',
    'pt-65px',
    'lg:pt-185px',
    'lg:text-6',
    'md:w-full',
    'md:block',
    'md:flex',
    'tablet-single-column',
    {
      pattern: /^text-/, 
      variants: ['hover', 'focus'], // Optionally safelist variants as well
    },
    {
      // Safelist all b-{color} and a-{color} classes
      pattern: /^(left-color|right-color)-/
    },
  ],
  content: [
  './**/**/**/*.{html,php}',
  './**/**/*.{html,php}',
  './**/*.{html,php}',
  './*.{html,php}'
  ],
  prefix: '',
  important: false,
  separator: ':',
  mode: 'jit',
  theme: {
    colors: {
      black: '#011A1E',
      gray: {
        DEFAULT: '#2C606A',
        mid: '#e3ecec'
      },
      transparent: 'transparent',
      white: '#FFFFFF',
      red: {
        DEFAULT: '#E62A4F',
        mid: '#F9C9D3'
      },
      green: {
        DEFAULT: '#D9DC42',
        success: '#63D666'
      },
      yellow: '#FCBE04',
      blue: {
        DEFAULT: '#09A3BF',
        light: '#C9DCDC',
        mid: '#D9EAF3'
      }
    },
    spacing: {
      0: '0',
      ...pxSizes,
      ...remSizes,
      ...percentSizes,
      ...gridColumns
    },
    screens: {
      xxs: '320px',
      xs: '375px',
      sxs: '425px',
      sm: '640px',
      md: '768px',
      tab: '992px',
      lg: '1024px',
      xl: '1280px',
      xxl: '1551px'
    },
    fontFamily: {
      gt: '"GT Medium", sans-serif',
      'gt-light-italic': '"GT Light Italic", sans-serif',
      gilroy: '"Gilroy-Regular", sans-serif',
      'gilroy-semi-bold': '"Gilroy-SemiBold", sans-serif',
      'gilroy-bold': '"Gilroy-Bold", sans-serif',
      'gilroy-extra-bold': '"Gilroy-ExtraBold", sans-serif'
    },
    fontSize: {
      ...pxSizes,
      ...fontSizes
    },
    fontWeight: {
      hairline: '100',
      thin: '100',
      light: '200',
      normal: '300',
      medium: '400',
      semibold: '500',
      bold: '600',
      extrabold: '700',
      black: '800'
    },
    lineHeight: {
      initial: 'initial',
      xxs: '0.5rem',
      xs: '0.625rem',
      caption: '0.875rem',
      none: '1rem',
      tight: '1.25rem',
      snug: '1.375rem',
      normal: '1.5rem',
      plain: '1.5',
      relaxed: '1.625rem',
      h2: '1.75rem',
      h1: '1.875rem',
      loose: '2rem',
      lg: '2.5rem',
      xl: '3rem',
      jumbo: '3.750rem',
      ...remSizes
    },
    letterSpacing: {
      tighter: '-0.05em',
      tight: '-0.025em',
      normal: '0',
      wide: '0.025em',
      wider: '0.05em',
      widest: '0.1em'
    },
    backgroundPosition: {
      bottom: 'bottom',
      center: 'center',
      left: 'left',
      'left-bottom': 'left bottom',
      'left-top': 'left top',
      right: 'right',
      'right-bottom': 'right bottom',
      'right-top': 'right top',
      top: 'top'
    },
    backgroundSize: {
      auto: 'auto',
      cover: 'cover',
      contain: 'contain',
      full: '100% 100%',
      'full-w-auto': '100% auto',
      'full-h-auto': 'auto 100%'
    },
    borderWidth: {
      '1/2': '0.5px',
      DEFAULT: '1px',
      0: '0',
      ...pxSizes
    },
    borderColor: theme => ({
      ...theme('colors'),
      DEFAULT: theme('colors.green', 'currentColor')
    }),
    borderRadius: {
      ...pxSizes,
      none: '0',
      sm: '0.125rem',
      DEFAULT: '1.25rem',
      lg: '0.5rem',
      full: '100%',
    },
    borderOpacity: {
      0: '0',
      5: '0.05',
      10: '0.10',
      15: '0.15',
      20: '0.20',
      25: '0.25',
      30: '0.30',
      35: '0.35',
      40: '0.40',
      45: '0.45',
      50: '0.5',
      55: '0.55',
      60: '0.60',
      65: '0.65',
      70: '0.70',
      75: '0.75',
      80: '0.80',
      85: '0.85',
      90: '0.90',
      95: '0.95',
      100: '1'
    },
    backgroundOpacity: {
      0: '0',
      5: '0.05',
      10: '0.10',
      15: '0.15',
      20: '0.20',
      25: '0.25',
      30: '0.30',
      35: '0.35',
      40: '0.40',
      45: '0.45',
      50: '0.5',
      55: '0.55',
      60: '0.60',
      65: '0.65',
      70: '0.70',
      75: '0.75',
      80: '0.80',
      85: '0.85',
      90: '0.90',
      95: '0.95',
      100: '1'
    },
    cursor: {
      auto: 'auto',
      DEFAULT: 'default',
      pointer: 'pointer',
      wait: 'wait',
      text: 'text',
      move: 'move',
      'not-allowed': 'not-allowed'
    },
    width: theme => ({
      auto: 'auto',
      ...theme('spacing'),
      ...vwSizes,
      full: '100%',
      screen: '100vw',
      unset: 'unset'
    }),
    height: theme => ({
      auto: 'auto',
      ...theme('spacing'),
      ...vhSizes,
      full: '100%',
      screen: '100vh',
      'full-less-menu': 'calc(100vh - 96px)'
    }),
    minWidth: {
      0: '0',
      ...pxSizes,
      ...remSizes,
      ...gridColumns,
      ...vwSizes,
      full: '100%'
    },
    minHeight: {
      0: '0',
      ...pxSizes,
      ...remSizes,
      ...gridColumns,
      ...vhSizes,
      full: '100%',
      screen: '100vh',
      'full-less-menu': 'calc(100vh - 96px)'
    },
    maxWidth: theme => ({
      ...theme('spacing'),
      ...gridColumns,
      ...vwSizes,
      '2xl': '42rem',
      '3xl': '48rem',
      '4xl': '56rem',
      '5xl': '64rem',
      '6xl': '72rem',
      1400: '1400px',
      full: '100%',
      none: 'none'
    }),
    maxHeight: {
      full: '100%',
      screen: '100vh',
      none: 'none',
      ...gridColumns,
      ...remSizes,
      ...vhSizes
    },
    padding: theme => ({
      page: '1.25rem',
      ...theme('spacing')
    }),
    margin: (theme, { negative }) => ({
      ...gridColumns,
      ...negative(gridColumns),
      ...theme('spacing'),
      ...negative(theme('spacing')),
      auto: 'auto',
      page: '5%'
    }),
    objectPosition: {
      bottom: 'bottom',
      center: 'center',
      left: 'left',
      'left-bottom': 'left bottom',
      'left-top': 'left top',
      right: 'right',
      'right-bottom': 'right bottom',
      'right-top': 'right top',
      top: 'top'
    },
    boxShadow: {
      DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      xl: '0 7px 25px -5px rgba(0, 0, 0, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
      outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
      none: 'none',
      bottom: '0 0px 12px -2px  rgba(0, 0, 0, 0.25)'
    },
    zIndex: {
      auto: 'auto',
      0: '0',
      10: '10',
      20: '20',
      30: '30',
      40: '40',
      50: '50',
      60: '60',
      90: '90',
      100: '100'
    },
    opacity: {
      0: '0',
      5: '0.05',
      10: '0.10',
      15: '0.15',
      20: '0.20',
      25: '0.25',
      30: '0.30',
      35: '0.35',
      40: '0.40',
      45: '0.45',
      50: '0.5',
      55: '0.55',
      60: '0.60',
      65: '0.65',
      70: '0.70',
      75: '0.75',
      80: '0.80',
      85: '0.85',
      90: '0.90',
      95: '0.95',
      100: '1'
    },
    fill: {
      current: 'currentColor'
    },
    stroke: {
      current: 'currentColor'
    },
    flex: {
      1: '1 1 0%',
      auto: '1 1 auto',
      initial: '0 1 auto',
      none: 'none'
    },
    flexGrow: {
      0: '0',
      DEFAULT: '1'
    },
    flexShrink: {
      0: '0',
      DEFAULT: '1'
    },
    order: {
      first: '-9999',
      last: '9999',
      none: '0',
      1: '1',
      2: '2',
      3: '3',
      4: '4',
      5: '5',
      6: '6',
      7: '7',
      8: '8',
      9: '9',
      10: '10',
      11: '11',
      12: '12'
    },
    listStyleType: {
      none: 'none',
      disc: 'disc',
      decimal: 'decimal'
    },
    inset: (theme, { negative }) => ({
      ...theme('spacing'),
      ...negative(theme('spacing')),
      0: '0',
      '1/2': '50%',
      1: '0.725rem',
      1.5: '1.5rem',
      2: '1.725rem',
      2.5: '2.5rem',
      3: '3rem',
      4: '4rem',
      5: '5rem',
      6: '6rem',
      8: '7rem',
      12: '10rem',
      '-0.05': '-0.05rem',
      '-0.8': '-0.625rem',
      '-1': '-0.725rem',
      '-1.5': '-1.25rem',
      '-2': '-1.725rem',
      '-3': '-2.5rem',
      '-4': '-4rem',
      '-12': '-10rem',
      '-5px': '-5px',
      '-1/2': '-50%',
      full: '100%',
      auto: 'auto'
    }),
    rotate: {
      '-180': '-180deg',
      '-90': '-90deg',
      90: '90deg',
      180: '180deg'
    },
    container: {}
  },
  variants: {
    appearance: ['responsive'],
    alignContent: ['responsive', 'hover', 'focus'],
    alignItems: ['responsive'],
    alignSelf: ['responsive'],
    backgroundAttachment: ['responsive', 'hover', 'focus'],
    backgroundColor: ['responsive', 'hover', 'focus', 'important'],
    backgroundOpacity: ['responsive', 'hover', 'focus', 'important'],
    backgroundPosition: ['responsive', 'important'],
    backgroundRepeat: ['responsive'],
    backgroundSize: ['responsive', 'important'],
    borderCollapse: ['responsive'],
    borderColor: ['responsive', 'hover', 'focus', 'important'],
    borderOpacity: ['responsive', 'hover', 'focus', 'important'],
    borderRadius: ['responsive'],
    borderStyle: ['responsive'],
    borderWidth: ['responsive', 'hover', 'focus', 'important'],
    boxShadow: ['responsive', 'hover', 'focus'],
    cursor: ['responsive', 'important'],
    display: ['responsive', 'important'],
    fill: ['responsive'],
    flexDirection: ['responsive'],
    flexWrap: ['responsive'],
    flex: ['responsive'],
    flexGrow: ['responsive'],
    flexShrink: ['responsive'],
    float: ['responsive'],
    fontFamily: ['responsive'],
    fontSize: ['responsive', 'important'],
    fontSmoothing: ['responsive'],
    fontStyle: ['responsive'],
    fontWeight: ['responsive', 'hover', 'focus', 'important'],
    height: ['responsive', 'important'],
    inset: ['responsive', 'important'],
    justifyContent: ['responsive', 'hover', 'focus', 'important'],
    letterSpacing: ['responsive'],
    lineHeight: ['responsive', 'important'],
    listStylePosition: ['responsive'],
    listStyleType: ['responsive'],
    margin: ['responsive', 'important'],
    maxHeight: ['responsive'],
    maxWidth: ['responsive'],
    minHeight: ['responsive', 'important'],
    minWidth: ['responsive'],
    objectFit: ['responsive'],
    objectPosition: ['responsive'],
    opacity: ['responsive'],
    order: ['responsive'],
    outline: ['responsive', 'focus'],
    overflow: ['responsive', 'important', 'hover'],
    padding: ['responsive', 'important'],
    pointerEvents: ['responsive'],
    position: ['responsive', 'important'],
    resize: ['responsive'],
    rotate: ['responsive', 'important'],
    stroke: ['responsive'],
    tableLayout: ['responsive'],
    textAlign: ['responsive', 'important'],
    textColor: ['responsive', 'hover', 'focus', 'active', 'important'],
    textTransform: ['responsive'],
    textDecoration: ['responsive', 'hover', 'focus'],
    transform: ['responsive'],
    userSelect: ['responsive'],
    verticalAlign: ['responsive'],
    visibility: ['responsive', 'important'],
    whitespace: ['responsive', 'hover', 'important'],
    wordBreak: ['responsive'],
    width: ['responsive', 'important'],
    zIndex: ['responsive', 'important']
  },
  corePlugins: {},
  plugins: [
    require('@tailwindcss/line-clamp'),
    function ({ addVariant, e }) {
      addVariant('important', ({ container }) => {
        container.walkRules((rule) => {
          rule.selector = `.\\!${rule.selector.slice(1)}`
          rule.walkDecls((decl) => {
            decl.important = true
          })
        })
      })
      addVariant('placeholder', ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`placeholder${separator}${className}`)}:placeholder`
        })
      })
    },
    function ({ addUtilities, theme, e }) {
      const colors = theme('colors');
      const beforeUtilities = {};
      const afterUtilities = {};

      // Generate classes for :before and :after pseudo-elements
      Object.keys(colors).forEach((colorName) => {
        const colorValue = colors[colorName];

        if (typeof colorValue === 'object') {
          // Handle color shades
          Object.keys(colorValue).forEach((shade) => {
            const className = shade === 'DEFAULT' ? `${colorName}` : `${colorName}-${shade}`;

            beforeUtilities[`.left-color-${e(className)}::before`] = {
              color: colorValue[shade],
            };
            afterUtilities[`.right-color-${e(className)}::after`] = {
              color: colorValue[shade],
            };
          });
        } else {
          // Handle plain colors
          beforeUtilities[`.left-color-${e(colorName)}::before`] = {
            color: colorValue,
          };
          afterUtilities[`.right-color-${e(colorName)}::after`] = {
            color: colorValue,
          };
        }
      });

      // Add the utilities to Tailwind
      addUtilities(beforeUtilities, ['before']);
      addUtilities(afterUtilities, ['after']);
    }
  ]
}
