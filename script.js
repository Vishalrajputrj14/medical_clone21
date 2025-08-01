const phrases = [
    "vishal medical store",
"Welcome to MedicoCare",
  "Your Trusted Medical Partner",
  "Fast Delivery.",
  "24/7 Support.",
  "Original Medicines.",
];

let currentPhrase = 1;
let currentChar = 1;
let isDeleting = false;
const textElement = document.getElementById("dynamic-text");

function type() {
  const currentText = phrases[currentPhrase];
  const displayedText = currentText.substring(0, currentChar);
  textElement.textContent = displayedText;

  if (!isDeleting && currentChar < currentText.length) {
    currentChar++;
    setTimeout(type, 100);
  } else if (isDeleting && currentChar > 0) {
    currentChar--;
    setTimeout(type, 50);
  } else {
    isDeleting = !isDeleting;
    if (!isDeleting) {
      currentPhrase = (currentPhrase + 1) % phrases.length;
    }
    setTimeout(type, 1000);
  }
}

type();
