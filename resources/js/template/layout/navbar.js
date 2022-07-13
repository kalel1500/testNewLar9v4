
let openUserMenu = document.querySelector('#openUserMenu');
let dropdownContent = document.querySelector('#dropdown-content');
openUserMenu.addEventListener('click', function() {
    dropdownContent.classList.toggle('hidden');
});

let iconOpenMovilMenu = document.querySelector('#iconOpenMovilMenu');
let iconCloseMovilMenu = document.querySelector('#iconCloseMovilMenu');
let mobileMenu = document.querySelector('#mobile-menu');

iconOpenMovilMenu.addEventListener('click', function() {
    iconOpenMovilMenu.classList.add('hidden');
    iconOpenMovilMenu.classList.remove('block');

    iconCloseMovilMenu.classList.add('block');
    iconCloseMovilMenu.classList.remove('hidden');

    mobileMenu.classList.add('block');
    mobileMenu.classList.remove('hidden');
});
iconCloseMovilMenu.addEventListener('click', function() {
    iconOpenMovilMenu.classList.add('block');
    iconOpenMovilMenu.classList.remove('hidden');

    iconCloseMovilMenu.classList.add('hidden');
    iconCloseMovilMenu.classList.remove('block');

    mobileMenu.classList.add('hidden');
    mobileMenu.classList.remove('block');
});