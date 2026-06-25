// Match Height
jQuery(document).ready(function() {
	jQuery('.sections-wrapper .sp-section-inner').matchHeight({	
		byRow: true,
		property: 'min-height'
	});
});

jQuery(window).load(function() {
	jQuery('.match-height-row .fl-module-content').matchHeight({	
		byRow: true,
		property: 'min-height'
	});
});

// Function to handle hash on load or change
function handleHash() {
	const hash = window.location.hash;
	if (hash === "#wealth-management") {
		wm_show();
	} else if (hash === "#financial-solutions") {
		fs_show();
	} else {
		close_all();
	}
}

// FS
function fs_show() {
	jQuery('body').removeClass('wm-shown');
	jQuery('body').removeClass('disc-shown');
	jQuery('#wm-section').removeClass('section-show');
	jQuery('body').addClass('fs-shown');
	jQuery('#fs-section').addClass('section-show');
	jQuery('html, body').animate({
		scrollTop: 0
	}, 100);
}

// WM
function wm_show() {
	jQuery('body').removeClass('fs-shown');
	jQuery('body').removeClass('disc-shown');
	jQuery('#fs-section').removeClass('section-show');
	jQuery('body').addClass('wm-shown');
	jQuery('#wm-section').addClass('section-show');
	jQuery('html, body').animate({
		scrollTop: 0
	}, 100);
}

// Disclosures
function disc_show() {
	jQuery('body').removeClass('wm-shown');
	jQuery('body').removeClass('fs-shown');
	jQuery('#fs-section').removeClass('section-show');
	jQuery('#wm-section').removeClass('section-show');
	jQuery('body').toggleClass('disc-shown');
	// Scroll to section
	if (jQuery('body').hasClass('disc-shown')) {
		jQuery('html, body').animate({
			scrollTop: 0
		}, 100);
	}
}

// Close Everything
function close_all() {
	jQuery('body').removeClass('wm-shown');
	jQuery('body').removeClass('fs-shown');
	jQuery('#fs-section').removeClass('section-show');
	jQuery('#wm-section').removeClass('section-show');
	jQuery('body').removeClass('disc-shown');
}

// On Click Events
jQuery(document).ready(function() {
	// Handle Hash
	// Fire on initial load
	handleHash();
	
	// Fire on hash change (e.g., back button or manual typing)
	jQuery(window).on('hashchange', function() {
		handleHash();
	});
	
	jQuery('.fs-show').on('click', function(event) {
		event.preventDefault();
		fs_show();
		window.location.hash = "financial-solutions";
	});
	jQuery('.wm-show').on('click', function(event) {
		event.preventDefault();
		wm_show();
		window.location.hash = "wealth-management";
	});
	jQuery('.disc-show').on('click', function(event) {
		event.preventDefault();
		disc_show();
		history.pushState("", document.title, window.location.pathname + window.location.search);
	});
	jQuery('#fs-section .sp-links a').on('click', function(event) {
		event.preventDefault;
		var targetId = jQuery(this).attr('href');
		
		// Ignore if no ID or just "#"
		if (targetId.length < 2) return;
		
		var target = jQuery(targetId);
		if (target.length) {
		  event.preventDefault();
		
		  fs_show(); // Run your custom function
		
		  // Slight delay in case fs_show() manipulates the DOM
		  setTimeout(function() {
			jQuery('html, body').animate({
			  scrollTop: target.offset().top - 150 // 50px offset
			}, 100);
		  }, 500); // Adjust delay as needed
		}
	});
	jQuery('#wm-section .sp-links a').on('click', function(event) {
		event.preventDefault;
		var targetId = jQuery(this).attr('href');
		
		// Ignore if no ID or just "#"
		if (targetId.length < 2) return;
		
		var target = jQuery(targetId);
		if (target.length) {
		  event.preventDefault();
		
		  wm_show(); // Run your custom function
		
		  // Slight delay in case fs_show() manipulates the DOM
		  setTimeout(function() {
			jQuery('html, body').animate({
			  scrollTop: target.offset().top - 150 // 50px offset
			}, 100);
		  }, 500); // Adjust delay as needed
		}
	});
});
// Move all Modals to just before </body>
jQuery(document).ready(function($) {
	$('.modal').each(function() {
		$('body').append(this);
	});
});