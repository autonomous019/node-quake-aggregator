//check package.json for appropriate dependencies
//Required modules
var express = require('express'); //npm install express
var app = express();  
var bodyParser= require('body-parser');  //npm install body-parser --save
var hbs = require('hbs');
var helpers = require('./helpers.js'); //Handlebars helpers methods

//setup app functionality
app.set('view engine', 'html');
app.engine('html', hbs.__express);
app.use(express.static('public'));
app.use(bodyParser.urlencoded({extended: true}));

//Mongodb initialization and functionality  >npm install mongodb
var MongoClient = require('mongodb').MongoClient
  , assert = require('assert');
// Mongodb Connection URL
var url = 'mongodb://localhost:27017/quakes_collection';

//to empty collection, comment out in production.       

var removeDocuments = function(db, callback) {
    db.collection('quakes').deleteMany();
    console.log('items deleted');
}; 

var findDocuments = function(db, callback) {
        // Get the documents collection
        var collection = db.collection('quakes');
        // Find some documents
        collection.find({}).toArray(function(err, docs) {
            assert.equal(err, null);
            console.log("Found the following quakes");
            console.log(docs)
            //callback(docs);
         });
        }


MongoClient.connect(url, function(err, db) {
    assert.equal(null, err);
    console.log("Connected correctly to server");
    //removeDocuments(db);  //comment this out when ready for production
    //findDocuments(db);
});



//data models and others
var posterEngine = require('./poster');


/* requesting info from NOAA using curl */
/* don't forget to >npm install request */
/*
var requester = require('request');

url='http://www.ncdc.noaa.gov/cdo-web/api/v2/data?datasetid=GHCND&locationid=ZIP:28801&startdate=2010-05-01&enddate=2010-05-01';

requester({
    url: 'http://www.ncdc.noaa.gov/cdo-web/api/v2/data?datasetid=GHCND&locationid=ZIP:28801&startdate=2010-05-01&enddate=2010-05-01',
    method: 'GET',
    headers: { 'token': 'SmGOPcOMJzsnZvYSNdugaaOqBDzoOiPu' },
    },
    function (error, response, body) {
        if (error) throw error;
        console.log(body);
    }
);
*/

/*  read cache files then populate into mongodb */

var fs = require('fs');

fs.readFile('cache/test_file.js', 'utf8', function(err, data) {  
    if (err) throw err;
    obj = JSON.parse(data);
    console.log(obj);
  
    //var exists = poster_controller.itemExists(uid, obj_collection);
  
});

///*** INIT THE SERVER ***///
//server start function
app.listen(1337, function () {
  console.log('File Parser running on port 1337!');
});



