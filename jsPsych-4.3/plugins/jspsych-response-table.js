/**
 * Adrian Oesch
 * Oktober 2015
 *
 *
 */
 jsPsych['response-table'] = (function(){

   var plugin = {};

   plugin.create = function(params) {
     var trials = new Array();
     trials[0] = {};
     trials[0].type = "response-table";
     trials[0].words = params.words
     trials[0].rows = params.rows
     trials[0].cols = params.cols
     // supporting the generic data object with the following line
     // is always a good idea. it allows people to pass in the data
     // parameter, but if they don't it gracefully adds an empty object
     // in it's place.
     trials[0].data = (typeof params.data === 'undefined') ? {} : params.data[i];
     return trials;
   };

   plugin.trial = function(display_element, trial){
    //  prepare html table
     response_table = "<table id='response_table'>"
     row = 'A'
     rows = trial.rows
     cols = trial.cols
     idx=0
     for (i=0;i<rows;i++){
       response_table = response_table.concat('<tr>')
       for(j=0;j<cols;j++){
         tdStr = "<td class='teAc' id='"+row+(j+1).toString()+"'>"+words_shuffled2[idx]+"</td>"
         response_table = response_table.concat(tdStr)
         idx+=1
       }
       response_table = response_table.concat('</tr>')
       row = String.fromCharCode(row.charCodeAt(0)+1)
     }
     response_table = response_table.concat("</table>")

     // prepare end function
     var endTrial = function(){
       trial_data = {
         "rt": JSON.stringify(responseTimes),
         "location": JSON.stringify(responseLocation),
         "content": JSON.stringify(responseContent)
       };
       jsPsych.data.write(trial_data);
       // clear the display
       display_element.html('');
       // move on to the next trial
       jsPsych.finishTrial();
     }

     //  prepare response arrays
     responseTimes = [];
     responseLocation = [];
     responseContent = [];

    //  show table
     display_element.html(response_table);
     $(".teAc").mouseenter(function(){$(this).css("background", "rgb(180,180,180)")});
     $(".teAc").mouseleave(function(){$(this).css("background", "")});

    // and start listening and recording
     idx = 0;
     t0 = Date.now();
     $(".teAc").click(function(event){
       t1 = Date.now();
       if (event.target.className=='teIn'){return};
       responseTimes.push(t1-t0);
       responseContent.push(event.target.textContent);
       responseLocation.push(event.target.id);
       t0=t1;
       $(event.target).removeClass('teAc').addClass('teIn').prop('onclick',null).off('click');
       $(event.target).unbind('mouseenter mouseleave');
       $(event.target).css("background-color", "rgb(180,180,180)");
       if (idx==rows*cols-1){endTrial()}
       idx+=1;
     });
  }

  return plugin;
})();
