#!/usr/bin/env bash
set -eu

cd `dirname $0`
npm='npm --prefix ../'

SKIN_SRC_DIR='../src/skins'
SKIN_DIST_BUILD_DIR='../dist'
SKIN_ARRAY=(`ls -1 $SKIN_SRC_DIR`)

echo "================================"
echo "Build Skins(all)"
echo "src = /src/skins/*"
echo "================================"
echo ""
bash build-skins.sh


echo "================================"
echo "Dist(all)"
echo "src = /build/skins/*"
echo "================================"
echo ""

rm -rf $SKIN_DIST_BUILD_DIR/*

for i in ${SKIN_ARRAY[@]}
do
    echo "building dist : $i"
    bash dist.sh $i
done

echo "Skin Dist Done!!"