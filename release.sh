# Release build script for Clean Starter Kit
# Copyright (c) Sergey Romanenko
# usage: bash release.sh [version] 

name="clean";
version="$1";
curl "https://github.com/flextype-starter-kits/$name/archive/refs/tags/v$version.zip" -L -O;
unzip "v$version.zip";
rm "v$version.zip";
cd "$name-$version";
npm install;
npx tailwindcss -i ./assets/src/css/styles.css -o ./assets/dist/css/styles.css --minify;
rm -rf node_modules;

mkdir plugins;

cd plugins;
mkdir site;
cd site;
wget -c $(curl -ksL "https://api.github.com/repos/flextype-plugins/site/releases/latest" | jq -r ".assets[0].browser_download_url");
unzip *.zip;
rm *.zip;
rm -rf __MACOSX;
cd ../../;

cd plugins;
mkdir feed;
cd feed;
wget -c $(curl -ksL "https://api.github.com/repos/flextype-plugins/feed/releases/latest" | jq -r ".assets[0].browser_download_url");
unzip *.zip;
rm *.zip;
rm -rf __MACOSX;
cd ../../;

cd plugins;
mkdir sitemap;
cd sitemap;
wget -c $(curl -ksL "https://api.github.com/repos/flextype-plugins/sitemap/releases/latest" | jq -r ".assets[0].browser_download_url");
unzip *.zip;
rm *.zip;
rm -rf __MACOSX;
cd ../../;

cd plugins;
mkdir twig;
cd twig;
wget -c $(curl -ksL "https://api.github.com/repos/flextype-plugins/twig/releases/latest" | jq -r ".assets[0].browser_download_url");
unzip *.zip;
rm *.zip;
rm -rf __MACOSX;
cd ../../;

rm -rf __MACOSX;
find . -name '.DS_Store' -type f -delete;
zip -r "$name-$version.zip" . ;

cd ../;
mv "$name-$version/$name-$version.zip" .;
rm -r "$name-$version/";
