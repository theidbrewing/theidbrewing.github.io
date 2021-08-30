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

SKIN_DIST_BUILD_DIR=$SKIN_DIST_DIR/build
if [ ! -d $SKIN_DIST_BUILD_DIR ]; then
    mkdir -p $SKIN_DIST_BUILD_DIR
    mkdir -p $SKIN_DIST_BUILD_DIR/images
    mkdir -p $SKIN_DIST_BUILD_DIR/skins/$SKIN_NAME
fi

# copy build skin
cp -r build/images/ $SKIN_DIST_BUILD_DIR/images/
cp -r build/skins/$SKIN_NAME $SKIN_DIST_BUILD_DIR/skins/$SKIN_NAME

# copy php files
cp tt1skin.php $SKIN_DIST_DIR/tt1skin.php
cp -r inc/ $SKIN_DIST_DIR/inc/

# change plugin name & description
cd $SKIN_DIST_DIR
sed -i "" "s|Plugin Name:       TT1 Skin - the_ID Brewing Styles|Plugin Name:       TT1 Skin (${SKIN_NAME})|" tt1skin.php
sed -i "" "s|Description:       CSS styles for the_ID Brewing demo sites|Description:       サイト[${SKIN_NAME}]のためのスタイル調整プラグイン|" tt1skin.php

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