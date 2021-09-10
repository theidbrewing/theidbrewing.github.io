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


## run sass
#echo "================================"
#echo "run sass"
#echo "--------------------------------"

${npm} run sass


## run postcss
#echo "================================"
#echo "run postcss"
#echo "--------------------------------"

${npm} run postcss


## run mv
#echo "================================"
#echo "run mv (all skins)"
#echo "--------------------------------"

SKIN_ARRAY=(`ls -1 $SKIN_SRC_DIR`)

for i in ${SKIN_ARRAY[@]}
do
    echo "move css src to build : $i"
    mkdir -p ${SKIN_DIST_BUILD_DIR}/$i/
    mv ${SKIN_SRC_DIR}/$i/scss/style.css ${SKIN_DIST_BUILD_DIR}/$i/
    mv ${SKIN_SRC_DIR}/$i/scss/editor-style.css ${SKIN_DIST_BUILD_DIR}/$i/
done

echo "================================"
echo "Done !"
echo "--------------------------------"