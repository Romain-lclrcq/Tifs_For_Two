const TitleChimique = document.querySelector ('section div>h4:nth-of-type(1)')
const TitleVegetale = document.querySelector ('section div>h4:nth-of-type(2)')
const TitleHeadSpa = document.querySelector ('section div>h4:nth-of-type(3)')
const TitleEmo = document.querySelector ('section div>h4:nth-of-type(4)')
const TitleChampissage = document.querySelector ('section div>h4:nth-of-type(5)')

const explicationChimique = document.querySelector('section div>div:nth-of-type(1)')
const explicationVegetale = document.querySelector('section div>div:nth-of-type(2)')
const explicationHeadSpa = document.querySelector('section div>div:nth-of-type(3)')
const explicationEmo = document.querySelector('section div>div:nth-of-type(4)')
const explicationChampissage = document.querySelector('section div>div:nth-of-type(5)')


TitleChimique.addEventListener("click", ()=>{
explicationChimique.classList.toggle('explicationVisible')
})

TitleVegetale.addEventListener("click", ()=> {
    explicationVegetale.classList.toggle('explicationVisible')
})

TitleHeadSpa.addEventListener("click", ()=> {
    explicationHeadSpa.classList.toggle('explicationVisible')
})
TitleEmo.addEventListener("click", ()=> {
    explicationEmo.classList.toggle('explicationVisible')
})
TitleChampissage.addEventListener("click", ()=> {
    explicationChampissage.classList.toggle('explicationVisible')
})