module.exports = Poster;

var fs = require('fs');

// Constructor
function Poster(req) {
  // always initialize all instance properties
  this.mode = req.body.mode;
  this.greeting = "Posting"; 
  if(this.mode == 'aggregator'){
	  this.writeContact(req.body);
  }
  
}

// class methods
Poster.prototype.greetingText = function() {

	if(this.mode == "aggregator"){
		this.greeting = "check terminal for results";
		//console.log(this.greeting);
		
	} 
	return this.greeting;
	
  
}


Poster.prototype.controlContext = function() {
	
	return this.mode;
	
}

Poster.prototype.writeContact = function(req) {
	/*
	var contact = fs.createWriteStream('contacts.txt', {'flags': 'a'});
	// use {'flags': 'a'} to append and {'flags': 'w'} to erase and write a new file
	var message = req.message;
	var email = req.email;
	var fname = req.fname;
	var lname = req.lname;
	var str = "email: "+email+" , name: "+fname+" "+lname+ " , message: "+message+ " \n";
	
	contact.write(str);
	*/
	
	
}


Poster.prototype.convertTimestamp = function(timestamp) {
        //function from https://gist.github.com/kmaida/6045266
        var d = new Date(timestamp),	
		yyyy = d.getFullYear(),
		mm = ('0' + (d.getMonth() + 1)).slice(-2),	// Months are zero based. Add leading 0.
		dd = ('0' + d.getDate()).slice(-2),			// Add leading 0.
		hh = d.getHours(),
		h = hh,
		min = ('0' + d.getMinutes()).slice(-2),		// Add leading 0.
		ampm = 'AM',
		time;
			
	    if (hh > 12) {
		    h = hh - 12;
		    ampm = 'PM';
	    } else if (hh === 12) {
		    h = 12;
		    ampm = 'PM';
	    } else if (hh == 0) {
		    h = 12;
	    }
	
	    // ie: 2013-02-18, 8:35 AM	
	    time = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;
		
	    return time;
    }


    
    ///**** addCollection() ***///
    /*
    Poster.prototype.addCollection = function(obj_collection) {
    
        //console.log(obj_collection);
        var insert_rec = obj_collection;
	    //Mongodb initialization and functionality  >npm install mongodb
        var MongoClient = require('mongodb').MongoClient, assert = require('assert');
        // Mongodb Connection URL
        var url = 'mongodb://localhost:27017/quakes_collection';
        
        var insertDocuments = function(db, callback) {
        // Get the quakes collection
        var collection = db.collection('quakes');
    
        // Insert some documents
            console.log(insert_rec);
            collection.insertOne(insert_rec, function(err, result) {
            assert.equal(err, null);
            assert.equal(1, result.result.n);
            assert.equal(1, result.ops.length);
            console.log("Inserted quake into the collection");
            callback(result);
        });
      }   
    

      MongoClient.connect(url, function(err, db) {
        assert.equal(null, err);
        console.log("Connected correctly to server");
        insertDocuments(db, function() {
        
      });
    });
	//return this.mode;
	
}// ends addCollection()
    */
    
    function addCollection(obj_collection){
        
         //console.log(obj_collection);
        var insert_rec = obj_collection;
	    //Mongodb initialization and functionality  >npm install mongodb
        var MongoClient = require('mongodb').MongoClient, assert = require('assert');
        // Mongodb Connection URL
        var url = 'mongodb://localhost:27017/quakes_collection';
        
        var insertDocuments = function(db, callback) {
        // Get the quakes collection
        var collection = db.collection('quakes');
    
        // Insert some documents
            console.log(insert_rec);
            collection.insertOne(insert_rec, function(err, result) {
            assert.equal(err, null);
            assert.equal(1, result.result.n);
            assert.equal(1, result.ops.length);
            console.log("Inserted quake into the collection");
            callback(result);
        });
      }   
    

      MongoClient.connect(url, function(err, db) {
        assert.equal(null, err);
        console.log("Connected correctly to server");
        insertDocuments(db, function() {
        
      });
    });
        
    }

     ///**** itemExists() ***///
    Poster.prototype.itemExists = function(uid, obj_collection) {
        
        console.log(uid);
        var uid = uid;
        //this.status = "UNSET"
	    //Mongodb initialization and functionality  >npm install mongodb
        var MongoClient = require('mongodb').MongoClient, assert = require('assert');
        // Mongodb Connection URL
        var url = 'mongodb://localhost:27017/quakes_collection';
        
         var findOneDocument = function(db, callback) {
        // Get the documents collection
        var collection = db.collection('quakes');
        // Find some documents
        collection.find({uid: uid}).toArray(function (err, result, status) {
          //this.status = "UNSET";            
          if (err) {
            console.log(err);
            this.status = "ERROR";
              console.log(this.status);
               
          } else if (result.length) {
            //console.log('Found:', result);
            console.log("FOUND");  
            this.status = "EXISTS";
              console.log(this.status);
              
          } else {
              console.log('NOT Found');
            //console.log('No document(s) found with defined "find" criteria!');
            //insert record since it does not exist
            this.status = "NOT_EXISTS";
              console.log(this.status);
              addCollection(obj_collection);
              
              
          }
          //Close connection
          db.close();
        });
        } 
        
        MongoClient.connect(url, function(err, db) {
            assert.equal(null, err);
            console.log("Connected correctly to server");
            findOneDocument(db, function() {
                
              db.close();
            });    
        });
        
        //console.log("status in scope "+ status);
        
        console.log("this.status is "+ this.status);
       
        
    } // ends itemExists 
    
    
    
    