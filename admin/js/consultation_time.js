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

// //making option of medicine
// var options = "";
// medicineArray.forEach(medicine => {
//     options = options + '<option>' + medicine + '</option><br>';
// });

var options = '<option>8     - 8.30</option>' +
    '<option>8.30  - 9</option>' +
    '<option>9     - 9.30</option>' +
    '<option>9.30  - 10</option>' +
    '<option>10    - 10.30</option>' +
    '<option>10.30 - 11</option>' +
    '<option>11    - 11.30</option>' +
    '<option>16    - 16.30</option>' +
    '<option>16.30 - 17</option>' +
    '<option>17    - 17.30</option>' +
    '<option>17.30 - 18</option>';



var noTime = 0; // used by the addFile() function to keep track of IDs
function addTimeSlot() {
    noTime++; // increment fileId to get a unique ID for the new element
    var html = '<td>' +
        '<select name="timeSlot[' + noTime + ']" class="form-control">' +
        '<option selected>Choose...</option>' +
        options +
        '</select>' +
        '</td>' +
        '<td><a href="" onclick="javascript:removeElement(\'timeSlot-' + noTime + '\'); return false;">Remove</a></td>';

    addElement('time', 'tr', 'timeSlot-' + noTime, html);
}