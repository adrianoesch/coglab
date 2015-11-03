/**
 * Adrian Oesch
 * Oktober 2015
 *
 * adapted from https://groups.google.com/forum/#!topic/jspsych/qP1qV82msm0
 */

jsPsych['fullscreen'] = (function(){

    function launchIntoFullscreen(element) {
      if(element.requestFullscreen) {
        element.requestFullscreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
      } else if(element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }
    };
    function quitFullscreen(element) {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    };

    function addFullScreenSurveillance(response){
      if (!document.webkitIsFullScreen){
        document.addEventListener('webkitfullscreenchange',function(){if(!document.webkitIsFullScreen){
          placeholder(response)
        }},false);
      } else if (!document.mozFullScreen){
        document.addEventListener('mozfullscreenchange',function(){if(!document.webkitIsFullScreen){
          placeholder(response)
        }},false);
      } else if (!document.msFullscreenElement){
        document.addEventListener('MSFullscreenChange',function(){if(!document.webkitIsFullScreen){
          placeholder(response)
        }},false);
      } else if (!document.fullscreenchange){
        document.addEventListener('fullscreenchange',function(){if(!document.webkitIsFullScreen){
          placeholder(response)
        }},false);
      }
    };

    function placeholder(response){
      response.call()
    };

    function removeFullScreenSurveillance(response){
      if (document.webkitIsFullScreen !== null){
        document.removeEventListener('webkitfullscreenchange',placeholder,false);
      } else if (document.mozFullScreen !== null){
        document.removeEventListener('mozfullscreenchange',placeholder(response),false);
      } else if (document.msFullscreenElement !== null){
        document.removeEventListener('MSFullscreenChange',placeholder(response),false);
      } else if (document.fullscreenchange !== null){
        document.removeEventListener('fullscreenchange',placeholder(response),false);
      }
    };

    var plugin = {};

    plugin.create = function(params){
        var trials = [];
        trials[0] = {};
        trials[0].text = params.showtext;
        trials[0].button = params.buttontext;
        trials[0].exit = params.exit || false;
        trials[0].buttonStyle = params.buttonStyle || "";
        trials[0].on_abort = params.on_abort || null;
        return trials;
    }

    plugin.trial = function(display_element, trial){
        display_element.html(trial.text);

        display_element.append("<div style="+trial.buttonStyle+"><button id='jspsych-fullscreen-button'>" + trial.button + "</button></div>");
        $('#jspsych-fullscreen-button').on('click',function(){
            if (!trial.exit) {
              launchIntoFullscreen(document.documentElement);
              if (typeof trial.on_abort !== 'undefined'){
                if (typeof trial.on_abort !== 'function'){
                  console.error('jspsych-fullscreen response parameter is not a function.');
                }else{
                  window.setTimeout(addFullScreenSurveillance(trial.on_abort),10);
                }
              }
            } else {
              quitFullscreen(document.documentElement);
              removeFullScreenSurveillance();
            };
            display_element.html('');
            jsPsych.finishTrial();
        });
    }

    return plugin;
})();
