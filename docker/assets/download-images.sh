#!/bin/bash

URL="https://www.coops.tech/cotech-images.tgz"
DEST="/app/web"

# we just check for one path that we assume will be created when we unpack
TEST_PATH="$DEST/app/uploads/2017"

if [ ! -e $TEST_PATH ] || [[ $* == *--force* ]]; then
  echo "Downloading WordPress images from $URL"
  curl -s $URL | tar -zxf - -C $DEST
  echo "Images downloaded!"
else
  echo "Images already present, skipping download. Use --force to force download."
fi