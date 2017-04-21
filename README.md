# g_starter

**WARNING this is an incomplete project still in active development.**

## Author

Nic Beltramelli   [@nicbeltramelli](https://twitter.com/NicBeltramelli)


## Summary

g_starter is a starter child theme for Genesis Framework developers, based on HTML5 Boilerplate, Gulp and Bower. It supports both Sass and Less, uses BrowserSync for syncing changes across local development devices and asset-builder to assemble dependencies through the JSON file based asset pipeline.
Tested up to WordPress 4.7 and Genesis 2.4.2.


## Requirements

| Prerequisite    | How to check | How to install
| --------------- | ------------ | ------------- |
| PHP >= 5.4.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js >= 4.5  | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 3.8.10  | `gulp -v`    | `npm install -g gulp` |
| Bower >= 1.3.12 | `bower -v`   | `npm install -g bower` |


## Features

* [gulp](http://gulpjs.com/) compiles both Sass and Less, checks for JavaScript errors, optimizes images, concatenates and minifies files, generates of a POT file for translation and automatic zipping production theme without including the development files.
* [BrowserSync](http://www.browsersync.io/) keeps multiple browsers in sync while testing and automatically updates your changes to HTML, CSS, JS, images and other project files while you're developing.
* [Bower](http://bower.io/) manages front-end packages.
* [asset-builder](https://github.com/austinpray/asset-builder) assembles and orchestrates your dependencies defined in the JSON file based asset pipeline.


## Theme installation

Download or clone g_starter into a new folder within your WordPress themes directory.

`git clone git@github.com:NicBeltramelli/g_starter.git your-theme`


## Theme setup

Edit `lib/g_starter/setup.php` to define child theme constants and features support.

Change the style.scss intro block to your theme informations.


## Theme development

g_starter uses [gulp](http://gulpjs.com/) as its build system and [Bower](http://bower.io/) to manage front-end packages.

### Install gulp and Bower

Building the theme requires [node.js](http://nodejs.org/download/). Update to the latest version of npm: `npm install -g npm@latest`.

From the command line:

1. Install [gulp](http://gulpjs.com) and [Bower](http://bower.io/) globally with `npm install -g gulp bower`
2. Navigate to the theme directory, then run `npm install`
3. Run `bower install`

You now have all the necessary dependencies to run the build process.

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps)
* `gulp translate-theme` — translate all the PHP files in your theme, and output a POT file in a newly created /lang/ directory in your theme root
* `gulp package-theme` — package your theme for production in a ZIP folder automatically ignoring dev-kit files

### Bower dependencies

- normalize-scss
- bourbon
- Ionicons
- matchHeight
- modular-scale
- scrollreveal
- fitvids

### Using BrowserSync

To use BrowserSync during `gulp watch` you need to update `devUrl` at the bottom of `assets/manifest.json` to reflect your local development hostname.

For example, if your local development URL is `http://project-name.dev` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://project-name.dev"
  }
...
```
If your local development URL looks like `http://localhost:8888/project-name/` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://localhost:8888/project-name/"
  }
...
```


## Credits

Without these projects g_starter wouldn't be possible.

* [Sage](https://github.com/roots/sage)
* [Genesis Framework](http://my.studiopress.com/themes/genesis/)