#!/bin/bash

switchLang () {
    echo "'$1' selected"
    echo "Switching keyboard layout..."

    xorgConfFile=/etc/X11/xorg.conf
    xorgConfLangFile=/home/zend/lang/xorg.conf.$1 

    cp $xorgConfLangFile $xorgConfFile

    setxkbmap -layout $1
}

clear
echo -e "\n"

languageSelected=1
until [ "$languageSelected" == "0" ]
do
    echo -n "Please choose your keyboard layout (us, it, fr, de): "
    read language

    case $language in
    "de")
        languageSelected=0
        ;;
    "fr")
        languageSelected=0
        ;;
    "it")
        languageSelected=0
        ;;
    "us")
        languageSelected=0
        ;;
    *)
        echo -e "Input not valid!\n"
        ;;
    esac
done

switchLang $language
echo "...done!"
rm -f $0
