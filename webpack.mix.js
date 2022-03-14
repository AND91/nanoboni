const mix = require("laravel-mix");

mix
  .js("resources/js/plugins/jquery.maskmoney.js", "public/js/plugins")
  .js("resources/js/plugins/jquery.mask.js", "public/js/plugins")
  .js("resources/js/plugins/jquery.validate.js", "public/js/plugins")
  .js("resources/js/plugins/perfect-scrollbar.js", "public/js/plugins")
  .js("resources/js/plugins/paper-dashboard.min.js", "public/js/plugins")
  .js("resources/js/bootstrap.js", "public/js")
  .js("resources/js/app.js", "public/js")
  .sass(
    "resources/sass/paper-dashboard/index.scss",
    "public/css/paper-dashboard.css"
  )
  .options({
    processCssUrls: false,
  })
  .sass("resources/sass/bootstrap.scss", "public/css/bootstrap.css")
  .sass("resources/sass/index.scss", "public/css/app.css");
