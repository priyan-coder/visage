from scipy.spatial import distance
from imutils import face_utils
import imutils
import dlib
import cv2
import numpy as np

def eye_aspect_ratio(eye):
	A = distance.euclidean(eye[1], eye[5])
	B = distance.euclidean(eye[2], eye[4])
	print(eye[2], eye[4])
	return [(eye[2][0]+eye[4][0])/2,(eye[2][1]+eye[4][1])/2]
	C = distance.euclidean(eye[0], eye[3])	
	ear = (A + B) / (2.0 * C)
	return ear
glass_img = cv2.imread('spectacles/2.png')	
cv2.imshow('Glasses10',glass_img)
thresh = 0.25
frame_check = 20
detect = dlib.get_frontal_face_detector()
predict = dlib.shape_predictor("shape_predictor_68_face_landmarks.dat")# Dat file is the crux of the code

(lStart, lEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["left_eye"]
(rStart, rEnd) = face_utils.FACIAL_LANDMARKS_68_IDXS["right_eye"]
cap=cv2.VideoCapture(0)
flag=0
if True:
	#ret,frame=cap.read()
	frame = cv2.imread('test9.jpg')		
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
		print("pupil distance", ear)
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
		cv2.imshow(' Glasses3',mask_inv)
		cv2.imshow(' Glasses',overlay_img)
		#cv2.imwrite("hello.jpg",image1)
		cv2.waitKey(0) &0xFF
		temp    =   cv2.bitwise_and(frame,  frame,  mask=mask)
		temp2   =   cv2.bitwise_and(overlay_img,    overlay_img,    mask=mask_inv)
		final_img   =   cv2.add(temp,   temp2)
		#imS = cv2.resize(final_img, (current_height, current_width))
		#image1[current_splice1:current_splice2,current_splice3:current_splice4] = imS
		cv2.imshow('Lets wear Glasses',final_img)
		#cv2.imwrite("hello.jpg",image1)
		cv2.waitKey(1) &0xFF
		cv2.drawContours(frame, [leftEyeHull], -1, (0, 255, 255), 1)
		cv2.drawContours(frame, [rightEyeHull], -1, (0, 255, 0), 1)
		'''
		if ear < thresh:
			flag += 1
			print (flag)
			if flag >= frame_check:
				cv2.putText(frame, "****************ALERT!****************", (10, 30),
					cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)
				cv2.putText(frame, "****************ALERT!****************", (10,325),
					cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)
				#print ("Drowsy")
		else:
			flag = 0
		'''
	cv2.imshow("Frame", frame)
	cv2.imwrite("hello.jpg",final_img)
	key = cv2.waitKey(0) & 0xFF
	#if key == ord("q"):
		#break
#cv2.destroyAllWindows()
#cap.stop()
