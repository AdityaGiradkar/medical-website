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
console.log(medicineArray);
//making option of medicine
var options = "";
medicineArray.forEach(medicine => {
    var mediID = medicine.medicine_id;
    var price = medicine.price;
    var quantity = medicine.quantity;
    var name = medicine.Name;
    var value = mediID + "," + price;
    options = options + '<option value="' + value + '">' + name + ' - (Rs. ' + price + ' / ' + quantity + ') </option><br>';
});


var noMedicine = 0; // used by the addFile() function to keep track of IDs
function addMedicine(treat_no) {
    noMedicine++; // increment fileId to get a unique ID for the new element
    var html = '<td>' +
        '<select id="inputState" name="medicine_name[' + noMedicine + ']" class="form-control">' +
        '<option value="0" selected disabled>Choose...</option>' +
        options +
        '</select>' +
        '</td>' +
        '<td><input type="text" value = "1" name="quantityMed[' + noMedicine + ']" class="form-control" /></td>' +
        '<td><a href="" onclick="javascript:removeElement(\'medicine-' + noMedicine + '\'); return false;">Remove</a></td>';

    addElement('medicine_' + treat_no, 'tr', 'medicine-' + noMedicine, html);
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