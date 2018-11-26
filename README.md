# Genesis Custom

Starter theme for the Genesis Framework

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Installing

Run `git clone` from your WordPress /themes/ directory:

```
git clone https://github.com/danbisso/genesis-custom.git
```

(optional) Rename your theme: 

```
mv genesis-custom ./MYTHEME
```

Then change to the theme directory and run `npm install` to fetch all dependencies: 

```
cd MYTHEME
```

```
npm install
```

And finally, start working: 

```
npm start
```

## Included tools:

* __Localization__: All `php` files will be automatically parsed for WP l10n functions, and a `genesis-custom.pot` file will be generated inside the `/languages/` folder. To translate the theme, rename that `.pot` file to `your_LANG.po` and type in your translations. The corresponding `.mo` file containing your translations will be automatically generated.
* __SASS__: `.scss` files inside the `/sass/` directory will be automatically *compiled, prefixed and minified*.
* __Icon Fonts__: `.svg` files in the `/assets/svg/` directory will be automatically compiled and converted to an *icon font* placed in the `/assets/fonts/` directory.

