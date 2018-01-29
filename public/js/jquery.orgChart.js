(function($){
	var methods = {
		init : function( options ) {
			settings = $.extend(true, {
				'querySelector': '.column',
				'areaSelector': '.dnd-destination-area'
			}, options);
			
			// イベントセット
			$(settings.querySelector).each(function(idx, obj){
				obj.addEventListener('dragstart', methods["dragstart"], false);
				obj.addEventListener('dragenter', methods["dragenter"], false);
				obj.addEventListener('dragleave', methods["dragleave"], false);
				obj.addEventListener('dragend', methods["dragend"], false);
			});
			$(settings.areaSelector).each(function(idx, obj){
				obj.addEventListener('dragover', methods["dragover"], false);
				obj.addEventListener('drop', methods["drop"], false);
			});
		},
		dragstart: function(e) {
			$(this).css("opacity", "0.4");
		},
		dragenter: function(e) {
			// this / e.target is the current hover target.
			$(this).addClass("over");
		},
		dragover:  function(e) {
			if (e.preventDefault) {
				e.preventDefault(); // Necessary. Allows us to drop.
			}
			e.dataTransfer.effectAllowed = 'copy';
			e.dataTransfer.dropEffect = 'copy';
			return false;
		},
		dragleave: function(e) {
			// this / e.target is previous target element.
			$(this).addClass("over");
		},
		drop: function(e) {
			// this / e.target is current target element.
			if (e.stopPropagation) {
			  e.stopPropagation(); // stops the browser from redirecting.
			}
			// See the section on the DataTransfer object.
			return false;
		},
		dragend: function(e) {
			// this/e.target is the source node.
			$(settings.querySelector).each(function(idx, obj){
				$(obj).removeClass("over");
				$(obj).css("opacity", "1");
			});
		}
	};

	$.fn.orgChart = function( method ) {
		if ( methods[method] ) {
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
		}
	};
})(jQuery)
