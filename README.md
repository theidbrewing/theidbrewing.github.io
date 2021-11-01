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
```

### Dist All (include `Build Skins`)
build skin (all), dist skin(all)
```
$ npm run dist:all
```
