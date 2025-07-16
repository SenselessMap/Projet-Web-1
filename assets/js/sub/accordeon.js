document.querySelectorAll('.accordion-header').forEach(header => {
	header.addEventListener('click', () => {
		const item = header.parentElement;
		const isActive = item.classList.contains('active');

		if (isActive) return;

		document.querySelectorAll('.accordion-item.active').forEach(activeItem => {
			activeItem.classList.remove('active');
		});

		item.classList.add('active');
	});
});
