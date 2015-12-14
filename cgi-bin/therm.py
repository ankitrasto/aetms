import os
import glob
import time
import sqlite3
import datetime
 
os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')
 
base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'
tempC = 0.0
 
def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines
 
def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    global tempC
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
        tempC = float(temp_string) / 1000.0
        # return temp_c

def logTempToDB(dbname, temp):
	conn = sqlite3.connect(dbname)
	curs = conn.cursor()
	curs.execute("INSERT INTO tempsTable values(datetime('now','localtime'),(?))", (temp,))
	conn.commit()
	conn.close();

read_temp()
logTempToDB("/var/www/tempLogDB.db", tempC)

#update rz_temp.txt:
rztempWrite = open("/var/www/html/rz_temp.txt", "w")
rztempWrite.write(str(tempC)+"\n"+datetime.datetime.today().strftime("%Y %b %d (%a) %H:%M"))
rztempWrite.close()
#os.system('t dm ankit_rpi2 "$(cat /var/www/html/rz_temp.txt)" > /dev/null 2>&1')
#print datetime.datetime.today().strftime("%Y %b %d (%a) %H:%M")
#print tempC
	

#while True:
#	read_temp()
#	print(tempC)
#	logTempToDB("testdb.db", tempC)	
#	time.sleep(1)
	
