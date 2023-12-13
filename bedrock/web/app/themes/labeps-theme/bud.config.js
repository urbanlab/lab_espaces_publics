/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/docs/sage sage documentation}
 * @see {@link https://bud.js.org/guides/configure bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/docs/bud.entry}
   * @see {@link https://bud.js.org/docs/bud.assets}
   */
  app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .assets(['images']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/docs/bud.setPublicPath}
   */
  app.setPublicPath('/app/themes/sage/public/');

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/docs/bud.setUrl}
   * @see {@link https://bud.js.org/docs/bud.setProxyUrl}
   * @see {@link https://bud.js.org/docs/bud.watch}
   */
  app
    // .setUrl('http://localhost:1200')
    // .setProxyUrl('http://localhost:1200')
    .watch(['resources/views', 'app']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setOption('styles', {
      spacing: {
        blockGap: "1.5rem"
      },
      blocks: {
        "core/paragraph": {
          typography: {
            fontFamily: 'var(--wp--preset--font-family--mono)',
          },
          color: {
            text:"var(--wp--preset--color--black)"
          },
          spacing: {
            margin: {
                top: 0,
                bottom: "var(--wp--preset--spacing--50)"
            }
          }
        },
        "core/heading": {
          typography: {
            fontWeight: 700,
            fontFamily: 'var(--wp--preset--font-family--sans)',
            color: {
              text:'var(--wp--preset--color--black)'
            }
          },
          spacing: {
            margin: {
                top: 0,
                bottom: "var(--wp--preset--spacing--50)"
            }
          },
          elements: {
            h1: {
              color: {
                text: 'var(--wp--preset--color--primary)'
              },
              typography: {
                fontSize: 'var(--wp--preset--font-size-4xl)',
                lineHeight: '2.986rem',
              }
            },
            h2: {
              typography: {
                fontSizes: 'var(--wp--preset--font-size-3xl)',
                lineHeight: '2.488rem'
              }
            },
            h3: {
              typography: {
                fontSizes: 'var(--wp--preset--font-size-2xl)',
                lineHeight: '2.074rem'
              }
            },
            h4: {
              typography: {
                fontSizes: 'var(--wp--preset--font-size-xl)',
                lineHeight: '1.728rem'
              }
            }
          },
        }
      },
    })
    .setSettings({
      appearanceTools: false,
      useRootPaddingAwareAlignments: true,
      layout: {
        contentSize: "840px",
        wideSize: "1100px"
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        background: "var(--wp--preset--color--white)",
        duotone: []
      },
      // custom: {
      //   spacing: {},
      //   typography: {
      //     'font-size': {},
      //     'line-height': {},
      //   },
      // },
      spacing: {
        padding: false,
        blockGap: false,
        spacingScale: {
          operator: "*",
          increment: 2,
          steps: 7,
          mediumStep: 1.5,
          unit: "rem"
            }
      },
      typography: {
        customFontSize: false,
        fontSizes: [],
        fontWeight: false,
        fontStyle: false
      },
      blocks: {
        "core/paragraph": {
          color: {
            custom: true
          },
          custom: {},
          layout: {},
          spacing: {},
          typography: {
            customFontSize: false,
            fontFamily: {
              fontFamily: "Roboto Regular, sans-serif",
              name: "Roboto Regular",
              slug: "mono"
            }
          }
      },
      "core/heading": {
        color:{
          palette:[
            {
              "color": "#e2092f",
              "name": "Primary",
              "slug": "primary"
            },
            {
              "color": "#00a887",
              "name": "Secondary",
              "slug": "secondary"
            },
            {
              "color": "#ffffff",
              "name": "White",
              "slug": "white"
            },
            {
              "color": "#000000",
              "name": "Black",
              "slug": "black"
            }
          ]
        },
        typography: {
          customFontSize: false,
          fontSize: [],
          dropCap: false,
          lineHeight: false,
          fontFamily: {
            fontFamily: "Inter var, sans-serif",
            name: "Inter var",
            slug: "sans"
        },
        }
      },
        "core/button": {
          typography: {
            fontSize: [
              {
                slug: "medium",
                size: "1.5rem",
                name: "medium"
              }
            ]
          }
        }
      } 
    })
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize()
};