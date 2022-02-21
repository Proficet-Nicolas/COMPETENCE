function Competence(id) {
    var id_situation = id;
    var myWindow = window.open("index.php?Competence_mobiliser=true?id_situation= . id_situation .", "", "width=1000,height=500");
}

var itemNum = 1;

function initLien() {
    var buttonForPHP = document.getElementById("itemNum")
    buttonForPHP.style = "display:none;"
    buttonForPHP.type = "text"
    buttonForPHP.name = "itemNum"
    buttonForPHP.value = itemNum

    var table = document.createElement("table")
    table.style = "width: 100%;"
    table.id = "table_" + itemNum

    var tr = document.createElement("tr")

    var tdLeft = document.createElement("td")
    tdLeft.style = "width:2.5%"

    var button = document.createElement("button")
    button.type = "button"
    button.onclick = function() {
        var newNum = itemNum - 1
        var elem = document.getElementById("table_" + parseInt(newNum))
        elem.remove();
        itemNum = itemNum - 1
    }
    button.style = "height:50px; width: 50px; font-size: 40px; color:red;"
    button.innerText = "X"

    var tdRight = document.createElement("td")
    tdRight.class = "right"

    var boxL = document.getElementById("boxLiens")
    var centralDiv = document.createElement("div")
    centralDiv.id = "centralDiv"
    boxL.appendChild(table)
    table.appendChild(tr)
    tr.appendChild(tdRight)
    tr.appendChild(tdLeft)
    tdRight.appendChild(centralDiv)
    tdLeft.appendChild(button)

    var URLDiv = document.createElement("div")
    var detailsDiv = document.createElement("div")
    centralDiv.appendChild(URLDiv)
    centralDiv.appendChild(detailsDiv)

    var spanURL = document.createElement("span")
    spanURL.innerText = "URL : "
    URLDiv.appendChild(spanURL)

    var url = document.createElement("input")
    url.type = "text"
    url.name = "url_" + itemNum;
    url.id = "url"
    URLDiv.appendChild(url)

    var spanDetails = document.createElement("span")
    spanDetails.innerHTML = "Détails : "
    detailsDiv.appendChild(spanDetails);

    var details = document.createElement("input")
    details.type = "text"
    details.name = "detail_" + itemNum;
    details.id = "url"
    detailsDiv.appendChild(details);

    itemNum++;
}

function openForm() {
    document.getElementById("editComp").style.display = "block";
    document.getElementById("showCollab").style.display = "none";
}

function closeForm() {
    document.getElementById("editComp").style.display = "none";
    document.getElementById("showCollab").style.display = "block";
}