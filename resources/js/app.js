import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);

// seleziono il tag input dove caricherò il file img in create/edit
const previewImage = document.getElementById("preview");

// aggiungo un evento "change" ovvero che si innesca quando il tag cambia valore
// cioè quando caricando un elemento di input questo assume un valore
previewImage.addEventListener("change", (event)=>{
    // creo una variabile associata con un nuovo oggetto di classe di js Filereader
    // una classe in grado di leggere i file
    var Reader = new FileReader();
    // sfrutto il metodo readAsDataUrl della classe FileReader
    // e prendo il valore di previewImage cioè il file che sto uploadando
    // premessa: per js il tag input genera un'array ogni qualvolta che carica un file
    // (in quanto l'input puo avere il valore multiple che gli permette di caricare piu file)
    //  pertanto nella parentesi oltre a specificare la var del file
    // inserirò anche il numero in array generato che corrisponde a quel file, cioè il primo
    Reader.readAsDataURL(previewImage.files[0]);
    // una volta che hai letto il file
    // metodo di fileReader, onload...
    Reader.onload = function(ReadEvent) {
        // ..e carico sul tag img la nuova src
        document.getElementById("uploaded").src= ReadEvent.target.result;
    };
});
