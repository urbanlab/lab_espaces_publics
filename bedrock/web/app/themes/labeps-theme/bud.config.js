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
    .assets(['images'])
    .watch('resources/views/**/*', 'app/**/*')
    .use(new bs({proxy: 'http://localhost:8080/'}));

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
    .setOption(
      'styles',
      {
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
        },
        elements: {
          h1: {
            color: {
              text: 'var(--wp--preset--color--primary)',
            },
            typography: {
              fontSize: 'var(--wp--preset--font-size--4-xl)',
              lineHeight: '2.986rem',
            },
          },
          h2: {
            typography: {
              fontSize: 'var(--wp--preset--font-size--3-xl)',
              lineHeight: '2.488rem',
            },
          },
          h3: {
            typography: {
              fontSize: 'var(--wp--preset--font-size--2-xl)',
              lineHeight: '2.074rem',
            },
          },
          h4: {
            typography: {
              fontSize: 'var(--wp--preset--font-size--xl)',
              lineHeight: '1.728rem',
            },
          },
        },
        blocks: {
          'core/paragraph': {
            typography: {
              fontFamily: 'var(--wp--preset--font-family--mono)',
            },
            color: {
              text: 'var(--wp--preset--color--black)',
            },
            spacing: {
              margin: {
                top: '4rem',
                bottom: '4rem',
              },
            },
          },
          'core/heading': {
            typography: {
              fontWeight: '700',
              fontFamily: 'var(--wp--preset--font-family--sans)',
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
            elements: {
              h1: {
                color: {
                  text: 'var(--wp--preset--color--primary)',
                },
                typography: {
                  scale: 1.25,
                  fontSize: 'var(--wp--preset--font-size--4-xl)',
                  lineHeight: '2.986rem',
                },
              },
            },
          },
        },
      },
      'customTemplates',
      [
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
      ],
      'templateParts',
      [
        {
          name: 'my-template-part',
          title: 'Header',
          area: 'header',
        },
      ],
    )
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
        background: false,
        duotone: [],
        gradients: [],
        link: false,
        palette: [],
        text: false,
      },
      spacing: {
        padding: false,
        blockGap: false,
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
      },
      blocks: {
        'core/paragraph': {
          color: {
            custom: false,
          },
          custom: {},
          layout: {},
          spacing: {},
          typography: {
            fluid: true,
            customFontSize: false,
            fontSizes: [
              {
                name: 'base',
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
                color: '#00a887',
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
                name: '4xl',
                size: '3.75rem',
                slug: '4xl',
                fluid: {
                  min: '2.5rem',
                  max: '3.75rem',
                },
              },
            ],
            dropCap: false,
            lineHeight: false,
            fontFamilies: [
              {
                fontFamily: 'Inter var, sans-serif',
                name: 'Inter var',
                slug: 'sans',
              },
            ],
          },
        },
        'core/button': {
          typography: {
            fontSizes: [
              {
                slug: 'medium',
                size: '1.5rem',
                name: 'medium',
              },
            ],
          },
        },
      },
    })
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize();
};
