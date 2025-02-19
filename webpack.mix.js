const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.js("resources/js/app.js", "public/asset/js").postCss(
    "resources/css/app.css",
    "public/asset/css",
    [tailwindcss("./tailwind.config.js")]
);
