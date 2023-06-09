/**
 * Initialize all modules
 */
(function ($, window, document, undefined) {
  $(window).on("elementor:init", function () {
    // Make our custom css visible in the panel's front-end
    if (typeof elementorPro == "undefined") {
      elementor.hooks.addFilter(
        "editor/style/styleText",
        function (css, context) {
          if (!context) {
            return;
          }

          var model = context.model,
            customCSS = model.get("settings").get("custom_css");
          var selector =
            ".elementor-element.elementor-element-" + model.get("id");

          if ("document" === model.get("elType")) {
            selector = elementor.config.document.settings.cssWrapperSelector;
          }

          if (customCSS) {
            css += customCSS.replace(/selector/g, selector);
          }

          return css;
        }
      );
    }

    var WpUlikeControlSelect2 = elementor.modules.controls.Select2;

    /*!
     * ================== Query Controller ===================
     **/
    var ControlQueryPostsItemView = WpUlikeControlSelect2.extend({
      cache: null,

      isTitlesReceived: false,

      getSelect2Placeholder: function getSelect2Placeholder() {
        return {
          id: "",
          text: "All",
        };
      },

      getControlValueByName: function getControlValueByName(controlName) {
        var name = this.model.get("group_prefix") + controlName;
        return this.elementSettingsModel.attributes[name];
      },

      getSelect2DefaultOptions: function getSelect2DefaultOptions() {
        var self = this;

        return jQuery.extend(
          WpUlikeControlSelect2.prototype.getSelect2DefaultOptions.apply(
            this,
            arguments
          ),
          {
            ajax: {
              transport: function transport(params, success, failure) {
                var bcFormat = !_.isEmpty(self.model.get("filter_type"));
                var data = {},
                  action = "wp_ulike_panel_posts_control_filter_autocomplete";

                if (bcFormat) {
                  data = self.getQueryDataDeprecated();
                  action =
                    "wp_ulike_panel_posts_control_filter_autocomplete_deprecated";
                } else {
                  data = self.getQueryData();
                }

                data.q = params.data.q;
                return elementorCommon.ajax.addRequest(action, {
                  data: data,
                  success: success,
                  error: failure,
                });
              },
              data: function data(params) {
                return {
                  q: params.term,
                  page: params.page,
                };
              },
              cache: true,
            },
            escapeMarkup: function escapeMarkup(markup) {
              return markup;
            },
            minimumInputLength: 1,
          }
        );
      },
      getQueryDataDeprecated: function getQueryDataDeprecated() {
        return {
          filter_type: this.model.get("filter_type"),
          object_type: this.model.get("object_type"),
          include_type: this.model.get("include_type"),
          query: this.model.get("query"),
        };
      },
      getQueryData: function getQueryData() {
        // Use a clone to keep model data unchanged:
        var autocomplete = elementorCommon.helpers.cloneObject(
          this.model.get("autocomplete")
        );

        if (_.isEmpty(autocomplete.query)) {
          autocomplete.query = {};
        } // Specific for Group_Control_Query

        if ("cpt_tax" === autocomplete.object) {
          autocomplete.object = "tax";

          if (
            _.isEmpty(autocomplete.query) ||
            _.isEmpty(autocomplete.query.post_type)
          ) {
            autocomplete.query.post_type =
              this.getControlValueByName("post_type");
          }
        }

        return {
          autocomplete: autocomplete,
        };
      },
      getValueTitles: function getValueTitles() {
        var self = this,
          data = {},
          bcFormat = !_.isEmpty(this.model.get("filter_type"));
        var ids = this.getControlValue(),
          action = "query_control_value_titles",
          filterTypeName = "autocomplete",
          filterType = {};

        if (bcFormat) {
          filterTypeName = "filter_type";
          filterType = this.model.get(filterTypeName).object;
          data.filter_type = filterType;
          data.object_type = self.model.get("object_type");
          data.include_type = self.model.get("include_type");
          data.unique_id = "" + self.cid + filterType;
          action = "query_control_value_titles_deprecated";
        } else {
          filterType = this.model.get(filterTypeName).object;
          data.get_titles = self.getQueryData().autocomplete;
          data.unique_id = "" + self.cid + filterType;
        }

        if (!ids || !filterType) {
          return;
        }

        if (!_.isArray(ids)) {
          ids = [ids];
        }

        elementorCommon.ajax.loadObjects({
          action: action,
          ids: ids,
          data: data,
          before: function before() {
            self.addControlSpinner();
          },
          success: function success(ajaxData) {
            self.isTitlesReceived = true;
            self.model.set("options", ajaxData);
            self.render();
          },
        });
      },
      addControlSpinner: function addControlSpinner() {
        this.ui.select.prop("disabled", true);
        this.$el
          .find(".elementor-control-title")
          .after(
            '<span class="elementor-control-spinner">&nbsp;<i class="eicon-spinner eicon-animation-spin"></i>&nbsp;</span>'
          );
      },

      onReady: function onReady() {
        // Safari takes it's time to get the original select width
        setTimeout(WpUlikeControlSelect2.prototype.onReady.bind(this));

        if (!this.isTitlesReceived) {
          this.getValueTitles();
        }
      },
    });
    elementor.addControlView("wp-ulike-query", ControlQueryPostsItemView);
  });
})(jQuery, window, document);
