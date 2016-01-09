import Adafruit_BBIO.UART as UART
import serial
import MySQLdb as mydb

#connect to databse
db = mydb.connect("localhost","root","","znwk")

#make a cursor to db
cursor = db.cursor()

#setup uart
UART.setup("UART1")

ser = serial.Serial(port="/dev/ttyO1",baudrate=9600)
ser.close()
ser.open()
if ser.isOpen():
	print "Serial is open!"
	while 1:
		txt = ser.readline()
		txt = txt.replace("\r\n","")
		print txt
ser.close()
