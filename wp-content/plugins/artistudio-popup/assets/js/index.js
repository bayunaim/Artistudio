document.addEventListener("DOMContentLoaded", async () => {
	try {
		let container = document.getElementById("popup-container");
		let attempts = 0;

		while (!container && attempts < 10) {
			await new Promise((resolve) => setTimeout(resolve, 500));
			container = document.getElementById("popup-container");
			attempts++;
		}

		if (!container) {
			console.error(
				"Error: #popup-container tidak ditemukan setelah menunggu!",
			);
			return;
		}

		const response = await fetch(
			"http://localhost:8888/Artistudio/wp-json/artistudio/v1/popup",
		);

		if (!response.ok) {
			throw new Error(`HTTP error! Status: ${response.status}`);
		}

		const data = await response.json();
		console.log("API Response:", data);

		if (data.title && data.description) {
			container.innerHTML = `
        <div class="popup-overlay" id="popup-overlay">
          <div class="popup" id="popup">
            <button id="close-popup">✖</button>
            <h2>${data.title}</h2>
            <p>${data.description}</p>
          </div>
        </div>
      `;

			// Animasi: Tambah kelas "show" setelah render
			setTimeout(() => {
				document.getElementById("popup-overlay").classList.add("show");
				document.getElementById("popup").classList.add("show");
			}, 10);

			// Event untuk menutup modal
			document
				.getElementById("close-popup")
				.addEventListener("click", closePopup);
			document
				.getElementById("popup-overlay")
				.addEventListener("click", closePopup);

			function closePopup() {
				document
					.getElementById("popup-overlay")
					.classList.remove("show");
				document.getElementById("popup").classList.remove("show");

				setTimeout(() => {
					container.innerHTML = ""; // Hapus popup dari DOM setelah animasi
				}, 300);
			}
		}
	} catch (error) {
		console.error("Error fetching popup:", error);
	}
});
