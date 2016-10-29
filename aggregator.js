var express = require('express');
var app = express();
var bodyParser= require('body-parser');

//app templating engines   
var hbs = require('hbs');
var helpers = require('./helpers.js'); //Handlebars helpers methods
app.set('view engine', 'html');
app.engine('html', hbs.__express);
//app.use(express.bodyParser());
app.use(express.static('public'));
app.use(bodyParser.urlencoded({extended: true}));

var MongoClient = require('mongodb').MongoClient
  , assert = require('assert');

// Connection URL
var url = 'mongodb://localhost:27017/quakes_collection';

var insertDocuments = function(db, callback) {
  // Get the documents collection
  var collection = db.collection('documents');
  // Insert some documents
  collection.insertMany([
    {a : 1}, {a : 2}, {a : 3}
  ], function(err, result) {
    assert.equal(err, null);
    assert.equal(3, result.result.n);
    assert.equal(3, result.ops.length);
    console.log("Inserted 3 documents into the collection");
    callback(result);
  });
}

var findDocuments = function(db, callback) {
  // Get the documents collection
  var collection = db.collection('documents');
  // Find some documents
  collection.find({}).toArray(function(err, docs) {
    assert.equal(err, null);
    console.log("Found the following records");
    console.log(docs)
    callback(docs);
  });
}

MongoClient.connect(url, function(err, db) {
  assert.equal(null, err);
  console.log("Connected correctly to server");

  insertDocuments(db, function() {
    findDocuments(db, function() {
      db.close();
    });
  });
});

var loadJsonFromRemote = function (url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("load", function () {
        callback(JSON.parse(this.response));
    });
    xhr.open("GET", url);
    xhr.send();
};



// load JSON from a remote server
loadJsonFromRemote("https://api.github.com/", function (data) {
    // display JSON data from remote server
    console.log(data);
    //el = document.querySelector("#xhr-json");
    //el.textContent = JSON.stringify(data, null, 4);
});

app.get('/', function(req, res) {
	res.render('index',{title:"Busr Transitor", entries:""});
});


app.listen(1337, function () {
  console.log('Example app listening on port 1337!');
});
