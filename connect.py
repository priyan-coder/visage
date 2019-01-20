import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="pitstawp"
)
mycursor = mydb.cursor(buffered=True)
sql = "UPDATE user SET waist_size = %s, shoulder_size=%s, waist_to_leg=%s  WHERE username = %s"
val = ("1","2","3","rishi1234", )
mycursor.execute(sql, val)
mydb.commit()
mycursor.close()


