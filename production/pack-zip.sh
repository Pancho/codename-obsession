#! /bin/bash

declare -a exclude_patterns=('\.*.swp' '\.*.swn' '\.*.swo' diff deploy.sh)

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )" &&
cd $DIR &&

rm -rf sleek_share_copy &&
rm -rf sleek-share.zip &&
mkdir sleek_share_copy &&
cp -r ../sleek-share/ sleek_share_copy/sleek-share &&

cd sleek_share_copy &&

echo "Removing tmp files" &&
for t in "${exclude_patterns[@]}"; do echo "  $t" && find . -name "$t" -delete; done &&

echo "Check php" &&
find . -name '*.php' | xargs -I file ../php_check.sh file &&

echo "Minimizing js" &&
find . -name '*.js' | xargs -I file ../minify_js.sh file &&

echo "Optimizing images" &&
find . -name '*.jpg' -exec ../optim_jpg.sh {} \; &&
find . -name '*.png' -exec ../optim_png.sh {} \; &&

echo "Packing" &&
zip -r sleek-share.zip sleek-share &&
mv sleek-share.zip ../ &&

echo && echo "OK" || echo "ERROR"
