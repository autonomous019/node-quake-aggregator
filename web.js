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
    findDocuments(db);
});


//data models and others
var posterEngine = require('./poster');

///**** MAIN or INDEX CONTROLLER ***///
app.get('/', function(req, res) {
	res.render('index',{title:"QN: Home", entries:""});
});

///**** POST CONTROLLER ***///
app.post('/post', function(req, res){ 
    
  var mode = req.body.mode;  //all forms need a mode for the post delegator
  var Poster = require('./poster');
  var poster_controller = new Poster(req);
  //req.body -- contains form data
  var q_data = req.body.quake_data;
  var q_json_data = JSON.parse(q_data);
 
  for (var key in q_json_data) {
    var cnt = 0;
    var obj_collection = {};

    for (var k in q_json_data[key]){

        obj_collection = q_json_data[key]['properties'];
        obj_collection.coordinates = JSON.stringify(q_json_data[key]['geometry']['coordinates']);
        obj_collection.date_time = poster_controller.convertTimestamp(q_json_data[key]['properties']['time']);
        obj_collection.uid = q_json_data[key]['id'];
        var uid = q_json_data[key]['id'];
        var exists = poster_controller.itemExists(uid, obj_collection);
        console.log('exists is '+ exists);
        
    
        
    cnt++;
    if(cnt > 0){
        break;
    }
        
   }
  }
   
  //add item should be outside the prevoius two loops    
  

    
  //console.log(poster_conroller.greetingText());
  var greeting = poster_controller.greetingText();
  //var fileUpdate = poster_controller.writeContact(req.body);
  res.render('post', {title:"Quakes Post", mode:mode, greeting:greeting });
});  //ends post controller


///*** INIT THE SERVER ***///
//server start function
app.listen(1337, function () {
  console.log('Node-Quake-Aggregator listening on port 1337!');
});



