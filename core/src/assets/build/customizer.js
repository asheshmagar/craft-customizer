/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["jQuery"];

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["lodash"];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _arrayLikeToArray)
/* harmony export */ });
function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/arrayWithoutHoles.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/arrayWithoutHoles.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _arrayWithoutHoles)
/* harmony export */ });
/* harmony import */ var _arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js");

function _arrayWithoutHoles(arr) {
  if (Array.isArray(arr)) return (0,_arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__["default"])(arr);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/iterableToArray.js":
/*!********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/iterableToArray.js ***!
  \********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _iterableToArray)
/* harmony export */ });
function _iterableToArray(iter) {
  if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/nonIterableSpread.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/nonIterableSpread.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _nonIterableSpread)
/* harmony export */ });
function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/toConsumableArray.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/toConsumableArray.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _toConsumableArray)
/* harmony export */ });
/* harmony import */ var _arrayWithoutHoles_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./arrayWithoutHoles.js */ "./node_modules/@babel/runtime/helpers/esm/arrayWithoutHoles.js");
/* harmony import */ var _iterableToArray_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./iterableToArray.js */ "./node_modules/@babel/runtime/helpers/esm/iterableToArray.js");
/* harmony import */ var _unsupportedIterableToArray_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js");
/* harmony import */ var _nonIterableSpread_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./nonIterableSpread.js */ "./node_modules/@babel/runtime/helpers/esm/nonIterableSpread.js");




function _toConsumableArray(arr) {
  return (0,_arrayWithoutHoles_js__WEBPACK_IMPORTED_MODULE_0__["default"])(arr) || (0,_iterableToArray_js__WEBPACK_IMPORTED_MODULE_1__["default"])(arr) || (0,_unsupportedIterableToArray_js__WEBPACK_IMPORTED_MODULE_2__["default"])(arr) || (0,_nonIterableSpread_js__WEBPACK_IMPORTED_MODULE_3__["default"])();
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _unsupportedIterableToArray)
/* harmony export */ });
/* harmony import */ var _arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return (0,_arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__["default"])(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return (0,_arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__["default"])(o, minLen);
}

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
/*!*************************************!*\
  !*** ./src/assets/js/customizer.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/toConsumableArray */ "./node_modules/@babel/runtime/helpers/esm/toConsumableArray.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_2__);


function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



var api = wp.customize;
/**
 * Extend sections and panels.
 */

{
  api.bind('pane-contents-reflowed', function () {
    var panels = [],
        sections = [];
    api.section.each(function (section) {
      var _section$params;

      if ('customind-section' === section.params.type && !!((_section$params = section.params) !== null && _section$params !== void 0 && _section$params.section)) {
        sections.push(section);
      }
    });
    sections.sort(api.utils.prioritySort).reverse();
    jquery__WEBPACK_IMPORTED_MODULE_1___default().each(sections, function (i, section) {
      var parentContainer = jquery__WEBPACK_IMPORTED_MODULE_1___default()("#sub-accordion-section-".concat(section.params.section));
      parentContainer.children('.section-meta').after(section.headContainer);
    });
    api.panel.each(function (panel) {
      var _panel$params;

      if ('customind-panel' === panel.params.type && !!((_panel$params = panel.params) !== null && _panel$params !== void 0 && _panel$params.panel)) {
        panels.push(panel);
      }
    });
    panels.sort(api.utils.prioritySort).reverse();
    jquery__WEBPACK_IMPORTED_MODULE_1___default().each(panels, function (i, panel) {
      var parentContainer = jquery__WEBPACK_IMPORTED_MODULE_1___default()("#sub-accordion-panel-".concat(panel.params.panel));
      parentContainer.children('.section-meta').after(panel.headContainer);
    });
  });
  var panelEmbed = api.Panel.prototype.embed,
      panelIsContextuallyActive = api.Panel.prototype.isContextuallyActive,
      panelAttachEvents = api.Panel.prototype.attachEvents;
  api.Panel = api.Panel.extend({
    attachEvents: function attachEvents() {
      var _this$params;

      if ('customind-panel' !== this.params.type || !((_this$params = this.params) !== null && _this$params !== void 0 && _this$params.panel)) {
        panelAttachEvents.call(this);
        return;
      }

      panelAttachEvents.call(this);
      var panel = this;
      panel.expanded.bind(function (expanded) {
        var parent = api.panel(panel.params.panel);

        if (expanded) {
          parent.contentContainer.addClass('current-panel-parent');
        } else {
          parent.contentContainer.removeClass('current-panel-parent');
        }
      });
      panel.container.find('.customize-panel-back').off('click keydown').on('click keydown', function (evt) {
        if (api.utils.isKeydownButNotEnterEvent(evt)) {
          return;
        }

        evt.preventDefault();

        if (panel.expanded()) {
          api.panel(panel.params.panel).expand();
        }
      });
    },
    embed: function embed() {
      var _this$params2;

      if ('customind-panel' !== this.params.type || !((_this$params2 = this.params) !== null && _this$params2 !== void 0 && _this$params2.section)) {
        panelEmbed.call(this);
        return;
      }

      panelEmbed.call(this);
      var panel = this;
      var parentContainer = jquery__WEBPACK_IMPORTED_MODULE_1___default()("#sub-accordion-panel-".concat(panel.params.panel));
      parentContainer.append(panel.headContainer);
    },
    isContextuallyActive: function isContextuallyActive() {
      if ('customind-panel' !== this.params.type) {
        return panelIsContextuallyActive.call(this);
      }

      var panel = this;

      var children = this._children('panel', 'section');

      var activeCount = 0;
      api.panel.each(function (child) {
        var _child$params;

        if (((_child$params = child.params) === null || _child$params === void 0 ? void 0 : _child$params.panel) !== panel.id) return;
        children.push(child);
      });
      children.sort(api.utils.prioritySort);

      lodash__WEBPACK_IMPORTED_MODULE_2___default()(children).each(function (child) {
        if (child.active() && child.isContextuallyActive()) {
          activeCount += 1;
        }
      });

      return 0 !== activeCount;
    }
  });
  var sectionEmbed = api.Section.prototype.embed,
      sectionIsContextuallyActive = api.Section.prototype.isContextuallyActive,
      sectionAttachEvents = api.Section.prototype.attachEvents;
  api.Section = api.Section.extend({
    attachEvents: function attachEvents() {
      var _section$params2;

      var section = this;

      if ('customind-section' !== section.params.type || !((_section$params2 = section.params) !== null && _section$params2 !== void 0 && _section$params2.section)) {
        sectionAttachEvents.call(this);
        return;
      }

      sectionAttachEvents.call(this);
      section.expanded.bind(function (expanded) {
        var parent = api.section(section.params.section);

        if (expanded) {
          parent.contentContainer.addClass('current-section-parent');
        } else {
          parent.contentContainer.removeClass('current-section-parent');
        }
      });
      section.container.find('.customize-section-back').off('click keydown').on('click keydown', function (evt) {
        if (api.utils.isKeydownButNotEnterEvent(evt)) {
          return;
        }

        evt.preventDefault();

        if (section.expanded()) {
          api.section(section.params.section).expand();
        }
      });
    },
    embed: function embed() {
      if ('customind-section' !== this.params.type) {
        sectionEmbed.call(this);
        return;
      }

      sectionEmbed.call(this);
      var section = this;
      var parentContainer = jquery__WEBPACK_IMPORTED_MODULE_1___default()("#sub-accordion-section-".concat(section.params.section));
      parentContainer.append(section.headContainer);
    },
    isContextuallyActive: function isContextuallyActive() {
      var _this$params3;

      if ('customind-section' !== this.params.type || !((_this$params3 = this.params) !== null && _this$params3 !== void 0 && _this$params3.section)) {
        return sectionIsContextuallyActive.call(this);
      }

      var section = this;

      var children = this._children('section', 'control');

      var activeCount = 0;
      api.section.each(function (child) {
        var _child$params2;

        if (((_child$params2 = child.params) === null || _child$params2 === void 0 ? void 0 : _child$params2.section) !== section.id) return;
        children.push(child);
      });
      children.sort(api.utils.prioritySort);

      lodash__WEBPACK_IMPORTED_MODULE_2___default()(children).each(function (child) {
        if (child !== null && child !== void 0 && child.isContextuallyActive) {
          if (child.active() && child.isContextuallyActive()) {
            activeCount += 1;
          }
        } else {
          if (child.active()) {
            // eslint-disable-line no-lonely-if
            activeCount += 1;
          }
        }
      });

      return 0 !== activeCount;
    }
  });
} // Initialize builder and its panel and section.

{
  api.bind('ready', function () {
    var builderPanelSection = {};
    api.control.each(function (control) {
      if (control.section()) {
        var _section$params3;

        var section = api.section(control.section());

        if (section !== null && section !== void 0 && section.panel() && 'customind-builder-section' === ((_section$params3 = section.params) === null || _section$params3 === void 0 ? void 0 : _section$params3.type)) {
          var _panel$params2;

          var panel = api.panel(section.panel());

          if (panel !== null && panel !== void 0 && panel.id && 'customind-builder-panel' === ((_panel$params2 = panel.params) === null || _panel$params2 === void 0 ? void 0 : _panel$params2.type)) {
            builderPanelSection[panel.id] = [].concat((0,_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__["default"])((builderPanelSection === null || builderPanelSection === void 0 ? void 0 : builderPanelSection[panel.id]) || []), [section.id]);
          }
        }
      }
    });

    var initBuilder = function initBuilder(panelId, sectionIds) {
      var _sectionIds;

      var panel = api.panel(panelId);
      if (!panel || !((_sectionIds = sectionIds) !== null && _sectionIds !== void 0 && _sectionIds.length)) return;
      sectionIds = lodash__WEBPACK_IMPORTED_MODULE_2___default().uniq(sectionIds);
      var selectors = [];
      var newBodyClass = "".concat(panelId.replaceAll('_', '-'), "-active");

      var _iterator = _createForOfIteratorHelper(sectionIds),
          _step;

      try {
        var _loop = function _loop() {
          var sectionId = _step.value;
          var section = api.section(sectionId);

          if (section) {
            var contentContainer = section.contentContainer;
            var headContainer = section.headContainer;
            selectors.push("#sub-accordion-section-".concat(section.id));
            headContainer.addClass('customind-hidden-section-navigator');
            contentContainer.find('.section-meta').addClass('hidden').hide();
            panel.expanded.bind(function (isExpanded) {
              var _section$controls;

              if (!((_section$controls = section.controls()) !== null && _section$controls !== void 0 && _section$controls.length)) return;

              lodash__WEBPACK_IMPORTED_MODULE_2___default().each(section.controls(), function (control) {
                if ('resolved' === control.deferred.embedded.state()) return;
                control.renderContent();
                control.deferred.embedded.resolve();
                control.container.trigger('init');
              });

              if (isExpanded) {
                jquery__WEBPACK_IMPORTED_MODULE_1___default()("#sub-accordion-panel-".concat(panelId, " li.control-section")).addClass('customind-hidden-section-navigator').hide();
                jquery__WEBPACK_IMPORTED_MODULE_1___default()('body').addClass(newBodyClass);
              } else {
                jquery__WEBPACK_IMPORTED_MODULE_1___default()('body').removeClass(newBodyClass);
              }
            });
          }
        };

        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          _loop();
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      var styles = '';

      if ((selectors === null || selectors === void 0 ? void 0 : selectors.length) > 0) {
        var _iterator2 = _createForOfIteratorHelper(selectors),
            _step2;

        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var selector = _step2.value;
            styles += ".".concat(newBodyClass, " .in-sub-panel:not(.section-open) ul").concat(selector, "{transform:none;height:auto;visibility:visible;top: 75px;}");
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }

      jquery__WEBPACK_IMPORTED_MODULE_1___default()('head').append("<style>".concat(styles, "</style>"));
    };

    if (!lodash__WEBPACK_IMPORTED_MODULE_2___default().isEmpty(builderPanelSection)) {
      for (var panel in builderPanelSection) {
        if (panel && builderPanelSection !== null && builderPanelSection !== void 0 && builderPanelSection[panel]) {
          initBuilder(panel, builderPanelSection[panel] || []);
        }
      }
    }
  });
}
{
  api.bind('ready', function () {
    api.state.create('customindTab');
    api.state('customindTab').set('general');
    var controls = jquery__WEBPACK_IMPORTED_MODULE_1___default()('#customize-theme-controls');

    var focusSection = function focusSection(sectionId) {
      var section = api.section(sectionId);

      if (section) {
        var container = section.contentContainer[0];
        container.addClass('customind-prevent-transition');
        setTimeout(function () {
          section.focus();
        }, 10);
        setTimeout(function () {
          container.removeClass('customind-prevent-transition').removeClass('busy');
          container.css('top', '');
        }, 300);
      }
    };

    controls.on('click', '.customind-tab', function (e) {
      e.preventDefault();
      var target = jquery__WEBPACK_IMPORTED_MODULE_1___default()(this).attr('data-target');
      api.state('customindTab').set(jquery__WEBPACK_IMPORTED_MODULE_1___default()(this).attr('data-tab'));

      if (target) {
        focusSection(target);
      }
    });
    api.state('customindTab').bind(function () {
      var tab = api.state('customindTab').get();
      jquery__WEBPACK_IMPORTED_MODULE_1___default()('.customind-tab').removeClass('active').filter(".customind-".concat(tab, "-tab")).addClass('active');
    });
    controls.on('click', '.customize-section-back', function () {
      return api.state('customindTab').set('general');
    });
  });
}
})();

/******/ })()
;