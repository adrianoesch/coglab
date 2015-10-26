jsPsych['fullscreen'] = (function(){

    var plugin = {};

    plugin.create = function(params){
        var trials = [];

        trials[0] = {};
        trials[0].text = params.showtext;
        trials[0].button = params.buttontext;
        trials[0].exit = params.exit || false;
        trials[0].buttonStyle = params.buttonStyle || "";

        return trials;
    }



    plugin.trial = function(display_element, trial){
        display_element.html(trial.text);

        display_element.append("<div style="+trial.buttonStyle+"><button id='jspsych-fullscreen-button'>" + trial.button + "</button></div>");
        $('#jspsych-fullscreen-button').on('click',function(){
            if (!trial.exit) { launchIntoFullscreen(document.documentElement); }
            else { quitFullscreen(document.documentElement);}
            display_element.html('');
            jsPsych.finishTrial();
        });
    }

    return plugin;
})();

function launchIntoFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }}
function quitFullscreen(element) {
  if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }}
