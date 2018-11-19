# Genesis Custom

Starter theme for the Genesis Framework

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Installing

Run git clone from your WordPress /themes/ directory:

```
git clone https://github.com/danbisso/genesis-custom.git
```

Then run npm install to fetch all dependencies: 

```
npm install
```

And finally, npm start: 

```
npm start
```

## Included tools:

* Localization: All php files will be automatically parsed for WP l10n functions, and a genesis-custom.pot file will be generated inside the /languages/ folder. To translate the theme, rename that .pot file to your_LANG.po and type in your translations. The corresponding .mo file containing your translations will be automatically generated.
* SASS: .scss files inside the /sass/ directory will be automatically compiled, prefixed and minified.
* Icon Fonts: SVG files in the /assets/svg/ directory will be automatically compiled and converted to an iconfont and placed in the /assets/fonts/ directory.

