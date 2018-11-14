var fs = require('fs');
var myNumber;

function countLines(error, data) {
	if (error) {
		console.error(error);
		return;
	}
	var str = data.toString();
	myNumber = str.split('\n').length;
	console.log(myNumber - 1);
}

fs.readFile(process.argv[2], countLines);
