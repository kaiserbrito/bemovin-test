var url = $('#_emailContainer').attr('data-url');

getEmail(url);
setInterval(function(argument){getEmail(url)}, 1000);

function getEmail(url) {
	$.getJSON(url + 'emails/get_emails', function(responser){
		$('#numUrls span').html(responser.urlsNum);
		var html = '<ul>';
		for(var index in responser.emails)
			html += '<li>' + responser.emails[index].Email.email + '</li>';

		html += '</ul>';
		$('#_emailContainer').html(html);
	});
}