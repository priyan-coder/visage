from visage import ApplyMakeup
import cv2
AM = ApplyMakeup()
#img = cv2.resize(oriimg,None,fx=0.5,fy=0.5)
o = cv2.imread('hello.jpg') 
output_file = AM.apply_lipstick(o,0,0,255) # (R,G,B) - (170,10,30)
output_file1 = AM.apply_liner(output_file) # (R,G,B) - (170,10,30)
print(output_file1)
