from flask import Flask
from flask import Flask, render_template, request, url_for, redirect
import os
from operator import itemgetter
import indicoio
from indicoio.custom import Collection
indicoio.config.api_key = '2c71eefa350e63b61a566fa99014e9ca'
import pickle 
PEOPLE_FOLDER = os.path.join('static')

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = PEOPLE_FOLDER

def get_match(img): 
    sort_key = itemgetter(1)
    file_pi2 = open('filename_pi.obj', 'r') 
    collection = pickle.load(file_pi2)
    t = (sorted(collection.predict(img).items(), key=sort_key))
    return t[-1][0] 

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = PEOPLE_FOLDER
@app.route('/',methods = ['POST', 'GET'])
def guest_entry():
    return "hello"

@app.route('/get_best_match',methods = ['POST'])
def get_best_match():
   if request.method == 'POST':
      result = request.form
      #name = str(result["username"])
      #t = str(result["user_id"]) +".jpg"
      t = "vr_image_"+result["user_id"]+".jpg"
      picture_shirt = "test_shirts/"+t 
      print(picture_shirt)
      #frontal = shoulder, waist and arm length 
      #side = waist_size  
      best_match = get_match(picture_shirt)
      p = best_match.split("label")[1]+".jpg" 
      full_filename = os.path.join(app.config['UPLOAD_FOLDER'], p)
      print full_filename
      return render_template("product.html", picture =full_filename,user_id1 = result["user_id"])

if __name__ == "__main__":
	app.run(host='127.1.1.1')
