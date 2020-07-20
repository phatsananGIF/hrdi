#!/bin/sh
#version 1
##                     sitecode start end minute delay  
## sh -x  timelapse.sh SF000 2019-07-19 2019-07-21 08 5

sitecode=$1
start=$2
end=$3
minute=$4
delay=$5

DIR="/home/smartfarmesrs/public_html/snapshot/$sitecode"
TIMELAPSE="/home/smartfarmesrs/public_html/snapshot/timelapse"

[ ! -d $DIR ] && {
   echo "${sitecode} not found !!!"
  exit
}

#if [ ! -d $DIR/timelapse ] ; then
#  mkdir $DIR/timelapse
#  chmod 777 $DIR/timelapse
#fi

cd $DIR

if [ $? -eq 0 ] ; then
##gen index
fileindex=index$$.idx

#find -iname "*.jpg" > $fileindex
find -iname "*.jpg" -newermt "${start} 00:00:00" ! -newermt "${end} 23:59:59"|grep "/$minute/"  > $TIMELAPSE/$fileindex

#echo  $DIR/timelapse/$fileindex
#cat  $DIR/timelapse/$fileindex

#echo "find -iname "*.jpg" -newermt "${start} 00:00:00" ! -newermt "${end} 23:59:59"|grep "/$minute/" "

    if [ $(cat $TIMELAPSE/$fileindex|wc -l) -gt 0 ] ; then

        file=${sitecode}_${start}_${end}_$minute.gif

        /usr/bin/convert -delay $delay -loop 0 $(cat $TIMELAPSE/$fileindex) -resize 500 $TIMELAPSE/$file
        #cat $DIR/$fileindex
        echo "$file"
   else
        echo "no.gif"
        #pwd
   fi

rm -rf $TIMELAPSE/$fileindex 2>/dev/null

else
    echo "${sitecode} not found !!!"
fi
