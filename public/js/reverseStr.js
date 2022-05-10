const reverse = document.querySelector(".reverse-text");

function reverseText() {
    let reversedText = reverse.textContent.split("").reverse().join("");
    reverse.textContent = reversedText;
}

reverse.addEventListener("mouseover", reverseText);
reverse.addEventListener("mouseout", reverseText);
