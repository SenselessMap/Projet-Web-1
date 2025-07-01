const banner = document.getElementById('topBanner');
const closeBtn = document.getElementById('closeBannerBtn');

closeBtn.addEventListener('click', () => {
	banner.style.display = 'none';
});
