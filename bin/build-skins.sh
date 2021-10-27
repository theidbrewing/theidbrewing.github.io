#!/usr/bin/env bash
set -eu

cd `dirname $0`

SKIN_SRC_DIR='../src/skins'
SKIN_DIST_BUILD_DIR='../build/skins'
SKIN_COUNT=''
SKIN_ARRAY=''


npm='npm --prefix ../'

## test overwrite
#SKIN_SRC_DIR=/dev/nul

# Check Skin
if [ -z "$(ls $SKIN_SRC_DIR)" ]; then
    echo "not found skin"
    exit 1
fi

# Count skin
SKIN_COUNT=(`ls -1 $SKIN_SRC_DIR`)
echo "================================"
echo "${#SKIN_COUNT[@]} Skin found."
echo "================================"
echo ""

## List Skin Name
echo "================================"
echo "Skin Name"
echo "--------------------------------"
ls -1 $SKIN_SRC_DIR
echo "================================"


## Build Skin List
#echo "================================"
#echo "Skin List"
#echo "--------------------------------"

SKIN_ARRAY=(`ls -1 $SKIN_SRC_DIR`)


## init:skin
#echo "================================"
#echo "init:skin"
#echo "--------------------------------"

${npm} run init:skin


#run build:css
#echo "================================"
#echo "run build:css"
#echo "--------------------------------"

SKIN_ARRAY=(`ls -1 $SKIN_SRC_DIR`)
${npm} run build:css --skin=${SKIN_ARRAY}


echo "================================"
echo "Done !"
echo "--------------------------------"