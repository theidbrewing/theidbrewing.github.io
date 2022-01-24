# TT1 skin plugin

Custom skin for WordPress Default theme TT1.

## Required environment

composer, node, npm.

## Install

npm install

```
$ npm i
```

wp-env global install

```
$ npm -g i @wordpress/env
```

## Use

### env

```
$ wp-env start
```

### Switch Skin

Set config file

#### 1. For wp-env

```
# copy sample file
$ cp .wp-env.override.json.sample .wp-env.override.json
```

edit `.wp-env.override.json`

```
{
    "config" : {
        "TT1_SKIN_NAME" : "{{SKIN_NAME}}"
    }
}
```

```
# apply
$ wp-env start --update
```


#### 2. For other local env

```
#copy sample file
$ cp tt1skin.config.php.sample tt1skin.config.php
```

edit `tt1skin.config.php`

```
define( 'TT1_SKIN_NAME', '{{SKIN_NAME}}' );
```

### Init Skin

Convert the skin settings set in `skin.json` to SCSS.

#### Setup skin.json

You can setup your skin styles in skin.json.
`color.palette`, `color.gradients` can be set in the same format as [theme.json](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/#presets).

`fontSizes` is also the same as `typography.fontSizes`.

`google_fonts_url` is the original setting in the skin.json. Fill in the URL of the Google font you want to set.

You can also setup your skin custom block pattern.
Add your block pattern json files in `inc/skins/yourskinname/block-pattern`, and patten name list in skin.json `block_pattern`.

Example:

```
{
    "name": "yourskinname",
    "version": "0.1.6",
    "settings": {
        "google_fonts_url": "https://fonts.googleapis.com/XXXXXXX",
        "color": {
            "palette": [
                {
                    "name": "Primary",
                    "slug": "primary",
                    "color": "#540CED"
                }
            ],
            "gradients": [
                {
                    "slug": "shadow01",
                    "gradient": "linear-gradient(104deg,rgb(0,0,0) 0%,rgba(255,255,255,0) 90%)",
                    "name": "Shadow 01"
                }
            ]
        },
        "fontSizes": [
            {
                "slug": "x-small",
                "size": "clamp(0.65rem, 0.9vw, 0.9rem)",
                "name": "X Small"
            }
        ]
    },
    "block_pattern" : [
        "card--member",
        "card"
    ]
}
```

Then, init the skin.json.

```
$ npm run init:skin
```

### Build CSS (one each)

```
$ npm run build:css --skin=[skinname]
```

### Build ALL(Skins)
$ npm run build:all

### Skin List check

```
$ npm run list:skin
```

### Dist Skin

```
$ npm run dist:theidbrewing
$ npm run dist:flower
$ npm run dist:samurai
```

### Dist All (include `Build Skins`)
build skin (all), dist skin(all)
```
$ npm run dist:all
```
