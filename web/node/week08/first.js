var fs = require('fs');
var myNumber;

var result = fs.readFileSync(process.argv[2]);

var str = result.toString();
myNumber = str.split('\n').length;
console.log(myNumber - 1);