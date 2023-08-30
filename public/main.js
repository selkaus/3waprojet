document.addEventListener("DOMContentLoaded", function() 
{
    let burgerButton = document.getElementById("burger");
    
    let nav = document.getElementById("navigation");
    
    burgerButton.addEventListener("click", function(){
        nav.classList.toggle("hidden");
    });
    
    
    let formDelete = document.querySelectorAll(".form-delete");
    formDelete.forEach((form) => {
        form.addEventListener("submit", (e) => {
            if (!confirm("Voulez-vous vraiment supprimer cet objet ?")) {
                e.preventDefault(); //Annule l'envoi
            }
        });
    });
});