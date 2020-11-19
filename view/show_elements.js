
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

        function show_edit(){
        if (document.getElementById("edit_login").style.display === "none") {
            openForm("edit_login");
            openForm("edit_name");
            openForm("edit_email");
            openForm("edit_heslo");
            openForm("confirm_changes");
            closeForm("show_login");
            closeForm("show_name");
            closeForm("show_email");
    }
        else {
            openForm("show_login");
            openForm("show_name");
            openForm("show_email");
            closeForm("edit_login");
            closeForm("edit_name");
            closeForm("edit_email");
    }
    }