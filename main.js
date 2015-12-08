var _ = require('underscore');
var mongodb = require('mongodb');
var config = require('./config.js');
var result = {};

mongodb.connect(config.database, function(err, db) {
	if (err) throw err;
	var infoCollection = db.collection('Info');
	infoCollection.find().toArray(function(err, info) {
		var infoName = _.pluck(info, "name");
		_.each(infoName, function(value, index) {
			result[value] = {};
		});
		var logCollection = db.collection('viewLog');
		logCollection.find().toArray(function(err, logs) {
			_.each(logs, function(value, index) {
				if (value.log.length > 1) {
					_.each(value.log, function(log, key) {
						_.each(value.log, function(otherLog, i) {
							if (log.name != otherLog.name) {
								if (log.name in result) {
									if (typeof result[log.name][otherLog.name] != 'undefined') 
										result[log.name][otherLog.name]++;
									else
										result[log.name][otherLog.name] = 1;
								}
							}
						});
					});
				}
			});
			result =  _.map(result, function(value, key) {
				return {name: key, result: value};
			});

			_.each(result, function(value, key) {
				result[key].data = [];
				_.each(value.result, function(data, index) {
					result[key].data.push({name: index, counter: data});
				});
			});
			//sort result
			_.each(result, function(value, key) {
				result[key].data = _.sortBy(value.data, "counter").reverse();
			});
			_.each(result, function(value, key) {
				console.log("inserting");
				infoCollection.updateOne({name: value.name}, {$set: {relative: value.data}}, 
					function(err, response) {
						if (err) throw err;
						console.log("yes");
				});
			});
			console.log("yes2");
		});
	});
});