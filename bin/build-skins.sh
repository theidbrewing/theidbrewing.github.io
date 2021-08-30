#!/usr/bin/env bash
#set -ex;

SKIN_SRC_DIR=./src/skins
#SKIN_SRC_DIR=/dev/nul

#pwd
#npm run list:skin
#npm run build:skin --skin=sample


# Check Skin
if [ -z "$(ls $SKIN_SRC_DIR)" ]; then
    echo "not found skin"
    exit 1
fi

# Count skin
skins_count=(`ls -1 $SKIN_SRC_DIR`)
echo "================================"
echo "${#skins_count[@]} Skin found."
echo "================================"
echo ""

## List Skin Name
echo "================================"
echo "Skin Name"
echo "--------------------------------"
ls -1 $SKIN_SRC_DIR
echo "================================"

## Build Skin Name
