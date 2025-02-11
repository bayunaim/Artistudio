document.addEventListener("DOMContentLoaded", function () {
  const popup = document.createElement("div");
  popup.classList.add("popup");
  popup.innerHTML = `<div class="popup-content">
                            <p>Welcome to WP Popup Plugin!</p>
                            <button class="close-popup">Close</button>
                        </div>`;
  document.body.appendChild(popup);

  document.querySelector(".close-popup").addEventListener("click", function () {
    popup.style.display = "none";
  });
});
