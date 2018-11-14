var http = require('http');

http.get(process.argv[2], function(response) {
	var content = [];
	response.on('data', function (data) {
		content.push(data);
	})
	response.on('end', function(){
		var str = content.join('');
		console.log(str.length);
		console.log(str);
	});
	response.setEncoding('utf8');
});