const iconBurgerMenu =  document.querySelector("header div")
const listNav = document.querySelector("header ul")
const title = document.querySelector(".title")
const btnRegister = document.querySelector("nav >span>li:nth-child(1)")



// Au clique, ajoute les classes permettant d'ouvrir le burger menu
iconBurgerMenu.addEventListener("click", ()=>{
    listNav.classList.toggle("burgerActive")
    iconBurgerMenu.classList.toggle("iconBurgerActive")
    title.classList.toggle("titleActive")
})


// Permet d'enlever toutes les classes en cas de changement de taille de fenêtre pour éviter un bug d'affichage
window.addEventListener("resize", ()=>{
    listNav.classList.remove("burgerActive")
    iconBurgerMenu.classList.remove("iconBurgerActive")
    title.classList.remove("titleActive")
})



