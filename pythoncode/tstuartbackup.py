import Adafruit_BBIO.UART as UART
import serial

UART.setup("UART1")

ser = serial.Serial(port="/dev/ttyO1",baudrate=9600)
ser.close()
ser.open()
if ser.isOpen():
	print "Serial is open!"
	while 1:
		txt = ser.readline()
		txt = txt.replace("\r\n","")
		if txt[0:4] == "From":
			if "00124B00025DDC25" == txt[5:21]:
				print "ROUTER"
				#parsing LQI
				txt = txt[5:].split(',')
				R_LQI = txt[1][5:7]
				#parsing supply voltage
				txt = ser.readline()
				R_Volt = txt[38:43]
				#parsing temperature
				txt = ser.readline()
				R_Temp = txt[35:40]
				print R_LQI + " " + R_Volt +" " + R_Temp + "\r\n"
			elif "00124B00025DD2B7" == txt[5:21]:
				#parsing LQI
                        	txt = txt[5:].split(',')
                        	E_LQI = txt[1][5:7]
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
				
				print E_LQI + " " + E_Volt + " " + E_Red + " "\
					+ E_Green + " " + E_Blue + "\r\n"					
ser.close()


