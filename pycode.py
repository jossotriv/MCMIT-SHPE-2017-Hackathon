my_ser = serial.Serial('/dev/tty.usbmodemfa131',19200)

while 1:
    #a = raw_input('enter a value:')
    #my_ser.write(a)
    data = my_ser.read(4)
    f_data, = struct.unpack('<f',data)
    print f_data
    #time.sleep(0.5)