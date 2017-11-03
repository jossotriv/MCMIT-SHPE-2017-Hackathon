# sends alerts to fire chief to tell that people are in danger
import smtplib

from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

def send_mail(me,you,name,location):

    msg = MIMEMultipart('alternative')
    msg['Subject'] = "Link"
    msg['From'] = me
    msg['To'] = you

    text = name + " is in danger in " +location+ ". Send help!!!"


    part1 = MIMEText(text, 'plain')

    msg.attach(part1)

    server = smtplib.SMTP('smtp.gmail.com:587')
    server.starttls()
    server.login(me, "PabJosSotRiv8")

    server.sendmail(me, you, msg.as_string())
    server.quit()
#sends
send_mail('jossotriv@gmail.com','jodosori@mit.edu','Andrew','(39.097334,-94.586437)')
send_mail('jossotriv@gmail.com','jodosori@mit.edu','Jennifer','(39.097334,-94.586437)')
