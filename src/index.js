// imports
import Search from "./scripts/Search"

// Initialization
const search = new Search()

// User menu button
const btnUserMenu = document.getElementById('user-menu-button')
const userMenu = document.getElementById('user-menu')
btnUserMenu.addEventListener('click', () => {
    userMenu.classList.toggle('hidden')
})

// Mobile Menu toggle
const btnMobile = document.getElementById('btn-mobile')
const mobileMenu = document.getElementById('mobile-menu')
const openMenu = document.querySelector('.open-menu')
const closeMenu = document.querySelector('.close-menu')
btnMobile.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden')
    openMenu.classList.toggle('hidden')
    closeMenu.classList.toggle('hidden')
})