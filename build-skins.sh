#!/usr/bin/env bash
#set -ex;

skin_directory=./src/skins
#skin_directory=/dev/nul

#pwd
#npm run list:skin
#npm run build:skin --skin=sample


# Check Skin
if [ -z "$(ls $skin_directory)" ]; then
    echo "not found skin"
    exit 1
fi

# Count skin
skins_count=(`ls -1 $skin_directory`)
echo "================================"
echo "${#skins_count[@]} Skin found."
echo "================================"
echo ""

## List Skin Name
echo "================================"
echo "Skin Name"
echo "--------------------------------"
ls -1 ./src/skins/
echo "================================"