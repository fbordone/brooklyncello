import picturefill from 'picturefill';
import webFont from 'webfontloader';

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
      timeout: 3000,
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

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
