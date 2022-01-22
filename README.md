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
