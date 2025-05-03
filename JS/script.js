
let state = false;
document.getElementById('menuBtn').addEventListener('click', () => {
    const menu = document.getElementById("menu");

    if (state) {
        menu.classList.add("hidden")
    } else {
        menu.classList.remove("hidden")
    }

    state = !state

})

