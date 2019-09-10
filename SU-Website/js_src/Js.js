$(document).ready(function () {

  $(document).on("click", '.fa-search', function (event) {
    $("#search").toggle(800);
    $(".social-icons").fadeOut(800);
    $(".fa-times.back").toggle(500);
    $(".fa-search.type").toggle(500);
  });

  $(document).on("click", ".fa-times.back", function (event) {
    $("#search").toggle(800);
    $(".social-icons").fadeIn(800);
    $(".fa-times.back").toggle(500);
    $(".fa-search.type").toggle(500);
  });

  $(".alert-wrapper").hide();

  $("#s-form").submit(function (event) {
    
    $(".alert-wrapper").show();
  });

  $("#chars , #chars-text").hide();

  var maxLength = 500;
  $('textarea').keyup(function () {
    $("#chars , #chars-text").show();
    var length = $(this).val().length;
    var length = maxLength - length;
    $('#chars').text(length);
  });

  var input = document.getElementById("#search");
  if (input) {
    input.addEventListener("keyup", function (event) {
      event.preventDefault();
      document.getElementById("#search-submit").click();
    });
  }

});








(function ($) {
  $.fn.countTo = function (options) {
    options = options || {};

    return $(this).each(function () {
      var settings = $.extend({}, $.fn.countTo.defaults, {
        from: $(this).data('from'),
        to: $(this).data('to'),
        speed: $(this).data('speed'),
        refreshInterval: $(this).data('refresh-interval'),
        decimals: $(this).data('decimals')
      }, options);

      var loops = Math.ceil(settings.speed / settings.refreshInterval),
              increment = (settings.to - settings.from) / loops;

      var self = this,
              $self = $(this),
              loopCount = 0,
              value = settings.from,
              data = $self.data('countTo') || {};

      $self.data('countTo', data);
      if (data.interval) {
        clearInterval(data.interval);
      }
      data.interval = setInterval(updateTimer, settings.refreshInterval);
      render(value);
      function updateTimer() {
        value += increment;
        loopCount++;
        render(value);
        if (typeof (settings.onUpdate) == 'function') {
          settings.onUpdate.call(self, value);
        }
        if (loopCount >= loops) {
          // remove the interval
          $self.removeData('countTo');
          clearInterval(data.interval);
          value = settings.to;

          if (typeof (settings.onComplete) == 'function') {
            settings.onComplete.call(self, value);
          }
        }
      }
      function render(value) {
        var formattedValue = settings.formatter.call(self, value, settings);
        $self.html(formattedValue);
      }
    });
  };
  $.fn.countTo.defaults = {
    from: 0,
    to: 0,
    speed: 1000,
    refreshInterval: 100,
    decimals: 0,
    formatter: formatter,
    onUpdate: null,
    onComplete: null
  };
  function formatter(value, settings) {
    return value.toFixed(settings.decimals);
  }
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
    formatter: function (value, options) {
      return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
  });
  $('.num').each(count);
  function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
    $this.countTo(options);
  }
});