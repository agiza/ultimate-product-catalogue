/*global QUnit:false, module:false, test:false, asyncTest:false, expect:false*/
/*global start:false, stop:false ok:false, equal:false, notEqual:false, deepEqual:false*/
/*global notDeepEqual:false, strictEqual:false, notStrictEqual:false, raises:false*/
(function(jQuery) {

  /*
    ======== A Handy Little QUnit Reference ========
    http://docs.jquery.com/QUnit

    Test methods:
      expect(numAssertions)
      stop(increment)
      start(decrement)
    Test assertions:
      ok(value, [message])
      equal(actual, expected, [message])
      notEqual(actual, expected, [message])
      deepEqual(actual, expected, [message])
      notDeepEqual(actual, expected, [message])
      strictEqual(actual, expected, [message])
      notStrictEqual(actual, expected, [message])
      raises(block, [expected], [message])
  */

  /*module('jQuery#gridster', {
    setup: function() {

      this.el = jQuery('#qunit-fixture').find(".wrapper ul");

    }
  });*/

  // test('is chainable', 1, function() {
  //   // Not a bad test to run on collection methods.
  //   strictEqual(this.el, this.el.gridster(), 'should be chaninable');
  // });

}(jQuery));

var gridster;
jQuery(function(){ //DOM Ready
 
    gridster = jQuery(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [90, 35],
				helper: 'clone',
				autogrow_cols: true,
        resize: {
          	enabled: true
        },
				serialize_params: function ($w, wgd) {
						return {
								element_type: $w.html(),
								element_class: $w.attr("data-elementclass"),
								element_id: $w.attr("data-elementid"),
								col: wgd.col,
              	row: wgd.row,
              	size_x: wgd.size_x,
              	size_y: wgd.size_y
						}
				}
   	}).data('gridster');
		
		jQuery('#gridster-button').on('click', function() {
				var serialized = gridster.serialize();
				var data = 'serialized_product_page='+JSON.stringify(serialized)+'&action=save_serialized_product_page';
				jQuery.post(ajaxurl, data, function(response) {
						/*if (response) {alert("Worked");}
						else {alert("Failed");}*/
				});
		});
});

function UPCP_Page_Builder_UpdateID(textarea) {
		jQuery(textarea).parent().attr("data-elementid", jQuery(textarea).val());
		jQuery('#gridster-button').click();
}

function add_element(element_name, element_class, element_id, x_size, y_size) {
		if (element_class == "text") {gridster.add_widget.apply(gridster, ["<li data-elementclass='"+element_class+"' data-elementid='"+element_id+"'>"+element_name+"<div class='gs-delete-handle' onclick='remove_element(this);'></div><textarea onkeyup='UPCP_Page_Builder_UpdateID(this);' class='upcp-pb-textarea'></textarea></li>", x_size, y_size]);}
		else {gridster.add_widget.apply(gridster, ["<li data-elementclass='"+element_class+"' data-elementid='"+element_id+"'>"+element_name+"<div class='gs-delete-handle' onclick='remove_element(this);'></div></li>", x_size, y_size]);}
		jQuery('#gridster-button').click();
		return false;
}

function remove_element(element) {
		gridster.remove_widget(jQuery(element).parent());
		jQuery('#gridster-button').click();
}