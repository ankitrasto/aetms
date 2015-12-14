#!/usr/bin/env python

import sqlite3

conn = sqlite3.connect("/var/www/tempLogDB.db")

curs=conn.cursor()

print "Content-type: text/html\n\n"
print "<h1>Temperature Log Database Dump</h1>"

for row in curs.execute("SELECT * FROM tempsTable"):
	print "<br> ",row

conn.close();
