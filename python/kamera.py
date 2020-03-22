import numpy as np
import cv2, sys, urllib2, urllib, time
from collections import deque
from datetime import datetime
from threading import Thread

class VideoCamera(object):
    def __init__(self):
        global t0, t1, t2
        self.q = deque(maxlen=20)

        self.cam = cv2.VideoCapture(0)
        self.cam.set(3, 960)
        self.cam.set(4, 720)

        #self.batas = 149000
        self.waktu = datetime.now().strftime("%d-%m-%Y %H:%M:%S")

        (self.grabbed, self.frame) = self.cam.read()
        self.stopped = False
        self.exeption = None

    def __del__(self):
        self.cam.release()

    def start(self):
        p1 = Thread(target=self.update, args=())
        p1.daemon = True
        p1.start()

        p2 = Thread(target=self.motion, args=())
        p2.daemon = True
        p2.start()

        p3 = Thread(target=self.simpan_video, args=())
        p3.daemon = True
        p3.start()

        return self

    def update(self):
        time.sleep(2)
        while True:
            if self.stopped:
                return

            (self.grabbed, self.frame) = self.cam.read()
            self.q.append(self.frame)

    def diffImg(self, t0, t1, t2):
        d1 = cv2.absdiff(t2,t1)
        d2 = cv2.absdiff(t1,t0)

        return cv2.bitwise_and(d1, d2)

    def motion(self):
        #winName = "Movement Indicator"
        #cv2.namedWindow(winName)
        time.sleep(.1)
        batas = 129000

        cek_waktu = datetime.now().strftime('%Ss')

        t_minus = cv2.cvtColor(self.cam.read()[1], cv2.COLOR_RGB2GRAY)
        t = cv2.cvtColor(self.cam.read()[1], cv2.COLOR_RGB2GRAY)
        t_plus = cv2.cvtColor(self.cam.read()[1], cv2.COLOR_RGB2GRAY)
        while True:
            jam = datetime.now().strftime("%d-%m-%Y %H:%M:%S")
            totalDiff = cv2.countNonZero(self.diffImg(t_minus, t, t_plus)) # total perbedaan nilai warna
            text = "threshold: " + str(totalDiff)
            cv2.putText(self.frame, text, (20,40), cv2.FONT_HERSHEY_SIMPLEX, 1, (0,0,0), 2)
            #print(text)
            if totalDiff > batas and cek_waktu != datetime.now().strftime('%Ss'):
                dimg = self.cam.read()[1]
                cv2.imwrite(('../pictures/' + str(jam) + '.jpg'), dimg)
                gambar = (str(jam)+'.jpg')
                print(gambar)
                dataKiriman = [('kamera','kamera satu'),('tanggal',jam),('gambar',gambar)]
                dataKiriman = urllib.urlencode(dataKiriman)
                path='http://192.168.0.100/kamera_pengawas/python/penerima.php'
                req = urllib2.Request(path, dataKiriman)
                page= urllib2.urlopen(req).read()
                #cv2.imshow(winName, self.frame)
                #cv2.imshow(winName, self.diffImg(t_minus, t, t_plus))

            cek_waktu = datetime.now().strftime('%Ss')
            t_minus = t
            t = t_plus
            t_plus = cv2.cvtColor(self.cam.read()[1], cv2.COLOR_RGB2GRAY)

            key = cv2.waitKey(10)
            if key == ord('q'):
                cv2.destroyWindow(winName)
                break
        return self

    def baca(self):
        ret, jpeg = cv2.imencode('.jpg', self.frame)
        return jpeg.tobytes()

    def simpan_video(self):
        width = int(self.cam.get(cv2.CAP_PROP_FRAME_WIDTH) + 0.5)
        height = int(self.cam.get(cv2.CAP_PROP_FRAME_HEIGHT) + 0.5)

        fourcc = cv2.VideoWriter_fourcc(*'mp4v')
        out = cv2.VideoWriter('../recording/'+ str(self.waktu)+'.mp4', fourcc, 20.0, (width,height))

        while(self.cam.isOpened()):
            ret, self.frame = self.cam.read()
            if ret == True:
                out.write(self.frame)
                key = cv2.waitKey(10)
                if key == ord('q'):
                    break
        return self
