#!/bin/bash

firstRunScriptName=/home/zend/firstrun.sh

if [ -s $firstRunScriptName ]
then
    $firstRunScriptName
fi
