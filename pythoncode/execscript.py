import MySQLdb as mydb

db = mydb.connect("localhost","root","","zNwk")

cursor = db.cursor()

sqlQuery = ''

with open("/usr/tmp/createTab.sql", 'r') as inp:
	
	for line in inp:
		if line == 'GO\n':
			cursor.execute(sqlQuery)
			sqlQuery = ''
		elif 'PRINT' in line:
			disp = line.split("'")[1]
			print(disp,'\r')
		else:
			sqlQuery = sqlQuery + line
inp.close()

import tstuart.py
