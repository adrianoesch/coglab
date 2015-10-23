/**
 * Adrian Oesch
 * Oktober 2015
 *
 * this plugin stores the given variables from the URL in the data object.
 *
 */
jsPsych['save-get-vars'] = (function(){

  var plugin = {};
  var $_GET = {};
  alert($_GET['id'])

  if(document.location.toString().indexOf('?') !== -1) {
        var query = document.location
                       .toString()
                       // get the query string
                       .replace(/^.*?\?/, '')
                       // and remove any existing hash string (thanks, @vrijdenker)
                       .replace(/#.*$/, '')
                       .split('&');

        for(var i=0, l=query.length; i<l; i++) {
           var aux = decodeURIComponent(query[i]).split('=');
           $_GET[aux[0]] = aux[1];
        }
    }

  plugin.create = function(params){
    var trials = new Array();
    for (i=0;i<params.vars.length;i++){
      trials[i] = {};
      trials[i].var=$_GET[params.vars[i]]
      trials[i].data = (typeof params.data === 'undefined') ? {} : params.data[i];
    }

    return trials;
  }

  plugin.trial = function(display_element, trial){
    // url = location.href
    // a = url.replace(/[?&]+([^=&]+)=([^&]*)/gi,trial.var)
    // alert(a)

    trial_data = {
      'id': trial.var
    };
    // jsPsych.data.write(trial_data);
    jsPsych.finishTrial();
  }

  return plugin;

})();
