// You will need to feed in the ajax endpoint of Wordpress
// somehow, possibly as an element attribute See the readme.
//
/*global window, jQuery */
(function (window, $) {
  "use strict";
  
  function tweets() {
    var $self = $(this),
        url = $self.data('anta');
    
    if (typeof url === 'undefined' || url.length === 0) {
      return;
    }
    
    markAsLoading($self);
    
    // add loader
    $.getJSON(url)
    .done(function (data) {
      $.each(data, function (index, value) {
        var txt = window.twttr.txt.autoLink(value.text, value.entities);
        $self.append('<article class="tweet">' + txt + '</article>');
      })
    })
    .fail(function () {
      $self.append('<p class="error">' + 'We are sorry, we could not fetch the tweets. Please try again.' + '</p>');
    })
    .always(function () {
      // remove loader
      markAsNotLoading($self);
    });
  }
  
  
  
  function markAsLoading($el) {
    $el.addClass('is-loading');
  }
  
  function markAsNotLoading($el) {
    $el.removeClass('is-loading');
  }
  
  $.fn.twitify = function() {
    return this.each(tweets);
  }
  
  
  
  
  
  
}(window, jQuery));

/**
 * Use the above, for example, like this
 *
 *   $(function () {
 *    $('#tweets').twitify();
 *   });
 */
