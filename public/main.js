document.addEventListener("DOMContentLoaded", function() 
{
    let burgerButton = document.getElementById("burger");
    
    let nav = document.getElementById("navigation");
    
    burgerButton.addEventListener("click", function(){
        nav.classList.toggle("hidden");
    });
    
});