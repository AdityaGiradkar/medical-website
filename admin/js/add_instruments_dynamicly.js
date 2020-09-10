//adding dyanamic medicine fields on button click
function addElement(parentId, elementTag, elementId, html) {

    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;
    p.appendChild(newElement);
}

// Removes a medicine from the document
function removeElement(elementId) {
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

//making option of medicine
var instru_options = "";
instrumentArray.forEach(instrument => {
    instru_options = instru_options + '<option>' + instrument + '</option><br>';
});

var noInstrument = 0; // used by the addFile() function to keep track of IDs
function addInstrument() {
    noInstrument++; // increment fileId to get a unique ID for the new element
    var instru_html = '<td>' +
        '<select id="inputState" name="instrument_name[' + noInstrument + ']" class="form-control">' +
        '<option selected>Choose...</option>' +
        instru_options +
        '</select>' +
        '</td>' +
        '<td><input type="text" name="note[' + noInstrument + ']" class="form-control" /></td>' +
        '<td><a href="" onclick="javascript:removeElement(\'instrument-' + noInstrument + '\'); return false;">Remove</a></td>';

    addElement('instrument', 'tr', 'instrument-' + noInstrument, instru_html);
}



function confirm_submission() {
    if (confirm("do you want to suggest medicines?")) {
        return true;
    }
    return false;
}

function close_treatment() {
    if (confirm("do you want to close this treatment?")) {
        return true;
    }
    return false;
}