
    function openForm(itemID) {
    document.getElementById(itemID).style.display = "block";
}

    function closeForm(itemID) {
    document.getElementById(itemID).style.display = "none";
}

    function gotoDiv(itemID){
        var elmnt = document.getElementById(itemID);

        elmnt.scrollIntoView(true); // Top
    }