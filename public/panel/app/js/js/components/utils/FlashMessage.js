(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/components/utils/FlashMessage"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/babel-loader/lib??ref--10!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FlashMessage.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
var toastID = 0;
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "FlashMessage",
  props: {
    flash: {
      type: Array | Object
    },
    error: {
      type: Array | Object
    },
    success: {
      type: Array | Object
    }
  },
  data: function data() {
    return {
      toasts: [],
      states: {
        '1': {
          type: 'success',
          icon: 'fa fa-check-circle fa-lg'
        },
        '-1': {
          type: 'danger',
          icon: 'fa fa-times-circle fa-lg'
        },
        '2': {
          type: 'warning',
          icon: 'fa fa-exclamation-triangle fa-lg'
        },
        '0': {
          type: 'info',
          icon: 'fa fa-info-circle fa-lg'
        }
      }
    };
  },
  methods: {
    addToast: function addToast(_ref) {
      var _this = this;

      var message = _ref.message,
          _ref$type = _ref.type,
          type = _ref$type === void 0 ? 'info' : _ref$type,
          _ref$duration = _ref.duration,
          duration = _ref$duration === void 0 ? 6000 : _ref$duration,
          _ref$sticky = _ref.sticky,
          sticky = _ref$sticky === void 0 ? false : _ref$sticky,
          icon = _ref.icon;
      var id = toastID++;
      this.toasts.push({
        id: id,
        type: type,
        message: message,
        icon: icon,
        sticky: sticky
      });

      if (!sticky) {
        setTimeout(function () {
          _this.removeToast(id);
        }, duration);
      }
    },
    removeToast: function removeToast(id) {
      this.toasts = this.toasts.filter(function (m) {
        return m.id !== id;
      });
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    if (this.error.message) {
      this.error.message.forEach(function (item) {
        _this2.addToast({
          type: _this2.states[_this2.error.code].type,
          message: item,
          sticky: _this2.error.sticky,
          icon: _this2.states[_this2.error.code].icon
        });
      });
    }

    if (this.success) {
      this.addToast({
        message: this.success.message,
        type: this.states[this.success.code].type,
        duration: this.success.message.duration,
        sticky: this.success.sticky,
        icon: this.states[this.success.code].icon
      });
    }

    window.eventBus.$on('flash', function (data) {
      console.log(data);
      if (data.message instanceof Array) data.message.forEach(function (item) {
        _this2.addToast({
          message: item,
          type: _this2.states[_this2.error.code].type,
          icon: _this2.states[_this2.error.code].icon
        });
      });else _this2.addToast({
        message: data.message,
        type: _this2.states[data.code].type,
        icon: _this2.states[data.code].icon
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/dist/cjs.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".toasts-item[data-v-3cea7a62] {\n  transition: all 0.5s;\n}\n.toasts-enter[data-v-3cea7a62],\n.toasts-leave-to[data-v-3cea7a62] {\n  opacity: 0;\n  transform: scale(0.9);\n}\n.toasts-leave-active[data-v-3cea7a62] {\n  position: absolute;\n  z-index: -1;\n}\n.c-toasts[data-v-3cea7a62] {\n  position: fixed;\n  top: 20px;\n  left: 20px;\n  z-index: 9999;\n  width: 300px;\n  /*pointer-events: none;*/\n}\n.c-toasts__item[data-v-3cea7a62] {\n  display: flex;\n  align-items: center;\n  width: 100%;\n  margin-bottom: 10px;\n  padding: 15px;\n  border-radius: 5px;\n  color: #fff;\n  background-color: rgba(0, 0, 0, 0.8);\n}\n.c-toasts__item-text[data-v-3cea7a62] {\n  font-size: 14px;\n  line-height: 1.5;\n}\n.c-toasts__item--success[data-v-3cea7a62] {\n  background-color: #339900;\n}\n.c-toasts__item--danger[data-v-3cea7a62] {\n  background-color: #cc3300;\n}\n.c-toasts__item--warning[data-v-3cea7a62] {\n  background-color: #ffc107;\n}\n.c-toasts__item--info[data-v-3cea7a62] {\n  background-color: #40a6ce;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/dist/cjs.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/sass-loader/dist/cjs.js??ref--6-3!../../../node_modules/vue-loader/lib??vue-loader-options!./FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "transition-group",
    { staticClass: "c-toasts", attrs: { name: "toasts", tag: "div" } },
    [
      _vm._l(_vm.toasts, function(toast, index) {
        return [
          _c(
            "div",
            {
              key: index,
              class: ["c-toasts__item", "c-toasts__item--" + toast.type]
            },
            [
              _c("span", { staticClass: "c-toasts__item-text" }, [
                _c("i", { class: toast.icon }),
                _vm._v(
                  "\n                " +
                    _vm._s(toast.message) +
                    "\n            "
                )
              ]),
              _vm._v(" "),
              toast.sticky
                ? _c(
                    "span",
                    {
                      staticClass: "mr-auto pointer",
                      attrs: { "aria-hidden": "true" },
                      on: {
                        click: function($event) {
                          return _vm.removeToast(toast.id)
                        }
                      }
                    },
                    [_vm._v("×")]
                  )
                : _vm._e()
            ]
          )
        ]
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/FlashMessage.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/FlashMessage.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true& */ "./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true&");
/* harmony import */ var _FlashMessage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FlashMessage.vue?vue&type=script&lang=js& */ "./resources/js/components/FlashMessage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& */ "./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _FlashMessage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3cea7a62",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/FlashMessage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/FlashMessage.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/FlashMessage.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_babel_loader_lib_index_js_ref_10_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/babel-loader/lib??ref--10!../../../node_modules/vue-loader/lib??vue-loader-options!./FlashMessage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_babel_loader_lib_index_js_ref_10_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& ***!
  \************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/sass-loader/dist/cjs.js??ref--6-3!../../../node_modules/vue-loader/lib??vue-loader-options!./FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=style&index=0&id=3cea7a62&scoped=true&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_dist_cjs_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_style_index_0_id_3cea7a62_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FlashMessage.vue?vue&type=template&id=3cea7a62&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FlashMessage_vue_vue_type_template_id_3cea7a62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);