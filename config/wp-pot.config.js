const wpPot = require('wp-pot');
 
wpPot({
  destFile: 'languages/genesis-custom.pot',
  relativeTo: '.',
  domain: 'genesis-custom',
  package: 'Genesis Custom'
});