window.addEventListener('load', function () {
	document.getElementById('area').addEventListener('paste', onTextChange);
	document.getElementById('area').addEventListener('input', onTextChange);
	document.getElementById('link').addEventListener('click', onLinkClicked);
	document.getElementById('code').addEventListener('click', onCodeClicked);
	
	var addComment = document.getElementsByClassName("add-comment");
	
	for (var i = 0; i < addComment.length; i++) {
	    addComment[i].addEventListener('click', showCommentField, false);
	}
});

function showCommentField(e) {
	e.preventDefault();
	var data = this.id.split('-');
	this.style.display = "none";
	document.getElementById(data[0] + 'Comment' + data[1]).style.display = "flex";
}

var modes = ["normal", "code"];

function onTextChange(e) {
	var data = this.value.split("\n");
	var preview = document.getElementById("preview");
	preview.innerHTML = "";
	var mode = modes[0];
	var codeElements = 0;
	var linkRegex = /{http[s]*:\/\/[^\s]+}\[.+\]/;

	for (var i = 0; i < data.length; i++) {
		if(data[i] == "-->") {
			codeElements += 1;
			mode = modes[1];
			preview.innerHTML += '<code></code>';
		} else if(data[i] == "<--") {
			mode = modes[0];
		}else {
			// Sanitize user input
			data[i] = data[i].replace(/</g, '&lt;').replace(/\/>/g, 'b&gt;');

			// Check for link
			if (linkRegex.test(data[i])) {
				data[i] = data[i].replace(/{/g, '<a href=').replace(/}/g, ' target="_blank">');
				data[i] = data[i].replace(/\[/g, '').replace(/\]/g, '</a>');
			}

			if(mode == modes[1]) {
				var code = preview.getElementsByTagName('code')[codeElements - 1];
				code.innerHTML += '<p>' + data[i] + '</p>';
			}else {
				preview.innerHTML += '<p>' + data[i] + '</p>';
			}
		}
	}
}

function onCodeClicked(e) {
	document.getElementById('area').value += '\n-->\ncode\n<--';
	triggerArea();
}

function onLinkClicked(e) {
	document.getElementById('area').value += '{http://www.example.com}[Example link]';
	triggerArea();
}

function triggerArea() {
	var event = document.createEvent("HTMLEvents");
    event.initEvent("input", false, true);
    document.getElementById('area').dispatchEvent(event);
    document.getElementById("area").focus();
}
