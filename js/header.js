// header
const hamburguer = document.querySelector('.header .header__container .nav-burguer');
const navigation = document.querySelector('.header .header__navigation');
const item = document.querySelectorAll('.header .header__navigation .header__navigation--list li a');
const body = document.querySelector('body');

hamburguer.addEventListener('click', ()=>{
    hamburguer.classList.toggle('active');
    navigation.classList.toggle('active');
    body.classList.toggle('active');
})

item.forEach(selectItem => selectItem.addEventListener('click', ()=>{
    if ((navigation.classList = 'active') && (hamburguer.classList = 'active')) {
        hamburguer.classList = 'nav-burguer flex';
        navigation.classList = 'header__navigation flex bg-violet';   
        body.classList.remove('active');  
    }
}))

window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    const logo__one = document.querySelector('.header .header__container .header__logo a .header__logo--img.one')
    const logo__two = document.querySelector('.header .header__container .header__logo a .header__logo--img.two')
    let scrollValue = window.scrollY;
    
    header.classList.toggle('active', scrollValue > 0);
    
    if (scrollValue > 0) {
        logo__two.classList.remove('hidden')
        logo__one.classList.add('hidden')
    } else {
        logo__two.classList.add('hidden')
        logo__one.classList.remove('hidden')
    }

})