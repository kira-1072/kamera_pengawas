import numpy as np
import cv2, sys, time, urllib
from threading import Thread
from datetime import datetime

class IPCAM(object):
    def __init__(self):
        self.url = 'http://192.168.0.100:80/webcapture.jpg?command=snap&channel=1'
        #self.cam.set
        self.cam = cv2.VideoCapture(self.url)
        (self.grabbed, self.frame) = self.cam.read()
        self.waktu = datetime.now().strftime("%d-%m-%Y %H:%M:%S")

    def start(self):
        p6 = Thread(target=self.kamera_ip, args=())
        p6.daemon = True
        p6.start()

        return self

    def kamera_ip(self):
        width = int(self.cam.get(cv2.CAP_PROP_FRAME_WIDTH) + 0.5)
        height = int(self.cam.get(cv2.CAP_PROP_FRAME_HEIGHT) + 0.5)
        fourcc = cv2.VideoWriter_fourcc(*'XVID')
        out = cv2.VideoWriter('../recording/' + str(self.waktu)+'.avi', fourcc, 20.0, (width, height))
        while True:

            #time.sleep(0.1)
            imgResp = urllib.urlopen(self.url)
            imgNp = np.array(bytearray(imgResp.read()),dtype=np.uint8)
            img = cv2.imdecode(imgNp,-1)

            while(self.cam.isOpened()):
                if self.grabbed == True:
                    out.write(img)
                    #cv2.imshow('IPWebcam',img)
                    if (cv2.waitKey(1) & 0xFF) == ord('q'): # Hit `q` to exit
                        break
                    else:
                        break

            print(img)
        out.release()
        self.cam.release()
        cv2.destroyAllwindows()
