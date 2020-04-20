import picturefill from 'picturefill';
import webFont from 'webfontloader';
import * as Cookies from 'js-cookie';

export default {
  init() {
    /* JavaScript to be fired on all pages */
    // feature detect for IE11
    if (!!window.MSInputMethodContext && !!document.documentMode) {
      document.body.classList.add('ie11');
    }

    // only add outline focus for keyboard/tab users
    window.addEventListener('keydown', handleFirstTab);

    // force picturefill to analyze every image
    picturefill();

    // load webfonts asynchronously
    // `webFont` is the arbitrary name we've assigned to the 'import' statement
    // @see https://www.npmjs.com/package/webfontloader
    // @see `../../../../app/setup.php` for the globally defined `BROOKLYNCELLO` JS object
    webFont.load({
      custom: {
        families: ['Built Titling:n4'],
        urls: [BROOKLYNCELLO.theme_fonts], // eslint-disable-line no-undef
      },
      google: {
        families: ['Nunito', 'Nunito:700'],
      },
      timeout: 3000,
    });

    // Age gate logic
    // Toggle age gate based on cookie existence
    if( !Cookies.get('age-gate-passed') ) {
      document.body.classList.add('age-gate-active');
    } else {
      document.body.classList.remove('age-gate-active');
    }

    // Age gate buttons
    const ageGateYes = document.querySelector('.overlay-block__cta--age-gate-yes');

    // Click event listener that sets cookie to pass age gate
    ageGateYes.addEventListener('click', (e) => {
      e.preventDefault();

      // Sets cookie with an expiration date of 3 days
      if (!Cookies.get('age-gate-passed')) {
        Cookies.set('age-gate-passed', 'true', {
          expires: 3,
        });

        console.log(Cookies.get('age-gate-passed'));
      }

      // Trigger window reload
      window.location.reload(true);
    });

    // handle mobile nav listener
    const bannerWrap = document.querySelector('.banner__wrap');
    const icon = document.querySelector('.icon-menu use');
    const mobileNav = document.querySelector('.banner__nav-header-mobile');
    const navBtn = document.querySelector('.banner__menu-btn');
    if (navBtn) {
      navBtn.addEventListener('click', handleToggleMenu.bind(navBtn, bannerWrap, icon, mobileNav), {passive: true});
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

/*
 * Mobile menu toggle
 *
 * @name handleToggleMenu
 * @desc show/hide mobile nav
 */
function handleToggleMenu(bannerWrap, icon, mobileNav) {
  // Toggle menu icon based on href attribute value
  if (icon.getAttribute('href') === '#icon-menu') {
    icon.setAttribute('href', '#icon-menu-close');
    icon.setAttribute('xlink:href', '#icon-menu-close');
  } else {
    icon.setAttribute('href', '#icon-menu');
    icon.setAttribute('xlink:href', '#icon-menu');
  }

  // Toggle banner wrap modifier
  bannerWrap.classList.toggle('banner__wrap--active-mobile-menu');

  // Toggle mobile nav menu
  mobileNav.classList.toggle('banner__nav-header-mobile--show');

  // Disable body scroll beneath nav when nav is showing
  if (mobileNav.classList.contains('banner__nav-header-mobile--show')) {
    disableBodyScroll(true);
  } else {
    disableBodyScroll(false);
  }
}

/**
 * Function to control body scrolling
 * @param {Boolean} $disable  Whether to disable body scrolling or not
 */
function disableBodyScroll( $disable ) {
  if ( $disable ) {
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
  }
  else {
    document.body.style.overflow = 'auto';
    document.documentElement.style.overflow = 'auto';
  }
}

/**
 * Adds a body class for styling focus elements (specific to keyboard users)
 * @param  {Object}   e   event object
 * @return void
 */
function handleFirstTab(e) {
  if (e.keyCode === 9) { // the "I am a keyboard user" key
    document.body.classList.add('user-is-tabbing');
    window.removeEventListener('keydown', handleFirstTab);
  }
}
