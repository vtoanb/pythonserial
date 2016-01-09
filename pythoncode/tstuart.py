import Adafruit_BBIO.UART as UART
import Adafruit_BBIO.GPIO as GPIO
import serial
import MySQLdb as mydb
import time

def turnLED_ON():
        GPIO.output("P8_14",GPIO.HIGH)
		
def turnLED_OFF():
		GPIO.output("P8_14",GPIO.LOW)

db = mydb.connect("localhost","root","","zNwk")

#make to cursor to router and end-device
cursor = db.cursor()

#UART.setup("UART1")

#setup GPIO
#GPIO.setup("P8_14", GPIO.OUT)


turnLED_OFF()

ser = serial.Serial(port="/dev/ttyO1",baudrate=9600)
ser.close()
ser.open()

if ser.isOpen():
	print "Serial is open, Start Logging system "
	while 1:
		txt = ser.readline()
		txt = txt.replace("\r\n","")
		if txt[0:4] == "From":
			if "00124B00025DDC25" == txt[5:21]:
			    #start processing for router message
				turnLED_ON()
#				print "ROUTER"
				#parsing LQI
				txt = txt[5:].split(',')
				LQI = txt[1][5:7]
				R_LQI = int(LQI,16)
				#parsing supply voltage
				txt = ser.readline()
				R_Volt = txt[38:43]
				#parsing temperature
				txt = ser.readline()
				R_Temp = txt[35:40]
				#write datab to Router database
				try:
					now = time.strftime("%Y:%m:%d %H:%M:%S")
					mysql = "insert into rTab(LQI,Volt,Temp,Time) values('%d','%s','%s','%s')" % (R_LQI,R_Volt,R_Temp,now)
					#execute sql command
					cursor.execute(mysql)
					db.commit()
				except:
#					print " router database fail "
					db.rollback()
#				print R_LQI , " " + R_Volt +" " + R_Temp + "\r\n"
				#finish processing for router message
				turnLED_OFF()
			elif "00124B00025DD2B7" == txt[5:21]:
				#parsing LQI
                        	txt = txt[5:].split(',')
                        	LQI = txt[1][5:7]
				E_LQI = int(LQI,16)
                        	#parsing supply voltage
                        	txt = ser.readline()
                        	E_Volt = txt[38:43]
				#parsing red
				txt = ser.readline()
				txt = txt.split("=")
				E_Red = txt[1].replace("\r\n","")
				#parsing green
				txt = ser.readline()
				txt = txt.split("=")
				E_Green = txt[1].replace("\r\n","")
				#parsing blue
				txt = ser.readline()
				txt = txt.split("=")
				E_Blue = txt[1].replace("\r\n","")
				now = time.strftime("%Y:%m:%d %H:%M:%S")
				sql = "insert into eTab(LQI,Volt,Red,Green,Blue,time) \
					values('%d','%s','%s','%s','%s','%s')" % \
					(E_LQI,E_Volt,E_Red,E_Green,E_Blue,now)
				try:
					cursor.execute(sql)
					db.commit()
				except:
#					print " end point database fail"
					db.rollback()

				print E_LQI , " " + E_Volt + " " + E_Red + " "\
					+ E_Green + " " + E_Blue + "\r\n"					
ser.close()


