var fs = require('fs');
var path = require('path');
var myNumber;

function printDir(error, data) {
	if (error) {
		console.error(error);
		return;
	}
	for(var i = 0; i < data.length; i++) {
		if (path.extname(data[i]).substring(1) == process.argv[3]) {
			console.log(data[i]);
		}
	}
}

fs.readdir(process.argv[2], printDir);