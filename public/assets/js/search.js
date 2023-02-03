const form = document.querySelector('#search-form');
const input = document.querySelector('#search');

console.log(form);
console.log(input);

input.addEventListener("keydown", (e) => {
    if (e.keyCode === 13) {
        console.log(input.value);
    }
});