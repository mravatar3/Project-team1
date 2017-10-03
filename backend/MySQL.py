#!/usr/bin/python3

import pymysql

# Open database connection
db = pymysql.connect("localhost","root","amsterdam","YogaSchool" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

# execute SQL query using execute() method.
cursor.execute("SELECT voornaam, achternaam FROM Klant")

# Fetch a single row using fetchone() method.
data = cursor.fetchone()

# Print date
for (voornaam, achternaam )in cursor:
  print("{} {} staat in de db".format(
    voornaam, achternaam))

# disconnect from server
db.close()


