(function ($) {
  'use strict';
  $(document).ready(function () {
    // Create a link to remove the keyword filter.
    // match column heights
    $('.listwrapper img').each(function () {
      var highestBox = $('.listwrapper img').height();
      $(this).height(highestBox);
    });
    $('.pane-menu-menu-information ul li.expanded').wrapInner('<div class="li-wrapper"></div>');
    $('body.page-availabletechnologies #search-block-form').clone().addClass('at-search').insertBefore('h2.pane-title');
    $('<h2 class="text-left">Search</h2>').insertBefore('.at-search');
    $('<h2 class="text-left">Browse</h2>').insertAfter('body.page-availabletechnologies .pane-available-technologies .pane-title');

    //  prevent first level menu in information panel from being link
    $('.pane-menu-menu-information a.active').on('click', function (e) {
      e.preventDefault();
    });

    // social links target blank new window
    $('.follow-us__list-item a').attr('target', '_blank');

    // success stories images into background image of parent
    $('.success-stories__image img').each(function () {
      var thisurl = $(this).attr('src');
      $(this).parent('.success-stories__image').css('background-image', 'url(' + thisurl + ')');
    });

  });
}(jQuery));
