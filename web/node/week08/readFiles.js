var file = require('./module.js');
file(process.argv[2], process.argv[3], function(error, list){
 for(var i = 0; i < list.length; i++) {
 	console.log(list[i]);
 }
 });