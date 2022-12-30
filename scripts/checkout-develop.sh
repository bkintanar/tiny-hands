#!/bin/bash

repos=(app ats auth baum core pim ras ui)

for repo in "${repos[@]}"
do
    cd ../"${repo}"

    echo ""
    echo "${repo}"

    git add .
    git stash
    git checkout develop
    git pull

done
