document.addEventListener("DOMContentLoaded", function() 
{
    //Début Burger Menu
    
    let burgerButton = document.getElementById("burger");
    
    let nav = document.getElementById("navigation");
    
    burgerButton.addEventListener("click", function(){
        nav.classList.toggle("hidden");
    });
    
    //Fin Burger Menu
    
        
        
    //Début Confirmation de suppression d'objets
    
    let formDelete = document.querySelectorAll(".form-delete");
    formDelete.forEach((form) => {
        form.addEventListener("submit", (e) => {
            if (!confirm("Voulez-vous vraiment supprimer cet objet ?")) {
                e.preventDefault(); //Annule l'envoi de la suppression
            }
        });
    });
    
    //Fin Confirmation de suppression d'objets
    
    
    
    //Début Modification des informations personnelles
    //TODO: Débugger
    
    let editButton = document.getElementById("editinfo-button");
    
            //Prevent l'envoi du form ?? Arrête le JS a cause du display none du boutton
            // let confirmButton = document.getElementById("edititemform-button");
    
    let editInputWrapper = document.querySelectorAll(".editinput-wrapper");

    editButton.addEventListener("click", function () {
        editInputWrapper.forEach((wrapper) => {
            const input = wrapper.querySelector(".editinfo-input");
            input.classList.toggle("editinfo-hidden");
        });
    
   editButton.textContent = editButton.textContent === "Annuler" ? "Modifier" : "Annuler";
    editButton.classList.toggle("annuler");
            
            //Ditto
            // confirmButton.classList.toggle("editinfo-hidden");
    });
    
    //Fin Modification des informations personnelles
    
    
    /*Début Pagination
    
    TODO: Pagination
  
    Fin Pagination*/
});