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

var options = '<option>05.30 - 06.00</option>' +
    '<option>06.00 - 06.30</option>' +
    '<option>06.30 - 07.00</option>' +
    '<option>07.00 - 07.30</option>' +
    '<option>07.30 - 08.00</option>' +
    '<option>08.00 - 08.30</option>' +
    '<option>08.30 - 09.00</option>' +
    '<option>09.00 - 09.30</option>' +
    '<option>09.30 - 10.00</option>' +
    '<option>10.00 - 10.30</option>' +
    '<option>10.30 - 11.00</option>' +
    '<option>11.00 - 11.30</option>' +
    '<option>11.30 - 12.00</option>' +
    '<option>12.00 - 12.30</option>' +
    '<option>12.30 - 13.00</option>' +
    '<option>13.00 - 13.30</option>' +
    '<option>13.30 - 14.00</option>' +
    '<option>14.00 - 14.30</option>' +
    '<option>14.30 - 15.00</option>' +
    '<option>15.00 - 15.30</option>' +
    '<option>15.30 - 16.00</option>' +
    '<option>16.00 - 16.30</option>' +
    '<option>16.30 - 17.00</option>' +
    '<option>17.00 - 17.30</option>' +
    '<option>17.30 - 18.00</option>' +
    '<option>18.00 - 18.30</option>' +
    '<option>18.30 - 19.00</option>' +
    '<option>19.00 - 19.30</option>' +
    '<option>19.30 - 20.00</option>' +
    '<option>20.00 - 20.30</option>' +
    '<option>20.30 - 21.00</option>' +
    '<option>21.00 - 21.30</option>' +
    '<option>21.30 - 22.00</option>' +
    '<option>22.00 - 22.30</option>' +
    '<option>22.30 - 23.00</option>' +
    '<option>23.00 - 23.30</option>';



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