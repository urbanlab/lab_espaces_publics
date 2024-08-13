/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/docs/sage sage documentation}
 * @see {@link https://bud.js.org/guides/configure bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
import bs from 'browser-sync-webpack-plugin';

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
    .entry('blocks', ['blocks'])
    .entry('blocks', ['@scripts/blocks/index.js', '@scripts/blocks/style.scss'])
    .assets(['images', 'fonts'])
    .watch('resources/views/**/*', 'app/**/*')
    .use(new bs({proxy: 'http://localhost:8080/'}));

  app.provide({
    jquery: ['jQuery', '$'],
  });

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/docs/bud.setPublicPath}
   */
  app.setPublicPath('/app/themes/labeps-theme/public/');

  app.watch(['resources/views', 'app']);

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
    .setOption('version', 3)
    .setOption('styles', {
      color: {
        background: 'var(--wp--preset--color--white)',
      },
      spacing: {
        blockGap: '2rem',
        margin: {
          top: '4rem',
          bottom: '4rem',
          left: '1.5rem',
          right: '1.5rem',
        },
        padding: {
          top: '100px',
          right: '0px',
          bottom: '0px',
          left: '0px',
        },
      },
      elements: {
        h1: {
          color: {
            text: 'var(--wp--preset--color--primary)',
          },
          typography: {
            fontFamily: 'var(--wp--preset--font-family--sans)',
            fontSize: '3.75rem',
            lineHeight: '4rem',
            fontWeight: '700',
          },
        },
        h2: {
          color: {
            text: 'var(--wp--preset--color--primary)',
          },
          typography: {
            fontFamily: 'var(--wp--preset--font-family--sans)',
            fontSize: '3.75rem',
            lineHeight: '3.5rem',
            fontWeight: '700',
          },
        },
        h3: {
          typography: {
            fontFamily: 'var(--wp--preset--font-family--sans)',
            fontSize: '2.5rem',
            lineHeight: '3rem',
          },
        },
        h4: {
          typography: {
            fontFamily: 'var(--wp--preset--font-family--sans)',
            fontSize: '1.875rem',
            lineHeight: '2.5rem',
          },
        },
      },
      blocks: {
        'core/paragraph': {
          typography: {
            fontFamily: 'var(--wp--preset--font-family--mono)',
            fontSize: '1.25rem',
            lineHeight: '1.75rem',
          },
          color: {
            text: 'var(--wp--preset--color--black)',
          },
          spacing: {
            padding: {
              top: '1rem',
              bottom: '1rem',
            },
          },
        },
        'core/heading': {
          typography: {
            fontWeight: '700',
            fontFamily: 'var(--wp--preset--font-family--sans)',
            lineHeight: '1.2',
          },
          color: {
            text: 'var(--wp--preset--color--black)',
          },
          spacing: {
            margin: {
              top: 'var(--wp--preset--spacing--50)',
              bottom: 'var(--wp--preset--spacing--50)',
            },
          },
          elements: {
            h3: {
              fontSize: '2.5rem',
            },
          },
        },
        'core/group': {
          spacing: {
            padding: {
              top: '2.5rem',
              bottom: '2.5rem',
              left: '1.5rem',
              right: '1.5rem',
            },
          },
        },
        'core/button': {
          typography: {
            fontWeight: '700',
          },
          border: {
            radius: '3px',
          },
          spacing: {
            padding: {
              top: '0.5rem',
              bottom: '0.5rem',
              left: '1.5rem',
              right: '1.5rem',
            },
          },
          variations: {
            outline: {
              border: {
                color: 'var(--wp--preset--color--black)',
                radius: '3px',
                style: 'solid',
                width: '1px',
              },
              spacing: {
                padding: {
                  top: '0.5rem',
                  bottom: '0.5rem',
                  left: '1.5rem',
                  right: '1.5rem',
                },
              },
            },
          },
        },
        'core/list-item': {
          typography: {
            fontFamily: 'var(--wp--preset--font-family--mono)',
            fontSize: '1rem',
            lineHeight: '1.5rem',
          },
          color: {
            text: 'var(--wp--preset--color--black)',
          },
          spacing: {
            padding: {
              bottom: '15px',
            },
          },
        },
      },
    })
    .setOption('customTemplates', [
      {
        name: 'home-page',
        title: 'Home',
        postTypes: ['page'],
      },
      {
        name: 'about-page',
        title: 'About',
        postTypes: ['page'],
      },
      {
        name: 'ressources-page',
        title: 'Ressources',
        postTypes: ['post'],
      },
      {
        name: 'actualités-page',
        title: 'Actualités',
        postTypes: ['articles'],
      },
      {
        name: 'archives-page',
        title: 'Archives cpt',
        postTypes: ['cpt'],
      },
    ])
    .setOption('templateParts', [
      {
        name: 'my-template-part',
        title: 'Header',
        area: 'header',
      },
    ])
    .setSettings({
      appearanceTools: false,
      useRootPaddingAwareAlignments: true,
      layout: {
        contentSize: '840px',
        wideSize: '1100px',
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        palette: [],
        background: true,
        duotone: [],
        gradients: [],
        link: true,
        text: true,
      },
      spacing: {
        margin: true,
        padding: true,
        blockGap: true,
        spacingScale: {
          operator: '*',
          increment: 2,
          steps: 7,
          mediumStep: 1.5,
          unit: 'rem',
        },
      },
      typography: {
        fluid: true,
        customFontSize: false,
        fontSizes: [],
        fontWeight: false,
        fontStyle: false,
        letterSpacing: false,
        textDecoration: false,
        textTransform: false,
        lineHeight: true,
      },
      blocks: {
        'core/paragraph': {
          color: {
            defaultPalette: false,
            palette: [
              {
                color: '#e2092f',
                name: 'Primary',
                slug: 'primary',
              },
              {
                color: '#158579',
                name: 'Secondary',
                slug: 'secondary',
              },
              {
                color: '#000000',
                name: 'Black',
                slug: 'black',
              },
              {
                color: '#ffffff',
                name: 'White',
                slug: 'white',
              },
            ],
          },
          custom: {},
          layout: {},
          spacing: {},
          typography: {
            fluid: true,
            customFontSize: false,
            fontWeight: true,
            fontSizes: [
              {
                name: 'Small',
                size: '1rem',
                slug: 'small',
                fluid: {
                  min: '0.875rem',
                  max: '1rem',
                },
              },
              {
                name: 'Base',
                size: '1.25rem',
                slug: 'base',
                fluid: {
                  min: '1rem',
                  max: '1.25rem',
                },
              },
            ],
            fontFamilies: [
              {
                fontFamily: 'Roboto Regular, sans-serif',
                name: 'Roboto Regular',
                slug: 'mono',
              },
            ],
          },
        },
        'core/heading': {
          color: {
            palette: [
              {
                color: '#e2092f',
                name: 'Primary',
                slug: 'primary',
              },
              {
                color: '#158579',
                name: 'Secondary',
                slug: 'secondary',
              },
              {
                color: '#ffffff',
                name: 'White',
                slug: 'white',
              },
              {
                color: '#000000',
                name: 'Black',
                slug: 'black',
              },
            ],
          },
        },
        'core/button': {
          spacing: {
            margin: false,
            padding: false,
          },
          color: {
            palette: [
              {
                color: '#e2092f',
                name: 'Primary',
                slug: 'primary',
              },
              {
                color: '#158579',
                name: 'Secondary',
                slug: 'secondary',
              },
              {
                color: '#ffffff',
                name: 'White',
                slug: 'white',
              },
              {
                color: '#000000',
                name: 'Black',
                slug: 'black',
              },
            ],
          },
          typography: {
            fluid: true,
            customFontSize: false,
            fontSizes: [
              {
                name: 'Small',
                size: '1rem',
                slug: 'small',
                fluid: {
                  min: '0.875rem',
                  max: '1rem',
                },
              },
              {
                name: 'Base',
                size: '1.25rem',
                slug: 'base',
                fluid: {
                  min: '1rem',
                  max: '1.25rem',
                },
              },
            ],
            fontFamilies: [
              {
                fontFamily: 'Roboto Regular, sans-serif',
                name: 'Roboto Regular',
                slug: 'mono',
              },
            ],
          },
        },
        'core/group': {},
        'core/list-item': {
          color: {
            palette: [
              {
                color: '#e2092f',
                name: 'Primary',
                slug: 'primary',
              },
              {
                color: '#158579',
                name: 'Secondary',
                slug: 'secondary',
              },
              {
                color: '#ffffff',
                name: 'White',
                slug: 'white',
              },
              {
                color: '#000000',
                name: 'Black',
                slug: 'black',
              },
            ],
          },
          typography: {
            fluid: true,
            customFontSize: false,
            fontWeight: true,
            fontSizes: [
              {
                name: 'Small',
                size: '1rem',
                slug: 'small',
                fluid: {
                  min: '0.875rem',
                  max: '1rem',
                },
              },
              {
                name: 'Base',
                size: '1.25rem',
                slug: 'base',
                fluid: {
                  min: '1rem',
                  max: '1.25rem',
                },
              },
              {
                name: 'Large',
                size: '1.563rem',
                slug: 'large',
                fluid: {
                  min: '1.25rem',
                  max: '1.563rem',
                },
              },
            ],
            fontFamilies: [
              {
                fontFamily: 'Roboto Regular, sans-serif',
                name: 'Roboto Regular',
                slug: 'mono',
              },
            ],
          },
        },
      },
    })
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize()
    .useTailwindSpacing();
};
