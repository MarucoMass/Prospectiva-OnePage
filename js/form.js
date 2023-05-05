// const plans = document.querySelector('.grid.col.plans');
// const text = document.querySelector('.textarea');

// plans.addEventListener('click', (e) => {

//     if (e.target.className == 'btn btn--hire bg-violet silver') {
//        text.value = 'Hola! Me interesa saber más sobre el plan Silver.'
//     }
//     if (e.target.className == 'btn btn--hire bg-violet gold') {
//        text.value = 'Hola! Me interesa saber más sobre el plan Gold.'
//     }

// })

// window.onload = function() {
//     text.value = '';
//   };

const planSilver = 'Hola! Me interesa saber más sobre el plan Silver.';
const planGold = 'Hola! Me interesa saber más sobre el plan Gold.';

document.addEventListener('DOMContentLoaded', function() {
   const plans = document.querySelector('.grid.col.plans');
   console.log(document.querySelector('.grid.col.plans'));
   const text = document.querySelector('.textarea');
 
   plans.addEventListener('click', (e) => {
     if (e.target.className == 'btn btn--hire bg-violet silver') {
       text.value = planSilver;
     }
     if (e.target.className == 'btn btn--hire bg-violet gold') {
       text.value = planGold;
     }
   });
 });
 