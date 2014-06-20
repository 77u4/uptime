#!/bin/bash
#uptime bash script
#Author: Jannis Hutt <hutt@jh0.eu>

#code is enough documentation

time=0 #no comment.
msg="" #message
auth="asdf" #password
gotoFail=0
success=0
newMsg=""

sleeptime=2

case "$1" in
	-m) 
		msg="$2" ;;
	-t) 
		time="$2" ;;
	*) 
		gotoFail=1 ;;
esac

#read msg with spaces
if [[ -z "$msg" ]];then
    msg="${str:4}"
fi

if [ $(echo "$time" | wc -c) == 0 ] && [ "$msg" == "" ]; then
	gotoFail=1
elif [ "$time" != 0 ] && [ $(echo "$time" | wc -c) -lt 11  ]; then
	gotoFail=2
fi

if [ "$gotoFail" == "1" ]; then
	echo "[FAIL] Falsche Parameter"
elif [ "$gotoFail" == "2" ]; then
	echo "[FAIL] Die Zeit ist ein Integer mit 10 chars."
elif [ "$gotoFail" == "3" ]; then
	echo "[FAIL] Ein unbekannter Fehler ist aufgetreten. Schlagen sie den Dev."
else
	if [ "$1" == "-t" ] && [ "$2" != 0 ]; then
		echo "[INFO] Zeit aktualisieren..."
		echo "[INFO] Zeit: $2" && sleep $sleeptime
		curl --get -d auth=$auth -d time=$time http://uptime.jh0.eu/set.php && sleep $sleeptime
		success=1
	elif [ "$1" == "-m" ]; then
	    echo "[INFO] Nachricht aktualisieren..."
		echo "[INFO] Nachricht: $msg"
		msg="$(echo "$msg" | sed -e 's/ /\%20/g')"
		curl --get -d auth=$auth -d msg="$msg" http://uptime.jh0.eu/set.php && sleep $sleeptime
		success=1
	fi
	if [ "$success" > 0 ]; then
	    echo "[SUCCESS] Aktualisiert."
	fi
fi
