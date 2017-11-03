import serial as s
#Makes a serial connection with the arduino,reads and parses the data and sends it over to a database

#establishes a connection with the arduino and reads the serial code
#reads serial from the connection
port_connection = s.Serial('/dev/tty.usbmodem1411',9600)
#creates a database file
file = open('database.txt','w')
while True:
    #reads and parses the input from the arduino
    line = port_connection.readline().decode('utf-8')[0:5]
    #writes serial lines to database
    file.write(line)