const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {

        colors: colors,

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            gridTemplateColumns: {
                // Simple 16 column grid
               '16': 'repeat(16, minmax(0, 1fr))',
      
                // Complex site-specific column configuration
               'footer': '200px minmax(900px, 1fr) 100px',
            },
            gridColumn: {
                'span-16': 'span 16 / span 16',
            },
            gridColumnStart: {
                '13': '13',
                '14': '14',
                '15': '15',
                '16': '16',
                '17': '17',
            },
            gridColumnEnd: {
                '13': '13',
                '14': '14',
                '15': '15',
                '16': '16',
                '17': '17',
            },
            gridTemplateColumns: {
                // Simple 16 column grid
               '16': 'repeat(16, minmax(0, 1fr))',
      
                // Complex site-specific column configuration
               'footer': '200px minmax(900px, 1fr) 100px',
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            colors: {
                blue: {
                  450: '#5F99F7'
                },
            },
            /*  gap: {
                '11': '2.75rem',
                '13': '3.25rem',
            }, */
            /* margin: {
                '-72': '-18rem',
            },  */
            /* width: {
                '1/7': '14.2857143%',
                '2/7': '28.5714286%',
                '3/7': '42.8571429%',
                '4/7': '57.1428571%',
                '5/7': '71.4285714%',
                '6/7': '85.7142857%',
            }, */

        },

        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }
      
            'md': '768px',
            // => @media (min-width: 768px) { ... }
      
            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }
      
            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }
      
            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }

          },

        fontSize: {
            'xs': '.75rem',
            'sm': '.875rem',
            'tiny': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
        } ,

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.trueGray,
            indigo: colors.indigo,
            red: colors.rose,
            yellow: colors.amber,
        },

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            blue: {
              light: '#85d7ff',
              DEFAULT: '#1fb6ff',
              dark: '#009eeb',
            },
            pink: {
              light: '#ff7ce5',
              DEFAULT: '#ff49db',
              dark: '#ff16d1',
            },
            gray: {
              darkest: '#1f2d3d',
              dark: '#3c4858',
              DEFAULT: '#c0ccda',
              light: '#e0e6ed',
              lightest: '#f9fafc',
            }
        },

        colors: {
            // Build your palette here
            transparent: 'transparent',
            current: 'currentColor',
            gray: colors.trueGray,
            red: colors.red,
            blue: colors.sky,
            yellow: colors.amber,
        },

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.coolGray,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue
        },
        /* spacing: {
            sm: '8px',
            md: '16px',
            lg: '24px',
            xl: '48px',
        },
    
        margin: {
            sm: '8px',
            md: '16px',
            lg: '24px',
            xl: '48px',
        },
 */
        /* height: {
            sm: '8px',
            md: '16px',
            lg: '24px',
            xl: '48px',
        }, */
   },
 
    variants: {
        extend: {
            opacity: ['disabled'],
            gridTemplateColumns: ['hover', 'focus'],
            justifyContent: ['hover', 'focus'],
            //gap: ['hover', 'focus'],
            //margin: ['hover', 'focus'],
            //height: ['hover', 'focus'],
            //width: ['hover', 'focus'], */
        },
        gridColumn: ['responsive', 'hover'],
        gridColumnStart: ['responsive', 'hover'],
        gridColumnEnd: ['responsive', 'hover'],
    },

    plugins: [require('@tailwindcss/forms'), 
    require('@tailwindcss/typography'),
    require('tailwindcss-rtl')],
};
