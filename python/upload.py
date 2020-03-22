import numpy as np
import cv2, sys, urllib, urllib2, MySQLdb, time
from  datetime import datetime
from googleapiclient.discovery import build
from httplib2 import Http
from oauth2client import file, client, tools
from threading import Thread

class UploadGoogleDrive(object):
    def __init__(self):
        self.SCOPES = 'https://www.googleapis.com/auth/drive.file'
        self.store = file.Storage('storage.json')
        self.creds = self.store.get()

    def start(self):
        p1 = Thread(target=self.argumen, args=())
        p1.start()

        p2 = Thread(target=self.upload, args=())
        p2.daemon=True
        p2.start()
        return self

    def argumen(self):
        try :
            import argparse
            self.flags = argparse.ArgumentParser(parents=[tools.argparser]).parse_args()
        except ImportError:
            self.flags = None

    def upload(self):
        if not self.creds or self.creds.invalid:
            print("buat penyimpanan file data baru")
            flow = client.flow_from_clientsecrets('client_secret.json', self.SCOPES)
            self.creds = tools.run_flow(flow, store, self.flags) \
                            if self.flags else tools.run(flow, self.store)

        DRIVE = build('drive', 'v3', http=self.creds.authorize(Http()))
        tmp=0

        while True:
            time.sleep(.1)
            db = MySQLdb.connect("localhost","root","Smart1996%","kamera-pengawas")
            cursor = db.cursor()

            sql = "select gambar from gambars order by gambar_id desc limit 1"
            cursor.execute(sql)
            results = cursor.fetchall()
            for row in results:
                data = row[0]

                if tmp != data:
                    tmp = data
                    cek = True

                if cek == True:
                    FILES = (
                        ('../pictures/'+data),
                    )

                    for file_title in FILES:
                        file_name = file_title
                        metadata = {'name': file_name,
                                    'mimeType': None
                                    }

                    res = DRIVE.files().create(body=metadata, media_body=file_name).execute()
                    if res:
                        file_name = file_title
                        print('Uploaded "%s" (%s)' % (file_name, res['mimeType']))
                        #print('\n Upload berhasil')
                    cek = False

                key = cv2.waitKey(10)
                if key == 27:
                    cv2.destroyWindow(winName)
                    break
            db.close()
        return self
