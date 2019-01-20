from flask import Flask
from flask import Flask, render_template, request, url_for, redirect
import os
from scipy.spatial import distance
from imutils import face_utils
import imutils
import dlib
import cv2
import numpy as np
import cv2 as cv
import numpy as np
import argparse
import time
import mysql.connector
#from visage import ApplyMakeup
from apply_makeup1 import ApplyMakeup
from bs4 import BeautifulSoup
import requests
import re

PEOPLE_FOLDER = os.path.join('static')

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = PEOPLE_FOLDER
app.config['SEND_FILE_MAX_AGE_DEFAULT'] = 0
parser = argparse.ArgumentParser()
parser.add_argument('--input', help='Path to image or video. Skip to capture frames from camera')
parser.add_argument('--thr', default=0.2, type=float, help='Threshold value for pose parts heat map')
parser.add_argument('--width', default=368, type=int, help='Resize input to specific width.')
parser.add_argument('--height', default=368, type=int, help='Resize input to specific height.')

args = parser.parse_args()

BODY_PARTS = { "Nose": 0, "Neck": 1, "RShoulder": 2, "RElbow": 3, "RWrist": 4,
               "LShoulder": 5, "LElbow": 6, "LWrist": 7, "RHip": 8, "RKnee": 9,
               "RAnkle": 10, "LHip": 11, "LKnee": 12, "LAnkle": 13, "REye": 14,
               "LEye": 15, "REar": 16, "LEar": 17, "Background": 18 }

POSE_PAIRS = [ ["Neck", "RShoulder"], ["Neck", "LShoulder"], ["RShoulder", "RElbow"],
               ["RElbow", "RWrist"], ["LShoulder", "LElbow"], ["LElbow", "LWrist"],
               ["Neck", "RHip"], ["RHip", "RKnee"], ["RKnee", "RAnkle"], ["Neck", "LHip"],
               ["LHip", "LKnee"], ["LKnee", "LAnkle"], ["Neck", "Nose"], ["Nose", "REye"],
               ["REye", "REar"], ["Nose", "LEye"], ["LEye", "LEar"] ]

inWidth = args.width
inHeight = args.height


net = cv.dnn.readNetFromTensorflow("graph_opt.pb")


def lipstick_draw(img, r,g,b,user_id): 
	AM = ApplyMakeup()
	#img = cv2.resize(oriimg,None,fx=0.5,fy=0.5)
	o = cv2.imread(img) 
	output_file = AM.apply_lipstick(o,r,g,b,user_id) # (R,G,B) - (170,10,30)
	return output_file 
def eye_aspect_ratio(eye):
	A = distance.euclidean(eye[1], eye[5])
	B = distance.euclidean(eye[2], eye[4])
	print(eye[2], eye[4])
	return [(eye[2][0]+eye[4][0])/2,(eye[2][1]+eye[4][1])/2]
	C = distance.euclidean(eye[0], eye[3])	
	ear = (A + B) / (2.0 * C)
	return ear
def get_points(img,number):
	shoulder = 0 
	waist = 0 
	arm = 0  
	leg = 0 
	waist_size = 0  
	cap = cv.VideoCapture(img)
	#args.input if args.input else 0
	while cv.waitKey(1) < 0:
            hasFrame, frame = cap.read()
            if not hasFrame:
                cv.waitKey()
                break
            frameWidth = frame.shape[1]
            frameHeight = frame.shape[0]
            net.setInput(cv.dnn.blobFromImage(frame, 1.0, (inWidth, inHeight), (127.5, 127.5, 127.5), swapRB=True, crop=False))
            out = net.forward()
            out = out[:, :19, :, :]  # MobileNet output [1, 57, -1, -1], we only need the first 19 elements
            assert(len(BODY_PARTS) == out.shape[1])
            points = []
            for i in range(len(BODY_PARTS)):
		# Slice heatmap of corresponging body's part.
                heatMap = out[0, i, :, :]

		# Originally, we try to find all the local maximums. To simplify a sample
		# we just find a global one. However only a single pose at the same time
		# could be detected this way.
                _, conf, _, point = cv.minMaxLoc(heatMap)
                x = (frameWidth * point[0]) / out.shape[3]
                y = (frameHeight * point[1]) / out.shape[2]
		# Add a point if it's confidence is higher than threshold.
                points.append((int(x), int(y)) if conf > args.thr else None)
            try: 
               shoulder = abs(points[2][0]-points[5][0]) 
            except: 
               pass 
            try: 
               waist =  abs(points[8][0]-points[11][0])
            except: 
               pass 
            try: 
               arm = abs(points[2][1]-points[4][1])
            except: 
                try: 
                    arm = abs(points[5][1]-points[7][1])
                except: 
                    pass
            try: 
                leg =  abs(points[11][1]-points[13][1] )
            except: 
                pass
	    #print("length of hand in pixel"  
	    #p = [points[1],points[2]]
	    #points = p
            for pair in POSE_PAIRS:
                partFrom = pair[0]
                partTo = pair[1]
                assert(partFrom in BODY_PARTS)
                assert(partTo in BODY_PARTS)
                idFrom = BODY_PARTS[partFrom]
                idTo = BODY_PARTS[partTo]	     
                if points[idFrom] and points[idTo]:
                    cv.line(frame, points[idFrom], points[idTo], (0, 255, 0), 3)
                    cv.ellipse(frame, points[idFrom], (3, 3), 0, 0, 360, (0, 0, 255), cv.FILLED)
                    cv.ellipse(frame, points[idTo], (3, 3), 0, 0, 360, (0, 0, 255), cv.FILLED)
            t, _ = net.getPerfProfile()
            freq = cv.getTickFrequency() / 1000
            #cv.putText(frame, '%.2fms' % (t / freq), (10, 20), cv.FONT_HERSHEY_SIMPLEX, 0.5, (0, 0, 0))

	    #cv.imshow('OpenPose using OpenCV', frame)
            if(number == 0): 
                return [shoulder,waist, arm,leg] 
            else: 
                return arm 

def pupil_distance(img): 
	detect = dlib.get_frontal_face_detector()
	predict = dlib.shape_predictor("shape_predictor_68_face_landmarks.dat")
	(lStart, lEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["left_eye"]
	(rStart, rEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["right_eye"]
	flag=0
	if True:
		#ret,frame=cap.read()
		frame = cv2.imread(img)		
		frame = imutils.resize(frame, width=450)
		gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
		subjects = detect(gray, 0)
		for subject in subjects:
			shape = predict(gray, subject)
			shape = face_utils.shape_to_np(shape)#converting to NumPy Array
			leftEye = shape[lStart:lEnd]
			rightEye = shape[rStart:rEnd]
			leftEAR = eye_aspect_ratio(leftEye)
			left_x_y = leftEye[0] 
			right_x_y = rightEye[3]
			rightEAR = eye_aspect_ratio(rightEye)
			ear = distance.euclidean(leftEAR , rightEAR)
			return ear

def glasses_draw(img_glasses, img,user_id): 
	glass_img = cv2.imread(img_glasses)	
	thresh = 0.25
	frame_check = 20
	detect = dlib.get_frontal_face_detector()
	predict = dlib.shape_predictor("shape_predictor_68_face_landmarks.dat")# Dat file is the crux of the code
	(lStart, lEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["left_eye"]
	(rStart, rEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["right_eye"]
	flag=0
	if True:
		#ret,frame=cap.read()
		frame = cv2.imread(img)		
		frame = imutils.resize(frame, width=450)
		gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
		subjects = detect(gray, 0)
		for subject in subjects:
			shape = predict(gray, subject)
			shape = face_utils.shape_to_np(shape)#converting to NumPy Array
			leftEye = shape[lStart:lEnd]
			rightEye = shape[rStart:rEnd]
			#print("left eye",leftEye)
			#print("right eye", rightEye)
			leftEAR = eye_aspect_ratio(leftEye)
			left_x_y = leftEye[0] 
			right_x_y = rightEye[3]
			rightEAR = eye_aspect_ratio(rightEye)
			ear = distance.euclidean(leftEAR , rightEAR)
			#print("pupil distance", ear)
			leftEyeHull = cv2.convexHull(leftEye)
			rightEyeHull = cv2.convexHull(rightEye)
			#print( leftEyeHull)
			#print("right eye",rightEyeHull)
			glasses_width = 3.5*abs(left_x_y[0]-right_x_y[0])
			overlay_img = np.ones(frame.shape,np.uint8)*255
			h,w = glass_img.shape[:2]
			scaling_factor = glasses_width/w
			overlay_glasses = cv2.resize(glass_img,None,fx=scaling_factor,fy=scaling_factor,interpolation=cv2.INTER_AREA)
			x = rightEyeHull[3][0][0]-(.8*int(distance.euclidean(rightEye[0],rightEye[3])))
			#print("right eye", rightEyeHull[1][0][0])
			y = rightEyeHull[3][0][1]-(.5*int(distance.euclidean(rightEye[0],rightEye[3])))
			#   The x and y variables  below depend upon the size of the detected face.
			#x   -=  0.26*overlay_glasses.shape[1]
			#y   +=  0.85*overlay_glasses.shape[0]
			#slice the height, width of the overlay image.
			h,  w   =   overlay_glasses.shape[:2]
			overlay_img[int(y):int(y+h),    int(x):int(x+w)]    =   overlay_glasses
			#   Create a mask and generate it's inverse.
			gray_glasses    =   cv2.cvtColor(overlay_img,   cv2.COLOR_BGR2GRAY)
			ret,    mask    =   cv2.threshold(gray_glasses, 110,    255,    cv2.THRESH_BINARY)
			mask_inv    =   cv2.bitwise_not(mask)
			#cv2.imshow(' Glasses',overlay_img)
			#cv2.imwrite("hello.jpg",image1)
			#cv2.waitKey(0) &0xFF
			temp    =   cv2.bitwise_and(frame,  frame,  mask=mask)
			temp2   =   cv2.bitwise_and(overlay_img,    overlay_img,    mask=mask_inv)
			final_img   =   cv2.add(temp,   temp2)
			#imS = cv2.resize(final_img, (current_height, current_width))
			#image1[current_splice1:current_splice2,current_splice3:current_splice4] = imS
			#cv2.imshow('Lets wear Glasses',final_img)
			#cv2.imwrite("hello.jpg",image1)
			#cv2.waitKey(1) &0xFF
			cv2.drawContours(frame, [leftEyeHull], -1, (0, 255, 255), 1)
			cv2.drawContours(frame, [rightEyeHull], -1, (0, 255, 0), 1)
			filename = "static/temp/glasses_" + str(user_id) +".jpg" 
			cv2.imwrite(filename,final_img)
			return [ear,filename] 
		
		#cv2.imshow("Frame", frame)
		#filename = "static/temp/glasses_" + str(user_id) +".jpg" 
		#cv2.imwrite(filename,final_img)
		#key = cv2.waitKey(0) & 0xFF	

# No caching at all for API endpoints.
@app.after_request
def add_header(response):
    # response.cache_control.no_store = True
    response.headers['Cache-Control'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0'
    response.headers['Pragma'] = 'no-cache'
    response.headers['Expires'] = '-1'
    return response
@app.route('/',methods = ['POST', 'GET'])
def guest_entry():
    return "hello"

dict1 = {1: 2, 2:3, 3:4, 4:1}

@app.route('/put_glasses',methods = ['POST'])
def put_glasses():
   if request.method == 'POST':
      result = request.form
      #name = str(result["username"])
      next_frame = dict1[int(result["product_id"])] 
      picture_add = str("users/image_")+ str(result["user_id"]) +".jpg"
      picture_glasses = str("spectacles/")+ result["product_id"]+".png"
      print(result["user_id"]);
      t = glasses_draw(picture_glasses, picture_add, result["user_id"]) 
      picture_glasses = str("static/spectacles/")+ str(result["product_id"]) +".png"
      #return render_template("product.html", user_image = t[1], ids = result["product_id"])
      print(t)
      t[0] = (7.72*t[0])/397.0
      print(t[0])
      return render_template("product.html", picture = t[1], cat = next_frame, user_ids = result["user_id"],user_id1 = result["user_id"],glasses=picture_glasses)


@app.route('/get_cart', methods = ['POST'])
def get_cart(): 
   if request.method == 'POST': 
        result = request.form 
        data = result["firstname"]
        soup = BeautifulSoup(data)
        regex = re.compile('.*price-box__regular-price sel-cart-unit-price-.*')
        s = soup.findAll("div", {"class":regex})
        prices = [] 
        for z in s: 
             k = z.find('span').text.split(" ")[1]
             prices.append(k)
        print(prices)
        temp = [] 
        f = soup.findAll("a", {"class": "cart__itemName"})
        name = [] 
        for j in f: 
             name.append(j.text.strip())
        t = soup.findAll("div", {"class": "cart__itemListDetailValue lfloat"})
        i = 0
        for x in t: 
             if(i%2 == 0): 
                temp.append(t[i])
             i+=1
        size = [] 
        for ts in temp: 
               sizes = ["M", "S", "XL", "XS"] 
               if("M" in ts.text): 
                    size.append("M")	
               f = re.findall(r'\d+', ts.text)
               if(f !=[]): 
                    size.append(f[0])
        print(size)
        print(name)

#255,0,128

dict2 = {1: [2,102,0,51], 2:[3,204,0,102], 3:[4,0,0,0], 4:[1,153,0,76]}
@app.route('/put_lipstick',methods = ['POST'])
def put_lipstick():
   if request.method == 'POST':
      result = request.form
      next_frame = dict2[int(result["product_id"])]
      next_product = next_frame[0]
      next_red = next_frame[1] 
      next_green = next_frame[2] 
      next_blue = next_frame[3] 
      #name = str(result["username"])
      red = int(result["red"]) 
      green = int(result["green"]) 
      blue = int(result["blue"])
      picture_add = str("users/image_")+ str(result["user_id"])+".jpg"
      k = lipstick_draw(picture_add, red, green,blue,result["user_id"])
      #name = 'color_' + str(self.red_l) + '_' + str(self.green_l) + '_' + str(self.blue_l)
      file_name = 'static/temp/lipstick_1' + str(result["user_id"]) + '.jpg'
      cv2.imwrite(file_name, k)
      #k = "static/temp/lipstick_1.jpg"
      #print(k)
      t = cv2.imread(file_name)
      #cv2.imshow("h",t) 
      cv2.imwrite(file_name,t)
      t = "static/lipstick/"+str(result["product_id"])+".png"
      #time.sleep(10);
      return render_template("product1.html",  picture = file_name, lipstick =t,  product_id = next_product, user_id = result["user_id"], red = next_red , blue = next_blue, green = next_green,user_id1 = result["user_id"])
 
@app.route('/home', methods = ['POST']) 
def home(): 
   if request.method == 'POST':
      result = request.form
      mydb = mysql.connector.connect(host="localhost",user="root",passwd="",database="pitstawp")
      print(result["username"])
      sql_select_Query = "SELECT password FROM user WHERE username = %s "
      val = (result["username"],)
      cursor = mydb.cursor()
      cursor.execute(sql_select_Query,val)
      records = cursor.fetchall()
      for row in records:
          passwd = row[0]    
      temp = "http://localhost/pitstawp/login.php?login_username="+result["username"]+"&login_pwd="+str(passwd)
      return redirect(temp)
@app.route('/get_dimensions',methods = ['POST'])
def get_dimension():
   if request.method == 'POST':
      result = request.form
      mydb = mysql.connector.connect(host="localhost",user="root",passwd="",database="pitstawp")
      mycursor = mydb.cursor(buffered=True)
      #name = str(result["username"])
      picture_frontal = str("users/image_body_frontal_")+ str(result["user_id"]) +".jpg"
      picture_side = str("users/image_body_side_")+ str(result["user_id"])+".jpg"
      picture_face = str("users/image_")+ str(result["user_id"])+".jpg"
      ear = pupil_distance(picture_face)
      ear = (15*ear)/479
      #frontal = shoulder, waist and arm length 
      #side = waist_size 
      #[shoulder,waist, arm,leg] 
      print("ear is", ear)
      front = get_points(picture_frontal,0) 
      side = get_points(picture_side,1)
      print("front", front)
      #print(front[1],front[0],front[3],front[2],ear,"rishi1234")
      sql = "UPDATE user SET waist_size = %s, shoulder_size=%s, waist_to_leg=%s, arm = %s, pupil_size=%s   WHERE username = %s"
      val = (front[1],front[0],front[3],front[2],ear,str(result["user_id"]),)
      mycursor.execute(sql, val)
      mydb.commit()
      mycursor.close()
      print(front, side)
      #return render_template("product.html")
      return redirect("http://localhost/pitstawp/",code=302)

#@app.route("/members/<string:name>/")
#def getMember(name):
#	return name</string:name>
 
if __name__ == "__main__":
	app.run()
