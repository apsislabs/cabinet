# Cabinet

An empty container for your WordPress Theme.

## Setup

We recommend using [`degit`](https://github.com/Rich-Harris/degit) to scaffold your project. Setup is simple:

```sh
npm install -g degit
degit apsislabs/wp-cabinet path/to/your/project
```

## Usage

This theme is just a starting point --- a lighter-weight version of the [`_s`](https://github.com/Automattic/_s) theme offered by Automattic. There's very little you need to do to get up and running:

1. Change the `I18N_DOMAIN` constant in `functions.php` to your own text domain.
2. Change the `Theme Name`, `Author`, `Author URI` in `style.css`.

## Assets

You can write your CSS and JS directly in the `assets` directory, but we highly recommend using a build tool. By default, Cabinet will include assets at `assets/bundle.js`, and `assets/main.css`.
