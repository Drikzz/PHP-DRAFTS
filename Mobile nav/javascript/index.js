let h = document.querySelector('.hamburger')
let mobile = document.querySelector('.mobile-nav')

h.addEventListener("click", function() {
    mobile.classList.toggle('d-flex')
    mobile.classList.toggle('d-none')
})