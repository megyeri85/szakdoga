/*
 | -------------------------------------------------------------------------------------------------
 |  myAccordion v1.0 - jQuery plugin
 |
 |  Written by István Völgyi (info@s4d.hu)
 |  Date: 2011/05/11 (Tuesday, 11 May 2011)
 |  http://www.s4d.hu/plugin/myAccordion/
 |
 |  Copyright (c) 2011 István Völgyi (S4 Design - http://www.s4d.hu)
 |  Dual licensed under the MIT and GPL licenses:
 |    http://www.opensource.org/licenses/mit-license.php
 |    http://www.gnu.org/licenses/gpl.html
 |
 |  Built for jQuery library
 |    http://jquery.com
 | -------------------------------------------------------------------------------------------------
*/

;(function($){
  jQuery.fn.myAccordion = function (settings){
    if (settings) $.extend(defaults, settings)
    buttons = $(this).children('[class^=' + defaults.cssButton + ']');
    tButton = '#' + this.attr('id') + ' [class^=' + defaults.cssButton + ']';
    tContent = '#' + this.attr('id') + ' [class^=' + defaults.cssContent + ']';

    init();

    return this.each(function(){
      if (defaults.accordionEvent === 'hover') { $(tButton).hover(function(){ base(obj = $(this)) }) }
      else if (defaults.accordionEvent === 'dblclick') { $(tButton).dblclick(function(){ base(obj = $(this)) }) }
      else { $(tButton).click(function(){ base(obj = $(this)) }) }
    })

  }



  /* -------------------------------------------------------------------------------------------------------------
     FUNCTIONS
  ------------------------------------------------------------------------------------------------------------- */
  /* initialization */
  function init()
  {
    $(tContent).hide();
    if (typeof(defaults.activeElement) === 'number') 
    {
      if (defaults.activeElement > 0) $(buttons[defaults.activeElement - 1]).next().show().prev().addClass(defaults.cssActive)
      else if ((defaults.everActive) && (defaults.accordionType === 'single')) $(buttons[0]).next().show().prev().addClass(defaults.cssActive)
    }
    else
    {
      if (defaults.accordionType === 'multi') { for (i = 0; i < defaults.activeElement.length; i++) $(buttons[defaults.activeElement[i] - 1]).next().show().prev().addClass(defaults.cssActive) }
      else
      {
        defaults.accordionType = 'single';
        $(buttons[defaults.activeElement[0] - 1]).next().show().prev().addClass(defaults.cssActive)
      }
    }
  }

  function base(obj)
  {
    if (defaults.accordionType === 'multi')
    {
      if (obj.hasClass(defaults.cssActive)) blockClose(obj, 1)
      else blockOpen(obj, 1)
    }
    else
    {
      if (!obj.hasClass(defaults.cssActive))
      {
        blockClose(obj, 0);
        blockOpen(obj, 1)
      }
      else if (!defaults.everActive) blockClose(obj, 1)
    }
  }

  // open block(s) (opt: [0=all | 1=actual])
  function blockOpen(obj, opt) {
    if (!opt) $(tContent).slideDown(defaults.openDuration, defaults.openEasing).prev().addClass(defaults.cssActive)
    else
    {
      if (defaults.accordionType !== 'multi') if (!obj.hasClass(defaults.cssActive)) blockClose(0)
      obj.next().slideDown(defaults.openDuration, defaults.openEasing).prev().addClass(defaults.cssActive)
    }
  }

  // close block(s) (opt: [0=all | 1=actual])
  function blockClose(obj, opt)
  {
    if (!opt) $(tContent).slideUp(defaults.closeDuration, defaults.closeEasing).prev().removeClass(defaults.cssActive)
    else
    {
      obj.next().slideUp(defaults.closeDuration, defaults.closeEasing);
      obj.removeClass(defaults.cssActive)
    }
  }

  // open/close all blocks (opt: [0=open all | 1=close all])
  function blockAll (opt){
    if (defaults.accordionType === 'multi')
    {
      if (opt) blockClose(0)
      else blockOpen(0)
    }
  }



  /* -------------------------------------------------------------------------------------------------------------
     PUBLIC METHODS
  ------------------------------------------------------------------------------------------------------------- */
  $.myAccordion = {};

  /* close bock(s) */
  $.myAccordion.blockClose = function (blockIndex){
    if ((typeof(blockIndex) === 'number') && (defaults.accordionType === 'multi'))blockClose($(buttons[blockIndex - 1]), 1)
    else if (defaults.accordionType === 'multi') for (i = 0; i < blockIndex.length; i++) blockClose($(buttons[blockIndex[i] - 1]), 1)
  }

  /* open block(s) */
  $.myAccordion.blockOpen = function (blockIndex){
    if (typeof(blockIndex) === 'number') blockOpen($(buttons[blockIndex - 1]), 1)
    else
    {
      if (defaults.accordionType !== 'multi')
      {
        if (!$(buttons[blockIndex[0] - 1]).hasClass(defaults.cssActive)) blockOpen($(buttons[blockIndex[0] - 1]), 1)
      }
      else for (i = 0; i < blockIndex.length; i++) blockOpen($(buttons[blockIndex[i] - 1]), 1)
    }
  }

  /* open all blocks */
  $.myAccordion.blockOpenAll = function (){ blockAll(0) }

  /* close all blocks */
  $.myAccordion.blockCloseAll = function (){ blockAll(1) }



  /* -------------------------------------------------------------------------------------------------------------
     DEFAULTS
  ------------------------------------------------------------------------------------------------------------- */
  var defaults = {
    cssButton: 'myButton',
    cssContent: 'myContent',
    cssActive: 'myActive',
    openEasing: 'easeOutBounce',  // [all kinds of easing effects]
    openDuration: 500,
    closeEasing: 'easeOutBounce', // [all kinds of easing effects]
    closeDuration: 500,
    activeElement: 0,
    everActive: 0,
    accordionType: 'single',  // [single|multi]
    accordionEvent: 'click' // [click|dblclick|hover]
  }
})(jQuery);