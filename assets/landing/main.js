if ('scrollRestoration' in window.history) {
	window.history.scrollRestoration = 'manual';
}
window.addEventListener('beforeunload', () => {
	window.scrollTo(0, 0);
});

document.addEventListener('click', event => {
	const navLink = event.target.closest('a[href]');
	if (!navLink) {
		return;
	}

	const href = navLink.getAttribute('href') || '';
	if (href.startsWith('#') || navLink.target === '_blank' || navLink.hasAttribute('download')) {
		return;
	}

	const nextUrl = new URL(navLink.href, window.location.origin);
	if (nextUrl.origin !== window.location.origin) {
		return;
	}

	window.scrollTo({ top: 0, behavior: 'smooth' });
});

const initializeTicketTabs = () => {
	const tabLinks = Array.from(document.querySelectorAll('.link-ourwork[data-target]'));
	if (!tabLinks.length) {
		return;
	}

	const tabPanels = Array.from(document.querySelectorAll('.ticket-tab-panel'));
	if (!tabPanels.length) {
		return;
	}

	const activatePanel = targetSelector => {
		const activePanel = document.querySelector(targetSelector);
		if (!activePanel) {
			return;
		}

		tabLinks.forEach(link => {
			link.classList.toggle('active', link.dataset.target === targetSelector);
		});

		tabPanels.forEach(panel => {
			panel.classList.toggle('is-active', `#${panel.id}` === targetSelector);
		});

		setTimeout(function () { window.dispatchEvent(new Event('resize')); }, 50);
	};

	const firstLink = tabLinks.find(link => document.querySelector(link.dataset.target)) || tabLinks[0];
	if (firstLink) {
		activatePanel(firstLink.dataset.target);
	}

	tabLinks.forEach(link => {
		link.addEventListener('click', event => {
			event.preventDefault();
			activatePanel(link.dataset.target);
		});
	});
};

initializeTicketTabs();


$('.owl-oceanarium-tours').owlCarousel({
	loop: true,
	center: true,
	margin: 20,
	animateOut: 'fadeOut',
	mouseDrag: false,
  	touchDrag: false,
	dots: false,
	nav: true,
	responsive: {
		0: {
			items: 1,
			center: false,
		},
		600: {
			items: 1,
			center: true,
		},
		800: {
			items: 1,
			center: true,
		},
		1000: {
			items: 1,
			center: true,
		},
		1200: {
			items: 1,
			center: true,
		},
		1400: {
			items: 1,
			center: true,
		},
	}
});



$('.owl-merchandise').owlCarousel({
	loop: true,
	center: false,
	margin: 10,
	autoplay: false,
	dots: false,
	nav: true,
	responsive: {
		0: {
			items: 1,
		},
		600: {
			items: 1,
		},
		800: {
			items: 1,
		},
		1000: {
			items: 1,
		},
		1200: {
			items: 4,
		},
		1400: {
			items: 4,
		},
	}
});



const faqs = document.querySelectorAll('.faq');

faqs.forEach(faq => {
	faq.addEventListener('click', () => {
		const isActive = faq.classList.contains('active');
		faqs.forEach(f => f.classList.remove('active'));
		if (!isActive) faq.classList.add('active');
	});
});


$('.owl-schoolpackage').owlCarousel({
	loop: true,
	center: false,
	margin: 10,
	autoplay: false,
	dots: true,
	nav: false,
	responsive: {
		0: {
			items: 1,
		},
		600: {
			items: 1,
		},
		800: {
			items: 1,
		},
		1000: {
			items: 1,
		},
		1200: {
			items: 3,
		},
		1400: {
			items: 3,
		},
	}
});



$('.owl-additional-exp').owlCarousel({
	loop: false,
	center: false,
	margin: 20,
	autoplay: false,
	dots: false,
	nav: false,
	responsive: {
		0: {
			items: 1,
		},
		429: {
			items: 2,
		},
		768: {
			items: 3,
		},
		992: {
			items: 3,
		},
		1200: {
			items: 3,
		},
	}
});



$('.owl-once').owlCarousel({
	loop: false,
	center: false,
	margin: 30,
	autoplay: false,
	dots: true,
	nav: false,
	responsive: {
		0: {
			items: 1,
		},
		576: {
			items: 1,
		},
		768: {
			items: 2,
		},
		992: {
			items: 3,
		},
		1200: {
			items: 3,
		},
	}
});

var $owl = $('.owl-memories').owlCarousel({
    loop: true,
    items: 1,
    margin: 0,
    nav: false,
    dots: false,
    autoplay: false,
    autoplayHoverPause: true,
    animateOut: 'fadeOut'
});
$('#memories-prev').on('click', function() { $owl.trigger('prev.owl.carousel'); });
$('#memories-next').on('click', function() { $owl.trigger('next.owl.carousel'); });



$('.owl-news').owlCarousel({
	loop: false,
	center: false,
	margin: 20,
	autoplay: false,
	dots: true,
	nav: true,
	responsive: {
		0: {
			items: 1,
		},
		576: {
			items: 2,
		},
		800: {
			items: 2,
		},
		1000: {
			items: 3,
		},
		1200: {
			items: 3,
		},
		1400: {
			items: 3,
		},
	}
});



$('.owl-floormap').owlCarousel({
	loop: true,
	center: false,
	margin: 10,
	autoplay: false,
	dots: true,
	nav: true,
	responsive: {
		0: {
			items: 1,
		},
		600: {
			items: 1,
		},
		800: {
			items: 1,
		},
		1000: {
			items: 1,
		},
		1200: {
			items: 4,
		},
		1400: {
			items: 4,
		},
	}
});


$('.explore-mainjourney-carousel').owlCarousel({
	loop: true,
	items: 1,
	margin: 0,
	animateOut: 'fadeOut',
	autoplay: true,
	autoplayTimeout: 4000,
	autoplayHoverPause: true,
	dots: false,
	nav: true,
	navText: ['<img src="/bxsea/assets/landing/image/bxsea_icon_arrow_left.png" alt="Prev">', '<img src="/bxsea/assets/landing/image/bxsea_icon_arrow_right.png" alt="Next">'],
	mouseDrag: false,
	touchDrag: false,
	pullDrag: false,
	smartSpeed: 450
});



const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
	const select = dropdown.querySelector('.select');
	const caret = dropdown.querySelector('.caret');
	const menu = dropdown.querySelector('.menu');
	const option = dropdown.querySelector('.menu li a');

	select.addEventListener('click', () => {
		caret.classList.toggle('caret-rotate');
		menu.classList.toggle('menu-open');

	});
});

const dropdowns2 = document.querySelectorAll('.dropdown2');

dropdowns2.forEach(dropdown => {
	const select2 = dropdown.querySelector('.select2');
	const caret2 = dropdown.querySelector('.caret2');
	const menu2 = dropdown.querySelector('.menu2');
	const option2 = dropdown.querySelector('.menu2 li a');

	select2.addEventListener('click', () => {
		caret2.classList.toggle('caret-rotate2');
		menu2.classList.toggle('menu-open2');

	});
});


function showPopup(popupId) {
	const popup = document.querySelector(popupId);

	if (popup) {
		gsap.to(popup, {
			duration: 0.8,
			opacity: 1,
			visibility: 'visible',
			scale: 1,
			ease: Power4.easeOut
		});

		gsap.from(`${popupId} .popup-top h1, ${popupId} .popup-top p`, {
			duration: 0.5,
			opacity: 0,
			y: 15,
			stagger: {
				amount: 0.4
			}
		}, '-=.3');
	}
}

function hidePopup(popupId) {
	const popup = document.querySelector(popupId);

	if (popup) {
		gsap.to(popup, {
			duration: 0.8,
			opacity: 0,
			scale: 0,
			visibility: 'hidden',
			ease: Power4.easeOut,
			onComplete: () => {
				popup.style.visibility = 'hidden';
			}
		});
	}
}



function togglePopup(journeyId) {
	const allPopups = document.querySelectorAll('.popup-template');

	// Hide all other pop-ups except the one targeted to be shown
	allPopups.forEach(popup => {
		if (`#${popup.id}` !== journeyId) {
			hidePopup(`#${popup.id}`);
		}
	});
	showPopup(journeyId);

}


const dataJourneyTriggers = document.querySelectorAll('[data-journey]');

dataJourneyTriggers.forEach(trigger => {
	trigger.addEventListener('click', function() {
		const journeyId = this.getAttribute('data-journey');
		togglePopup(journeyId);
	});
});

const closeButtons = document.querySelectorAll('.popup-close');
closeButtons.forEach(btn => {
	btn.addEventListener('click', function() {
		const popup = this.closest('.popup-template');
		if (popup) {
			hidePopup(`#${popup.id}`);
		}
	});
});



const navMenu = document.getElementById('nav-menu'),
	togggleMenu = document.getElementById('toggle-menu'),
	closeMenu = document.getElementById('close-menu');


togggleMenu.addEventListener('click', () => {
	navMenu.classList.toggle('show__menu')
})

closeMenu.addEventListener('click', () => {
	navMenu.classList.remove('show__menu')
})



$(document).ready(function() {
	var journeyCards = $(".journey-zone .col-md-6");
	var loadMoreButton = $(".btn-load-more");

	var hiddenCards = journeyCards.slice(8);

	hiddenCards.hide();

	if (hiddenCards.length === 0) {
		loadMoreButton.hide();
	}

	var isHidden = true;

	loadMoreButton.on("click", function() {
		if (isHidden) {
			hiddenCards.show();
			loadMoreButton.text("View Less");
		} else {
			hiddenCards.hide();
			loadMoreButton.text("View All");
		}
		isHidden = !isHidden;
	});
});



document.addEventListener("DOMContentLoaded", function() {
	const buttons = document.querySelectorAll('.button');
	const items = document.querySelectorAll('.work-item');

	buttons.forEach(button => {
		button.addEventListener('click', function() {
			const filterValue = this.getAttribute('data-filter');
			buttons.forEach(btn => {
				btn.classList.remove('active');
			});

			this.classList.add('active');

			items.forEach(item => {
				item.style.display = 'none';
				if (item.getAttribute('data-item') === filterValue || filterValue === 'all') {
					item.style.display = 'block';
				}
			});
		});
	});
});


$(document).ready(function() {
	var journeyCards = $(".box-merchandise-card .col-lg-3");
	var loadMoreButton = $(".btn-more");
	var hiddenCards = journeyCards.slice(12);
	hiddenCards.hide();

	if (hiddenCards.length === 0) {
		loadMoreButton.hide();
	}

	var isHidden = true;
	var originalHiddenCards = hiddenCards.slice();

	loadMoreButton.on("click", function() {
		if (isHidden) {
			hiddenCards.show();
			loadMoreButton.text("Sembunyikan");
		} else {
			hiddenCards.hide();
			loadMoreButton.text("Selengkapnya");
		}
		isHidden = !isHidden;
	});

	$(".button").on("click", function() {
		var filter = $(this).data("filter");

		journeyCards.hide();

		if (filter === "all") {
			journeyCards.slice(0, 12).show();
			hiddenCards = originalHiddenCards.slice();
		} else {
			var filteredItems = journeyCards.filter("[data-item='" + filter + "']");
			filteredItems.slice(0, 12).show();
			hiddenCards = filteredItems.slice(12);
		}

		if (hiddenCards.length === 0) {
			loadMoreButton.hide();
		} else {
			loadMoreButton.show();
			loadMoreButton.text("Selengkapnya");
			isHidden = true;
		}
	});
});





$(document).ready(function() {
	$(".box-category-merchan").click(function() {
		if ($(window).width() <= 767) {
			var indicatorMerchanWeb = $(".indicator-merchan-web");
			if (indicatorMerchanWeb.css("visibility") === "hidden") {
				indicatorMerchanWeb.css({
					"opacity": "1",
					"visibility": "visible"
				});
			} else {
				indicatorMerchanWeb.css({
					"opacity": "0",
					"visibility": "hidden"
				});
			}
		}
	});
});


$(document).ready(function() {
	if (!$('#calendar').length || typeof $.fn.evoCalendar !== 'function') {
		return;
	}

	var scheduleEvents = Array.isArray(window.bxseaScheduleEvents) ? window.bxseaScheduleEvents : [];
	var initialMonth = typeof window.bxseaScheduleInitialMonth === 'number' ? window.bxseaScheduleInitialMonth : new Date().getMonth();
	var initialYear = typeof window.bxseaScheduleInitialYear === 'number' ? window.bxseaScheduleInitialYear : new Date().getFullYear();

	$('#calendar').evoCalendar({
		theme: 'Royal Navy',
		todayHighlight: true,
		sidebarToggler: true,
		eventListToggler: true,
		canAddEvent: false,
		calendarEvents: scheduleEvents,
	});

	$('#calendar').evoCalendar('selectMonth', initialMonth);
	$('#calendar').evoCalendar('selectYear', initialYear);
	$('#month').val(String(initialMonth));
	$('#year').val(String(initialYear));

	$('#search').on('click', function() {
		var month = $('#month').find(":selected").val();
		var year = $('#year').find(":selected").val();
		if (!month || !year) {
			return;
		}

		$('#calendar').evoCalendar('selectMonth', month);
		$('#calendar').evoCalendar('selectYear', year);
	});
})



$(document).ready(function() {
	var journeyCards = $(".Achievement-cards .col-lg-4");
	var loadMoreButton = $(".button-achievement a");

	var hiddenCards = journeyCards.slice(6);

	hiddenCards.hide();

	if (hiddenCards.length === 0) {
		loadMoreButton.hide();
	}

	var isHidden = true;

	loadMoreButton.on("click", function() {
		if (isHidden) {
			hiddenCards.show();
			loadMoreButton.text("Sembunyikan");
		} else {
			hiddenCards.hide();
			loadMoreButton.text("Selengkapnya");
		}
		isHidden = !isHidden;
	});
});



$('html').css({
	overflowX: 'hidden'
});



/* =========================================
   FOOTER MOBILE ACCORDION
   ========================================= */
$(document).on('click', 'footer .navbar-footer h4', function () {
	if ($(window).width() <= 991) {
		var $navbarFooter = $(this).closest('.navbar-footer');
		$navbarFooter.toggleClass('open');
	}
});



/* =========================================
   SHOW SPECTACULAR FILTER TABS (mobile)
   ========================================= */
$(document).on('click', '.show-filter-tab', function () {
	if ($(window).width() <= 767) {
		var target = $(this).data('show');
		$('.show-filter-tab').removeClass('active');
		$(this).addClass('active');
		if (target === 'seapecial') {
			$('.flex-show .box-title-show-ocean:first-child .relative-show').addClass('show-hidden');
			$('.flex-show .box-title-show-ocean:last-child .relative-show2').addClass('show-active');
		} else {
			$('.flex-show .box-title-show-ocean:first-child .relative-show').removeClass('show-hidden');
			$('.flex-show .box-title-show-ocean:last-child .relative-show2').removeClass('show-active');
		}
	}
});


/* =========================================
   SHOW BXSEA FILTER
   ========================================= */
// Init: hide cards that don't match the active tab on page load
var activeTab = $('.showbx-filter-tab.active').data('showbx');
if (activeTab) {
	$('.showbx-card').addClass('showbx-hidden');
	$('.showbx-card[data-showbx="' + activeTab + '"]').removeClass('showbx-hidden');
}

$(document).on('click', '.showbx-filter-tab', function() {
	var target = $(this).data('showbx');
	$('.showbx-filter-tab').removeClass('active');
	$(this).addClass('active');
	$('.showbx-card').addClass('showbx-hidden');
	$('.showbx-card[data-showbx="' + target + '"]').removeClass('showbx-hidden');
});


/* =========================================
   SEARCH POPUP
   ========================================= */

// Inject search popup HTML into every page
(function() {
	var popupHtml = '<div id="search-popup-overlay" class="search-popup-overlay">'
		+ '<div class="search-popup-container">'
		+ '<button class="search-popup-close" onclick="closeSearchPopup()" aria-label="Close search"><i class="fa-solid fa-xmark"></i></button>'
		+ '<div class="search-popup-inner">'
		+ '<div class="search-popup-bar">'
		+ '<input type="text" id="search-popup-input" class="search-popup-input" placeholder="Search..." autocomplete="off">'
		+ '<button class="search-popup-btn" onclick="doSearch()">Search</button>'
		+ '</div>'
		+ '<div id="search-popup-results" class="search-popup-results"></div>'
		+ '<div id="search-popup-pagination" class="search-popup-pagination"></div>'
		+ '</div></div></div>';
	document.body.insertAdjacentHTML('beforeend', popupHtml);
})();

const searchPages = [
	{
		title: 'Home',
		breadcrumb: 'Home',
		desc: 'Welcome to BXSea Oceanarium at Bintaro Xchange Mall. Explore marine life, shows, tickets, and more.',
		url: 'index.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'home beranda bxsea oceanarium'
	},
	{
		title: 'Harga Tiket',
		breadcrumb: 'Home > Tiket Masuk > Harga Tiket',
		desc: 'Cek harga tiket masuk BXSea untuk berbagai kategori pengunjung. Pesan sekarang dan dapatkan akses penuh ke seluruh zona!',
		url: 'ticketfee.html',
		img: '/bxsea/assets/landing/image/penguin-carousel.png',
		keywords: 'ticket tiket harga price masuk admission fee'
	},
	{
		title: 'Promosi',
		breadcrumb: 'Home > Tiket Masuk > Promosi',
		desc: 'Dapatkan penawaran spesial dan promosi menarik di BXSea. Hemat lebih banyak dengan promo eksklusif kami!',
		url: 'promotions.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'promosi promo discount diskon special offer'
	},
	{
		title: 'Pengalaman Premium',
		breadcrumb: 'Home > Tiket Masuk > Pengalaman Premium',
		desc: 'Nikmati pengalaman premium di BXSea: Boat Tour, Behind The Sea, dan Penguin Feeding Fun yang tak terlupakan.',
		url: 'premium.html',
		img: '/bxsea/assets/landing/image/seatunnel-carousel.png',
		keywords: 'premium experience boat tour behind sea penguin feeding fun exclusive'
	},
	{
		title: 'Program Kunjungan Sekolah',
		breadcrumb: 'Home > Tiket Masuk > Program Kunjungan Sekolah',
		desc: 'Program edukasi untuk sekolah di BXSea. Bawa siswa untuk belajar tentang kehidupan laut secara langsung.',
		url: 'school.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'school sekolah program kunjungan edukasi education students'
	},
	{
		title: 'Momen Istimewa',
		breadcrumb: 'Home > Tiket Masuk > Momen Istimewa',
		desc: 'Jadikan momen spesialmu lebih berkesan di BXSea. Rayakan ulang tahun, anniversary, atau acara spesial lainnya.',
		url: 'once.html',
		img: '/bxsea/assets/landing/image/penguin-carousel.png',
		keywords: 'momen istimewa special moment birthday anniversary event celebration'
	},
	{
		title: 'Journey Utama',
		breadcrumb: 'Home > Jelajah > Journey Utama',
		desc: 'Jelajahi berbagai zona unik di BXSea: Raja Ampat, Kalimantan Rainforest, Sea Tunnel, dan masih banyak lagi.',
		url: 'highlight.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'highlight journey zona zone explore jelajah raja ampat rainforest sea tunnel'
	},
	{
		title: 'Shows',
		breadcrumb: 'Home > Jelajah > Shows',
		desc: 'Make the most of your visit with our shows! Various exciting shows are ready for your entertainment.',
		url: 'show.html',
		img: '/bxsea/assets/landing/image/rainforest-carousel.png',
		keywords: 'show pertunjukan showtime feeding otter stingray spectacular'
	},
	{
		title: 'Show Schedule',
		breadcrumb: 'Home > Kunjungan > Jadwal Aquarium',
		desc: "If you're looking for the schedule for our spectacular shows, you're at the right place! Plan your visit to BXSea here.",
		url: 'schedule.html',
		img: '/bxsea/assets/landing/image/seatunnel-carousel.png',
		keywords: 'schedule jadwal jadwal aquarium show schedule waktu time calendar'
	},
	{
		title: 'Visitor Information',
		breadcrumb: 'Home > Kunjungan > Visitor Information',
		desc: 'Semua yang perlu kamu ketahui sebelum berkunjung ke BXSea. Jam buka, lokasi, fasilitas, dan informasi penting lainnya.',
		url: 'visitor-information.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'visitor information informasi pengunjung jam buka opening hours facilities fasilitas'
	},
	{
		title: 'Denah BXSea',
		breadcrumb: 'Home > Kunjungan > Denah BXSea',
		desc: 'Temukan denah lengkap BXSea untuk membantu kamu menavigasi setiap zona dan fasilitas yang tersedia.',
		url: 'map.html',
		img: '/bxsea/assets/landing/image/seatunnel-carousel.png',
		keywords: 'map denah floor plan peta layout zona zone'
	},
	{
		title: 'Panduan Aksesibilitas',
		breadcrumb: 'Home > Kunjungan > Panduan Aksesibilitas',
		desc: 'Panduan aksesibilitas BXSea untuk memastikan semua pengunjung dapat menikmati pengalaman terbaik.',
		url: 'guide.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'guide panduan aksesibilitas accessibility wheelchair difabel'
	},
	{
		title: 'Tenant Kami',
		breadcrumb: 'Home > Kunjungan > Tenant Kami',
		desc: 'Temukan berbagai pilihan kuliner dan toko menarik di dalam BXSea. Wingstop, Chatime, Popcorn, dan lainnya siap melayanimu.',
		url: 'tenant.html',
		img: '/bxsea/assets/landing/image/rainforest-carousel.png',
		keywords: 'tenant food kuliner restaurant cafe wingstop chatime popcorn'
	},
	{
		title: 'Merchandise',
		breadcrumb: 'Home > Kunjungan > Merchandise',
		desc: 'Bawa pulang kenangan terbaik dari BXSea dengan koleksi merchandise eksklusif kami.',
		url: 'merchandise.html',
		img: '/bxsea/assets/landing/image/penguin-carousel.png',
		keywords: 'merchandise souvenir shop official store oleh-oleh'
	},
	{
		title: 'FAQ',
		breadcrumb: 'Home > Kunjungan > FAQ',
		desc: 'Temukan jawaban atas pertanyaan yang sering diajukan tentang kunjungan, tiket, dan fasilitas BXSea.',
		url: 'faq.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'faq pertanyaan frequently asked questions help bantuan'
	},
	{
		title: 'Hubungi Kami',
		breadcrumb: 'Home > Kunjungan > Hubungi Kami',
		desc: 'Ada pertanyaan atau butuh bantuan? Hubungi tim BXSea dan kami siap membantu kamu.',
		url: 'contact.html',
		img: '/bxsea/assets/landing/image/seatunnel-carousel.png',
		keywords: 'contact hubungi kontak email phone telepon whatsapp'
	},
	{
		title: 'Berita Terbaru',
		breadcrumb: 'Home > Berita Terbaru',
		desc: 'Jangan lewatkan berita dan update terbaru tentang aktivitas dan makhluk laut yang menawan di BXSea!',
		url: 'whats.html',
		img: '/bxsea/assets/landing/image/rainforest-carousel.png',
		keywords: 'berita news update latest terbaru artikel blog'
	},
	{
		title: 'Tentang BXSea',
		breadcrumb: 'Home > Tentang Kami',
		desc: 'Kenali lebih dalam tentang BXSea, aquarium terbesar di Bintaro yang menghadirkan pengalaman laut yang menakjubkan.',
		url: 'tentang.html',
		img: '/bxsea/assets/landing/image/rajaampat-carousel.png',
		keywords: 'tentang about us bxsea profile sejarah history misi visi'
	},
	{
		title: 'Kemitraan',
		breadcrumb: 'Home > Kemitraan',
		desc: 'Bergabunglah dengan program kemitraan BXSea dan kembangkan bisnis Anda bersama kami.',
		url: 'partnership.html',
		img: '/bxsea/assets/landing/image/seatunnel-carousel.png',
		keywords: 'partnership kemitraan partner kerjasama sponsor kolaborasi'
	}
];

const RESULTS_PER_PAGE = 5;
let currentSearchQuery = '';
let currentSearchPage = 1;
let currentResults = [];

function openSearchPopup() {
	const overlay = document.getElementById('search-popup-overlay');
	overlay.classList.add('active');
	document.body.style.overflow = 'hidden';
	setTimeout(function() {
		document.getElementById('search-popup-input').focus();
	}, 100);
}

function closeSearchPopup() {
	const overlay = document.getElementById('search-popup-overlay');
	overlay.classList.remove('active');
	document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
	if (e.key === 'Escape') {
		closeSearchPopup();
	}
});

(function() {
	var overlay = document.getElementById('search-popup-overlay');
	if (overlay) {
		overlay.addEventListener('click', function(e) {
			if (e.target === this) { closeSearchPopup(); }
		});
	}
	var input = document.getElementById('search-popup-input');
	if (input) {
		input.addEventListener('keydown', function(e) {
			if (e.key === 'Enter') { doSearch(); }
		});
	}
})();

function doSearch() {
	var q = (document.getElementById('search-popup-input').value || '').trim().toLowerCase();
	currentSearchQuery = q;
	currentSearchPage = 1;

	if (!q) {
		currentResults = [];
		renderSearchResults();
		return;
	}

	currentResults = searchPages.filter(function(page) {
		var haystack = (page.title + ' ' + page.breadcrumb + ' ' + page.desc + ' ' + page.keywords).toLowerCase();
		return haystack.indexOf(q) !== -1;
	});

	renderSearchResults();
}

function renderSearchResults() {
	var resultsEl = document.getElementById('search-popup-results');
	var paginationEl = document.getElementById('search-popup-pagination');

	if (!resultsEl) return;

	if (!currentSearchQuery) {
		resultsEl.innerHTML = '';
		paginationEl.innerHTML = '';
		return;
	}

	if (currentResults.length === 0) {
		resultsEl.innerHTML = '<p class="search-no-results">No results found for "<strong>' + escapeHtml(currentSearchQuery) + '</strong>"</p>';
		paginationEl.innerHTML = '';
		return;
	}

	var totalPages = Math.ceil(currentResults.length / RESULTS_PER_PAGE);
	var start = (currentSearchPage - 1) * RESULTS_PER_PAGE;
	var pageItems = currentResults.slice(start, start + RESULTS_PER_PAGE);

	var html = '<p class="search-popup-results-title">Search Results</p>';
	pageItems.forEach(function(page) {
		html += '<a class="search-result-card" href="' + page.url + '">';
		html += '<div class="search-result-thumb"><img src="' + page.img + '" alt="' + escapeHtml(page.title) + '" loading="lazy"></div>';
		html += '<div class="search-result-body">';
		html += '<span class="search-result-breadcrumb">' + escapeHtml(page.breadcrumb) + '</span>';
		html += '<h4 class="search-result-title">' + escapeHtml(page.title) + '</h4>';
		html += '<p class="search-result-desc">' + escapeHtml(page.desc) + '</p>';
		html += '</div></a>';
	});
	resultsEl.innerHTML = html;

	// Render pagination
	var pgHtml = '';
	for (var i = 1; i <= totalPages; i++) {
		pgHtml += '<button class="search-page-btn' + (i === currentSearchPage ? ' active' : '') + '" onclick="goToSearchPage(' + i + ')">' + i + '</button>';
	}
	paginationEl.innerHTML = pgHtml;
}

function goToSearchPage(page) {
	currentSearchPage = page;
	renderSearchResults();
	var el = document.getElementById('search-popup-results');
	if (el) { el.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
}

function escapeHtml(str) {
	return String(str)
		.replace(/&/g, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;')
		.replace(/"/g, '&quot;');
}
/* END SEARCH POPUP */