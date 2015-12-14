import os
import glob
import time
import sqlite3
import datetime

criticalMin = 2.0
criticalMax = 8.0
warnMin = 2.5
warnMax = 7.5
strEmailAddress = "dr.ankitrastogi@gmail.com"
strTwitterHandle = "anuj_k_rastogi"
dirProbe1 = "rz_temp.txt"


def processNotify(info):
	temp = float(info[0])
	date = info[1]
	if(temp <= criticalMin or temp >= criticalMax):
		critMsg = "CRITICAL TEMPERATURE EVENT. %s deg.C. on %s" % ('{0:.2f}'.format(temp), date)
		os.system('echo "%s" | mailx -s "CRITICAL EVENT" %s' % (critMsg, strEmailAddress))
		os.system('t dm %s "%s"' % (strTwitterHandle, critMsg))
		
	if((temp > criticalMin and temp < criticalMax) and (temp <= warnMin or temp >= warnMax)):
		warnMsg = "WARN TEMPERATURE EVENT. %s deg.C. on %s" % ('{0:.2f}'.format(temp), date)
		os.system('echo "%s" | mailx -s "WARN EVENT" %s' % (warnMsg, strEmailAddress)) 
		os.system('t dm %s "%s"' % (strTwitterHandle, warnMsg))

#temperatureProbe_1---------------------------
rztempRead = open(dirProbe1, "r")
processNotify(rztempRead.read().split('\n'))
rztempRead.close()

