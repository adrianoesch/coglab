<!doctype html>
<html>
    <head>
        <title>My experiment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../jsPsych-4.3/jspsych.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-text.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-single-stim.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-fullscreen.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-response-table.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-save-get-vars.js"></script>
        <link href="../jsPsych-4.3/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
    </body>
    <script>
      // settings
      var url = document.location.toString();
      var experiment_name =  url.split('/')[url.split('/').length-1].split('.')[0];

      // prepare structures
        /* define welcome message block */
        var welcome_block = {
          type: "text",
          text: "Welcome to the experiment. Press any key to begin."
        };

        /* define instructions block */
        var instructions_block = {
          type: "text",
          text: "<p>Bli bla blo blu ...</p>",
          timing_post_trial: 2000
        };

        /* prepare words block */
        var words = ['eins','zwei','drei','vier','fuenf','sechs','sieben','acht','neun','zehn','elf','zwoelf','dreizehn','vierzehn','fuenfzehn'];
        var colors = ['blue','blue','blue','blue','blue','red','red','red','red','red'];
        var color_dic = {'red':'#FF0000','blue':'#0000FF'}

        var words_shuffled = words.slice(0,10)
        var words_shuffled = words_shuffled.sort(function() { return(0.5-Math.random())})
        var colors_shuffled = colors.sort(function() { return(0.5-Math.random())})

        html_words = [];
        for(i=0;i<10;i++){
          html_words.push("<p style='color:"+
          color_dic[colors_shuffled[i]]+";'>"+
          words_shuffled[i]+"</p>")
        }

        var word_presentation = {
            type: 'single-stim',
            stimuli: html_words,
            is_html: true,
            timing_response: 2000,
            response_ends_trial: false
        }

        words_shuffled2 = words.sort(function() { return(0.5-Math.random())})

        var response_block = {
          type : "response-table",
          words : words_shuffled2,
          rows : 3,
          cols : 5
        }

        var activate_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">Welcome</p><p>Please click ok to enter full screen mode and enter the experiment.',
            buttontext: "OK"
        }

        var end_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">Exit fullscreen-mode',
            buttontext: "OK",
            exit: true
          }


          function saveData(filedata){
           $.ajax({
              type: 'post',
              cache: false,
              url: '../store.php', // this is the path to the above PHP script
              data: {filename: filename, filedata: filedata, subjectID: subjectID, folder: experiment_name}
           });
          }


        var save_get_block = {
            type: 'save-get-vars',
            all: "True"
          }

        /* create experiment definition array */
        var experiment = [];
        experiment.push(save_get_block);
        experiment.push(activate_fullscreen);
        experiment.push(instructions_block);
        experiment.push(word_presentation);
        experiment.push(response_block);
        experiment.push(end_fullscreen);


        /* start the experiment */
        jsPsych.init({
          experiment_structure: experiment,
          on_finish: function(data){ saveData(jsPsych.data.dataAsCSV()) }
          // on_finish: function() {jsPsych.data.displayData('JSON')}
        });
      </script>
</html>
