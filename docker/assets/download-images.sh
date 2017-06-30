#!/bin/bash

BASEDIR="/app/web"

# we just check for one path that we assume will be created when we unpack
TEST_PATH="$BASEDIR/app/uploads/2017"

if [ ! -e $TEST_PATH ] || [[ $* == *--force* ]]; then
  echo "Downloading WordPress images"
  curl -s https://www.coops.tech/cotech-images.tgz | tar -zxf - -C $BASEDIR
  echo "Images downloaded!"
else
  echo "Images already present, skipping download. Use --force to force update."
fi