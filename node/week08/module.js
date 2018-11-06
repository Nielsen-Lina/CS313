var fs = require('fs');
var path = require('path');
var myNumber;

module.exports = function print(directoryName, ext, callback) {
	function printDir(error, data) {
		if (error) {
			callback(error);
			return;
		}
		var list = [];
		for(var i = 0; i < data.length; i++) {
			if (path.extname(data[i]).substring(1) == ext) {
				list.push(data[i]);
			}
		}
		callback(null, list);
	}

	fs.readdir(directoryName, printDir);
}