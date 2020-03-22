import cv2, atexit, logging, sys, time
from datetime import datetime
from threading import Thread
from flask import Flask, render_template, Response
from kamera import VideoCamera
from kamera_ip import IPCAM
from upload import UploadGoogleDrive

app = Flask(__name__)
vs = VideoCamera().start()
#gd = UploadGoogleDrive().start()
#ipc= IPCAM().start()

@app.route('/')
def index():
    return render_template('index.html')

def bacakamera(kamera):
    while True:
        frame = vs.baca()
        time.sleep(.1)
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n\r\n')

@app.route('/video_feed')
def video_feed():
    return Response(bacakamera(VideoCamera()),
                    mimetype='multipart/x-mixed-replace; boundary=frame')

if __name__ == '__main__':
	logging.basicConfig(format='%(asctime)s %(message)s', filename='kamerapengawas.log', level=logging.INFO)
	app.run(host='0.0.0.0', port=5000)
