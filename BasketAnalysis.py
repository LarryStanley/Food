import json
import urllib2
import sys
from pymongo import MongoClient

client = MongoClient('beta.ncufood.info', 65147)
db = client.Food
collection = db.Info

allFoodData = collection.find({})
foodList = {}

collection = db.viewLog
viewLogs = collection.find({})

for food in allFoodData:
    foodList[food['name']] = {}

for logs in viewLogs:
    for log in logs['log']:


print "done"