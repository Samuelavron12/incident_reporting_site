document.addEventListener("DOMContentLoaded", function(){

    const toggleBtn = document.getElementById("menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    if(toggleBtn){
        toggleBtn.addEventListener("click", function(){
            sidebar.classList.toggle("active");
        });
    }

    const links = document.querySelectorAll(".sidebar a");

    links.forEach(function(link){
        link.addEventListener("click", function(){
            sidebar.classList.remove("active");
        });
    });

});