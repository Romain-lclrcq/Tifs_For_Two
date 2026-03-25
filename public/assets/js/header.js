const iconBurgerMenu =  document.querySelector("header div")
const listNav = document.querySelector("header ul")
const title = document.querySelector(".title")
const btnRegister = document.querySelector("nav >span>li:nth-child(1)")




iconBurgerMenu.addEventListener("click", ()=>{
    listNav.classList.toggle("burgerActive")
    iconBurgerMenu.classList.toggle("iconBurgerActive")
    title.classList.toggle("titleActive")
})

window.addEventListener("resize", ()=>{
    listNav.classList.remove("burgerActive")
    iconBurgerMenu.classList.remove("iconBurgerActive")
    title.classList.remove("titleActive")
})
