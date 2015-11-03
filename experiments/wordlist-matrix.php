<!doctype html>
<html>
    <head>
        <title>Coglab Experiment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../jsPsych-4.3/jspsych.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-text.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-single-stim.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-wordlist.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-fullscreen.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-response-table.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-save-get-vars.js"></script>
        <script src="./words.js"></script>
        <link href="../jsPsych-4.3/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
    </body>
    <script>
      // settings
      var url = document.location.toString();
      var experiment_name =  url.split('/')[url.split('/').length-1].split('.')[0];
      var subjectID = 'hans_wurst';


      wordlistShuffled = jsPsych.randomization.sample(wordlistItems,250,true);

      // prepare structures
      var activate_fullscreen = {
          type: 'fullscreen',
          showtext: '<p style="padding-top: 50px; text-align: center;">Welcome <br><br> Please continue to enter into full screen mode.<br><br>',
          buttonStyle : 'float:right;',
          buttontext: "Enter",
          on_abort: function(){
            $('body').html('')
            alert('You were not supposed to end fullscreen mode. This session is now aborted.');
            jsPsych.finishTrial();
            jsPsych.endExperiment();
        }
      }
        /* define instructions block */
        var instructions_block = {
          type: "text",
          text: "<p style='text-align:center;'>Bli bla blo blu ... Press a key.</p>",
          timing_post_trial: 2000
        };

        /* prepare word blocks */

        var screen_width = screen.width;
        var screen_height = screen.height;
        var centerX = screen_width*0.5
        var centerY = screen_height*0.5
        var fullScreenDiv_style = "position:absolute;left:0;top:0;height:"+screen_height+"px;width:"+screen_width+"px;";
        var crossTable =  "<table align='center' style='margin-top:"+(centerY-120)+"px;text-align:center;font-weight:bold;font-size:100px;border-collapse:collapse;'>"+
                          "<tr><td style='height:100px;width:100px;border-right:4px solid black;border-bottom:4px solid black;'/>"+
                          "<td style='height:100px;width:100px;border-left:4px solid black;border-bottom:4px solid black;'/></tr>"+
                          "<tr><td style='height:100px;width:100px;border-right:4px solid black;border-top:4px solid black;'/>"+
                          "<td style='height:100px;width:100px;border-left:4px solid black;border-top:4px solid black;'/></tr></table>";
        var centeredCross = "<div style='"+fullScreenDiv_style+"'>"+crossTable+"</div>"

        var cross_center = {
            type: 'single-stim',
            stimuli: centeredCross,
            is_html: true,
            timing_post_trial: 0,
            timing_stim: 500,
            timing_response: 500,
            response_ends_trial: false
        }
        var empty_block = {
            type: 'single-stim',
            stimuli: '',
            is_html: true,
            timing_post_trial: 0,
            timing_stim: 500,
            timing_response: 500,
            response_ends_trial: false
        }

        function randomColors(){
          var colors = ['blue','blue','blue','blue','blue','red','red','red','red','red'];
          var colorsShuffled = colors.sort(function() { return 0.5-Math.random() });
          return colorsShuffled
        }
        function getRandomWordlistSample(N,option){
          sample = jsPsych.randomization.sample(wordlistItems,N,true)
          if(typeof option === "undefined") {
            return sample
          }else{
            newSample = []
            for(i=0;i<N;i++){
              newSample.push(sample[i][option])
            }
            return newSample
          }
        }
        var items_func = function(){return getRandomWordlistSample(10)};
        var colors_func = function(){return randomColors()};

        var word_presentation = {
            type: 'wordlist',
            items: items_func,
            colors: colors_func,
            style: "margin-top:"+(centerY-50)+"px;text-align:center;"+
                          "font-weight:bold;font-size:100px;",
            timing_stim: 50,
            timing_response: 50,
            timing_post_trial: 50,
            response_ends_trial: false,
            evaluate_block: true
        }

        function getPreviousTenWords(){
            lastTrials = jsPsych.data.getTrialsOfType('wordlist')
            keys = Object.keys(lastTrials[0])
            if (keys.indexOf('text') == -1){
              return
            }
            lastTenTrials = lastTrials.slice(lastTrials.length-10,lastTrials.length)
            lastTenTrialsTexts = []
            for (i=0;i<10;i++){
              lastTenTrialsTexts.push(lastTenTrials[i].text)
            }
            return lastTenTrialsTexts
        }

        function sameElementInArrays(array1,array2){
          b = false
          for (i=0;i<array1.length;i++){
            if ( array2.indexOf(array1[i]) > -1){
              b = true
              break
            }
          }
          return(b)
        };

        var response_words = function getResponseSet(wordlistItems){
            var preWords = getPreviousTenWords();
            if (typeof preWords =="undefined"){
              preWords = getRandomWordlistSample(1,'text')
            }
            while(true){
              newSample = getRandomWordlistSample(5,'text');
              if(!sameElementInArrays(newSample,preWords)){
                break;
              }
            }
            var sample = preWords.concat(newSample);
            var sample = sample.sort(function() { return(0.5-Math.random())});
            return sample;
        }

        var response_table = {
          type : "response-table",
          words : response_words,
          rows : 3,
          cols : 5,
          tdStyle : "height:80px;width:150px;font-size:25px;padding:15px;text-align:center;",
          tableStyle: "margin-top:200px;"
        }

        var end_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">Thank you for participating!<br><br> Please save your responses before you close the window.',
            buttonStyle : 'float:right;',
            buttontext: "Save & Exit",
            exit: true
          }


          function saveData(subjectID,experiment_name,dataAsCSV,dataAsJSON){
           $.ajax({
              type: 'post',
              cache: false,
              url: '../store.php', // this is the path to the above PHP script
              data: {subjectID: subjectID, folder: experiment_name, dataAsCSV: dataAsCSV, dataAsJSON: dataAsJSON}
           });
          }


        var save_get_block = {
            type: 'save-get-vars',
            all: true
          }

        var chunkIdx=0;
        var chunk = {
            chunk_type: 'while',
            timeline: [cross_center, word_presentation, response_table, empty_block],
            // timeline: [ word_presentation, response_table],
            continue_function: function(){
            if (chunkIdx==3){
              return false
            }else{
              chunkIdx+=1
              return true
            }
          }
        };

        /* create experiment definition array */
        var experiment = [];
        experiment.push(save_get_block);
        experiment.push(activate_fullscreen);
        experiment.push(instructions_block);
        experiment.push(chunk);
        experiment.push(end_fullscreen);



        /* start the experiment */
        jsPsych.init({
          experiment_structure: experiment,
          // on_finish: function(data){ saveData(subjectID,experiment_name, jsPsych.data.dataAsCSV(), jsPsych.data.dataAsJSON()) }
          on_finish: function() {jsPsych.data.displayData('JSON')}
        });
      </script>
</html>
