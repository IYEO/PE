var JFormValidator = function() {
	var $, handlers, inputEmail, custom, setHandler = function(name, fn, en) {
		en = en === "" ? true : en;
		handlers[name] = {
			enabled : en,
			exec : fn
		}
	}, findLabel = function(id, form) {
		var $label, $form = jQuery(form);
		if (!id) {
			return false
		}
		$label = $form.find("#" + id + "-lbl");
		if ($label.length) {
			return $label
		}
		$label = $form.find('label[for="' + id + '"]');
		if ($label.length) {
			return $label
		}
		return false
	}, handleResponse = function(state, $el) {
		var $label = $el.data("label");
		if (state === false) {			
			$el.addClass("invalid").attr("aria-invalid", "true");
			/*if ($label) {
				$label.addClass("invalid").attr("aria-invalid", "true")
			}*/
						
			if ($el.closest("div.form-group").hasClass("has-success")) $el.closest("div.form-group").removeClass("has-success");
			$el.closest("div.form-group").addClass("has-error");
			
			/*$el.attr("aria-invalid", "true");
			if ($label) {
				$label.attr("aria-invalid", "true")
			}*/
			
		} else {			
			$el.removeClass("invalid").attr("aria-invalid", "false");
			/*if ($label) {
				$label.removeClass("invalid").attr("aria-invalid", "false")
			}*/
			
			if ($el.closest("div.form-group").hasClass("has-error")) {
				$el.closest("div.form-group").removeClass("has-error");
				$el.closest("div.form-group").addClass("has-success");
			}
			
			/*$el.attr("aria-invalid", "false");
			if ($label) {
				$label.attr("aria-invalid", "false")
			}*/
			
			jQuery(function () {
			  jQuery('[data-toggle="tooltip"]').tooltip();
			});
			
			$el.tooltip("destroy");
			
			$el.removeAttr("data-toggle data-placement data-original-title");
		}
	}, validate = function(el) {
		var $el = jQuery(el), tagName, handler;
		if ($el.attr("disabled")) {
			handleResponse(true, $el);
			return true
		}
		if ($el.attr("required") || $el.hasClass("required")) {
			tagName = $el.prop("tagName").toLowerCase();
			if (tagName === "fieldset" && ($el.hasClass("radio") || $el.hasClass("checkboxes"))) {
				if (!$el.find("input:checked").length) {
					handleResponse(false, $el);
					return false
				}
			} else if (!$el.val() || $el.hasClass("placeholder") || $el.attr("type") === "checkbox" && !$el.is(":checked")) {
				handleResponse(false, $el);
				return false
			}
		}
		handler = $el.attr("class") && $el.attr("class").match(/validate-([a-zA-Z0-9\_\-]+)/) ? $el.attr("class").match(/validate-([a-zA-Z0-9\_\-]+)/)[1] : "";
		if (handler === "") {
			handleResponse(true, $el);
			return true
		}
		if (handler && handler !== "none" && handlers[handler] && $el.val()) {
			if (handlers[handler].exec($el.val()) !== true) {
				handleResponse(false, $el);
				return false
			}
		}
		handleResponse(true, $el);
		return true
	}, isValid = function(form) {
            var fields, valid = true, message, error, label, invalid = [], i, l;
            // Validate form fields
            fields = jQuery(form).find('input, textarea, select, fieldset');
            for (i = 0, l = fields.length; i < l; i++) {
                    if (validate(fields[i]) === false) {
                            valid = false;
                            invalid.push(fields[i]);
                    }
            }
            // Run custom form validators if present
            jQuery.each(custom, function(key, validator) {
                    if (validator.exec() !== true) {
                            valid = false;
                    }
            });
            if (!valid && invalid.length > 0) {
                    jQuery(function () {
                        jQuery('[data-toggle="tooltip"]').tooltip();
                    });                    
                    message = Joomla.JText._('JLIB_FORM_FIELD_INVALID');
                    error = {"error": []};
                    for (i = invalid.length - 1; i >= 0; i--) {
                        label = jQuery(invalid[i]).data("label");
                        if (label) {
                            error.error.push(message + label.text().replace("*", ""));
                            jQuery(invalid[i]).attr("data-toggle", "tooltip").attr("data-placement", "bottom");
                            jQuery(invalid[i]).tooltip({html: true, container: "body", animation: true, title: message + label.text().replace("*", ""), delay: {show: "200", "hide": 100}});
                        }                        
                    }                    
                    jQuery(invalid).tooltip("show");
                    jQuery(invalid[0]).focus();
                    //Joomla.renderMessages(error);
            }
            return valid;
		
	}, attachToForm = function(form) {
		var inputFields = [];
		jQuery(form).find("input, textarea, select, fieldset, button").each(function() {
			var $el = $(this), id = $el.attr("id"), tagName = $el.prop("tagName").toLowerCase();
			if ($el.hasClass("required")) {
				$el.attr("aria-required", "true").attr("required", "required")
			}
			if ((tagName === "input" || tagName === "button") && $el.attr("type") === "submit") {
				if ($el.hasClass("validate")) {
					$el.on("click", function() {
						return isValid(form)
					})
				}
			} else {
				if (tagName !== "fieldset") {
					$el.on("blur", function() {
						return validate(this)
					});
					if ($el.hasClass("validate-email") && inputEmail) {
						$el.get(0).type = "email"
					}
				}
				$el.data("label", findLabel(id, form));
				inputFields.push($el)
			}
		});
		$(form).data("inputfields", inputFields)
	}, initialize = function() {
		$ = jQuery.noConflict();
		handlers = {};
		custom = custom || {};
		inputEmail = function() {
			var input = document.createElement("input");
			input.setAttribute("type", "email");
			return input.type !== "text"
		}();
		setHandler("username", function(value) {
			regex = new RegExp("[<|>|\"|'|%|;|(|)|&]", "i");
			return !regex.test(value)
		});
		setHandler("password", function(value) {
			regex = /^\S[\S ]{2,98}\S$/;
			return regex.test(value)
		});
		setHandler("numeric", function(value) {
			regex = /^(\d|-)?(\d|,)*\.?\d*$/;
			return regex.test(value)
		});
		setHandler("email", function(value) {
			value = punycode.toASCII(value);			
			regex = /^([a-z0-9_'&\.\-\+])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,10})+$/i;
			return regex.test(value)
		});
		jQuery("form.form-validate").each(function() {
			attachToForm(this)
		})
	};
	initialize();
	return {
		isValid : isValid,
		validate : validate,
		setHandler : setHandler,
		attachToForm : attachToForm,
		custom : custom
	}
};
document.formvalidator = null;
jQuery(function() {
	document.formvalidator = new JFormValidator
}); 