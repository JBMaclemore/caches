(function ($) {
	"use strict";

	$(document).ready(function () {

		$('.select-kb-top').on('change', function() {
			javascript:location.href = "admin.php?page=betterdocs-admin&knowledgebase=" + this.value;
		});

		let ia_color_settings = [
			{
				id: "#ia_accent_color",
				settings: [
					{
						selector:
							".betterdocs-conversation-container, .betterdocs-footer-wrapper, .betterdocs-launcher, .betterdocs-ask-wrapper .betterdocs-ask-submit",
						property: "background-color",
					},
					{
						selector:
							".betterdocs-footer-wrapper .bd-ia-feedback-wrap, .betterdocs-footer-wrapper .bd-ia-feedback-response",
						property: "background-color",
					},
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-header .inner-container.betterdocs-active-answer .toggle:first-of-type > p, .betterdocs-header-wrapper .betterdocs-header .inner-container.betterdocs-active-ask .toggle:last-of-type > p",
						property: "color",
					},
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-header .inner-container.betterdocs-active-answer .toggle:first-of-type svg, .betterdocs-header-wrapper .betterdocs-header .inner-container.betterdocs-active-ask .toggle:last-of-type svg",
						property: "fill",
					},
				],
			},
			{
				id: "#ia_sub_accent_color",
				settings: [
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-header .inner-container, .betterdocs-footer-wrapper .betterdocs-footer-emo > div",
						property: "background-color",
					},
				],
			},
			{
				id: "#ia_heading_color",
				settings: [
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ans-header > h3, .betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ask-header > h3",
						property: "color",
					},
				],
			},
			{
				id: "#ia_heading_font_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ans-header > h3, .betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ask-header > h3",
						property: "font-size",
					},
				],
			},
			{
				id: "#ia_sub_heading_color",
				settings: [
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ans-header > p, .betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ask-header > p",
						property: "color",
					},
				],
			},
			{
				id: "#ia_sub_heading_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ans-header > p, .betterdocs-header-wrapper .betterdocs-sub-header.betterdocs-ask-header > p",
						property: "font-size",
					},
				],
			},
			{
				id: "#ia_searchbox_bg",
				settings: [
					{
						selector:
							".betterdocs-tab-content-wrapper .bdc-search-box, .betterdocs-tab-content-wrapper .bdc-search-box .search-button, .betterdocs-tab-content-wrapper .bdc-search-box input",
						property: "background-color",
					},
				],
			},
			{
				id: "#ia_searchbox_text",
				settings: [
					{
						selector:
							".betterdocs-tab-content-wrapper .bdc-search-box input",
						property: "color",
					},
				],
			},
			{
				id: "#ia_searchbox_icon_color",
				settings: [
					{
						selector:
							".betterdocs-tab-content-wrapper .bdc-search-box .search-button svg",
						property: "fill",
					},
				],
			},
			{
				id: "#iac_article_bg",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-card-link",
						property: "background-color",
					},
				],
			},
			{
				id: "#iac_article_title",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-card-link .betterdocs-card-title-wrapper .betterdocs-card-title",
						property: "color",
					},
				],
			},
			{
				id: "#iac_article_title_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-card-link .betterdocs-card-title-wrapper .betterdocs-card-title",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-card-link .betterdocs-card-body-wrapper .betterdocs-card-body",
						property: "color",
					},
				],
			},
			{
				id: "#iac_article_content_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-card-link .betterdocs-card-body-wrapper .betterdocs-card-body",
						property: "font-size",
					},
				],
			},
			{
				id: "#ia_feedback_title_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .betterdocs-footer-label p",
						property: "font-size",
					},
				],
			},
			{
				id: "#ia_feedback_title_color",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .betterdocs-footer-label p",
						property: "color",
					},
				],
			},
			{
				id: "#ia_feedback_icon_color",
				settings: [
					{
						selector: ".betterdocs-footer-wrapper .betterdocs-emo",
						property: "fill",
					},
				],
			},
			{
				id: "#ia_feedback_icon_size",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .betterdocs-footer-emo > div",
						property: "width",
						multiple: 2,
					},
					{
						selector:
							".betterdocs-footer-wrapper .betterdocs-footer-emo > div",
						property: "height",
						multiple: 2,
					},
					{
						selector: ".betterdocs-footer-wrapper .betterdocs-emo",
						property: "width",
					},
					{
						selector: ".betterdocs-footer-wrapper .betterdocs-emo",
						property: "height",
					},
				],
			},
			{
				id: "#ia_response_icon_size",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .bd-ia-feedback-response .feedback-success-icon",
						property: "width",
					},
				],
			},
			{
				id: "#ia_response_icon_color",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .bd-ia-feedback-response .feedback-success-icon",
						property: "fill",
					},
				],
			},
			{
				id: "#ia_response_title_size",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .bd-ia-feedback-response .feedback-success-title",
						property: "font-size",
					},
				],
			},
			{
				id: "#ia_response_title_color",
				settings: [
					{
						selector:
							".betterdocs-footer-wrapper .bd-ia-feedback-response .feedback-success-title",
						property: "color",
					},
				],
			},
			{
				id: "#ia_ask_bg_color",
				settings: [
					{
						selector:
							'.betterdocs-tab-ask .betterdocs-ask-wrapper input[type="text"], .betterdocs-tab-ask .betterdocs-ask-wrapper input[type="email"], .betterdocs-tab-ask .betterdocs-ask-wrapper textarea',
						property: "background-color",
					},
					{
						selector:
							".betterdocs-ask-wrapper .betterdocs-ask-submit",
						property: "background-color",
					},
				],
			},
			{
				id: "#ia_ask_input_foreground",
				settings: [
					{
						selector:
							'.betterdocs-ask-wrapper input:not([type="submit"]), .betterdocs-ask-wrapper textarea, .betterdocs-ask-wrapper .betterdocs-attach-button',
						property: "color",
					},
					{
						selector:
							".betterdocs-ask-wrapper .betterdocs-attach-button",
						property: "fill",
					},
				],
			},
			{
				id: "#ia_luncher_bg",
				settings: [
					{
						selector:
							".betterdocs-launcher[type=button], .betterdocs-launcher[type=button]:focus",
						property: "background-color",
					},
				],
			},
			{
				id: "#ia_luncher_bg_hover",
				settings: [
					{
						selector: ".betterdocs-widget-container .betterdocs-launcher[type=button]:hover",
						property: "background-color",
					},
				],
			},
			{
				id: "#iac_docs_title_font_size",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-modal-content-container .betterdocs-entry-title",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h1",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h1",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h2",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h2",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h3",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h3",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h4",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h4",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h5",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h5",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_h6",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content h6",
						property: "font-size",
					},
				],
			},
			{
				id: "#iac_article_content_p",
				event: "keyup",
				suffix: "px",
				settings: [
					{
						selector:
							".betterdocs-messages-container .betterdocs-modal-wrapper .betterdocs-modal-content-container .betterdocs-ia-content p",
						property: "font-size",
					},
				],
			},
		];

		ia_color_settings.map(function (item, i) {
			var suffix = item.suffix != undefined ? item.suffix : "",
				event = item.event != undefined ? item.event : "change";

			$(item.id).on(event, function (e) {
				var value = e.currentTarget.value,
					isMultiplied = true;
				item.settings.map(function (single, j) {
					var multiple =
						single.multiple != undefined ? single.multiple : 1;

					if (multiple === 1) {
						value = e.currentTarget.value;
					}

					if (suffix === "px" && isMultiplied) {
						value = value * multiple;
						isMultiplied = false;
					}

					$(single.selector).css(single.property, value + suffix);
				});
			});
		});

		var copyCross = new ClipboardJS(".betterdocs-copy-button");
		copyCross.on("success", function (e) {
			e.trigger.innerText = "Copied";
			e.clearSelection(),
				$(e.trigger).addClass("copied"),
				setTimeout(function () {
					e.trigger.innerText = "Copy Snippet";
				}, 1000);
		});

		// drag and drop sortalbe knowledge base
		const kb_index =
			parseInt(docs_cat_ordering_data.paged) > 0
				? (parseInt(docs_cat_ordering_data.paged) - 1) *
				  parseInt($("#" + docs_cat_ordering_data.per_page_id).val())
				: 0;
		const kb_table = $(".taxonomy-knowledge_base #the-list");

		if (kb_table.length > 0) {
			// If the tax table contains items.
			if (!kb_table.find("tr:first-child").hasClass("no-items")) {
				kb_table.sortable({
					placeholder: "betterdocs-drag-drop-kb-tax-placeholder",
					axis: "y",

					// On start, set a height for the placeholder to prevent table jumps.
					start: function (event, ui) {
						const item = $(ui.item[0]);
						const index = item.index();
						$(".betterdocs-drag-drop-kb-tax-placeholder").css(
							"height",
							item.css("height")
						);
					},
					// Update callback.
					update: function (event, ui) {
						const item = $(ui.item[0]);

						const kb_ordering_data = [];

						kb_table
							.find("tr.ui-sortable-handle")
							.each(function () {
								const ele = $(this);
								const term_data = {
									term_id: ele.attr("id").replace("tag-", ""),
									order: parseInt(ele.index()) + 1,
								};
								kb_ordering_data.push(term_data);
							});

						// AJAX Data.
						const data = {
							action: "update_knowledge_base_order",
							kb_ordering_data: kb_ordering_data,
							kb_index: kb_index,
							knowledge_base_order_nonce:
								docs_cat_ordering_data.knowledge_base_order_nonce,
						};

						// Run the ajax request.
						$.ajax({
							type: "POST",
							url: docs_cat_ordering_data.ajaxurl,
							data: data,
							dataType: "JSON",
						});
					},
				});
			}
		}

		$('#betterdocs-meta-reporting_frequency .betterdocs-field-description').hide();
		var reporting_frequency = $('#reporting_frequency').attr("data-value");
        if (reporting_frequency == 'betterdocs_monthly' ) {
            $('#betterdocs-meta-reporting_frequency .betterdocs-field-description').show(); 
        }

        $('#reporting_frequency').on('select2:select', function (e) {
            var data = e.params.data.id;
            if(data === 'betterdocs_monthly') {
                $('#betterdocs-meta-reporting_frequency .betterdocs-field-description').show();
            } else {
                $('#betterdocs-meta-reporting_frequency .betterdocs-field-description').hide(); 
            }
        });

		// Disable tabs condition for IA
		var chatTab = $("#chat_tab_visibility_switch"),
			ansTab = $("#answer_tab_visibility_switch"),
			chatTabDependency = [
				"chat_tab_icon",
				"chat_tab_title",
				"chat_subtitle_one",
				"chat_subtitle_two",
			],
			ansTabDependency = [
				"answer_tab_icon",
				"answer_tab_title",
				"answer_tab_subtitle",
			];

		chatTab.prop("checked") === true && ansTab.prop("checked") === true
			? ansTab.prop("checked", false)
			: null;

		ansTab.on("click", function () {
			if (
				chatTab.prop("checked") === true &&
				$(this).prop("checked") === true
			) {
				chatTab.prop("checked", false);

				chatTabDependency.map(function (handle) {
					$("#betterdocs-meta-" + handle).css("display", "table-row");
				});
			}
		});

		chatTab.on("click", function () {
			if (
				ansTab.prop("checked") === true &&
				$(this).prop("checked") === true
			) {
				ansTab.prop("checked", false);

				ansTabDependency.map(function (handle) {
					$("#betterdocs-meta-" + handle).css("display", "table-row");
				});
			}
		});
	});
})(jQuery);
