import sqlite3 
import sys
import cgi
import cgitb

def fetch_data(interval, dbname):
        conn = sqlite3.connect(dbname)
        dbCursor = conn.cursor()

        if interval == None:
		dbCursor.execute("SELECT * FROM tempsTable")
	else:
                dbCursor.execute("SELECT * FROM tempsTable WHERE timestamp > datetime('now','-s% hours')" % interval) 
	
	rowsHold = dbCursor.fetchall()
	conn.close()
	return rowsHold

def create_table(rows)
	chart_table=""
	for row in rows[:-1]:
		rowstr="['{0}', {1}],\n".format(str(row[0]),str(row[1]))
		chart_table+=rowstr
	
	row=rows[-1]
	rowstr="['{0}', {1}]\n".format(str(row[0]),str(row[1]))
	chart_table+=rowstr
	return chart_table


