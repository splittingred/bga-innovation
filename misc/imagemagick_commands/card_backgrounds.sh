#!/bin/bash

mkdir temp

function crop_add_colorblind_indicators() {
    local border_color=${1}  # e.g. blue
    local colorblind_img=../card_shapes/${border_color}_shape.png
    local background_img=../card_backgrounds/${border_color}.png
    local result_img=temp/${border_color}.png
    
    magick composite -geometry +580+12 \
    $colorblind_img \
    $background_img[666x475+42+36] \
    $result_img
}

for color in {blue,red,green,yellow,purple}; do
    crop_add_colorblind_indicators $color
done

# Build base card background spritesheet
magick montage temp/{blue,red,green,yellow,purple}.png \
-tile 5x1 -resize 560x408 -geometry +5+5 -background 'white' \
../../img/card_backgrounds.jpg

# Build cities card background spritesheet (these had colirblind indicators included)
magick montage ../card_backgrounds/{blue,red,green,yellow,purple}_cities.png[666x475+42+36] \
-tile 5x1 -resize 560x408 -geometry +5+5 -background 'white' \
../../img/card_backgrounds_cities.jpg

rm -r temp