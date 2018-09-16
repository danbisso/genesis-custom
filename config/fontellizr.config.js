var fontellizr = require('fontellizr');
 
fontellizr({
  svgsSourceDir: './assets/svg',
  fontsDestDir: './assets/fonts',
  stylesDestDir: './assets/fonts',
  fontelloConfig: {
    // ascent: 850,
    // units_per_em: 1000,
    // hinting: true,
    css_use_suffix: false,
    css_prefix_text: 'icon-',
    name: 'icons'
  }
});