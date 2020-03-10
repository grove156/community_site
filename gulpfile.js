const elixir = require('laravel-elixir');
require('laravel-elixir-vue');

elixir(mix=>[
    mix.sass('app.scss');
    mix.webpack('app.js');
    mix.version([
      'css/app.css',
      'js/app.js'
    ]);
    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    mix.scripts([
      '../../public/js/app.js',
      '../../node_modules/select2/dist/js/select2.js',
      '../../../node_modules/dropzone/dost/dropzone.js'
    ], 'public/js/app.js');
]);
