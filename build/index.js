/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/modules/PrintHtml.js":
/*!*************************************!*\
  !*** ./assets/modules/PrintHtml.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class PrintHtml {
  constructor() {
    this.targetContainer = jquery__WEBPACK_IMPORTED_MODULE_0___default()('#inspyde-table');
    if (this.targetContainer.length === 0) {
      console.error('Target container does not exist. Program terminated.');
      return; // Terminate the program
    }
  }

  printHtmlTable(response) {
    const dataArray = JSON.parse(response);
    const tableRows = dataArray.map(item => `
          <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.username}</td>
          </tr>
        `);
    const tableHtml = `
          <h2 class="search-overlay__section-title">General Information</h2>
          ${dataArray.length ? '<table class="your-table-class">' : "<p>No general information matches that search.</p>"}
            ${tableRows.join("")}
          ${dataArray.length ? "</table>" : ""}
        `;
    this.targetContainer.html(tableHtml);
  }
  printUserInfo(response) {}
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PrintHtml);

/***/ }),

/***/ "./assets/modules/Request.js":
/*!***********************************!*\
  !*** ./assets/modules/Request.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _PrintHtml__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PrintHtml */ "./assets/modules/PrintHtml.js");
// Import jQuery


class Request {
  constructor() {
    this.printHtmlInstance = new _PrintHtml__WEBPACK_IMPORTED_MODULE_1__["default"]();
    this.eventHandlers();
  }
  sendData(action, userId) {
    const data = {
      action: action,
      userId: userId
    };
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      url: ajax_obj.ajaxurl,
      method: 'POST',
      data: data,
      success: response => {
        this.printHtmlInstance.printHtmlTable(response);
      },
      error: function (error) {
        console.error('Error:', error);
      }
    });
  }
  eventHandlers() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(() => {
      this.sendData('inpsyde_get_users');
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Request);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["jQuery"];

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
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
})();

/******/ })()
;
//# sourceMappingURL=index.js.map