/*!
 * Distpicker v2.0.4
 * https://fengyuanchen.github.io/distpicker
 *
 * Copyright 2014-present Chen Fengyuan
 * Released under the MIT license
 *
 * Date: 2018-06-01T12:33:03.031Z
 */

import $ from 'jquery';

var DEFAULTS = {
  // Selects the districts automatically.
  // 0 -> Disable autoselect
  // 1 -> Autoselect province only
  // 2 -> Autoselect province and city only
  // 3 -> Autoselect all (province, city and district)
  autoselect: 0,

  // Show placeholder.
  placeholder: true,

  // Select value. Options: 'name' and 'code'
  valueType: 'name',

  // Defines the initial value of province.
  province: '—— 省 ——',

  // Defines the initial value of city.
  city: '—— 市 ——',

  // Defines the initial value of district.
  district: '—— 区 ——'
};

var DISTRICTS = {
  100000 : {
    110000 : '托斯卡纳',
    120000 : '伦巴第',
    130000 : '拉齐奥',
  },
  110000 : {
    110100 : '佛罗伦萨'
  },
  110100 : {
    110101 : "Novoli",
		110102 : "Rifredi-careggi",
		110105 : "centro storico",
		110106 : "Campo di marte",
		110107 : "Scandicci — l'isoletto'",
		110108 : "Santo spirito",
		110109 : "Piazza libertà",
		110111 : "Santa Croce",
		110112 : "Stazione centrale",
		110113 : "San Niccolò — Michelangelo",
		110114 : "Piazza Cesare Beccaria",
		110115 : "San Marco",
		110116 : "Statuto",
		110117 : "Porta prato"
  },
  120000 : {
    120100 : '米兰'
  },
  120100: {
    120101 : "Duomo",
    120102 : "China twon",
    120103 : "Stazione centrale",
    120104 : "AcquaBella",
    120105 : "Porta Romana",
    120106 : "Vigentino",
    120110 : "Ticinese",
    120111 : "Lorenteggio",
    120112 : "Zone2 of Milan",
    120113 : "Quartiere Stadera",
    120114 : "Afori",
    120115 : "San Vittore",
    120116 : "Feltre-Città Studi",
    120117 : "Guastalla",
    120118 : "Corvetto",
    120119 : "Calvairate",
    120120 : "Gratosoglio",
    120121 : "Zona Risorgimento",
    120122 : "Rho",
    120123 : "Crescenzago",
    120124 : "Turro",
    120125 : "De Angeli",
    120126 : "Naviglio Pavese",
    120127 : "Quartiere Mazzini",
    120128 : "Villa San Giovanni",
    120129 : "Vicocca",
    120130 : "Restocco Maroni"
  },
  130000 : {
    130100 : '罗马',
  },
  130100 : {
    130102 : "Ottaviano",
    130104 : "Lucio Sestio",
    130105 : "Roma Stazione S.pietro",
    130107 : "Centro Storico",
    130108 : "Trastevere",
    130109 : "Colosseo",
    130110 : "Quartiere III",
    130111 : "Quartiere XVII Trieste",
    130121 : "San Giovanni",
    130123 : "Trieste",
    130125 : "Teano",
    130126 : "Cipro",
    130127 : "Valle Fiorita",
    130128 : "S.Maria del Soccorso",
    130129 : "Vittorio Emanuele",
    130130 : "Tiburtina",
    130131 : "Pigneto"
  }
};

var WINDOW = typeof window !== 'undefined' ? window : {};
var NAMESPACE = 'distpicker';
var EVENT_CHANGE = 'change';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var DEFAULT_CODE = 100000;
var PROVINCE = 'province';
var CITY = 'city';
var DISTRICT = 'district';

var Distpicker = function () {
  function Distpicker(element, options) {
    _classCallCheck(this, Distpicker);

    this.$element = $(element);
    this.options = $.extend({}, DEFAULTS, $.isPlainObject(options) && options);
    this.placeholders = $.extend({}, DEFAULTS);
    this.ready = false;
    this.init();
  }

  _createClass(Distpicker, [{
    key: 'init',
    value: function init() {
      var _this = this;

      var options = this.options;

      var $selects = this.$element.find('select');
      var length = $selects.length;

      var data = {};

      $selects.each(function (i, select) {
        return $.extend(data, $(select).data());
      });

      $.each([PROVINCE, CITY, DISTRICT], function (i, type) {
        if (data[type]) {
          options[type] = data[type];
          _this['$' + type] = $selects.filter('[data-' + type + ']');
        } else {
          _this['$' + type] = length > i ? $selects.eq(i) : null;
        }
      });

      this.bind();

      // Reset all the selects (after event binding)
      this.reset();
      this.ready = true;
    }
  }, {
    key: 'bind',
    value: function bind() {
      var _this2 = this;

      if (this.$province) {
        this.$province.on(EVENT_CHANGE, this.onChangeProvince = $.proxy(function () {
          _this2.output(CITY);
          _this2.output(DISTRICT);
        }, this));
      }

      if (this.$city) {
        this.$city.on(EVENT_CHANGE, this.onChangeCity = $.proxy(function () {
          return _this2.output(DISTRICT);
        }, this));
      }
    }
  }, {
    key: 'unbind',
    value: function unbind() {
      if (this.$province) {
        this.$province.off(EVENT_CHANGE, this.onChangeProvince);
      }

      if (this.$city) {
        this.$city.off(EVENT_CHANGE, this.onChangeCity);
      }
    }
  }, {
    key: 'output',
    value: function output(type) {
      var options = this.options,
          placeholders = this.placeholders;

      var $select = this['$' + type];

      if (!$select || !$select.length) {
        return;
      }

      var code = void 0;

      switch (type) {
        case PROVINCE:
          code = DEFAULT_CODE;
          break;

        case CITY:
          code = this.$province && (this.$province.find(':selected').data('code') || '');
          break;

        case DISTRICT:
          code = this.$city && (this.$city.find(':selected').data('code') || '');
          break;
      }

      var districts = this.getDistricts(code);
      var value = options[type];
      var data = [];
      var matched = false;

      if ($.isPlainObject(districts)) {
        $.each(districts, function (i, name) {
          var selected = name === value;

          if (options.valueType === 'code') {
            selected = i === String(value);
          }

          if (selected) {
            matched = true;
          }

          data.push({
            code: i,
            name: name,
            value: options.valueType === 'name' ? name : i,
            selected: selected
          });
        });
      }

      if (!matched) {
        var autoselect = options.autoselect || options.autoSelect;

        if (data.length && (type === PROVINCE && autoselect > 0 || type === CITY && autoselect > 1 || type === DISTRICT && autoselect > 2)) {
          data[0].selected = true;
        }

        // Save the unmatched value as a placeholder at the first output
        if (!this.ready && value) {
          placeholders[type] = value;
        }
      }

      // Add placeholder option
      if (options.placeholder) {
        data.unshift({
          code: '',
          name: placeholders[type],
          value: '',
          selected: false
        });
      }

      if (data.length) {
        $select.html(this.getList(data));
      } else {
        $select.empty();
      }

      $select.trigger(EVENT_CHANGE);
    }

    // eslint-disable-next-line class-methods-use-this

  }, {
    key: 'getList',
    value: function getList(data) {
      var list = [];

      $.each(data, function (i, n) {
        var attrs = ['data-code="' + n.code + '"', 'data-text="' + n.name + '"', 'value="' + n.value + '"'];

        if (n.selected) {
          attrs.push('selected');
        }

        list.push('<option ' + attrs.join(' ') + '>' + n.name + '</option>');
      });

      return list.join('');
    }

    // eslint-disable-next-line class-methods-use-this

  }, {
    key: 'getDistricts',
    value: function getDistricts() {
      var code = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : DEFAULT_CODE;

      return DISTRICTS[code] || null;
    }
  }, {
    key: 'reset',
    value: function reset(deep) {
      if (!deep) {
        this.output(PROVINCE);
        this.output(CITY);
        this.output(DISTRICT);
      } else if (this.$province) {
        this.$province.find(':first').prop('selected', true).end().trigger(EVENT_CHANGE);
      }
    }
  }, {
    key: 'destroy',
    value: function destroy() {
      this.unbind();
    }
  }], [{
    key: 'setDefaults',
    value: function setDefaults(options) {
      $.extend(DEFAULTS, $.isPlainObject(options) && options);
    }
  }]);

  return Distpicker;
}();

if ($.fn) {
  var AnotherDistpicker = $.fn.distpicker;

  $.fn.distpicker = function jQueryDistpicker(option) {
    for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    var result = void 0;

    this.each(function (i, element) {
      var $element = $(element);
      var isDestroy = option === 'destroy';
      var distpicker = $element.data(NAMESPACE);

      if (!distpicker) {
        if (isDestroy) {
          return;
        }

        var options = $.extend({}, $element.data(), $.isPlainObject(option) && option);

        distpicker = new Distpicker(element, options);
        $element.data(NAMESPACE, distpicker);
      }

      if (typeof option === 'string') {
        var fn = distpicker[option];

        if ($.isFunction(fn)) {
          result = fn.apply(distpicker, args);

          if (isDestroy) {
            $element.removeData(NAMESPACE);
          }
        }
      }
    });

    return typeof result === 'undefined' ? this : result;
  };

  $.fn.distpicker.Constructor = Distpicker;
  $.fn.distpicker.setDefaults = Distpicker.setDefaults;

  $.fn.distpicker.noConflict = function noConflict() {
    $.fn.distpicker = AnotherDistpicker;
    return this;
  };
}

if (WINDOW.document) {
  $(function () {
    $('[data-toggle="' + NAMESPACE + '"]').distpicker();
  });
}
