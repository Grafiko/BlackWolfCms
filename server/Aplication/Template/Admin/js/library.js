$.fn.center = function () {
    this.css("position","absolute");
    this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
    return this;
}

$.fn.centerElements = function () {
   var width = 0;
   $(this).children().each(function(i) {
      if($(this).css('display') != 'none') {
         width = width + $(this).outerWidth(true);
      }
   });
   $(this).css({ marginLeft: ($(this).width() - width)/2+'px', visibility:'visible' });
}

$(function() {
   jQuery.widget("custom._window", {
      options: {
         title: 255,
         width: 400,
         content: null
      },

      _create: function() {
         this.overlay = $('<div>', {
            'class': 'overlay',
            'css': {opacity:0.7}
         })
         .appendTo($('body'));

         this.element
            .addClass("abs window")
            .width(this.options.width)
            .attr('id', 'window_' + this.options.id)
            .attr('rel', '_window')
         ;

         this.title = $("<div>", {
            text: this.options.title,
            "class": "title"
         })
         .appendTo( this.element );

         this.content = $("<div>", {
            text: "",
            "class": "content"
         })
         .appendTo( this.element );

         this.iframe = $("<iframe style='border:0;' frameborder='0' ALLOWTRANSPARENCY='true' />")
            .addClass('iframe')
            .attr('src', this.options.content);
         
         this.iframe.appendTo( this.content );

         this.element.appendTo($('body'));
         this.element.center();
         var ttt = this.element;
         $(window).resize(function() {
            ttt.center();
         });

         var ttt2 = this.overlay;
         $(window).scroll(function() {
            $(ttt2).height($(document).height());
            ttt.center();
         });
         $(ttt2).height($(document).height());

         this._load();
      },

      _load: function() {
         //this.iframe.attr('src', this.options.content);
         var fr = this.iframe;
         //console.log($(fr, '>document').height())
         $(this.iframe, '>document').resize(function() {
            //console.log($(fr, '>window').height())
         });
      },

      _refresh: function() {
         this._refresh();
      },

      destroy: function() {   
         $.Widget.prototype.destroy.call( this );
         this.element.remove();
         this.overlay.remove();
      },

      // _setOptions is called with a hash of all options that are changing
      // always refresh when changing options
      _setOptions: function() {
         // in 1.9 would use _superApply
         $.Widget.prototype._setOptions.apply( this, arguments );
         this._refresh();
      }
   });
})