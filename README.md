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

### Build CSS

```
$ npm run build:css
```
### Skin List check

```
$ npm run list:skin
```
### Build Skin (one each)

```
$ npm run build:skin --skin=[skinname]
```
