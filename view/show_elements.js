
    function showItems(itemID) {
    var x = document.getElementById(itemID);
    if (x.style.display === "none") {
    x.style.display = "block";
} else {
    x.style.display = "none";
}
}

    function openForm(itemID) {
    document.getElementById(itemID).style.display = "block";
}

    function closeForm(itemID) {
    document.getElementById(itemID).style.display = "none";
}
