#!/bin/bash

if [ $# -lt 1 ]; then
	echo "usage: $0 <skin-name>"
	exit 1
fi

set -e

cd "$(dirname "$0")"
cd ..

SKIN_NAME=$1

# check build
SKIN_BUILD_DIR='./build/skins/'$SKIN_NAME
if [ ! -d $SKIN_BUILD_DIR ]; then
    "This skin has not been built yet. Please build it first."
    exit 1
fi

# prepar dist dir
DIST_DIR='./dist'
if [ ! -d $DIST_DIR ]; then
    mkdir -p $DIST_DIR
fi

# clean up first
SKIN_DIST_DIR=$DIST_DIR/$1
if [ -d $SKIN_DIST_DIR ]; then
    rm -rf $SKIN_DIST_DIR
fi
mkdir -p $SKIN_DIST_DIR

# clean up composer
if [ ! -d ./vendor ]; then
    rm -rf ./vendor
fi
composer install --no-dev

# copy composer vendor dir
cp -r ./vendor $SKIN_DIST_DIR/vendor

# skin buid dir
SKIN_DIST_BUILD_DIR=$SKIN_DIST_DIR/build
if [ ! -d $SKIN_DIST_BUILD_DIR ]; then
    mkdir -p $SKIN_DIST_BUILD_DIR/images
    mkdir -p $SKIN_DIST_BUILD_DIR/skins/$SKIN_NAME
fi

# skin src dir
SKIN_DIST_SRC_DIR=$SKIN_DIST_DIR/src
if [ ! -d $SKIN_DIST_SRC_DIR ]; then
    mkdir -p $SKIN_DIST_SRC_DIR/skins/$SKIN_NAME
fi

# copy src/{skin}/skin.json
cp src/skins/$SKIN_NAME/skin.json $SKIN_DIST_SRC_DIR/skins/$SKIN_NAME/skin.json

# copy src/{skin}/functions.php
if [ -f src/skins/$SKIN_NAME/functions.php ]; then
    cp src/skins/$SKIN_NAME/functions.php $SKIN_DIST_SRC_DIR/skins/$SKIN_NAME/functions.php
fi

# copy src/{skin}/block_pattern/
if [ -d src/skins/$SKIN_NAME/block_pattern ]; then
    cp -r src/skins/$SKIN_NAME/block_pattern/ $SKIN_DIST_SRC_DIR/skins/$SKIN_NAME/block_pattern/
fi

# copy build skin
cp -r build/images/ $SKIN_DIST_BUILD_DIR/images/
cp -r build/skins/$SKIN_NAME $SKIN_DIST_BUILD_DIR/skins/

# copy php files
cp tt1skin.php $SKIN_DIST_DIR/tt1skin.php
cp -r inc/ $SKIN_DIST_DIR/inc/

if [ -f src/skins/$SKIN_NAME/skin.json ]; then
    SKIN_VERSION=`awk -F\" '/"version"/{print $4}' src/skins/$SKIN_NAME/skin.json`
else
    SKIN_VERSION='0.0.1'
fi

# change plugin headers
# copy
if [ -d languages ]; then
    cp -r languages/ $SKIN_DIST_DIR/languages/
fi

# change plugin name & description
cd $SKIN_DIST_DIR
sed -i "" "s|Plugin Name:       TT1 Skin - the_ID Brewing Styles|Plugin Name: TT1 Skin (${SKIN_NAME})|" tt1skin.php
sed -i "" "s|Version:|Version: ${SKIN_VERSION}|" tt1skin.php
sed -i "" "s|Update URI:|Update URI: https://theidbrewing.github.io/dist/tt1skin-${SKIN_NAME}.zip|" tt1skin.php

# put config file
echo "<?php 
if ( ! defined( 'TT1_SKIN_NAME' ) ) :
    define( 'TT1_SKIN_NAME', '${SKIN_NAME}'  );
endif;
" >> tt1skin.config.php

# zip archive
cd ..
zip -r 'tt1skin-'${SKIN_NAME}.zip $SKIN_NAME/

# delete tmp dir
rm -rf $SKIN_NAME/