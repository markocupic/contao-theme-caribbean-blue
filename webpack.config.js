const Encore = require('@symfony/webpack-encore');

Encore
.setOutputPath('public/')
.setPublicPath('/bundles/markocupiccontaothemecaribbeanblue')
.setManifestKeyPrefix('')

.addEntry('headroom', './assets/entries/headroom.js')
//.addEntry('frontend', './assets/filepond.js')
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
    from: './assets/js',
    to: 'js/[path][name].[ext]'
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

.enablePostCssLoader()
// Preprocessing scss in css
.enableSassLoader()
.enablePostCssLoader()
.addStyleEntry('styles/frontend', './assets/scss/main.scss')
;

module.exports = Encore.getWebpackConfig();
