/**
 * Se produit lorsque l'utilisateur clic sur l'image, cela gèle le fond et affiche une grande version de l'image.
 */
document.addEventListener("DOMContentLoaded", () => { 
	const overlay = document.getElementById("imageOverlay");
	const overlayImg = document.getElementById("overlayImage");
	const thumb = document.querySelector(".catalogue_image");

	if (thumb) {
		thumb.addEventListener("click", () => {
		overlayImg.src = thumb.src;
		overlay.style.display = "flex";
		});

		overlay.addEventListener("click", () => {
		overlay.style.display = "none";
		});
	}
});
