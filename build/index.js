/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/modules/Request.js":
/*!***********************************!*\
  !*** ./assets/modules/Request.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
// import $ from "jquery"

class Request {
  constructor() {
    // this.addSearchHTML()
    // this.resultsDiv = $("#user_profile")
    // this.singleLink = $(".single-link")
    this.events();
  }
  events() {
    // this.singleLink.on("click", this.getResults.bind(this))
    // $(document).on("keydown", this.keyPressDispatcher.bind(this))
    console.log('HermanFrau');
  }

  // 3. methods (function, action...)
  //   typingLogic() {
  //     if (this.searchField.val() != this.previousValue) {
  //       clearTimeout(this.typingTimer)

  //       if (this.searchField.val()) {
  //         if (!this.isSpinnerVisible) {
  //           this.resultsDiv.html('<div class="spinner-loader"></div>')
  //           this.isSpinnerVisible = true
  //         }
  //         this.typingTimer = setTimeout(this.getResults.bind(this), 750)
  //       } else {
  //         this.resultsDiv.html("")
  //         this.isSpinnerVisible = false
  //       }
  //     }

  //     this.previousValue = this.searchField.val()
  //   }

  //   getResults() {
  //     $.when($.getJSON(universityData.root_url + "/wp-json/wp/v2/posts?search=" + this.searchField.val()), $.getJSON(universityData.root_url + "/wp-json/wp/v2/pages?search=" + this.searchField.val())).then(
  //       (posts, pages) => {
  //         var combinedResults = posts[0].concat(pages[0])
  //         this.resultsDiv.html(`
  //         <h2 class="search-overlay__section-title">General Information</h2>
  //         ${combinedResults.length ? '<ul class="link-list min-list">' : "<p>No general information matches that search.</p>"}
  //           ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join("")}
  //         ${combinedResults.length ? "</ul>" : ""}
  //       `)
  //         this.isSpinnerVisible = false
  //       },
  //       () => {
  //         this.resultsDiv.html("<p>Unexpected error; please try again.</p>")
  //       }
  //     )
  //   }

  //   userProfile() {
  //     $("body").append(`
  //       <div class="search-overlay">
  //         <div class="search-overlay__top">
  //           <div class="container">
  //             <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
  //             <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
  //             <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
  //           </div>
  //         </div>

  //         <div class="container">
  //           <div id="search-overlay__results"></div>
  //         </div>

  //       </div>
  //     `)
  //   }
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Request);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*************************!*\
  !*** ./assets/index.js ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_Request__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/Request */ "./assets/modules/Request.js");

new _modules_Request__WEBPACK_IMPORTED_MODULE_0__["default"]();

// https://jsonplaceholder.typicode.com/users
})();

/******/ })()
;
//# sourceMappingURL=index.js.map