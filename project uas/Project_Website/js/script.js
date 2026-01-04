
document.querySelectorAll("nav a").forEach(link => {
   
    link.style.transition = "transform 0.2s ease";

    link.addEventListener("click", () => {
        link.style.transform = "scale(0.9)";
        setTimeout(() => {
            link.style.transform = "scale(1)";
        }, 150);  
    });
});
