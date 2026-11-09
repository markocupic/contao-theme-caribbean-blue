const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/')
    .setPublicPath('/bundles/markocupiccontaothemecaribbeanblue')
    .setManifestKeyPrefix('')

    .copyFiles({
      from: './node_modules/bootstrap/dist/js',
      to: 'bootstrap/dist/js/[path][name].[ext]',
      pattern: /(bootstrap\.bundle\.min\.js)$/,
    })
    .copyFiles({
      from: './assets/favicon',
      to: 'favicon/[path][name].[ext]'
    })
    .copyFiles({
      from: './assets/logos',
      to: 'logos/[path][name].[hash:8].[ext]'
    })
    .copyFiles({
      from: './assets/js',
      to: 'js/[path][name].[hash:8].[ext]'
    })
    .copyFiles({
      from: './node_modules/swiper',
      to: 'swiper/[path][name].[hash:8].[ext]',
      pattern: /(swiper-bundle\.js|swiper-bundle\.css)$/,
    })
    .copyFiles({
      from: './assets/leitbild',
      to: 'leitbild/[path][name].[ext]',
    })

    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps()
    .enableVersioning()

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
      config.useBuiltIns = 'usage';
      config.corejs = 3;
    })

    // Preprocessing scss in css
    .enableSassLoader((options) => {
        options.sassOptions = {
            // Hide deprecation warnings from node_modules (Bootstrap 5.3 still uses @import & global functions)
            quietDeps: true,
            // Our own SCSS still uses @import as well (Bootstrap 5 cannot be loaded via @use)
            silenceDeprecations: ['import'],
        };
    })
    .enablePostCssLoader()
    .addStyleEntry('styles/frontend', './assets/scss/main.scss')
;

module.exports = Encore.getWebpackConfig();
