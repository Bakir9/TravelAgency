function validacija(){
    var ime = document.forms["dodavanjeAdmina"]["ime"].value;
    var prezime = document.forms["dodavanjeAdmina"]["prezime"].value;
    var email = document.forms["dodavanjeAdmina"]["email"].value;
    var korisnicko_ime = document.forms["dodavanjeAdmina"]["korisnicko_ime"].value;
    var lozinka = document.forms["dodavanjeAdmina"]["lozinka"].value;
    var Regex='/^[^a-zA-Z]\S*$/';
    if(ime == "" && Regex.test(ime)){
        alert ("Samo slova, bez brojeva");
    }
}