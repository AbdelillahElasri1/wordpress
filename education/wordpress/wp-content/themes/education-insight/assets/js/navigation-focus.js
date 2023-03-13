var education_insight_Keyboard_loop = function (elem) {
  var education_insight_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var education_insight_firstTabbable = education_insight_tabbable.first();
  var education_insight_lastTabbable = education_insight_tabbable.last();
  /*set focus on first input*/
  education_insight_firstTabbable.focus();

  /*redirect last tab to first input*/
  education_insight_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
        e.preventDefault();
        education_insight_firstTabbable.focus();
    }
  });

  /*redirect first shift+tab to last input*/
  education_insight_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
        e.preventDefault();
        education_insight_lastTabbable.focus();
    }
  });

  /* allow escape key to close insiders div */
  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
        elem.hide();
    };
  });
};