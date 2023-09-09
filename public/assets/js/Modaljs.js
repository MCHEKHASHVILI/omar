
// Get the modal
const modal = document.getElementById("myModal");

// Get the button that opens the modal
const btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
const span = document.querySelector(".close");

// Function to open the modal
const openModal = () => {
  modal.style.display = "block";
};

// Function to close the modal
const closeModal = () => {
  modal.style.display = "none";
};

// When the user clicks the button, open the modal
btn.addEventListener("click", openModal);

// When the user clicks on <span> (x), close the modal
span.addEventListener("click", closeModal);

// When the user clicks anywhere outside of the modal, close it
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    closeModal();
  }
});

